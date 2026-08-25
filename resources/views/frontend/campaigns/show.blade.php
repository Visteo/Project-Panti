@extends('frontend.layouts.app')

@section('title', $campaign->title . ' | Harapan Bangsa')

@section('meta_description', $campaign->short_description)

@push('styles')
    <style>
        .breadcrumb-section {
            padding: 24px 0;
            border-bottom: 1px solid #e5e7eb;
            background: white;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            color: #6b7280;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #0f766e;
        }

        .detail-section {
            padding: 50px 0 75px;
        }

        .detail-grid {
            display: grid;
            align-items: start;
            grid-template-columns: minmax(0, 1.4fr) minmax(320px, 0.6fr);
            gap: 34px;
        }

        .detail-main,
        .donation-card {
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            background: white;
        }

        .detail-image {
            width: 100%;
            max-height: 470px;
            object-fit: cover;
            border-radius: 18px 18px 0 0;
        }

        .detail-content {
            padding: 30px;
        }

        .detail-category {
            display: inline-block;
            margin-bottom: 13px;
            padding: 6px 11px;
            border-radius: 20px;
            background: #ccfbf1;
            color: #0f766e;
            font-size: 13px;
            font-weight: 700;
        }

        .detail-title {
            margin-bottom: 14px;
            font-size: clamp(28px, 4vw, 41px);
            line-height: 1.2;
        }

        .detail-summary {
            color: #6b7280;
            font-size: 17px;
        }

        .description {
            margin-top: 30px;
            padding-top: 28px;
            border-top: 1px solid #e5e7eb;
        }

        .description h2 {
            margin-bottom: 16px;
        }

        .description-text {
            color: #4b5563;
            white-space: pre-line;
        }

        .donation-card {
            position: sticky;
            top: 98px;
            padding: 25px;
        }

        .donation-card h2 {
            margin-bottom: 6px;
            font-size: 21px;
        }

        .donation-card > p {
            color: #6b7280;
            font-size: 14px;
        }

        .detail-progress {
            margin: 25px 0;
        }

        .amount-collected {
            color: #0f766e;
            font-size: 28px;
            font-weight: 800;
        }

        .target-label {
            color: #6b7280;
            font-size: 14px;
        }

        .progress-information {
            display: flex;
            justify-content: space-between;
            margin-top: 9px;
            color: #6b7280;
            font-size: 13px;
        }

        .information-list {
            display: flex;
            flex-direction: column;
            gap: 13px;
            margin: 22px 0;
            padding: 19px 0;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
        }

        .information-item {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            font-size: 14px;
        }

        .information-item span {
            color: #6b7280;
        }

        .donor-section {
            margin-top: 30px;
            padding-top: 27px;
            border-top: 1px solid #e5e7eb;
        }

        .donor-section h2 {
            margin-bottom: 18px;
        }

        .donor-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .donor-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px;
            border-radius: 11px;
            background: #f8fafc;
        }

        .donor-avatar {
            width: 42px;
            height: 42px;
            display: grid;
            flex-shrink: 0;
            place-items: center;
            border-radius: 50%;
            background: #ccfbf1;
            color: #0f766e;
            font-weight: 700;
        }

        .donor-data {
            flex: 1;
        }

        .donor-data span {
            display: block;
            color: #6b7280;
            font-size: 12px;
        }

        .donor-amount {
            color: #0f766e;
            font-weight: 700;
        }

        @media (max-width: 900px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .donation-card {
                position: static;
            }
        }
    </style>
@endpush

@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>

                <a href="{{ route('campaigns.index') }}">
                    Campaign
                </a>

                <span>/</span>
                <span>{{ $campaign->title }}</span>
            </div>
        </div>
    </section>

    <section class="detail-section">
        <div class="container detail-grid">
            <article class="detail-main">
                <img
                    src="{{ asset(
                        'storage/' . $campaign->thumbnail
                    ) }}"
                    alt="{{ $campaign->title }}"
                    class="detail-image"
                >

                <div class="detail-content">
                    <span class="detail-category">
                        {{ $campaign->category->name }}
                    </span>

                    <h1 class="detail-title">
                        {{ $campaign->title }}
                    </h1>

                    <p class="detail-summary">
                        {{ $campaign->short_description }}
                    </p>

                    <div class="description">
                        <h2>Cerita Campaign</h2>

                        <div class="description-text">
                            {{ $campaign->description }}
                        </div>
                    </div>

                    <div class="donor-section">
                        <h2>Donatur Terbaru</h2>

                        @if ($campaign->paidDonations->isEmpty())
                            <div class="empty-state">
                                Jadilah donatur pertama dalam campaign ini.
                            </div>
                        @else
                            <div class="donor-list">
                                @foreach (
                                    $campaign->paidDonations
                                    as $donation
                                )
                                    <div class="donor-item">
                                        <div class="donor-avatar">
                                            {{ strtoupper(
                                                substr(
                                                    $donation->display_name,
                                                    0,
                                                    1
                                                )
                                            ) }}
                                        </div>

                                        <div class="donor-data">
                                            <strong>
                                                {{ $donation->display_name }}
                                            </strong>

                                            <span>
                                                {{ $donation->created_at
                                                    ->diffForHumans() }}
                                            </span>
                                        </div>

                                        <div class="donor-amount">
                                            Rp {{ number_format(
                                                $donation->amount,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </article>

            <aside class="donation-card" id="donasi">
                <h2>Bantu Campaign Ini</h2>

                <p>
                    Setiap bantuanmu sangat berarti bagi mereka.
                </p>

                <div class="detail-progress">
                    <div class="amount-collected">
                        Rp {{ number_format(
                            $collectedAmount,
                            0,
                            ',',
                            '.'
                        ) }}
                    </div>

                    <div class="target-label">
                        dari target Rp {{ number_format(
                            $campaign->target_amount,
                            0,
                            ',',
                            '.'
                        ) }}
                    </div>

                    <div class="progress">
                        <div
                            class="progress-bar"
                            style="width: {{ $progressPercentage }}%;"
                        ></div>
                    </div>

                    <div class="progress-information">
                        <span>
                            {{ number_format(
                                $progressPercentage,
                                1,
                                ',',
                                '.'
                            ) }}%
                        </span>

                        <span>
                            {{ $campaign->paidDonations()->count() }}
                            donatur
                        </span>
                    </div>
                </div>

                <div class="information-list">
                    <div class="information-item">
                        <span>Dimulai</span>

                        <strong>
                            {{ $campaign->start_date
                                ->translatedFormat('d M Y') }}
                        </strong>
                    </div>

                    <div class="information-item">
                        <span>Batas waktu</span>

                        <strong>
                            {{ $campaign->end_date
                                ? $campaign->end_date
                                    ->translatedFormat('d M Y')
                                : 'Tanpa batas waktu' }}
                        </strong>
                    </div>
                </div>

                <a
                    href="{{ route(
                        'donations.create',
                        $campaign->slug
                    ) }}"
                    class="btn btn-primary"
                    style="width: 100%;"
                >
                    Donasi Sekarang
                </a>
                    Donasi Sekarang
                </a>
            </aside>
        </div>
    </section>
@endsection