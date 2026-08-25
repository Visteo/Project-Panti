@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="page-header">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Ringkasan campaign dan donasi Harapan Bangsa.</p>
        </div>
    </section>

    <section class="statistics">
        <div class="card statistic-card">
            <p>Total Campaign</p>
            <h3>{{ $statistics['campaigns'] }}</h3>
        </div>

        <div class="card statistic-card">
            <p>Campaign Aktif</p>
            <h3>{{ $statistics['active_campaigns'] }}</h3>
        </div>

        <div class="card statistic-card">
            <p>Total Donasi</p>
            <h3>{{ $statistics['donations'] }}</h3>
        </div>

        <div class="card statistic-card">
            <p>Dana Terkumpul</p>

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
        <h2 style="margin-bottom: 20px;">Donasi Terbaru</h2>

        @if ($latestDonations->isEmpty())
            <div class="empty-state">
                Belum ada data donasi.
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
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($latestDonations as $donation)
                            <tr>
                                <td>{{ $donation->invoice_number }}</td>
                                <td>{{ $donation->display_name }}</td>
                                <td>{{ $donation->campaign->title }}</td>

                                <td>
                                    Rp {{ number_format(
                                        $donation->amount,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>
                                    {{ ucfirst($donation->payment_status) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection