@extends('frontend.layouts.app')

@section('title', 'Donasi Berhasil Dikirim')

@push('styles')
    <style>
        .success-section {
            min-height: 70vh;
            display: flex;
            align-items: center;
            padding: 70px 0;
        }

        .success-card {
            max-width: 680px;
            margin: auto;
            padding: 40px;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            background: white;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            display: grid;
            place-items: center;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #dcfce7;
            color: #15803d;
            font-size: 38px;
        }

        .success-card h1 {
            margin-bottom: 10px;
        }

        .success-card > p {
            color: #6b7280;
        }

        .invoice-box {
            margin: 28px 0;
            padding: 20px;
            border-radius: 13px;
            background: #f8fafc;
            text-align: left;
        }

        .invoice-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 9px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .invoice-row:last-child {
            border-bottom: none;
        }

        .invoice-row span {
            color: #6b7280;
        }

        .status-badge {
            padding: 5px 9px;
            border-radius: 20px;
            background: #fef3c7;
            color: #92400e;
            font-size: 12px;
            font-weight: 700;
        }

        .success-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
@endpush

@section('content')
    <section class="success-section">
        <div class="container">
            <div class="success-card">
                <div class="success-icon">✓</div>

                <h1>Terima Kasih atas Donasimu</h1>

                <p>
                    @if ($donation->payment_status === 'paid')
                        Pembayaran berhasil diterima. Terima kasih
                        atas bantuan dan kebaikanmu.
                    @elseif (
                        $donation->payment_status === 'waiting_verification'
                    )
                        Bukti pembayaran telah dikirim dan sedang
                        menunggu verifikasi admin.
                    @else
                        Transaksi donasi telah dibuat. Silakan
                        selesaikan pembayaran jika masih pending.
                    @endif
                </p>

                <div class="invoice-box">
                    <div class="invoice-row">
                        <span>Nomor invoice</span>
                        <strong>{{ $donation->invoice_number }}</strong>
                    </div>

                    <div class="invoice-row">
                        <span>Campaign</span>
                        <strong>{{ $donation->campaign->title }}</strong>
                    </div>

                    <div class="invoice-row">
                        <span>Nominal</span>

                        <strong>
                            Rp {{ number_format(
                                $donation->amount,
                                0,
                                ',',
                                '.'
                            ) }}
                        </strong>
                    </div>

                    <div class="invoice-row">
                        <span>Status</span>

                        @switch($donation->payment_status)
                            @case('paid')
                                <strong
                                    class="status-badge"
                                    style="
                                        background: #dcfce7;
                                        color: #166534;
                                    "
                                >
                                    Pembayaran Berhasil
                                </strong>
                                @break

                            @case('waiting_verification')
                                <strong class="status-badge">
                                    Menunggu Verifikasi Admin
                                </strong>
                                @break

                            @case('failed')
                                <strong
                                    class="status-badge"
                                    style="
                                        background: #fee2e2;
                                        color: #991b1b;
                                    "
                                >
                                    Pembayaran Gagal
                                </strong>
                                @break

                            @case('expired')
                                <strong
                                    class="status-badge"
                                    style="
                                        background: #e5e7eb;
                                        color: #4b5563;
                                    "
                                >
                                    Pembayaran Kedaluwarsa
                                </strong>
                                @break

                            @case('cancelled')
                                <strong
                                    class="status-badge"
                                    style="
                                        background: #e5e7eb;
                                        color: #4b5563;
                                    "
                                >
                                    Pembayaran Dibatalkan
                                </strong>
                                @break

                            @default
                                <strong class="status-badge">
                                    Menunggu Pembayaran
                                </strong>
                        @endswitch
                    </div>
                </div>

                <div class="success-actions">
                    <a
                        href="{{ route('home') }}"
                        class="btn btn-outline"
                    >
                        Ke Beranda
                    </a>

                    <a
                        href="{{ route('campaigns.index') }}"
                        class="btn btn-primary"
                    >
                        Campaign Lainnya
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection