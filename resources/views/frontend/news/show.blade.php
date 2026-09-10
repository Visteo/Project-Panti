@extends('frontend.layouts.app')

@section('title', $news->title . ' | Harapan Bangsa')
@section('meta_description', $news->excerpt)

@push('styles')
    <style>
        .news-detail-hero {
            position: relative;
            padding: 85px 24px 155px;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    #0c2947 0%,
                    #12355b 58%,
                    #256b8f 100%
                );
            color: white;
        }

        .news-detail-hero::before {
            position: absolute;
            top: -150px;
            right: -90px;
            width: 380px;
            height: 380px;
            border: 75px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            content: "";
        }

        .news-detail-hero::after {
            position: absolute;
            bottom: -130px;
            left: -80px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(245, 158, 11, 0.13);
            content: "";
        }

        .news-detail-hero-content {
            position: relative;
            z-index: 2;
            max-width: 920px;
            margin: auto;
            text-align: center;
        }

        .news-detail-breadcrumb {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 9px;
            margin-bottom: 27px;
            color: rgba(255, 255, 255, 0.65);
            font-size: 13px;
        }

        .news-detail-breadcrumb a {
            color: #fbbf24;
            font-weight: 700;
            text-decoration: none;
        }

        .news-detail-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 20px;
            padding: 8px 14px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.09);
            color: #fbbf24;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .news-detail-label::before {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef6a5b;
            content: "";
        }

        .news-detail-hero h1 {
            margin-bottom: 23px;
            color: white;
            font-size: clamp(36px, 5.5vw, 66px);
            line-height: 1.12;
            letter-spacing: -1.5px;
        }

        .news-detail-meta {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 13px;
        }

        .news-detail-meta span {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 14px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.82);
            font-size: 13px;
        }

        .news-detail-section {
            position: relative;
            z-index: 4;
            margin-top: -95px;
            padding: 0 24px 105px;
        }

        .news-detail-layout {
            display: grid;
            align-items: start;
            grid-template-columns: minmax(0, 1fr) 340px;
            gap: 28px;
        }

        .news-article {
            overflow: hidden;
            border-radius: 32px;
            background: white;
            box-shadow: 0 25px 65px rgba(18, 53, 91, 0.15);
        }

        .news-article-image-wrapper {
            position: relative;
            height: min(550px, 55vw);
            min-height: 330px;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    #12355b,
                    #256b8f
                );
        }

        .news-article-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .news-article-image-wrapper::after {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            height: 35%;
            background:
                linear-gradient(
                    to top,
                    rgba(12, 41, 71, 0.32),
                    transparent
                );
            content: "";
        }

        .news-image-placeholder {
            display: grid;
            width: 100%;
            height: 100%;
            place-items: center;
            color: rgba(255, 255, 255, 0.28);
            font-size: 90px;
            font-weight: 900;
        }

        .news-article-content {
            padding: 48px 52px 55px;
        }

        .news-article-excerpt {
            position: relative;
            margin-bottom: 32px;
            padding: 24px 26px 24px 31px;
            border-radius: 18px;
            background: #fff8ed;
            color: #374151;
            font-size: 18px;
            font-weight: 600;
            line-height: 1.75;
        }

        .news-article-excerpt::before {
            position: absolute;
            top: 20px;
            bottom: 20px;
            left: 0;
            width: 5px;
            border-radius: 5px;
            background: #f59e0b;
            content: "";
        }

        .news-article-body {
            color: #374151;
            font-size: 17px;
            line-height: 1.95;
        }

        .news-article-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-top: 42px;
            padding-top: 27px;
            border-top: 1px solid #e5e7eb;
        }

        .news-article-footer-text {
            color: #6b7280;
            font-size: 13px;
        }

        .news-article-footer-text strong {
            display: block;
            margin-bottom: 4px;
            color: #12355b;
            font-size: 15px;
        }

        .related-news {
            position: sticky;
            top: 105px;
            padding: 26px;
            border-radius: 28px;
            background: #fff8ed;
            box-shadow: 0 18px 45px rgba(18, 53, 91, 0.1);
        }

        .related-news-heading {
            margin-bottom: 21px;
        }

        .related-news-label {
            display: block;
            margin-bottom: 7px;
            color: #ef6a5b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .related-news-heading h2 {
            color: #172033;
            font-size: 24px;
        }

        .related-item {
            display: grid;
            grid-template-columns: 95px 1fr;
            gap: 14px;
            padding: 17px 0;
            border-top: 1px solid rgba(18, 53, 91, 0.1);
            color: inherit;
            text-decoration: none;
        }

        .related-item-image {
            width: 95px;
            height: 88px;
            overflow: hidden;
            border-radius: 14px;
            background: #12355b;
        }

        .related-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s;
        }

        .related-item:hover .related-item-image img {
            transform: scale(1.08);
        }

        .related-item-placeholder {
            display: grid;
            width: 100%;
            height: 100%;
            place-items: center;
            color: rgba(255, 255, 255, 0.65);
            font-weight: 900;
        }

        .related-item-date {
            color: #ef6a5b;
            font-size: 11px;
            font-weight: 800;
        }

        .related-item strong {
            display: block;
            margin-top: 7px;
            color: #172033;
            font-size: 14px;
            line-height: 1.45;
            transition: color 0.2s;
        }

        .related-item:hover strong {
            color: #ef6a5b;
        }

        .related-news-empty {
            padding: 20px 0;
            border-top: 1px solid rgba(18, 53, 91, 0.1);
            color: #6b7280;
            line-height: 1.6;
        }

        .related-news-all {
            display: flex;
            justify-content: center;
            margin-top: 17px;
        }

        @media (max-width: 980px) {
            .news-detail-layout {
                grid-template-columns: 1fr;
            }

            .related-news {
                position: static;
            }
        }

        @media (max-width: 650px) {
            .news-detail-hero {
                padding: 65px 12px 125px;
            }

            .news-detail-hero h1 {
                font-size: 36px;
                letter-spacing: -0.5px;
            }

            .news-detail-section {
                margin-top: -70px;
                padding: 0 12px 75px;
            }

            .news-article {
                border-radius: 24px;
            }

            .news-article-image-wrapper {
                height: 290px;
                min-height: 290px;
            }

            .news-article-content {
                padding: 30px 22px 37px;
            }

            .news-article-excerpt {
                padding: 20px 19px 20px 25px;
                font-size: 16px;
            }

            .news-article-body {
                font-size: 16px;
            }

            .news-article-footer {
                align-items: stretch;
                flex-direction: column;
            }

            .news-article-footer .btn {
                width: 100%;
            }

            .related-news {
                padding: 23px 20px;
                border-radius: 23px;
            }
        }

        @media (max-width: 390px) {
            .related-item {
                grid-template-columns: 80px 1fr;
            }

            .related-item-image {
                width: 80px;
                height: 80px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="news-detail-hero">
        <div class="container">
            <div class="news-detail-hero-content">
                <nav
                    class="news-detail-breadcrumb"
                    aria-label="Breadcrumb"
                >
                    <a href="{{ route('home') }}">
                        Beranda
                    </a>

                    <span>/</span>

                    <a href="{{ route('news.index') }}">
                        Berita
                    </a>

                    <span>/</span>

                    <span>Detail Berita</span>
                </nav>

                <span class="news-detail-label">
                    Cerita Harapan Bangsa
                </span>

                <h1>{{ $news->title }}</h1>

                <div class="news-detail-meta">
                    <span>
                        ◷
                        {{ $news->published_at
                            ?->translatedFormat('d F Y') ?? '-' }}
                    </span>

                    <span>
                        ✎
                        {{ $news->author?->name
                            ?? 'Harapan Bangsa' }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="news-detail-section">
        <div class="container">
            <div class="news-detail-layout">
                <article class="news-article">
                    <div class="news-article-image-wrapper">
                        @if ($news->thumbnail)
                            <img
                                src="{{ asset(
                                    'storage/' . $news->thumbnail
                                ) }}"
                                alt="{{ $news->title }}"
                                class="news-article-image"
                            >
                        @else
                            <div class="news-image-placeholder">
                                HB
                            </div>
                        @endif
                    </div>

                    <div class="news-article-content">
                        @if ($news->excerpt)
                            <p class="news-article-excerpt">
                                {{ $news->excerpt }}
                            </p>
                        @endif

                        <div class="news-article-body">
                            {!! nl2br(e($news->content)) !!}
                        </div>

                        <div class="news-article-footer">
                            <div class="news-article-footer-text">
                                <strong>
                                    Harapan Bangsa Indonesia
                                </strong>

                                Berbagi cerita, menghadirkan harapan.
                            </div>

                            <a
                                href="{{ route('news.index') }}"
                                class="btn btn-primary"
                            >
                                ← Kembali ke Berita
                            </a>
                        </div>
                    </div>
                </article>

                <aside class="related-news">
                    <div class="related-news-heading">
                        <span class="related-news-label">
                            Baca Selanjutnya
                        </span>

                        <h2>Berita Lainnya</h2>
                    </div>

                    @forelse ($otherNews as $item)
                        <a
                            href="{{ route(
                                'news.show',
                                $item->slug
                            ) }}"
                            class="related-item"
                        >
                            <div class="related-item-image">
                                @if ($item->thumbnail)
                                    <img
                                        src="{{ asset(
                                            'storage/' .
                                            $item->thumbnail
                                        ) }}"
                                        alt="{{ $item->title }}"
                                    >
                                @else
                                    <div
                                        class="related-item-placeholder"
                                    >
                                        HB
                                    </div>
                                @endif
                            </div>

                            <div>
                                <span class="related-item-date">
                                    {{ $item->published_at
                                        ?->translatedFormat('d M Y')
                                        ?? '-' }}
                                </span>

                                <strong>
                                    {{ Str::limit(
                                        $item->title,
                                        58
                                    ) }}
                                </strong>
                            </div>
                        </a>
                    @empty
                        <p class="related-news-empty">
                            Belum ada berita lainnya.
                        </p>
                    @endforelse

                    <div class="related-news-all">
                        <a
                            href="{{ route('news.index') }}"
                            class="btn btn-outline"
                            style="width: 100%;"
                        >
                            Lihat Semua Berita
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection