@extends('frontend.layouts.app')

@section('title', 'Acara & Kegiatan | Harapan Bangsa')

@push('styles')
    <style>
        .events-hero {
            position: relative;
            padding: 105px 0 130px;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    #12355b,
                    #256b8f
                );
            color: white;
        }

        .events-hero::after {
            position: absolute;
            right: -100px;
            bottom: -180px;
            width: 420px;
            height: 420px;
            border: 75px solid rgba(255, 255, 255, 0.07);
            border-radius: 50%;
            content: "";
        }

        .events-hero-content {
            position: relative;
            z-index: 2;
            max-width: 720px;
        }

        .events-label {
            display: inline-block;
            margin-bottom: 15px;
            color: #fbbf24;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .events-hero h1 {
            margin-bottom: 18px;
            color: white;
            font-size: clamp(40px, 6vw, 68px);
            line-height: 1.08;
        }

        .events-hero p {
            max-width: 620px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 18px;
            line-height: 1.8;
        }

        .events-content {
            position: relative;
            z-index: 3;
            margin-top: -65px;
            padding-bottom: 90px;
        }

        .events-wrapper {
            padding: 50px;
            border-radius: 40px;
            background: #fff8ed;
            box-shadow: 0 25px 60px rgba(18, 53, 91, 0.12);
        }

        .events-heading {
            margin-bottom: 32px;
        }

        .events-heading h2 {
            margin-bottom: 8px;
            color: #172033;
            font-size: 32px;
        }

        .events-heading p {
            color: #6b7280;
        }

        .public-events-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .public-event-card {
            overflow: hidden;
            border-radius: 24px;
            background: white;
            box-shadow: 0 12px 35px rgba(18, 53, 91, 0.09);
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .public-event-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 20px 45px rgba(18, 53, 91, 0.15);
        }

        .public-event-image {
            position: relative;
            height: 230px;
            overflow: hidden;
            background: #dbeafe;
        }

        .public-event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .public-event-card:hover img {
            transform: scale(1.05);
        }

        .public-event-date {
            position: absolute;
            bottom: 15px;
            left: 15px;
            min-width: 68px;
            padding: 10px 13px;
            border-radius: 15px;
            background: #f59e0b;
            color: #172033;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .public-event-date strong,
        .public-event-date span {
            display: block;
        }

        .public-event-date strong {
            font-size: 24px;
            line-height: 1;
        }

        .public-event-date span {
            margin-top: 4px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .public-event-placeholder {
            display: grid;
            width: 100%;
            height: 100%;
            place-items: center;
            background:
                linear-gradient(
                    135deg,
                    #dbeafe,
                    #fef3c7
                );
            color: #12355b;
            font-size: 45px;
            font-weight: 800;
        }

        .public-event-body {
            padding: 24px;
        }

        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 15px;
            margin-bottom: 14px;
            color: #6b7280;
            font-size: 13px;
        }

        .public-event-body h3 {
            margin-bottom: 10px;
            color: #172033;
            font-size: 21px;
            line-height: 1.35;
        }

        .public-event-body p {
            min-height: 67px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.65;
        }

        .event-detail-link {
            display: inline-flex;
            margin-top: 18px;
            color: #12355b;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
        }

        .past-events-section {
            padding: 85px 0;
            background: #eaf4ff;
        }

        .empty-events {
            grid-column: 1 / -1;
            padding: 50px 25px;
            border: 2px dashed #d1d5db;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.6);
            color: #6b7280;
            text-align: center;
        }

        @media (max-width: 950px) {
            .public-events-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .events-hero {
                padding: 80px 0 110px;
            }

            .events-wrapper {
                padding: 30px 20px;
                border-radius: 28px;
            }

            .public-events-grid {
                grid-template-columns: 1fr;
            }

            .public-event-body p {
                min-height: auto;
            }
        }
    </style>
@endpush

@section('content')
    <section class="events-hero">
        <div class="container">
            <div class="events-hero-content">
                <span class="events-label">
                    Agenda Harapan Bangsa
                </span>

                <h1>Acara & Kegiatan</h1>

                <p>
                    Temukan berbagai kegiatan sosial, pendidikan,
                    dan kebersamaan yang diselenggarakan oleh
                    Yayasan Harapan Bangsa.
                </p>
            </div>
        </div>
    </section>

    <section class="events-content">
        <div class="container">
            <div class="events-wrapper">
                <div class="events-heading">
                    <h2>Acara Mendatang</h2>

                    <p>
                        Mari hadir dan menjadi bagian dari kegiatan kami.
                    </p>
                </div>

                <div class="public-events-grid">
                    @forelse ($upcomingEvents as $event)
                        @include(
                            'frontend.events._card',
                            ['event' => $event]
                        )
                    @empty
                        <div class="empty-events">
                            Belum ada acara mendatang yang dipublikasikan.
                        </div>
                    @endforelse
                </div>

                @if ($upcomingEvents->hasPages())
                    <div style="margin-top: 35px;">
                        {{ $upcomingEvents->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if ($pastEvents->isNotEmpty())
        <section class="past-events-section">
            <div class="container">
                <div class="events-heading">
                    <span class="events-label">
                        Cerita Perjalanan
                    </span>

                    <h2>Kegiatan yang Telah Dilaksanakan</h2>

                    <p>
                        Lihat kembali kebersamaan dan kegiatan
                        Harapan Bangsa sebelumnya.
                    </p>
                </div>

                <div class="public-events-grid">
                    @foreach ($pastEvents as $event)
                        @include(
                            'frontend.events._card',
                            ['event' => $event]
                        )
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection