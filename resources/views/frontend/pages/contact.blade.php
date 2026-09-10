@extends('frontend.layouts.app')

@section(
    'title',
    'Kontak | ' .
    ($siteSetting?->organization_name ?? 'Harapan Bangsa')
)

@section(
    'meta_description',
    'Hubungi ' .
    ($siteSetting?->organization_name ?? 'Harapan Bangsa') .
    ' untuk informasi donasi dan kegiatan yayasan.'
)

@push('styles')
    <style>
        .contact-hero {
            position: relative;
            padding: 95px 24px 165px;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    #0c2947 0%,
                    #12355b 55%,
                    #256b8f 100%
                );
            color: white;
        }

        .contact-hero::before {
            position: absolute;
            top: -150px;
            right: -90px;
            width: 390px;
            height: 390px;
            border: 75px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            content: "";
        }

        .contact-hero::after {
            position: absolute;
            bottom: -150px;
            left: -90px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(245, 158, 11, 0.14);
            content: "";
        }

        .contact-hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
        }

        .contact-hero-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 21px;
            color: #fbbf24;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .contact-hero-label::before {
            width: 31px;
            height: 3px;
            border-radius: 5px;
            background: #fbbf24;
            content: "";
        }

        .contact-hero h1 {
            max-width: 750px;
            margin-bottom: 21px;
            color: white;
            font-size: clamp(42px, 6vw, 70px);
            line-height: 1.08;
            letter-spacing: -1.5px;
        }

        .contact-hero p {
            max-width: 650px;
            color: rgba(255, 255, 255, 0.77);
            font-size: 18px;
            line-height: 1.8;
        }

        .contact-section {
            position: relative;
            z-index: 4;
            margin-top: -95px;
            padding: 0 24px 105px;
        }

        .contact-wrapper {
            position: relative;
            overflow: hidden;
            padding: 65px;
            border-radius: 45px;
            background:
                linear-gradient(
                    145deg,
                    #eaf4ff 0%,
                    #f6f9ff 52%,
                    #fff8ed 100%
                );
            box-shadow: 0 27px 70px rgba(18, 53, 91, 0.15);
        }

        .contact-wrapper::before {
            position: absolute;
            top: -110px;
            right: -75px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(239, 106, 91, 0.13);
            content: "";
        }

        .contact-heading {
            position: relative;
            z-index: 2;
            max-width: 680px;
            margin-bottom: 40px;
        }

        .contact-heading span {
            display: block;
            margin-bottom: 11px;
            color: #ef6a5b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .contact-heading h2 {
            margin-bottom: 13px;
            color: #172033;
            font-size: clamp(31px, 4vw, 47px);
            line-height: 1.15;
        }

        .contact-heading p {
            color: #6b7280;
            line-height: 1.75;
        }

        .contact-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .contact-card {
            position: relative;
            display: flex;
            min-height: 275px;
            padding: 30px;
            overflow: hidden;
            flex-direction: column;
            border: 1px solid rgba(18, 53, 91, 0.08);
            border-radius: 27px;
            background: white;
            box-shadow: 0 14px 35px rgba(18, 53, 91, 0.08);
            transition:
                transform 0.3s,
                box-shadow 0.3s;
        }

        .contact-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 22px 45px rgba(18, 53, 91, 0.14);
        }

        .contact-card::after {
            position: absolute;
            right: -45px;
            bottom: -55px;
            width: 135px;
            height: 135px;
            border-radius: 50%;
            background: rgba(18, 53, 91, 0.04);
            content: "";
        }

        .contact-card:nth-child(2)::after {
            background: rgba(239, 106, 91, 0.08);
        }

        .contact-card:nth-child(3)::after {
            background: rgba(245, 158, 11, 0.1);
        }

        .contact-icon {
            display: grid;
            width: 58px;
            height: 58px;
            margin-bottom: 24px;
            place-items: center;
            border-radius: 18px;
            background: #12355b;
            color: white;
            font-size: 24px;
        }

        .contact-card:nth-child(2) .contact-icon {
            background: #ef6a5b;
        }

        .contact-card:nth-child(3) .contact-icon {
            background: #f59e0b;
            color: #172033;
        }

        .contact-card:nth-child(4) .contact-icon {
            background: #256b8f;
        }

        .contact-card h3 {
            margin-bottom: 10px;
            color: #172033;
            font-size: 23px;
        }

        .contact-card p {
            position: relative;
            z-index: 2;
            margin-bottom: 22px;
            color: #6b7280;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .contact-card-action {
            position: relative;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
            margin-top: auto;
            color: #12355b;
            font-weight: 800;
            text-decoration: none;
            transition: color 0.2s;
        }

        .contact-card-action:hover {
            color: #ef6a5b;
        }

        .contact-main-card {
            grid-row: span 2;
            min-height: 572px;
            padding: 40px;
            background:
                linear-gradient(
                    145deg,
                    #12355b,
                    #194b76
                );
            color: white;
        }

        .contact-main-card::after {
            right: -85px;
            bottom: -100px;
            width: 280px;
            height: 280px;
            border: 55px solid rgba(255, 255, 255, 0.06);
            background: transparent;
        }

        .contact-main-card .contact-icon {
            background: #f59e0b;
            color: #172033;
        }

        .contact-main-card h3 {
            color: white;
            font-size: 30px;
        }

        .contact-main-card p {
            color: rgba(255, 255, 255, 0.75);
        }

        .contact-main-card .contact-card-action {
            padding: 13px 19px;
            border-radius: 13px;
            background: #f59e0b;
            color: #172033;
        }

        .contact-main-card .contact-card-action:hover {
            transform: translateY(-2px);
            background: #fbbf24;
        }

        .contact-phone {
            display: block;
            margin-top: 8px;
            color: rgba(255, 255, 255, 0.65);
            font-size: 14px;
        }

        .contact-empty {
            position: relative;
            z-index: 2;
            padding: 45px 25px;
            border-radius: 25px;
            background: white;
            color: #6b7280;
            text-align: center;
        }

        .contact-bottom {
            padding: 0 24px 110px;
        }

        .contact-bottom-wrapper {
            display: grid;
            align-items: center;
            grid-template-columns: 1fr auto;
            gap: 35px;
            padding: 48px 55px;
            border-radius: 35px;
            background: #f59e0b;
            color: #172033;
        }

        .contact-bottom-label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .contact-bottom h2 {
            margin-bottom: 10px;
            color: #172033;
            font-size: clamp(27px, 4vw, 40px);
        }

        .contact-bottom p {
            max-width: 690px;
            color: rgba(23, 32, 51, 0.75);
            line-height: 1.7;
        }

        .contact-donation-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 51px;
            padding: 13px 22px;
            border-radius: 13px;
            background: #12355b;
            color: white;
            font-weight: 800;
            text-decoration: none;
            white-space: nowrap;
            transition: 0.25s;
        }

        .contact-donation-button:hover {
            transform: translateY(-3px);
            background: #0c2947;
        }

        @media (max-width: 850px) {
            .contact-wrapper {
                padding: 48px 30px;
                border-radius: 34px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .contact-main-card {
                grid-row: auto;
                min-height: 350px;
            }

            .contact-bottom-wrapper {
                grid-template-columns: 1fr;
            }

            .contact-donation-button {
                width: fit-content;
            }
        }

        @media (max-width: 600px) {
            .contact-hero {
                padding: 70px 12px 130px;
            }

            .contact-hero h1 {
                font-size: 42px;
            }

            .contact-section {
                margin-top: -70px;
                padding: 0 12px 75px;
            }

            .contact-wrapper {
                padding: 38px 20px;
                border-radius: 28px;
            }

            .contact-card,
            .contact-main-card {
                min-height: auto;
                padding: 26px 22px;
                border-radius: 22px;
            }

            .contact-bottom {
                padding: 0 12px 75px;
            }

            .contact-bottom-wrapper {
                padding: 36px 23px;
                border-radius: 27px;
            }

            .contact-donation-button {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $hasContact =
            $siteSetting?->whatsapp_url
            || $siteSetting?->email
            || $siteSetting?->phone
            || $siteSetting?->instagram
            || $siteSetting?->address;
    @endphp

    <section class="contact-hero">
        <div class="container">
            <div class="contact-hero-content">
                <span class="contact-hero-label">
                    Terhubung dengan Kami
                </span>

                <h1>
                    Mari Berbagi Cerita dan Kebaikan
                </h1>

                <p>
                    Kami siap menerima pertanyaan mengenai donasi,
                    kegiatan, kerja sama, maupun informasi lainnya
                    tentang
                    {{ $siteSetting?->organization_name
                        ?? 'Harapan Bangsa' }}.
                </p>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-heading">
                    <span>Informasi Kontak</span>

                    <h2>Pilih Cara untuk Menghubungi Kami</h2>

                    <p>
                        Hubungi kami melalui saluran komunikasi yang
                        paling nyaman untukmu.
                    </p>
                </div>

                @if ($hasContact)
                    <div class="contact-grid">
                        @if ($siteSetting?->whatsapp_url)
                            <article
                                class="contact-card contact-main-card"
                            >
                                <div class="contact-icon">☎</div>

                                <h3>WhatsApp</h3>

                                <p>
                                    Hubungi kami secara langsung untuk
                                    bertanya mengenai donasi, acara, dan
                                    kegiatan yayasan.
                                </p>

                                <strong>
                                    {{ $siteSetting->whatsapp }}
                                </strong>

                                @if ($siteSetting?->phone)
                                    <span class="contact-phone">
                                        Telepon:
                                        {{ $siteSetting->phone }}
                                    </span>
                                @endif

                                <a
                                    href="{{ $siteSetting->whatsapp_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="contact-card-action"
                                >
                                    Hubungi via WhatsApp →
                                </a>
                            </article>
                        @endif

                        @if ($siteSetting?->email)
                            <article class="contact-card">
                                <div class="contact-icon">✉</div>

                                <h3>Email</h3>

                                <p>{{ $siteSetting->email }}</p>

                                <a
                                    href="mailto:{{ $siteSetting->email }}"
                                    class="contact-card-action"
                                >
                                    Kirim Email →
                                </a>
                            </article>
                        @endif

                        @if ($siteSetting?->instagram)
                            <article class="contact-card">
                                <div class="contact-icon">◎</div>

                                <h3>Instagram</h3>

                                <p>
                                    Ikuti informasi dan dokumentasi
                                    kegiatan terbaru kami.
                                </p>

                                <a
                                    href="{{ $siteSetting->instagram }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="contact-card-action"
                                >
                                    Buka Instagram →
                                </a>
                            </article>
                        @endif

                        @if (
                            $siteSetting?->phone
                            && !$siteSetting?->whatsapp_url
                        )
                            <article class="contact-card">
                                <div class="contact-icon">☎</div>

                                <h3>Telepon</h3>

                                <p>{{ $siteSetting->phone }}</p>

                                <a
                                    href="tel:{{ preg_replace(
                                        '/[^0-9+]/',
                                        '',
                                        $siteSetting->phone
                                    ) }}"
                                    class="contact-card-action"
                                >
                                    Hubungi Sekarang →
                                </a>
                            </article>
                        @endif

                        @if ($siteSetting?->address)
                            <article class="contact-card">
                                <div class="contact-icon">⌖</div>

                                <h3>Alamat Yayasan</h3>

                                <p>{{ $siteSetting->address }}</p>

                                <a
                                    href="https://www.google.com/maps/search/?api=1&query={{
                                        urlencode($siteSetting->address)
                                    }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="contact-card-action"
                                >
                                    Buka Google Maps →
                                </a>
                            </article>
                        @endif
                    </div>
                @else
                    <div class="contact-empty">
                        Informasi kontak belum tersedia.
                        Silakan lengkapi melalui Pengaturan Website.
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="contact-bottom">
        <div class="container">
            <div class="contact-bottom-wrapper">
                <div>
                    <span class="contact-bottom-label">
                        Mari Ambil Bagian
                    </span>

                    <h2>
                        Kebaikan Kecilmu Membawa Harapan Besar
                    </h2>

                    <p>
                        Setiap bantuan menjadi langkah nyata untuk
                        mendukung kebutuhan, pendidikan, dan masa
                        depan anak-anak Harapan Bangsa.
                    </p>
                </div>

                <a
                    href="{{ route('campaigns.index') }}"
                    class="contact-donation-button"
                >
                    Donasi Sekarang →
                </a>
            </div>
        </div>
    </section>
@endsection