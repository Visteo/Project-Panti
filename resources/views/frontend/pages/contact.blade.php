@extends('frontend.layouts.app')

@section(
    'title',
    'Kontak | ' .
    ($siteSetting?->organization_name ?? 'Harapan Bangsa')
)

@push('styles')
    <style>
        .contact-hero {
            padding: 65px 0;
            background: linear-gradient(
                135deg,
                #0f766e,
                #34d399
            );
            color: white;
            text-align: center;
        }

        .contact-hero h1 {
            margin-bottom: 10px;
            font-size: 42px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
            max-width: 900px;
            margin: auto;
        }

        .contact-card {
            padding: 27px;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            background: white;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            display: grid;
            place-items: center;
            margin-bottom: 16px;
            border-radius: 13px;
            background: #ccfbf1;
            color: #0f766e;
            font-size: 22px;
        }

        .contact-card h2 {
            margin-bottom: 8px;
            font-size: 20px;
        }

        .contact-card p {
            color: #6b7280;
        }

        .contact-card .btn {
            margin-top: 18px;
        }

        @media (max-width: 650px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <section class="contact-hero">
        <div class="container">
            <h1>Hubungi Kami</h1>

            <p>
                Kami siap menerima pertanyaan dan informasi
                mengenai donasi serta kegiatan organisasi.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="contact-grid">
                @if ($siteSetting?->whatsapp_url)
                    <article class="contact-card">
                        <div class="contact-icon">☎</div>
                        <h2>WhatsApp</h2>
                        <p>{{ $siteSetting->whatsapp }}</p>

                        <a
                            href="{{ $siteSetting->whatsapp_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-primary"
                        >
                            Hubungi melalui WhatsApp
                        </a>
                    </article>
                @endif

                @if ($siteSetting?->email)
                    <article class="contact-card">
                        <div class="contact-icon">✉</div>
                        <h2>Email</h2>
                        <p>{{ $siteSetting->email }}</p>

                        <a
                            href="mailto:{{ $siteSetting->email }}"
                            class="btn btn-primary"
                        >
                            Kirim Email
                        </a>
                    </article>
                @endif

                @if ($siteSetting?->instagram)
                    <article class="contact-card">
                        <div class="contact-icon">◎</div>
                        <h2>Instagram</h2>
                        <p>Ikuti kegiatan terbaru kami.</p>

                        <a
                            href="{{ $siteSetting->instagram }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-primary"
                        >
                            Buka Instagram
                        </a>
                    </article>
                @endif

                @if ($siteSetting?->address)
                    <article class="contact-card">
                        <div class="contact-icon">⌖</div>
                        <h2>Alamat</h2>
                        <p>{{ $siteSetting->address }}</p>
                    </article>
                @endif
            </div>

            @if (
                !$siteSetting?->whatsapp
                && !$siteSetting?->email
                && !$siteSetting?->instagram
                && !$siteSetting?->address
            )
                <div class="empty-state">
                    Informasi kontak belum tersedia.
                </div>
            @endif
        </div>
    </section>
@endsection