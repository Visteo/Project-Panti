@extends('frontend.layouts.app')

@section('title', $campaign->title . ' | Harapan Bangsa')

@section('meta_description', $campaign->short_description)

@push('styles')
    <style>
        .campaign-detail-hero {
            position: relative;
            padding: 75px 0 145px;
            overflow: hidden;
            background: linear-gradient(
                135deg,
                #0c2947,
                #12355b 55%,
                #256b8f
            );
            color: white;
        }

        .campaign-detail-hero::before {
            position: absolute;
            top: -150px;
            right: -100px;
            width: 400px;
            height: 400px;
            border: 75px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            content: "";
        }

        .campaign-breadcrumb {
            position: relative;
            z-index: 2;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.62);
            font-size: 13px;
        }

        .campaign-breadcrumb a {
            color: #fbbf24;
        }

        .campaign-detail-heading {
            position: relative;
            z-index: 2;
            max-width: 900px;
        }

        .campaign-detail-category {
            display: inline-flex;
            padding: 7px 12px;
            border-radius: 20px;
            background: #f59e0b;
            color: #172033;
            font-size: 12px;
            font-weight: 800;
        }

        .campaign-detail-heading h1 {
            margin: 18px 0;
            color: white;
            font-size: clamp(38px, 6vw, 65px);
            line-height: 1.1;
        }

        .campaign-detail-heading p {
            max-width: 720px;
            color: rgba(255, 255, 255, 0.76);
            font-size: 17px;
            line-height: 1.8;
        }

        .campaign-detail-section {
            position: relative;
            z-index: 3;
            margin-top: -80px;
            padding: 0 24px 105px;
        }

        .campaign-detail-grid {
            display: grid;
            align-items: start;
            grid-template-columns:
                minmax(0, 1.35fr)
                minmax(320px, 0.65fr);
            gap: 30px;
        }

        .campaign-story-card {
            overflow: hidden;
            border-radius: 34px;
            background: white;
            box-shadow: 0 22px 55px rgba(18, 53, 91, 0.13);
        }

        .campaign-detail-image {
            width: 100%;
            height: 480px;
            object-fit: cover;
        }

        .campaign-detail-placeholder {
            display: grid;
            width: 100%;
            height: 480px;
            place-items: center;
            background: linear-gradient(
                135deg,
                #12355b,
                #256b8f
            );
            color: rgba(255, 255, 255, 0.25);
            font-size: 90px;
            font-weight: 900;
        }

        .campaign-story-content {
            padding: 42px;
        }

        .campaign-story-content h2 {
            margin-bottom: 19px;
            color: #172033;
            font-size: 30px;
        }

        .campaign-story-text {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.9;
        }

        .campaign-donors {
            margin-top: 38px;
            padding-top: 34px;
            border-top: 1px solid #e5e7eb;
        }

        .campaign-donors-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .campaign-donors-heading h2 {
            margin: 0;
            font-size: 25px;
        }

        .campaign-donors-heading span {
            color: #6b7280;
            font-size: 13px;
        }

        .campaign-donor-list {
            display: grid;
            gap: 11px;
        }

        .campaign-donor-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px;
            border-radius: 15px;
            background: #f4f8ff;
        }

        .campaign-donor-avatar {
            display: grid;
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            place-items: center;
            border-radius: 15px;
            background: #12355b;
            color: white;
            font-weight: 800;
        }

        .campaign-donor-data {
            min-width: 0;
            flex: 1;
        }

        .campaign-donor-data strong,
        .campaign-donor-data span {
            display: block;
        }

        .campaign-donor-data strong {
            overflow: hidden;
            color: #172033;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .campaign-donor-data span {
            margin-top: 3px;
            color: #9ca3af;
            font-size: 11px;
        }

        .campaign-donor-amount {
            color: #ef6a5b;
            font-size: 14px;
            font-weight: 800;
            white-space: nowrap;
        }

        .campaign-donor-empty {
            padding: 35px 20px;
            border: 2px dashed #d8dee8;
            border-radius: 17px;
            background: #f8fafc;
            color: #6b7280;
            text-align: center;
        }

        .campaign-donation-card {
            position: sticky;
            top: 105px;
            overflow: hidden;
            padding: 30px;
            border-radius: 28px;
            background: white;
            box-shadow: 0 22px 55px rgba(18, 53, 91, 0.15);
        }

        .campaign-donation-card::before {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 7px;
            background: linear-gradient(
                90deg,
                #ef6a5b,
                #f59e0b
            );
            content: "";
        }

        .campaign-donation-icon {
            display: grid;
            width: 58px;
            height: 58px;
            margin-bottom: 20px;
            place-items: center;
            border-radius: 18px;
            background: #fff1ed;
            color: #ef6a5b;
            font-size: 26px;
        }

        .campaign-donation-card h2 {
            margin-bottom: 7px;
            color: #172033;
            font-size: 24px;
        }

        .campaign-donation-intro {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.65;
        }

        .campaign-collected {
            margin-top: 25px;
            color: #172033;
            font-size: 29px;
            font-weight: 900;
        }

        .campaign-target-label {
            color: #6b7280;
            font-size: 13px;
        }

        .campaign-detail-progress {
            height: 11px;
            margin: 17px 0 10px;
            overflow: hidden;
            border-radius: 20px;
            background: #e5e7eb;
        }

        .campaign-detail-progress-bar {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(
                90deg,
                #ef6a5b,
                #f59e0b
            );
        }

        .campaign-progress-information {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            color: #6b7280;
            font-size: 12px;
        }

        .campaign-information-list {
            display: grid;
            gap: 14px;
            margin: 25px 0;
            padding: 20px 0;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
        }

        .campaign-information-item {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            font-size: 13px;
        }

        .campaign-information-item span {
            color: #6b7280;
        }

        .campaign-information-item strong {
            color: #172033;
            text-align: right;
        }

        .campaign-donate-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 52px;
            padding: 13px 20px;
            border-radius: 13px;
            background: #f59e0b;
            color: #172033;
            font-weight: 900;
            text-decoration: none;
            box-shadow: 0 12px 28px rgba(245, 158, 11, 0.23);
            transition: transform 0.2s, background 0.2s;
        }

        .campaign-donate-button:hover {
            transform: translateY(-3px);
            background: #fbbf24;
        }

        .campaign-security-note {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-top: 17px;
            color: #6b7280;
            font-size: 11px;
            line-height: 1.5;
        }

        @media (max-width: 950px) {
            .campaign-detail-grid {
                grid-template-columns: 1fr;
            }

            .campaign-donation-card {
                position: static;
            }
        }

        @media (max-width: 620px) {
            .campaign-detail-hero {
                padding: 60px 0 115px;
            }

            .campaign-detail-section {
                margin-top: -60px;
                padding: 0 12px 75px;
            }

            .campaign-story-card {
                border-radius: 25px;
            }

            .campaign-detail-image,
            .campaign-detail-placeholder {
                height: 300px;
            }

            .campaign-story-content {
                padding: 29px 21px;
            }

            .campaign-donation-card {
                padding: 26px 21px;
            }

            .campaign-donor-item {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .campaign-donor-amount {
                width: 100%;
                padding-left: 57px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="campaign-detail-hero">
        <div class="container">
            <nav
                class="campaign-breadcrumb"
                aria-label="Breadcrumb"
            >
                <a href="{{ route('home') }}">
                    Beranda
                </a>

                <span>/</span>

                <a href="{{ route('campaigns.index') }}">
                    Campaign
                </a>

                <span>/</span>

                <span>{{ Str::limit($campaign->title, 45) }}</span>
            </nav>

            <div class="campaign-detail-heading">
                <span class="campaign-detail-category">
                    {{ $campaign->category?->name ?? 'Umum' }}
                </span>

                <h1>{{ $campaign->title }}</h1>

                <p>{{ $campaign->short_description }}</p>
            </div>
        </div>
    </section>

    <section class="campaign-detail-section">
        <div class="container campaign-detail-grid">
            <article class="campaign-story-card">
                @if ($campaign->thumbnail)
                    <img
                        src="{{ asset(
                            'storage/' . $campaign->thumbnail
                        ) }}"
                        alt="{{ $campaign->title }}"
                        class="campaign-detail-image"
                    >
                @else
                    <div class="campaign-detail-placeholder">
                        HB
                    </div>
                @endif

                <div class="campaign-story-content">
                    <h2>Cerita Campaign</h2>

                    <div class="campaign-story-text">
                        {!! nl2br(e($campaign->description)) !!}
                    </div>

                    <section class="campaign-donors">
                        <div class="campaign-donors-heading">
                            <h2>Donatur Terbaru</h2>

                            <span>
                                {{ $campaign
                                    ->paidDonations()
                                    ->count() }}
                                donatur
                            </span>
                        </div>

                        @if ($campaign->paidDonations->isEmpty())
                            <div class="campaign-donor-empty">
                                Jadilah donatur pertama dalam
                                campaign ini.
                            </div>
                        @else
                            <div class="campaign-donor-list">
                                @foreach (
                                    $campaign->paidDonations
                                    as $donation
                                )
                                    <div class="campaign-donor-item">
                                        <div class="campaign-donor-avatar">
                                            {{ strtoupper(
                                                substr(
                                                    $donation->display_name,
                                                    0,
                                                    1
                                                )
                                            ) }}
                                        </div>

                                        <div class="campaign-donor-data">
                                            <strong>
                                                {{ $donation->display_name }}
                                            </strong>

                                            <span>
                                                {{ $donation->created_at
                                                    ->diffForHumans() }}
                                            </span>
                                        </div>

                                        <div class="campaign-donor-amount">
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
                    </section>
                </div>
            </article>

            <aside class="campaign-donation-card" id="donasi">
                <div class="campaign-donation-icon">
                    ♥
                </div>

                <h2>Bantu Campaign Ini</h2>

                <p class="campaign-donation-intro">
                    Setiap bantuanmu sangat berarti untuk
                    menghadirkan masa depan yang lebih baik.
                </p>

                <div class="campaign-collected">
                    Rp {{ number_format(
                        $collectedAmount,
                        0,
                        ',',
                        '.'
                    ) }}
                </div>

                <div class="campaign-target-label">
                    terkumpul dari target
                    Rp {{ number_format(
                        $campaign->target_amount,
                        0,
                        ',',
                        '.'
                    ) }}
                </div>

                <div class="campaign-detail-progress">
                    <div
                        class="campaign-detail-progress-bar"
                        style="
                            width: {{
                                number_format(
                                    $progressPercentage,
                                    2,
                                    '.',
                                    ''
                                )
                            }}%;
                        "
                    ></div>
                </div>

                <div class="campaign-progress-information">
                    <span>
                        {{ number_format(
                            $progressPercentage,
                            1,
                            ',',
                            '.'
                        ) }}% tercapai
                    </span>

                    <span>
                        {{ $campaign
                            ->paidDonations()
                            ->count() }}
                        donatur
                    </span>
                </div>

                <div class="campaign-information-list">
                    <div class="campaign-information-item">
                        <span>Dimulai</span>

                        <strong>
                            {{ $campaign->start_date
                                ->translatedFormat('d M Y') }}
                        </strong>
                    </div>

                    <div class="campaign-information-item">
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
                    class="campaign-donate-button"
                >
                    Donasi Sekarang →
                </a>

                <div class="campaign-security-note">
                    <span>●</span>

                    <span>
                        Pembayaran diproses melalui sistem yang aman.
                    </span>
                </div>
            </aside>
        </div>
    </section>
@endsection