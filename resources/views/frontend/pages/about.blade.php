@extends('frontend.layouts.app')

@section(
    'title',
    'Tentang Kami | ' .
    ($siteSetting?->organization_name ?? 'Harapan Bangsa')
)

@push('styles')
    <style>
        .page-hero {
            padding: 65px 0;
            background: linear-gradient(
                135deg,
                #0f766e,
                #34d399
            );
            color: white;
            text-align: center;
        }

        .page-hero h1 {
            margin-bottom: 10px;
            font-size: 42px;
        }

        .page-hero p {
            max-width: 650px;
            margin: auto;
            color: rgba(255, 255, 255, 0.82);
        }

        .about-card {
            max-width: 900px;
            margin: auto;
            padding: 38px;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            background: white;
        }

        .about-logo {
            max-width: 180px;
            max-height: 130px;
            display: block;
            margin: 0 auto 25px;
            object-fit: contain;
        }

        .about-card h2 {
            margin-bottom: 18px;
            text-align: center;
            font-size: 30px;
        }

        .about-content {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.9;
            white-space: pre-line;
        }

        .about-address {
            margin-top: 30px;
            padding: 20px;
            border-radius: 12px;
            background: #f0fdfa;
        }

        @media (max-width: 600px) {
            .about-card {
                padding: 24px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>Tentang Kami</h1>

            <p>
                Mengenal lebih dekat
                {{ $siteSetting?->organization_name
                    ?? 'Harapan Bangsa' }}.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <article class="about-card">
                @if ($siteSetting?->logo)
                    <img
                        src="{{ asset(
                            'storage/' . $siteSetting->logo
                        ) }}"
                        alt="{{ $siteSetting->organization_name }}"
                        class="about-logo"
                    >
                @endif

                <h2>
                    {{ $siteSetting?->organization_name
                        ?? 'Harapan Bangsa' }}
                </h2>

                <div class="about-content">
                    {{ $siteSetting?->about
                        ?? 'Informasi tentang organisasi belum tersedia.' }}
                </div>

                @if ($siteSetting?->address)
                    <div class="about-address">
                        <strong>Alamat Organisasi</strong>

                        <p style="margin-top: 7px;">
                            {{ $siteSetting->address }}
                        </p>
                    </div>
                @endif
            </article>
        </div>
    </section>
@endsection