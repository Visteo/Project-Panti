@extends('frontend.layouts.app')

@section('title', $news->title . ' | Harapan Bangsa')

@section('meta_description', $news->excerpt)

@push('styles')
    <style>
        .article-section {
            padding: 45px 0 75px;
        }

        .article-wrapper {
            display: grid;
            align-items: start;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 30px;
        }

        .article-main,
        .other-news {
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            background: white;
        }

        .article-main {
            overflow: hidden;
        }

        .article-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
        }

        .article-content {
            padding: 34px;
        }

        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 14px;
            color: #0f766e;
            font-size: 14px;
            font-weight: 700;
        }

        .article-title {
            margin-bottom: 18px;
            font-size: clamp(30px, 5vw, 45px);
            line-height: 1.2;
        }

        .article-excerpt {
            margin-bottom: 27px;
            padding-bottom: 25px;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 18px;
        }

        .article-body {
            color: #374151;
            font-size: 16px;
            line-height: 1.85;
            white-space: pre-line;
        }

        .other-news {
            position: sticky;
            top: 95px;
            padding: 22px;
        }

        .other-news h2 {
            margin-bottom: 18px;
            font-size: 20px;
        }

        .other-item {
            display: block;
            padding: 14px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .other-item:last-child {
            border-bottom: none;
        }

        .other-item img {
            width: 100%;
            height: 145px;
            margin-bottom: 10px;
            object-fit: cover;
            border-radius: 9px;
        }

        .other-item strong {
            display: block;
            line-height: 1.4;
        }

        .other-item span {
            color: #6b7280;
            font-size: 12px;
        }

        .breadcrumb-section {
            padding: 22px 0;
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

        @media (max-width: 900px) {
            .article-wrapper {
                grid-template-columns: 1fr;
            }

            .other-news {
                position: static;
            }
        }

        @media (max-width: 600px) {
            .article-content {
                padding: 23px;
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

                <a href="{{ route('news.index') }}">
                    Berita
                </a>

                <span>/</span>
                <span>{{ $news->title }}</span>
            </div>
        </div>
    </section>

    <section class="article-section">
        <div class="container article-wrapper">
            <article class="article-main">
                <img
                    src="{{ asset(
                        'storage/' . $news->thumbnail
                    ) }}"
                    alt="{{ $news->title }}"
                    class="article-image"
                >

                <div class="article-content">
                    <div class="article-meta">
                        <span>
                            {{ $news->published_at
                                ->translatedFormat('d F Y') }}
                        </span>

                        <span>
                            Oleh {{ $news->author->name }}
                        </span>
                    </div>

                    <h1 class="article-title">
                        {{ $news->title }}
                    </h1>

                    <p class="article-excerpt">
                        {{ $news->excerpt }}
                    </p>

                    <div class="article-body">
                        {{ $news->content }}
                    </div>
                </div>
            </article>

            <aside class="other-news">
                <h2>Berita Lainnya</h2>

                @forelse ($otherNews as $item)
                    <a
                        href="{{ route(
                            'news.show',
                            $item->slug
                        ) }}"
                        class="other-item"
                    >
                        <img
                            src="{{ asset(
                                'storage/' . $item->thumbnail
                            ) }}"
                            alt="{{ $item->title }}"
                        >

                        <strong>{{ $item->title }}</strong>

                        <span>
                            {{ $item->published_at
                                ->translatedFormat('d F Y') }}
                        </span>
                    </a>
                @empty
                    <p style="color: #6b7280;">
                        Belum ada berita lainnya.
                    </p>
                @endforelse
            </aside>
        </div>
    </section>
@endsection