<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $donations = Donation::with('campaign')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where(
                            'invoice_number',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'donor_name',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'donor_email',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'donor_phone',
                            'like',
                            "%{$search}%"
                        );
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('payment_status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.donations.index',
            compact('donations')
        );
    }

    public function show(Donation $donation)
    {
        $donation->load('campaign');

        return view(
            'admin.donations.show',
            compact('donation')
        );
    }

    public function paymentProof(
        Donation $donation
    ): BinaryFileResponse {
        abort_unless(
            $donation->payment_proof,
            404,
            'Bukti pembayaran tidak tersedia.'
        );

        if (
            Storage::disk('local')
                ->exists($donation->payment_proof)
        ) {
            $path = Storage::disk('local')
                ->path($donation->payment_proof);

            return response()->file(
                $path,
                [
                    'Content-Disposition' =>
                        'inline; filename="' .
                        basename($path) .
                        '"',
                ]
            );
        }

        if (
            Storage::disk('public')
                ->exists($donation->payment_proof)
        ) {
            $path = Storage::disk('public')
                ->path($donation->payment_proof);

            return response()->file(
                $path,
                [
                    'Content-Disposition' =>
                        'inline; filename="' .
                        basename($path) .
                        '"',
                ]
            );
        }

        abort(404, 'File bukti pembayaran tidak ditemukan.');
    }

    public function updateStatus(
        Request $request,
        Donation $donation
    ) {
        $validated = $request->validate([
            'payment_status' => [
                'required',
                Rule::in([
                    'waiting_verification',
                    'paid',
                    'failed',
                    'cancelled',
                ]),
            ],
        ], [
            'payment_status.required' => 'Status pembayaran wajib dipilih.',
            'payment_status.in' => 'Status pembayaran tidak valid.',
        ]);

        $donation->update([
            'payment_status' => $validated['payment_status'],

            'paid_at' => $validated['payment_status'] === 'paid'
                ? ($donation->paid_at ?? now())
                : null,
        ]);

        $messages = [
            'waiting_verification' => 'Donasi dikembalikan ke status menunggu verifikasi.',
            'paid' => 'Pembayaran berhasil diverifikasi.',
            'failed' => 'Pembayaran ditandai sebagai gagal atau ditolak.',
            'cancelled' => 'Donasi berhasil dibatalkan.',
        ];

        return redirect()
            ->route('admin.donations.show', $donation)
            ->with(
                'success',
                $messages[$validated['payment_status']]
            );
    }
}