<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filters = $this->validateFilters($request);

        $query = $this->buildQuery($filters);

        $statistics = [
            'total_transactions' => (clone $query)->count(),

            'paid_transactions' => (clone $query)
                ->where('payment_status', 'paid')
                ->count(),

            'collected_amount' => (clone $query)
                ->where('payment_status', 'paid')
                ->sum('amount'),

            'pending_transactions' => (clone $query)
                ->whereIn('payment_status', [
                    'pending',
                    'waiting_verification',
                ])
                ->count(),
        ];

        $donations = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $campaigns = Campaign::orderBy('title')->get([
            'id',
            'title',
        ]);

        return view(
            'admin.reports.index',
            compact(
                'donations',
                'campaigns',
                'statistics'
            )
        );
    }

    public function export(Request $request): StreamedResponse
    {
        $filters = $this->validateFilters($request);

        $query = $this->buildQuery($filters)->latest();

        $filename = 'laporan-donasi-' .
            now()->format('Y-m-d-His') .
            '.csv';

        return response()->streamDownload(
            function () use ($query) {
                $file = fopen('php://output', 'w');

                fwrite($file, "\xEF\xBB\xBF");

                fputcsv($file, [
                    'Nomor Invoice',
                    'Tanggal',
                    'Nama Donatur',
                    'Email',
                    'Nomor WhatsApp',
                    'Campaign',
                    'Nominal',
                    'Metode Pembayaran',
                    'Channel Pembayaran',
                    'Status',
                    'Tanggal Pembayaran',
                ], ';');

                $query->chunk(500, function ($donations) use ($file) {
                    foreach ($donations as $donation) {
                        fputcsv($file, [
                            $this->safeCsv(
                                $donation->invoice_number
                            ),

                            $donation->created_at
                                ->format('d/m/Y H:i'),

                            $this->safeCsv(
                                $donation->donor_name
                            ),

                            $this->safeCsv(
                                $donation->donor_email ?? ''
                            ),

                            $this->safeCsv(
                                $donation->donor_phone ?? ''
                            ),

                            $this->safeCsv(
                                $donation->campaign->title
                            ),

                            (int) $donation->amount,

                            $this->paymentMethodLabel(
                                $donation->payment_method
                            ),

                            strtoupper(
                                $donation->payment_channel ?? '-'
                            ),

                            $this->statusLabel(
                                $donation->payment_status
                            ),

                            $donation->paid_at
                                ? $donation->paid_at
                                    ->format('d/m/Y H:i')
                                : '-',
                        ], ';');
                    }
                });

                fclose($file);
            },
            $filename,
            [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]
        );
    }

    private function validateFilters(Request $request): array
    {
        return $request->validate([
            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'campaign_id' => [
                'nullable',
                'integer',
                'exists:campaigns,id',
            ],

            'payment_status' => [
                'nullable',
                Rule::in([
                    'pending',
                    'waiting_verification',
                    'paid',
                    'failed',
                    'expired',
                    'cancelled',
                ]),
            ],
        ], [
            'end_date.after_or_equal' =>
                'Tanggal akhir tidak boleh sebelum tanggal awal.',

            'campaign_id.exists' =>
                'Campaign yang dipilih tidak ditemukan.',

            'payment_status.in' =>
                'Status pembayaran tidak valid.',
        ]);
    }

    private function buildQuery(array $filters): Builder
    {
        return Donation::query()
            ->with('campaign')
            ->when(
                $filters['start_date'] ?? null,
                function ($query, $startDate) {
                    $query->whereDate(
                        'created_at',
                        '>=',
                        $startDate
                    );
                }
            )
            ->when(
                $filters['end_date'] ?? null,
                function ($query, $endDate) {
                    $query->whereDate(
                        'created_at',
                        '<=',
                        $endDate
                    );
                }
            )
            ->when(
                $filters['campaign_id'] ?? null,
                function ($query, $campaignId) {
                    $query->where(
                        'campaign_id',
                        $campaignId
                    );
                }
            )
            ->when(
                $filters['payment_status'] ?? null,
                function ($query, $status) {
                    $query->where(
                        'payment_status',
                        $status
                    );
                }
            );
    }

    private function statusLabel(string $status): string
    {
        return match ($status) {
            'pending' => 'Menunggu Pembayaran',
            'waiting_verification' => 'Menunggu Verifikasi',
            'paid' => 'Berhasil',
            'failed' => 'Gagal/Ditolak',
            'expired' => 'Kedaluwarsa',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($status),
        };
    }

    private function paymentMethodLabel(string $method): string
    {
        return match ($method) {
            'bank_transfer' => 'Transfer Manual',
            'midtrans' => 'Midtrans',
            'qris' => 'QRIS',
            'virtual_account' => 'Virtual Account',
            'ewallet' => 'E-Wallet',
            default => ucfirst($method),
        };
    }

    private function safeCsv(?string $value): string
    {
        $value = $value ?? '';

        if (
            $value !== ''
            && in_array($value[0], ['=', '+', '-', '@'], true)
        ) {
            return "'" . $value;
        }

        return $value;
    }
}