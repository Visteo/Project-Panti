@extends('frontend.layouts.app')

@section('title', 'Berita dan Kegiatan | Harapan Bangsa')

@push('styles')
    <style>
        .news-hero {
            padding: 65px 0;
            background: linear-gradient(
                135deg,
                #0f766e,
                #34d399
            );
            color: white;
            text-align: center;
        }

        .news-hero h1 {
            margin-bottom: 10px;
            font-size: 42px;
        }

        .news-hero p {
            max-width: 650px;
            margin: auto;
            color: rgba(255, 255, 255, 0.82);
        }

        .news-search {
            max-width: 700px;
            display: flex;
            gap: 10px;
            margin: 0 auto 35px;
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            background: white;
        }

        .news-search input {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            outline: none;
        }

        .news-search input:focus {
            border-color: #0f766e;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .news-card {
            overflow: hidden;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
            background: white;
            transition: 0.2s;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .news-image {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }

        .news-content {
            padding: 20px;
        }

        .news-date {
            color: #0f766e;
            font-size: 13px;
            font-weight: 700;
        }

        .news-content h2 {
            min-height: 57px;
            margin: 9px 0;
            font-size: 20px;
            line-height: 1.4;
        }

        .news-content p {
            min-height: 67px;
            color: #6b7280;
            font-size: 14px;
        }

        .news-footer {
            margin-top: 18px;
        }

        .pagination-wrapper {
            margin-top: 30px;
        }

        @media (max-width: 900px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 620px) {
            .news-grid {
                grid-template-columns: 1fr;
            }

            .news-search {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
    <section class="news-hero">
        <div class="container">
            <h1>Berita dan Kegiatan</h1>

            <p>
                Ikuti informasi, kegiatan, dan cerita terbaru
                dari Harapan Bangsa.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <form
                action="{{ route('news.index') }}"
                method="GET"
                class="news-search"
            >
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari berita atau kegiatan..."
                >

                <button type="submit" class="btn btn-primary">
                    Cari
                </button>

                @if (request('search'))
                    <a
                        href="{{ route('news.index') }}"
                        class="btn btn-outline"
                    >
                        Reset
                    </a>
                @endif
            </form>

            <div class="news-grid">
                @forelse ($news as $item)
                    <article class="news-card">
                        <a
                            href="{{ route(
                                'news.show',
                                $item->slug
                            ) }}"
                        >
                            <img
                                src="{{ asset(
                                    'storage/' . $item->thumbnail
                                ) }}"
                                alt="{{ $item->title }}"
                                class="news-image"
                            >
                        </a>

                        <div class="news-content">
                            <span class="news-date">
                                {{ $item->published_at
                                    ->translatedFormat('d F Y') }}
                            </span>

                            <a
                                href="{{ route(
                                    'news.show',
                                    $item->slug
                                ) }}"
                            >
                                <h2>{{ $item->title }}</h2>
                            </a>

                            <p>
                                {{ Str::limit(
                                    $item->excerpt,
                                    120
                                ) }}
                            </p>

                            <div class="news-footer">
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
                @empty
                    <div
                        class="empty-state"
                        style="grid-column: 1 / -1;"
                    >
                        <h3>Berita tidak ditemukan</h3>

                        <p style="margin-top: 7px;">
                            Belum ada berita yang sesuai dengan pencarian.
                        </p>
                    </div>
                @endforelse
            </div>

            @if ($news->hasPages())
                <div class="pagination-wrapper">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection