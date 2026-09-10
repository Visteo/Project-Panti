@extends('frontend.layouts.app')

@section('title', $event->title . ' | Harapan Bangsa')

@push('styles')
    <style>
        .event-detail-hero {
            padding: 85px 0 160px;
            background:
                linear-gradient(
                    135deg,
                    #12355b,
                    #256b8f
                );
            color: white;
        }

        .event-detail-hero a {
            color: #fbbf24;
            font-weight: 700;
            text-decoration: none;
        }

        .event-detail-hero h1 {
            max-width: 850px;
            margin: 25px 0 18px;
            color: white;
            font-size: clamp(38px, 6vw, 65px);
            line-height: 1.12;
        }

        .event-detail-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 24px;
            color: rgba(255, 255, 255, 0.8);
        }

        .event-detail-content {
            margin-top: -100px;
            padding-bottom: 90px;
        }

        .event-detail-wrapper {
            overflow: hidden;
            border-radius: 38px;
            background: white;
            box-shadow: 0 25px 65px rgba(18, 53, 91, 0.14);
        }

        .event-detail-image {
            width: 100%;
            max-height: 570px;
            object-fit: cover;
        }

        .event-detail-placeholder {
            display: grid;
            height: 450px;
            place-items: center;
            background: #eaf4ff;
            color: #12355b;
            font-size: 70px;
            font-weight: 800;
        }

        .event-detail-body {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 55px;
            padding: 55px;
        }

        .event-description {
            color: #374151;
            font-size: 17px;
            line-height: 1.9;
        }

        .event-information {
            align-self: start;
            padding: 25px;
            border-radius: 22px;
            background: #fff8ed;
        }

        .event-information h3 {
            margin-bottom: 18px;
            color: #172033;
        }

        .information-item {
            padding: 14px 0;
            border-bottom: 1px solid #fde68a;
        }

        .information-item:last-child {
            border-bottom: 0;
        }

        .information-item span,
        .information-item strong {
            display: block;
        }

        .information-item span {
            margin-bottom: 5px;
            color: #6b7280;
            font-size: 12px;
        }

        .information-item strong {
            color: #172033;
            line-height: 1.5;
        }

        .other-events {
            padding: 80px 0;
            background: #eaf4ff;
        }

        @media (max-width: 800px) {
            .event-detail-body {
                grid-template-columns: 1fr;
                padding: 35px 25px;
            }

            .event-detail-placeholder {
                height: 300px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="event-detail-hero">
        <div class="container">
            <a href="{{ route('events.index') }}">
                ← Kembali ke Acara
            </a>

            <h1>{{ $event->title }}</h1>

            <div class="event-detail-meta">
                <span>
                    {{ $event->event_date
                        ->translatedFormat('d F Y') }}
                </span>

                @if ($event->start_time)
                    <span>
                        {{ substr($event->start_time, 0, 5) }}
                        @if ($event->end_time)
                            – {{ substr($event->end_time, 0, 5) }}
                        @endif
                        WIB
                    </span>
                @endif

                @if ($event->location)
                    <span>{{ $event->location }}</span>
                @endif
            </div>
        </div>
    </section>

    <section class="event-detail-content">
        <div class="container">
            <article class="event-detail-wrapper">
                @if ($event->thumbnail)
                    <img
                        src="{{ asset(
                            'storage/' . $event->thumbnail
                        ) }}"
                        alt="{{ $event->title }}"
                        class="event-detail-image"
                    >
                @else
                    <div class="event-detail-placeholder">
                        HB
                    </div>
                @endif

                <div class="event-detail-body">
                    <div class="event-description">
                        {!! nl2br(e($event->description)) !!}
                    </div>

                    <aside class="event-information">
                        <h3>Informasi Acara</h3>

                        <div class="information-item">
                            <span>Tanggal</span>

                            <strong>
                                {{ $event->event_date
                                    ->translatedFormat('d F Y') }}
                            </strong>
                        </div>

                        @if ($event->start_time)
                            <div class="information-item">
                                <span>Waktu</span>

                                <strong>
                                    {{ substr(
                                        $event->start_time,
                                        0,
                                        5
                                    ) }}

                                    @if ($event->end_time)
                                        – {{ substr(
                                            $event->end_time,
                                            0,
                                            5
                                        ) }}
                                    @endif

                                    WIB
                                </strong>
                            </div>
                        @endif

                        @if ($event->location)
                            <div class="information-item">
                                <span>Lokasi</span>

                                <strong>
                                    {{ $event->location }}
                                </strong>
                            </div>
                        @endif

                        <a
                            href="{{ route('campaigns.index') }}"
                            class="btn btn-primary"
                            style="
                                width: 100%;
                                margin-top: 20px;
                            "
                        >
                            Dukung Harapan Bangsa
                        </a>
                    </aside>
                </div>
            </article>
        </div>
    </section>

    @if ($otherEvents->isNotEmpty())
        <section class="other-events">
            <div class="container">
                <div class="section-header">
                    <span>Acara Lainnya</span>

                    <h2>Jelajahi Kegiatan Kami</h2>
                </div>

                <div class="public-events-grid">
                    @foreach ($otherEvents as $otherEvent)
                        @include(
                            'frontend.events._card',
                            ['event' => $otherEvent]
                        )
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection