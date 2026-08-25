@extends('frontend.layouts.app')

@section('title', 'Pembayaran Donasi')

@push('styles')
    <style>
        .payment-section {
            min-height: 70vh;
            display: flex;
            align-items: center;
            padding: 70px 0;
        }

        .payment-card {
            max-width: 650px;
            margin: auto;
            padding: 38px;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            background: white;
            text-align: center;
        }

        .payment-icon {
            width: 78px;
            height: 78px;
            display: grid;
            place-items: center;
            margin: 0 auto 19px;
            border-radius: 50%;
            background: #ccfbf1;
            color: #0f766e;
            font-size: 35px;
        }

        .payment-card h1 {
            margin-bottom: 8px;
        }

        .payment-description {
            color: #6b7280;
        }

        .payment-information {
            margin: 27px 0;
            padding: 20px;
            border-radius: 13px;
            background: #f8fafc;
            text-align: left;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 9px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .payment-row:last-child {
            border-bottom: none;
        }

        .payment-row span {
            color: #6b7280;
        }

        .payment-note {
            margin-top: 16px;
            color: #6b7280;
            font-size: 13px;
        }
    </style>
@endpush

@section('content')
    <section class="payment-section">
        <div class="container">
            <div class="payment-card">
                <div class="payment-icon">♥</div>

                <h1>Selesaikan Pembayaran</h1>

                <p class="payment-description">
                    Pilih QRIS, virtual account, atau metode
                    pembayaran lainnya melalui Midtrans.
                </p>

                <div class="payment-information">
                    <div class="payment-row">
                        <span>Nomor invoice</span>

                        <strong>
                            {{ $donation->invoice_number }}
                        </strong>
                    </div>

                    <div class="payment-row">
                        <span>Nama donatur</span>

                        <strong>
                            {{ $donation->donor_name }}
                        </strong>
                    </div>

                    <div class="payment-row">
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
                </div>

                <button
                    type="button"
                    id="payButton"
                    class="btn btn-primary"
                    style="width: 100%;"
                >
                    Pilih Metode Pembayaran
                </button>

                <p class="payment-note">
                    Pembayaran diproses secara aman melalui Midtrans Sandbox.
                </p>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script
        src="{{ config('midtrans.snap_url') }}"
        data-client-key="{{ config('midtrans.client_key') }}"
    ></script>

    <script>
        const payButton = document.getElementById('payButton');

        payButton.addEventListener('click', function () {
            window.snap.pay(
                @json($donation->snap_token),
                {
                    onSuccess: function (result) {
                        window.location.href = @json(
                            route(
                                'donations.success',
                                $donation->invoice_number
                            )
                        );
                    },

                    onPending: function (result) {
                        window.location.href = @json(
                            route(
                                'donations.success',
                                $donation->invoice_number
                            )
                        );
                    },

                    onError: function (result) {
                        alert(
                            'Pembayaran gagal diproses. Silakan coba kembali.'
                        );
                    },

                    onClose: function () {
                        alert(
                            'Kamu menutup pembayaran sebelum transaksi selesai.'
                        );
                    }
                }
            );
        });
    </script>
@endpush