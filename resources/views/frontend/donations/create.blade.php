@extends('frontend.layouts.app')

@section('title', 'Donasi untuk ' . $campaign->title)

@push('styles')
    <style>
        .donation-section {
            padding: 55px 0 80px;
        }

        .donation-grid {
            display: grid;
            align-items: start;
            grid-template-columns: 0.7fr 1.3fr;
            gap: 30px;
        }

        .campaign-summary,
        .donation-form {
            border: 1px solid #e5e7eb;
            border-radius: 17px;
            background: white;
        }

        .campaign-summary {
            position: sticky;
            top: 95px;
            overflow: hidden;
        }

        .campaign-summary img {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }

        .summary-content {
            padding: 22px;
        }

        .summary-content h2 {
            margin-bottom: 9px;
            font-size: 21px;
            line-height: 1.4;
        }

        .summary-content p {
            color: #6b7280;
            font-size: 14px;
        }

        .donation-form {
            padding: 30px;
        }

        .donation-form h1 {
            margin-bottom: 6px;
            font-size: 29px;
        }

        .form-subtitle {
            margin-bottom: 27px;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        .required {
            color: #dc2626;
        }

        .form-control {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            outline: none;
        }

        .form-control:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        textarea.form-control {
            min-height: 110px;
            resize: vertical;
        }

        .amount-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 9px;
            margin-bottom: 12px;
        }

        .amount-button {
            padding: 11px 8px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            background: white;
            color: #374151;
            cursor: pointer;
            font-weight: 700;
        }

        .amount-button:hover,
        .amount-button.active {
            border-color: #0f766e;
            background: #ccfbf1;
            color: #0f766e;
        }

        .bank-grid {
            display: grid;
            gap: 10px;
        }

        .bank-option input {
            position: absolute;
            opacity: 0;
        }

        .bank-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px;
            border: 1px solid #d1d5db;
            border-radius: 11px;
            cursor: pointer;
        }

        .bank-option input:checked + .bank-card {
            border-color: #0f766e;
            background: #f0fdfa;
            box-shadow: 0 0 0 2px rgba(15, 118, 110, 0.1);
        }

        .bank-name {
            color: #0f766e;
            font-weight: 800;
        }

        .bank-number {
            text-align: right;
        }

        .bank-number strong,
        .bank-number small {
            display: block;
        }

        .bank-number small {
            color: #6b7280;
        }

        .checkbox-row {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #4b5563;
            font-size: 14px;
        }

        .field-error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 13px;
        }

        .information-box {
            margin: 22px 0;
            padding: 15px;
            border-radius: 10px;
            background: #fef3c7;
            color: #92400e;
            font-size: 14px;
        }

        @media (max-width: 850px) {
            .donation-grid {
                grid-template-columns: 1fr;
            }

            .campaign-summary {
                position: static;
            }
        }

        @media (max-width: 550px) {
            .amount-options {
                grid-template-columns: repeat(2, 1fr);
            }

            .donation-form {
                padding: 22px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="donation-section">
        <div class="container donation-grid">
            <aside class="campaign-summary">
                <img
                    src="{{ asset(
                        'storage/' . $campaign->thumbnail
                    ) }}"
                    alt="{{ $campaign->title }}"
                >

                <div class="summary-content">
                    <h2>{{ $campaign->title }}</h2>
                    <p>{{ $campaign->short_description }}</p>
                </div>
            </aside>

            <section class="donation-form">
                <h1>Form Donasi</h1>

                <p class="form-subtitle">
                    Lengkapi data berikut dan unggah bukti transfer.
                </p>

                @if ($errors->any())
                <div
                    style="
                        margin-bottom: 20px;
                        padding: 14px;
                        border-radius: 10px;
                        background: #fee2e2;
                        color: #991b1b;
                    "
                >
                    <strong>Data belum dapat diproses:</strong>

                    <ul
                        style="
                            margin-top: 8px;
                            padding-left: 20px;
                        "
                    >
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                @if (session('payment_error'))
                    <div
                        style="
                            margin-bottom: 20px;
                            padding: 14px;
                            border-radius: 10px;
                            background: #fee2e2;
                            color: #991b1b;
                        "
                    >
                        {{ session('payment_error') }}
                    </div>
                @endif

                <form
                    action="{{ route(
                        'donations.store',
                        $campaign->slug
                    ) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="donor_name">
                            Nama Lengkap
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="donor_name"
                            name="donor_name"
                            class="form-control"
                            value="{{ old('donor_name') }}"
                            required
                        >

                        @error('donor_name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div
                        style="
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 15px;
                        "
                    >
                        <div class="form-group">
                            <label class="form-label" for="donor_email">
                                Email
                            </label>

                            <input
                                type="email"
                                id="donor_email"
                                name="donor_email"
                                class="form-control"
                                value="{{ old('donor_email') }}"
                            >

                            @error('donor_email')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="donor_phone">
                                Nomor WhatsApp
                                <span class="required">*</span>
                            </label>

                            <input
                                type="tel"
                                id="donor_phone"
                                name="donor_phone"
                                class="form-control"
                                value="{{ old('donor_phone') }}"
                                placeholder="08xxxxxxxxxx"
                                required
                            >

                            @error('donor_phone')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Nominal Donasi
                            <span class="required">*</span>
                        </label>

                        <div class="amount-options">
                            @foreach (
                                [10000, 25000, 50000, 100000, 250000, 500000]
                                as $nominal
                            )
                                <button
                                    type="button"
                                    class="amount-button"
                                    data-amount="{{ $nominal }}"
                                >
                                    Rp {{ number_format(
                                        $nominal,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </button>
                            @endforeach
                        </div>

                        <input
                            type="text"
                            id="amount_display"
                            class="form-control"
                            inputmode="numeric"
                            placeholder="Atau masukkan nominal lainnya"
                            autocomplete="off"
                            required
                        >

                        <input
                            type="hidden"
                            id="amount"
                            name="amount"
                            value="{{ old('amount') }}"
                        >

                        @error('amount')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">
                            Pesan atau Doa
                        </label>

                        <textarea
                            id="message"
                            name="message"
                            class="form-control"
                            maxlength="500"
                            placeholder="Tulis pesan terbaikmu"
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="checkbox-row">
                            <input
                                type="checkbox"
                                name="is_anonymous"
                                value="1"
                                {{ old('is_anonymous') ? 'checked' : '' }}
                            >

                            Sembunyikan nama saya dari daftar donatur
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Metode Pembayaran
                            <span class="required">*</span>
                        </label>

                        <div
                            style="
                                display: grid;
                                grid-template-columns: repeat(2, 1fr);
                                gap: 12px;
                            "
                        >
                            <label class="bank-option">
                                <input
                                    type="radio"
                                    name="payment_type"
                                    value="midtrans"
                                    {{
                                        old('payment_type', 'midtrans') === 'midtrans'
                                            ? 'checked'
                                            : ''
                                    }}
                                    required
                                >

                                <span
                                    class="bank-card"
                                    style="
                                        min-height: 95px;
                                        align-items: flex-start;
                                        flex-direction: column;
                                    "
                                >
                                    <span class="bank-name">
                                        Pembayaran Otomatis
                                    </span>

                                    <small style="color: #6b7280;">
                                        QRIS, virtual account, dan e-wallet melalui Midtrans.
                                    </small>
                                </span>
                            </label>

                            <label class="bank-option">
                                <input
                                    type="radio"
                                    name="payment_type"
                                    value="manual"
                                    {{
                                        old('payment_type') === 'manual'
                                            ? 'checked'
                                            : ''
                                    }}
                                    required
                                >

                                <span
                                    class="bank-card"
                                    style="
                                        min-height: 95px;
                                        align-items: flex-start;
                                        flex-direction: column;
                                    "
                                >
                                    <span class="bank-name">
                                        Transfer Manual
                                    </span>

                                    <small style="color: #6b7280;">
                                        Transfer ke rekening yayasan dan unggah bukti.
                                    </small>
                                </span>
                            </label>
                        </div>

                        @error('payment_type')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="manualPaymentSection">
                    <div class="form-group">
                        <label class="form-label">
                            Rekening Tujuan
                            <span class="required">*</span>
                        </label>

                        <div class="bank-grid">
                            @foreach ($bankAccounts as $key => $bank)
                                <label class="bank-option">
                                    <input
                                        type="radio"
                                        name="payment_channel"
                                        value="{{ $key }}"
                                        {{
                                            old('payment_channel') === $key
                                                ? 'checked'
                                                : ''
                                        }}
                                        required
                                    >

                                    <span class="bank-card">
                                        <span class="bank-name">
                                            {{ $bank['name'] }}
                                        </span>

                                        <span class="bank-number">
                                            <strong>
                                                {{ $bank['account_number'] }}
                                            </strong>

                                            <small>
                                                a.n. {{ $bank['account_name'] }}
                                            </small>
                                        </span>
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        @error('payment_channel')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="information-box">
                        Transfer sesuai nominal donasi, lalu unggah
                        bukti pembayaran melalui form di bawah.
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="payment_proof">
                            Bukti Pembayaran
                            <span class="required">*</span>
                        </label>

                        <input
                            type="file"
                            id="payment_proof"
                            name="payment_proof"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp,.pdf"
                            required
                        >

                        <small
                            style="
                                display: block;
                                margin-top: 7px;
                                color: #6b7280;
                            "
                        >
                            Format JPG, PNG, WEBP, atau PDF. Maksimal 3 MB.
                        </small>

                        @error('payment_proof')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                        style="width: 100%;"
                    >
                        Lanjutkan Pembayaran
                    </button>
                </form>
            </section>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const amountDisplay = document.getElementById('amount_display');
        const amountInput = document.getElementById('amount');
        const amountButtons = document.querySelectorAll('.amount-button');

        const paymentTypeInputs = document.querySelectorAll(
            'input[name="payment_type"]'
        );

        const manualPaymentSection = document.getElementById(
            'manualPaymentSection'
        );

        const paymentProof = document.getElementById(
            'payment_proof'
        );

        const paymentChannels = document.querySelectorAll(
            'input[name="payment_channel"]'
        );

        function updatePaymentMethod() {
            const selectedPayment = document.querySelector(
                'input[name="payment_type"]:checked'
            );

            const isManual = selectedPayment
                && selectedPayment.value === 'manual';

            manualPaymentSection.style.display = isManual
                ? 'block'
                : 'none';

            paymentProof.required = isManual;

            paymentChannels.forEach(function (channel) {
                channel.required = isManual;
            });
        }

        paymentTypeInputs.forEach(function (input) {
            input.addEventListener('change', updatePaymentMethod);
        });

        function formatRupiah(value) {
            const numbers = String(value).replace(/\D/g, '');

            if (!numbers) {
                return '';
            }

            return 'Rp ' + new Intl.NumberFormat('id-ID').format(
                Number(numbers)
            );
        }

        function setAmount(value) {
            const numbers = String(value).replace(/\D/g, '');

            amountInput.value = numbers;
            amountDisplay.value = formatRupiah(numbers);

            amountButtons.forEach(function (button) {
                button.classList.toggle(
                    'active',
                    button.dataset.amount === numbers
                );
            });
        }

        amountButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                setAmount(button.dataset.amount);
            });
        });

        amountDisplay.addEventListener('input', function () {
            setAmount(amountDisplay.value);
        });

        document.addEventListener('DOMContentLoaded', function () {
            if (amountInput.value) {
                setAmount(amountInput.value);
            }
            updatePaymentMethod();
        });
    </script>
@endpush