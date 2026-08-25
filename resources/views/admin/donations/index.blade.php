@extends('admin.layouts.app')

@section('title', 'Donasi')

@section('content')
    <section class="page-header">
        <div>
            <h1>Data Donasi</h1>

            <p>
                Kelola dan verifikasi pembayaran donatur.
            </p>
        </div>
    </section>

    <section class="card" style="margin-bottom: 20px;">
        <form
            action="{{ route('admin.donations.index') }}"
            method="GET"
            style="
                display: grid;
                grid-template-columns: 1fr 230px auto;
                gap: 12px;
            "
        >
            <input
                type="text"
                name="search"
                class="form-control"
                value="{{ request('search') }}"
                placeholder="Cari invoice, nama, email, atau WhatsApp..."
            >

            <select name="status" class="form-control">
                <option value="">Semua status</option>

                <option
                    value="waiting_verification"
                    {{
                        request('status') === 'waiting_verification'
                            ? 'selected'
                            : ''
                    }}
                >
                    Menunggu Verifikasi
                </option>

                <option
                    value="paid"
                    {{ request('status') === 'paid' ? 'selected' : '' }}
                >
                    Berhasil
                </option>

                <option
                    value="pending"
                    {{ request('status') === 'pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="failed"
                    {{ request('status') === 'failed' ? 'selected' : '' }}
                >
                    Ditolak/Gagal
                </option>

                <option
                    value="cancelled"
                    {{ request('status') === 'cancelled' ? 'selected' : '' }}
                >
                    Dibatalkan
                </option>
            </select>

            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn btn-primary">
                    Filter
                </button>

                @if (request('search') || request('status'))
                    <a
                        href="{{ route('admin.donations.index') }}"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </section>

    <section class="card">
        @if ($donations->isEmpty())
            <div class="empty-state">
                Belum ada data donasi yang ditemukan.
            </div>
        @else
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Donatur</th>
                            <th>Campaign</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($donations as $donation)
                            <tr>
                                <td>
                                    <strong>
                                        {{ $donation->invoice_number }}
                                    </strong>
                                </td>

                                <td>
                                    <strong>
                                        {{ $donation->donor_name }}
                                    </strong>

                                    @if ($donation->is_anonymous)
                                        <div
                                            style="
                                                margin-top: 4px;
                                                color: #6b7280;
                                                font-size: 12px;
                                            "
                                        >
                                            Ditampilkan sebagai anonim
                                        </div>
                                    @endif
                                </td>

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
                                    {{ strtoupper(
                                        $donation->payment_channel
                                            ?? $donation->payment_method
                                    ) }}
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
                                </td>

                                <td>
                                    {{ $donation->created_at
                                        ->format('d/m/Y H:i') }}
                                </td>

                                <td>
                                    <a
                                        href="{{ route(
                                            'admin.donations.show',
                                            $donation
                                        ) }}"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Detail
                                    </a>
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