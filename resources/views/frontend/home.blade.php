@extends('frontend.layouts.app')

@section('title', 'Harapan Bangsa | Berbagi Harapan')

@push('styles')
    <style>
        .hero {
            padding: 90px 0;
            background: linear-gradient(
                135deg,
                #0f766e,
                #34d399
            );
            color: white;
        }

        .hero-grid {
            display: grid;
            align-items: center;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 60px;
        }

        .hero-label {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.15);
            font-size: 13px;
            font-weight: 700;
        }

        .hero h1 {
            max-width: 650px;
            margin: 18px 0;
            font-size: clamp(38px, 5vw, 61px);
            line-height: 1.1;
        }

        .hero p {
            max-width: 620px;
            color: rgba(255, 255, 255, 0.82);
            font-size: 18px;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }

        .hero-card {
            padding: 32px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.13);
            backdrop-filter: blur(10px);
        }

        .hero-card-icon {
            margin-bottom: 15px;
            font-size: 55px;
        }

        .statistics-section {
            position: relative;
            z-index: 2;
            margin-top: -42px;
        }

        .statistics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            overflow: hidden;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            background: white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .statistic {
            padding: 25px;
            text-align: center;
        }

        .statistic + .statistic {
            border-left: 1px solid #e5e7eb;
        }

        .statistic strong {
            display: block;
            color: #0f766e;
            font-size: 27px;
        }

        .statistic span {
            color: #6b7280;
            font-size: 14px;
        }

        .campaign-footer {
            margin-top: 18px;
        }

        .news-section {
            background: white;
        }

        .home-news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .home-news-card {
            overflow: hidden;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
            background: white;
            transition: 0.2s;
        }

        .home-news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .home-news-image {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }

        .home-news-content {
            padding: 20px;
        }

        .home-news-date {
            color: #0f766e;
            font-size: 13px;
            font-weight: 700;
        }

        .home-news-title {
            min-height: 56px;
            margin: 9px 0;
            font-size: 20px;
            line-height: 1.4;
        }

        .home-news-excerpt {
            min-height: 65px;
            color: #6b7280;
            font-size: 14px;
        }

        .home-news-footer {
            margin-top: 18px;
        }

        @media (max-width: 900px) {
            .home-news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 800px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }

            .hero-card {
                display: none;
            }
        }

        @media (max-width: 620px) {
            .statistics-grid,
            .home-news-grid {
                grid-template-columns: 1fr;
            }

            .statistic + .statistic {
                border-top: 1px solid #e5e7eb;
                border-left: none;
            }

            .hero-actions {
                align-items: stretch;
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <span class="hero-label">
                    Berbagi Kebaikan, Menumbuhkan Harapan
                </span>

                <h1>
                    Satu Donasi, Sejuta Harapan untuk Mereka
                </h1>

                <p>
                    Mari bersama membantu memenuhi kebutuhan,
                    pendidikan, dan masa depan anak-anak
                    Harapan Bangsa.
                </p>

                <div class="hero-actions">
                    <a
                        href="{{ route('campaigns.index') }}"
                        class="btn btn-light"
                    >
                        Donasi Sekarang
                    </a>

                    <a
                        href="#campaign"
                        class="btn btn-outline"
                    >
                        Lihat Campaign
                    </a>
                </div>
            </div>

            <div class="hero-card">
                <div class="hero-card-icon">♥</div>

                <h2>Kebaikanmu Sangat Berarti</h2>

                <p>
                    Setiap bantuan yang diberikan menjadi langkah
                    berharga untuk mewujudkan masa depan yang
                    lebih baik.
                </p>
            </div>
        </div>
    </section>

    <section class="statistics-section">
        <div class="container">
            <div class="statistics-grid">
                <div class="statistic">
                    <strong>
                        {{ number_format(
                            $statistics['campaigns'],
                            0,
                            ',',
                            '.'
                        ) }}
                    </strong>

                    <span>Campaign Aktif</span>
                </div>

                <div class="statistic">
                    <strong>
                        {{ number_format(
                            $statistics['donations'],
                            0,
                            ',',
                            '.'
                        ) }}
                    </strong>

                    <span>Donasi Berhasil</span>
                </div>

                <div class="statistic">
                    <strong>
                        Rp {{ number_format(
                            $statistics['collected'],
                            0,
                            ',',
                            '.'
                        ) }}
                    </strong>

                    <span>Dana Terkumpul</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="campaign">
        <div class="container">
            <div class="section-header">
                <span>Campaign Pilihan</span>

                <h2>Mari Hadirkan Perubahan Bersama</h2>

                <p>
                    Pilih campaign yang ingin kamu dukung dan
                    jadilah bagian dari perubahan.
                </p>
            </div>

            <div class="campaign-grid">
                @forelse ($featuredCampaigns as $campaign)
                    @php
                        $collected =
                            $campaign->collected_amount ?? 0;

                        $percentage =
                            $campaign->target_amount > 0
                                ? min(
                                    (
                                        $collected
                                        / $campaign->target_amount
                                    ) * 100,
                                    100
                                )
                                : 0;
                    @endphp

                    <article class="campaign-card">
                        <a
                            href="{{ route(
                                'campaigns.show',
                                $campaign->slug
                            ) }}"
                        >
                            <div class="campaign-image">
                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $campaign->thumbnail
                                    ) }}"
                                    alt="{{ $campaign->title }}"
                                >

                                <span class="category-badge">
                                    {{ $campaign->category->name }}
                                </span>
                            </div>
                        </a>

                        <div class="campaign-content">
                            <a
                                href="{{ route(
                                    'campaigns.show',
                                    $campaign->slug
                                ) }}"
                            >
                                <h3>
                                    {{ $campaign->title }}
                                </h3>
                            </a>

                            <p>
                                {{ Str::limit(
                                    $campaign->short_description,
                                    100
                                ) }}
                            </p>

                            <div class="progress">
                                <div
                                    class="progress-bar"
                                    style="
                                        width: {{
                                            number_format(
                                                $percentage,
                                                2,
                                                '.',
                                                ''
                                            )
                                        }}%;
                                    "
                                ></div>
                            </div>

                            <div class="campaign-nominal">
                                <div>
                                    <strong>
                                        Rp {{ number_format(
                                            $collected,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </strong>

                                    <span>Terkumpul</span>
                                </div>

                                <div class="campaign-target">
                                    <strong>
                                        Rp {{ number_format(
                                            $campaign->target_amount,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </strong>

                                    <span>Target</span>
                                </div>
                            </div>

                            <div class="campaign-footer">
                                <a
                                    href="{{ route(
                                        'campaigns.show',
                                        $campaign->slug
                                    ) }}"
                                    class="btn btn-primary"
                                    style="width: 100%;"
                                >
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        Belum ada campaign yang dipublikasikan.
                    </div>
                @endforelse
            </div>

            @if ($featuredCampaigns->isNotEmpty())
                <div
                    style="
                        margin-top: 35px;
                        text-align: center;
                    "
                >
                    <a
                        href="{{ route('campaigns.index') }}"
                        class="btn btn-outline"
                    >
                        Lihat Semua Campaign
                    </a>
                </div>
            @endif
        </div>
    </section>

    @if ($latestNews->isNotEmpty())
        <section class="section news-section">
            <div class="container">
                <div class="section-header">
                    <span>Berita Terbaru</span>

                    <h2>
                        Kegiatan dan Cerita Harapan Bangsa
                    </h2>

                    <p>
                        Ikuti kegiatan dan perkembangan terbaru
                        bersama anak-anak Harapan Bangsa.
                    </p>
                </div>

                <div class="home-news-grid">
                    @foreach ($latestNews as $item)
                        <article class="home-news-card">
                            <a
                                href="{{ route(
                                    'news.show',
                                    $item->slug
                                ) }}"
                            >
                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $item->thumbnail
                                    ) }}"
                                    alt="{{ $item->title }}"
                                    class="home-news-image"
                                >
                            </a>

                            <div class="home-news-content">
                                <span class="home-news-date">
                                    {{ $item->published_at
                                        ->translatedFormat('d F Y') }}
                                </span>

                                <a
                                    href="{{ route(
                                        'news.show',
                                        $item->slug
                                    ) }}"
                                >
                                    <h3 class="home-news-title">
                                        {{ $item->title }}
                                    </h3>
                                </a>

                                <p class="home-news-excerpt">
                                    {{ Str::limit(
                                        $item->excerpt,
                                        110
                                    ) }}
                                </p>

                                <div class="home-news-footer">
                                    <a
                                        href="{{ route(
                                            'news.show',
                                            $item->slug
                                        ) }}"
                                        class="btn btn-outline"
                                        style="width: 100%;"
                                    >
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div
                    style="
                        margin-top: 32px;
                        text-align: center;
                    "
                >
                    <a
                        href="{{ route('news.index') }}"
                        class="btn btn-outline"
                    >
                        Lihat Semua Berita
                    </a>
                </div>
            </div>
        </section>
    @endif
@endsection