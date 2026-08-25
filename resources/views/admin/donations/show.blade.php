@extends('admin.layouts.app')

@section('title', 'Detail Donasi')

@section('content')
    <section class="page-header">
        <div>
            <h1>Detail Donasi</h1>
            <p>{{ $donation->invoice_number }}</p>
        </div>

        <a
            href="{{ route('admin.donations.index') }}"
            class="btn btn-secondary"
        >
            Kembali
        </a>
    </section>

    <div
        class="donation-detail-grid"
        style="
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(300px, 0.8fr);
            gap: 20px;
            align-items: start;
        "
    >
        <section class="card">
            <h2 style="margin-bottom: 22px;">
                Informasi Donatur
            </h2>

            <div class="table-responsive">
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 210px;">Nomor Invoice</th>
                            <td>
                                <strong>
                                    {{ $donation->invoice_number }}
                                </strong>
                            </td>
                        </tr>

                        <tr>
                            <th>Nama Donatur</th>
                            <td>{{ $donation->donor_name }}</td>
                        </tr>

                        <tr>
                            <th>Ditampilkan sebagai</th>
                            <td>{{ $donation->display_name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $donation->donor_email ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Nomor WhatsApp</th>
                            <td>{{ $donation->donor_phone }}</td>
                        </tr>

                        <tr>
                            <th>Campaign</th>
                            <td>{{ $donation->campaign->title }}</td>
                        </tr>

                        <tr>
                            <th>Nominal</th>
                            <td>
                                <strong
                                    style="
                                        color: #0f766e;
                                        font-size: 18px;
                                    "
                                >
                                    Rp {{ number_format(
                                        $donation->amount,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </strong>
                            </td>
                        </tr>

                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>Transfer Bank</td>
                        </tr>

                        <tr>
                            <th>Rekening Tujuan</th>
                            <td>
                                {{ strtoupper(
                                    $donation->payment_channel ?? '-'
                                ) }}
                            </td>
                        </tr>

                        <tr>
                            <th>Tanggal Donasi</th>
                            <td>
                                {{ $donation->created_at
                                    ->format('d/m/Y H:i') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Pesan atau Doa</th>
                            <td>
                                {{ $donation->message ?? '-' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <div>
            <section class="card" style="margin-bottom: 20px;">
                <h2 style="margin-bottom: 18px;">
                    Status Pembayaran
                </h2>

                <div style="margin-bottom: 20px;">
                    @switch($donation->payment_status)
                        @case('paid')
                            <span class="badge badge-success">
                                Pembayaran Berhasil
                            </span>
                            @break

                        @case('waiting_verification')
                            <span
                                class="badge"
                                style="
                                    background: #fef3c7;
                                    color: #92400e;
                                "
                            >
                                Menunggu Verifikasi
                            </span>
                            @break

                        @case('failed')
                            <span
                                class="badge"
                                style="
                                    background: #fee2e2;
                                    color: #991b1b;
                                "
                            >
                                Ditolak/Gagal
                            </span>
                            @break

                        @case('cancelled')
                            <span class="badge badge-secondary">
                                Dibatalkan
                            </span>
                            @break

                        @default
                            <span class="badge badge-secondary">
                                Pending
                            </span>
                    @endswitch
                </div>

                @if ($donation->paid_at)
                    <p
                        style="
                            margin-bottom: 20px;
                            color: #6b7280;
                            font-size: 14px;
                        "
                    >
                        Diverifikasi pada
                        {{ $donation->paid_at->format('d/m/Y H:i') }}
                    </p>
                @endif

                <form
                    action="{{ route(
                        'admin.donations.update-status',
                        $donation
                    ) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label
                            for="payment_status"
                            class="form-label"
                        >
                            Ubah Status
                        </label>

                        <select
                            id="payment_status"
                            name="payment_status"
                            class="form-control"
                            required
                        >
                            <option
                                value="waiting_verification"
                                {{
                                    $donation->payment_status
                                        === 'waiting_verification'
                                            ? 'selected'
                                            : ''
                                }}
                            >
                                Menunggu Verifikasi
                            </option>

                            <option
                                value="paid"
                                {{
                                    $donation->payment_status === 'paid'
                                        ? 'selected'
                                        : ''
                                }}
                            >
                                Terima Pembayaran
                            </option>

                            <option
                                value="failed"
                                {{
                                    $donation->payment_status === 'failed'
                                        ? 'selected'
                                        : ''
                                }}
                            >
                                Tolak Pembayaran
                            </option>

                            <option
                                value="cancelled"
                                {{
                                    $donation->payment_status === 'cancelled'
                                        ? 'selected'
                                        : ''
                                }}
                            >
                                Batalkan Donasi
                            </option>
                        </select>

                        @error('payment_status')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                        style="width: 100%;"
                        onclick="
                            return confirm(
                                'Yakin ingin mengubah status pembayaran?'
                            )
                        "
                    >
                        Simpan Status
                    </button>
                </form>
            </section>

            <section class="card">
                <h2 style="margin-bottom: 18px;">
                    Bukti Pembayaran
                </h2>

                @if ($donation->payment_proof)
                    @php
                        $extension = strtolower(
                            pathinfo(
                                $donation->payment_proof,
                                PATHINFO_EXTENSION
                            )
                        );
                    @endphp

                    @if ($extension === 'pdf')
                        <p
                            style="
                                margin-bottom: 14px;
                                color: #6b7280;
                            "
                        >
                            Bukti pembayaran berupa dokumen PDF.
                        </p>

                        <a
                            href="{{ route(
                                'admin.donations.payment-proof',
                                $donation
                            ) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-primary"
                            style="width: 100%;"
                        >
                            Buka Bukti PDF
                        </a>
                    @else

                        <a
                            href="{{ route(
                                'admin.donations.payment-proof',
                                $donation
                            ) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img
                                src="{{ route(
                                    'admin.donations.payment-proof',
                                    $donation
                                ) }}"
                                alt="Bukti pembayaran"
                                style="
                                    width: 100%;
                                    max-height: 420px;
                                    object-fit: contain;
                                    border: 1px solid #e5e7eb;
                                    border-radius: 10px;
                                "
                            >
                        </a>

                        <p
                            style="
                                margin-top: 10px;
                                color: #6b7280;
                                text-align: center;
                                font-size: 12px;
                            "
                        >
                            Klik gambar untuk memperbesar.
                        </p>
                    @endif
                @else
                    <div class="empty-state">
                        Bukti pembayaran belum tersedia.
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection