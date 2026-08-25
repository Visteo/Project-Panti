<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Harapan Bangsa')
    </title>

    <meta
        name="description"
        content="@yield(
            'meta_description',
            'Berbagi harapan bersama anak-anak Harapan Bangsa.'
        )"
    >

    <style>
        :root {
            --primary: #0f766e;
            --primary-dark: #115e59;
            --primary-light: #ccfbf1;
            --accent: #f59e0b;
            --background: #f8fafc;
            --white: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--background);
            color: var(--text);
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        img {
            max-width: 100%;
        }

        .container {
            width: min(1160px, calc(100% - 40px));
            margin: 0 auto;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.96);
        }

        .navbar-content {
            min-height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            color: var(--primary);
            font-size: 21px;
            font-weight: 800;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: var(--primary);
            color: white;
            font-size: 21px;
        }

        .brand-logo {
            width: 45px;
            height: 45px;
            padding: 4px;
            object-fit: contain;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: white;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 27px;
        }

        .nav-link {
            color: #4b5563;
            font-size: 14px;
            font-weight: 600;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 17px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-light {
            background: white;
            color: var(--primary);
        }

        .btn-outline {
            border: 1px solid var(--border);
            background: white;
            color: var(--text);
        }

        .mobile-button {
            display: none;
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 9px;
            background: var(--primary-light);
            color: var(--primary);
            cursor: pointer;
        }

        .section {
            padding: 75px 0;
        }

        .section-header {
            max-width: 650px;
            margin: 0 auto 38px;
            text-align: center;
        }

        .section-header span {
            color: var(--primary);
            font-weight: 700;
        }

        .section-header h2 {
            margin: 8px 0 10px;
            font-size: 34px;
            line-height: 1.25;
        }

        .section-header p {
            color: var(--muted);
        }

        .campaign-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .campaign-card {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 17px;
            background: white;
            transition: 0.2s;
        }

        .campaign-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .campaign-image {
            position: relative;
            height: 210px;
            overflow: hidden;
            background: #e5e7eb;
        }

        .campaign-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            padding: 6px 10px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.92);
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        .campaign-content {
            padding: 20px;
        }

        .campaign-content h3 {
            min-height: 56px;
            margin-bottom: 9px;
            font-size: 19px;
            line-height: 1.45;
        }

        .campaign-content p {
            min-height: 48px;
            color: var(--muted);
            font-size: 14px;
        }

        .progress {
            height: 9px;
            margin: 19px 0 10px;
            overflow: hidden;
            border-radius: 20px;
            background: #e5e7eb;
        }

        .progress-bar {
            height: 100%;
            border-radius: 20px;
            background: var(--primary);
        }

        .campaign-nominal {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-size: 13px;
        }

        .campaign-nominal strong {
            display: block;
            color: var(--primary);
            font-size: 15px;
        }

        .campaign-target {
            color: var(--muted);
            text-align: right;
        }

        .footer {
            padding: 55px 0 25px;
            background: #0f3d3a;
            color: white;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 45px;
        }

        .footer p,
        .footer a {
            color: rgba(255, 255, 255, 0.72);
        }

        .footer h3 {
            margin-bottom: 14px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .copyright {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            font-size: 13px;
        }

        .empty-state {
            grid-column: 1 / -1;
            padding: 55px 20px;
            border: 1px solid var(--border);
            border-radius: 15px;
            background: white;
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 900px) {
            .campaign-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .mobile-button {
                display: block;
            }

            .nav-menu {
                position: absolute;
                top: 74px;
                right: 20px;
                left: 20px;
                display: none;
                align-items: stretch;
                flex-direction: column;
                gap: 6px;
                padding: 18px;
                border: 1px solid var(--border);
                border-radius: 12px;
                background: white;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            }

            .nav-menu.open {
                display: flex;
            }

            .nav-link {
                padding: 10px;
            }
        }

        @media (max-width: 620px) {
            .campaign-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 55px 0;
            }

            .section-header h2 {
                font-size: 28px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <nav class="navbar">
        <div class="container navbar-content">
            <a href="{{ route('home') }}" class="brand">
                @if ($siteSetting?->logo)
                    <img
                        src="{{ asset(
                            'storage/' . $siteSetting->logo
                        ) }}"
                        alt="{{ $siteSetting->organization_name }}"
                        class="brand-logo"
                    >
                @else
                    <span class="brand-icon">♥</span>
                @endif

                {{ $siteSetting?->organization_name
                    ?? 'Harapan Bangsa' }}
            </a>

            <button
                type="button"
                class="mobile-button"
                id="mobileButton"
            >
                ☰
            </button>

            <div class="nav-menu" id="navMenu">
                <a
                    href="{{ route('home') }}"
                    class="nav-link {{
                        request()->routeIs('home')
                            ? 'active'
                            : ''
                    }}"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('campaigns.index') }}"
                    class="nav-link {{
                        request()->routeIs('campaigns.*')
                            ? 'active'
                            : ''
                    }}"
                >
                    Campaign
                </a>

                <a
                    href="{{ route('news.index') }}"
                    class="nav-link {{
                        request()->routeIs('news.*')
                            ? 'active'
                            : ''
                    }}"
                >
                    Berita
                </a>

                <a href="{{ route('about') }}"
                    class="nav-link {{
                        request()->routeIs('about')
                            ? 'active' : '' }}">
                    Tentang Kami
                </a>

                <a href="{{ route('contact') }}"
                    class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Kontak
                </a>

                <a
                    href="{{ route('campaigns.index') }}"
                    class="btn btn-primary"
                >
                    Donasi Sekarang
                </a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3>
                        {{ $siteSetting?->organization_name
                            ?? 'Harapan Bangsa' }}
                    </h3>

                    <p>
                        {{ $siteSetting?->short_description
                            ?? 'Bersama menghadirkan harapan, pendidikan, dan masa depan yang lebih baik bagi anak-anak.' }}
                    </p>
                </div>

                <div>
                    <h3>Navigasi</h3>

                    <div class="footer-links">
                        <a href="{{ route('home') }}">
                            Beranda
                        </a>

                        <a href="{{ route('campaigns.index') }}">
                            Campaign
                        </a>

                        <a href="{{ route('news.index') }}">
                            Berita
                        </a>

                        <a href="{{ route('about') }}">
                            Tentang Kami
                        </a>

                        <a href="{{ route('contact') }}">
                            Kontak
                        </a>
                    </div>
                </div>

                <div>
                    <h3>Hubungi Kami</h3>

                    <div class="footer-links">
                        @if ($siteSetting?->whatsapp_url)
                            <a
                                href="{{ $siteSetting->whatsapp_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                WhatsApp:
                                {{ $siteSetting->whatsapp }}
                            </a>
                        @endif

                        @if ($siteSetting?->email)
                            <a
                                href="mailto:{{ $siteSetting->email }}"
                            >
                                {{ $siteSetting->email }}
                            </a>
                        @endif

                        @if ($siteSetting?->instagram)
                            <a
                                href="{{ $siteSetting->instagram }}"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                Instagram
                            </a>
                        @endif

                        @if ($siteSetting?->address)
                            <span
                                style="
                                    color: rgba(255, 255, 255, 0.72);
                                "
                            >
                                {{ $siteSetting->address }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="copyright">
                &copy; {{ date('Y') }}
                {{ $siteSetting?->organization_name
                    ?? 'Harapan Bangsa' }}.
                Seluruh hak dilindungi.
            </div>
        </div>
    </footer>

    <script>
        const mobileButton = document.getElementById('mobileButton');
        const navMenu = document.getElementById('navMenu');

        mobileButton.addEventListener('click', function () {
            navMenu.classList.toggle('open');
        });
    </script>

    @stack('scripts')
</body>
</html>