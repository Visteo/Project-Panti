@extends('admin.layouts.app')

@section('title', 'Laporan Donasi')

@section('content')
    <section class="page-header">
        <div>
            <h1>Laporan Donasi</h1>
            <p>
                Pantau dan unduh data transaksi donasi.
            </p>
        </div>

        <a
            href="{{ route(
                'admin.reports.export',
                request()->query()
            ) }}"
            class="btn btn-primary"
        >
            Unduh CSV
        </a>
    </section>

    @if ($errors->any())
        <div class="alert alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <section class="card" style="margin-bottom: 22px;">
        <form
            action="{{ route('admin.reports.index') }}"
            method="GET"
        >
            <div
                class="report-filter-grid"
                style="
                    display: grid;
                    grid-template-columns:
                        repeat(2, 1fr)
                        minmax(180px, 1.2fr)
                        minmax(180px, 1fr);
                    gap: 15px;
                "
            >
                <div class="form-group">
                    <label class="form-label" for="start_date">
                        Tanggal Awal
                    </label>

                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        class="form-control"
                        value="{{ request('start_date') }}"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="end_date">
                        Tanggal Akhir
                    </label>

                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        class="form-control"
                        value="{{ request('end_date') }}"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="campaign_id">
                        Campaign
                    </label>

                    <select
                        id="campaign_id"
                        name="campaign_id"
                        class="form-control"
                    >
                        <option value="">Semua campaign</option>

                        @foreach ($campaigns as $campaign)
                            <option
                                value="{{ $campaign->id }}"
                                {{
                                    (string) request('campaign_id')
                                        === (string) $campaign->id
                                            ? 'selected'
                                            : ''
                                }}
                            >
                                {{ $campaign->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label
                        class="form-label"
                        for="payment_status"
                    >
                        Status
                    </label>

                    <select
                        id="payment_status"
                        name="payment_status"
                        class="form-control"
                    >
                        <option value="">Semua status</option>

                        <option
                            value="pending"
                            {{
                                request('payment_status') === 'pending'
                                    ? 'selected'
                                    : ''
                            }}
                        >
                            Menunggu Pembayaran
                        </option>

                        <option
                            value="waiting_verification"
                            {{
                                request('payment_status')
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
                                request('payment_status') === 'paid'
                                    ? 'selected'
                                    : ''
                            }}
                        >
                            Berhasil
                        </option>

                        <option
                            value="failed"
                            {{
                                request('payment_status') === 'failed'
                                    ? 'selected'
                                    : ''
                            }}
                        >
                            Gagal/Ditolak
                        </option>

                        <option
                            value="expired"
                            {{
                                request('payment_status') === 'expired'
                                    ? 'selected'
                                    : ''
                            }}
                        >
                            Kedaluwarsa
                        </option>

                        <option
                            value="cancelled"
                            {{
                                request('payment_status') === 'cancelled'
                                    ? 'selected'
                                    : ''
                            }}
                        >
                            Dibatalkan
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Terapkan Filter
                </button>

                <a
                    href="{{ route('admin.reports.index') }}"
                    class="btn btn-secondary"
                >
                    Reset
                </a>
            </div>
        </form>
    </section>

    <section class="statistics">
        <div class="card statistic-card">
            <p>Total Transaksi</p>

            <h3>
                {{ number_format(
                    $statistics['total_transactions'],
                    0,
                    ',',
                    '.'
                ) }}
            </h3>
        </div>

        <div class="card statistic-card">
            <p>Transaksi Berhasil</p>

            <h3>
                {{ number_format(
                    $statistics['paid_transactions'],
                    0,
                    ',',
                    '.'
                ) }}
            </h3>
        </div>

        <div class="card statistic-card">
            <p>Menunggu Diproses</p>

            <h3>
                {{ number_format(
                    $statistics['pending_transactions'],
                    0,
                    ',',
                    '.'
                ) }}
            </h3>
        </div>

        <div class="card statistic-card">
            <p>Dana Berhasil Diterima</p>

            <h3>
                Rp {{ number_format(
                    $statistics['collected_amount'],
                    0,
                    ',',
                    '.'
                ) }}
            </h3>
        </div>
    </section>

    <section class="card">
        @if ($donations->isEmpty())
            <div class="empty-state">
                Tidak ada transaksi yang sesuai dengan filter.
            </div>
        @else
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Donatur</th>
                            <th>Campaign</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($donations as $donation)
                            <tr>
                                <td>
                                    <a
                                        href="{{ route(
                                            'admin.donations.show',
                                            $donation
                                        ) }}"
                                        style="
                                            color: #0f766e;
                                            font-weight: 700;
                                        "
                                    >
                                        {{ $donation->invoice_number }}
                                    </a>
                                </td>

                                <td>
                                    {{ $donation->created_at
                                        ->format('d/m/Y H:i') }}
                                </td>

                                <td>{{ $donation->donor_name }}</td>

                                <td>
                                    {{ Str::limit(
                                        $donation->campaign->title,
                                        35
                                    ) }}
                                </td>

                                <td>
                                    <strong>
                                        Rp {{ number_format(
                                            $donation->amount,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $donation->payment_method === 'midtrans'
                                        ? 'Midtrans'
                                        : 'Transfer Manual' }}
                                </td>

                                <td>
                                    @switch($donation->payment_status)
                                        @case('paid')
                                            <span class="badge badge-success">
                                                Berhasil
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
                                                Perlu Verifikasi
                                            </span>
                                            @break

                                        @case('pending')
                                            <span
                                                class="badge"
                                                style="
                                                    background: #dbeafe;
                                                    color: #1e40af;
                                                "
                                            >
                                                Pending
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
                                                Gagal
                                            </span>
                                            @break

                                        @case('expired')
                                            <span class="badge badge-secondary">
                                                Kedaluwarsa
                                            </span>
                                            @break

                                        @default
                                            <span class="badge badge-secondary">
                                                Dibatalkan
                                            </span>
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($donations->hasPages())
                <div class="pagination-wrapper">
                    {{ $donations->links() }}
                </div>
            @endif
        @endif
    </section>
@endsection

@push('styles')
    <style>
        @media (max-width: 900px) {
            .report-filter-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        @media (max-width: 600px) {
            .report-filter-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endpush