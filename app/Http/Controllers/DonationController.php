<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Throwable;
use App\Models\Setting;

class DonationController extends Controller
{
    public function create(Campaign $campaign)
    {
        abort_unless(
            $campaign->status === 'published',
            404
        );

        $bankAccounts = $this->getBankAccounts();

        return view(
            'frontend.donations.create',
            compact('campaign', 'bankAccounts')
        );
    }

    public function store(
        Request $request,
        Campaign $campaign,
        MidtransService $midtransService
    ) {
        abort_unless(
            $campaign->status === 'published',
            404
        );

        $bankChannels = array_keys(
             $this->getBankAccounts()
        );

        $validated = $request->validate([
            'donor_name' => [
                'required',
                'string',
                'max:100',
            ],

            'donor_email' => [
                'required_if:payment_type,midtrans',
                'nullable',
                'email',
                'max:150',
            ],

            'donor_phone' => [
                'required',
                'string',
                'max:20',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:10000',
            ],

            'message' => [
                'nullable',
                'string',
                'max:500',
            ],

            'is_anonymous' => [
                'nullable',
                'boolean',
            ],

            'payment_type' => [
                'required',
                Rule::in([
                    'manual',
                    'midtrans',
                ]),
            ],

            'payment_channel' => [
                'exclude_unless:payment_type,manual',
                'required',
                Rule::in($bankChannels),
            ],

            'payment_proof' => [
                'exclude_unless:payment_type,manual',
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:3072',
            ],
        ], [
            'donor_name.required' =>
                'Nama donatur wajib diisi.',

            'donor_email.required_if' =>
                'Email wajib diisi untuk pembayaran otomatis.',

            'donor_email.email' =>
                'Format email tidak valid.',

            'donor_phone.required' =>
                'Nomor WhatsApp wajib diisi.',

            'amount.required' =>
                'Nominal donasi wajib diisi.',

            'amount.min' =>
                'Nominal donasi minimal Rp10.000.',

            'payment_type.required' =>
                'Pilih metode pembayaran.',

            'payment_type.in' =>
                'Metode pembayaran tidak valid.',

            'payment_channel.required' =>
                'Pilih rekening tujuan.',

            'payment_channel.in' =>
                'Rekening tujuan tidak valid.',

            'payment_proof.required' =>
                'Bukti pembayaran wajib diunggah.',

            'payment_proof.mimes' =>
                'Bukti pembayaran harus berupa JPG, PNG, WEBP, atau PDF.',

            'payment_proof.max' =>
                'Ukuran bukti pembayaran maksimal 3 MB.',
        ]);

        if ($validated['payment_type'] === 'manual') {
            return $this->storeManualDonation(
                $request,
                $campaign,
                $validated
            );
        }

        return $this->storeMidtransDonation(
            $request,
            $campaign,
            $validated,
            $midtransService
        );
    }

    public function payment(Donation $donation)
    {
        abort_unless(
            $donation->payment_method === 'midtrans'
                && !empty($donation->snap_token),
            404
        );

        if ($donation->payment_status === 'paid') {
            return redirect()->route(
                'donations.success',
                $donation->invoice_number
            );
        }

        return view(
            'frontend.donations.payment',
            compact('donation')
        );
    }

    public function success(Donation $donation)
    {
        $donation->load('campaign');

        return view(
            'frontend.donations.success',
            compact('donation')
        );
    }

    private function storeManualDonation(
        Request $request,
        Campaign $campaign,
        array $validated
    ) {
        $proofPath = $request
            ->file('payment_proof')
            ->store('payment-proofs', 'local');

        $donation = Donation::create([
            'campaign_id' => $campaign->id,
            'invoice_number' => $this->generateInvoiceNumber(),
            'donor_name' => $validated['donor_name'],
            'donor_email' => $validated['donor_email'] ?? null,
            'donor_phone' => $validated['donor_phone'],
            'amount' => $validated['amount'],
            'message' => $validated['message'] ?? null,
            'is_anonymous' => $request->boolean('is_anonymous'),
            'payment_method' => 'bank_transfer',
            'payment_channel' => $validated['payment_channel'],
            'payment_proof' => $proofPath,
            'payment_status' => 'waiting_verification',
        ]);

        return redirect()->route(
            'donations.success',
            $donation->invoice_number
        );
    }

    private function storeMidtransDonation(
        Request $request,
        Campaign $campaign,
        array $validated,
        MidtransService $midtransService
    ) {
        $donation = Donation::create([
            'campaign_id' => $campaign->id,
            'invoice_number' => $this->generateInvoiceNumber(),
            'donor_name' => $validated['donor_name'],
            'donor_email' => $validated['donor_email'],
            'donor_phone' => $validated['donor_phone'],
            'amount' => $validated['amount'],
            'message' => $validated['message'] ?? null,
            'is_anonymous' => $request->boolean('is_anonymous'),
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'payment_expired_at' => now()->addHours(24),
        ]);

        try {
            $donation->load('campaign');

            $transaction = $midtransService
                ->createTransaction($donation);

            $donation->update([
                'snap_token' => $transaction['token'],
                'snap_redirect_url' => $transaction['redirect_url'],
            ]);
        } catch (Throwable $exception) {
            Log::error('Gagal membuat transaksi Midtrans', [
                'invoice' => $donation->invoice_number,
                'message' => $exception->getMessage(),
            ]);

            $donation->delete();

            return back()
                ->withInput()
                ->with(
                    'payment_error',
                    'Transaksi pembayaran otomatis gagal dibuat. Periksa konfigurasi Midtrans atau coba kembali.'
                );
        }

        return redirect()->route(
            'donations.payment',
            $donation->invoice_number
        );
    }

    private function getBankAccounts(): array
    {
        $setting = Setting::first();

        return [
            'bca' => [
                'name' => 'BCA',

                'account_number' =>
                    $setting?->bca_account_number
                    ?: config(
                        'donation.bank_accounts.bca.account_number'
                    ),

                'account_name' =>
                    $setting?->bca_account_name
                    ?: config(
                        'donation.bank_accounts.bca.account_name'
                    ),
            ],

            'bri' => [
                'name' => 'BRI',

                'account_number' =>
                    $setting?->bri_account_number
                    ?: config(
                        'donation.bank_accounts.bri.account_number'
                    ),

                'account_name' =>
                    $setting?->bri_account_name
                    ?: config(
                        'donation.bank_accounts.bri.account_name'
                    ),
            ],

            'mandiri' => [
                'name' => 'Mandiri',

                'account_number' =>
                    $setting?->mandiri_account_number
                    ?: config(
                        'donation.bank_accounts.mandiri.account_number'
                    ),

                'account_name' =>
                    $setting?->mandiri_account_name
                    ?: config(
                        'donation.bank_accounts.mandiri.account_name'
                    ),
            ],
        ];
    }

    private function generateInvoiceNumber(): string
    {
        do {
            $invoice = 'DON-' .
                now()->format('Ymd') .
                '-' .
                Str::upper(Str::random(6));
        } while (
            Donation::where('invoice_number', $invoice)->exists()
        );

        return $invoice;
    }
}