<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?php echo $__env->yieldContent('title', 'Harapan Bangsa'); ?>
    </title>

    <meta
        name="description"
        content="<?php echo $__env->yieldContent(
            'meta_description',
            'Berbagi harapan bersama anak-anak Harapan Bangsa.'
        ); ?>"
    >

    <style>
        :root {
            --primary: #12355b;
            --primary-dark: #0c2947;
            --primary-light: #eaf4ff;
            --accent: #f59e0b;
            --coral: #ef6a5b;
            --background: #f8fafc;
            --white: #ffffff;
            --text: #172033;
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
            border-bottom: 1px solid rgba(18, 53, 91, 0.08);
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 8px 30px rgba(18, 53, 91, 0.05);
            backdrop-filter: blur(15px);
        }

        .navbar-content {
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--primary);
            font-size: 20px;
            font-weight: 900;
            letter-spacing: -0.4px;
        }

        .brand-icon {
            display: grid;
            width: 45px;
            height: 45px;
            place-items: center;
            border-radius: 15px;
            background: var(--coral);
            color: white;
            font-size: 21px;
            box-shadow: 0 8px 20px rgba(239, 106, 91, 0.22);
        }

        .brand-logo {
            width: 47px;
            height: 47px;
            padding: 4px;
            border: 1px solid rgba(18, 53, 91, 0.1);
            border-radius: 14px;
            background: white;
            object-fit: contain;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 23px;
        }

        .nav-link {
            position: relative;
            padding: 29px 0 27px;
            color: #4b5563;
            font-size: 13px;
            font-weight: 700;
            transition: color 0.2s;
        }

        .nav-link::after {
            position: absolute;
            right: 0;
            bottom: 19px;
            left: 0;
            width: 0;
            height: 3px;
            margin: auto;
            border-radius: 5px;
            background: var(--coral);
            content: "";
            transition: width 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 22px;
        }

        .nav-donate {
            min-height: 47px;
            padding: 12px 19px;
            border-radius: 13px;
            background: var(--accent);
            color: var(--text);
            box-shadow: 0 9px 22px rgba(245, 158, 11, 0.23);
            transition: transform 0.2s, background 0.2s;
        }

        .nav-donate:hover {
            transform: translateY(-2px);
            background: #fbbf24;
        }

        .mobile-button {
            display: none;
            width: 44px;
            height: 44px;
            border: 0;
            border-radius: 13px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 20px;
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
            position: relative;
            overflow: hidden;
            padding: 75px 0 28px;
            background: #0c2947;
            color: white;
        }

        .footer::before {
            position: absolute;
            top: -170px;
            right: -130px;
            width: 400px;
            height: 400px;
            border: 75px solid rgba(255, 255, 255, 0.04);
            border-radius: 50%;
            content: "";
        }

        .footer::after {
            position: absolute;
            bottom: -170px;
            left: -120px;
            width: 330px;
            height: 330px;
            border-radius: 50%;
            background: rgba(239, 106, 91, 0.07);
            content: "";
        }

        .footer .container {
            position: relative;
            z-index: 2;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.6fr 0.8fr 1fr;
            gap: 65px;
        }

        .footer h3 {
            position: relative;
            margin-bottom: 21px;
            color: white;
            font-size: 18px;
        }

        .footer h3::after {
            display: block;
            width: 35px;
            height: 3px;
            margin-top: 9px;
            border-radius: 5px;
            background: var(--accent);
            content: "";
        }

        .footer p,
        .footer a,
        .footer span {
            color: rgba(255, 255, 255, 0.7);
        }

        .footer p {
            max-width: 440px;
            line-height: 1.8;
        }

        .footer-links {
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            gap: 10px;
        }

        .footer-links a {
            position: relative;
            transition: color 0.2s, transform 0.2s;
        }

        .footer-links a:hover {
            transform: translateX(4px);
            color: #fbbf24;
        }

        .copyright {
            margin-top: 55px;
            padding-top: 23px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.52);
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

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <nav class="navbar">
        <div class="container navbar-content">
            <a href="<?php echo e(route('home')); ?>" class="brand">
                <?php if($siteSetting?->logo): ?>
                    <img
                        src="<?php echo e(asset(
                            'storage/' . $siteSetting->logo
                        )); ?>"
                        alt="<?php echo e($siteSetting->organization_name); ?>"
                        class="brand-logo"
                    >
                <?php else: ?>
                    <span class="brand-icon">♥</span>
                <?php endif; ?>

                <?php echo e($siteSetting?->organization_name
                    ?? 'Harapan Bangsa'); ?>

            </a>

            <button
                type="button"
                class="mobile-button"
                id="mobileButton"
                aria-label="Buka menu navigasi"
                aria-controls="navMenu"
                aria-expanded="false"
            >
                ☰
            </button>

            <div class="nav-menu" id="navMenu">
                <a
                    href="<?php echo e(route('home')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('home')
                            ? 'active'
                            : ''); ?>"
                >
                    Beranda
                </a>

                <a
                    href="<?php echo e(route('campaigns.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('campaigns.*')
                            ? 'active'
                            : ''); ?>"
                >
                    Campaign
                </a>

                <a
                    href="<?php echo e(route('news.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('news.*')
                            ? 'active'
                            : ''); ?>"
                >
                    Berita
                </a>

                <a
                    href="<?php echo e(route('events.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('events.*')
                            ? 'active'
                            : ''); ?>"
                >
                    Acara
                </a>

                <a href="<?php echo e(route('about')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('about')
                            ? 'active' : ''); ?>">
                    Tentang Kami
                </a>

                <a href="<?php echo e(route('contact')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>">
                    Kontak
                </a>

                <a
                    href="<?php echo e(route('campaigns.index')); ?>"
                    class="btn nav-donate"
                >
                    Donasi Sekarang
                </a>
            </div>
        </div>
    </nav>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3>
                        <?php echo e($siteSetting?->organization_name
                            ?? 'Harapan Bangsa'); ?>

                    </h3>

                    <p>
                        <?php echo e($siteSetting?->short_description
                            ?? 'Bersama menghadirkan harapan, pendidikan, dan masa depan yang lebih baik bagi anak-anak.'); ?>

                    </p>
                </div>

                <div>
                    <h3>Navigasi</h3>

                    <div class="footer-links">
                        <a href="<?php echo e(route('home')); ?>">
                            Beranda
                        </a>

                        <a href="<?php echo e(route('campaigns.index')); ?>">
                            Campaign
                        </a>

                        <a href="<?php echo e(route('events.index')); ?>">
                            Acara & Kegiatan
                        </a>

                        <a href="<?php echo e(route('news.index')); ?>">
                            Berita
                        </a>

                        <a href="<?php echo e(route('about')); ?>">
                            Tentang Kami
                        </a>

                        <a href="<?php echo e(route('contact')); ?>">
                            Kontak
                        </a>
                    </div>
                </div>

                <div>
                    <h3>Hubungi Kami</h3>

                    <div class="footer-links">
                        <?php if($siteSetting?->whatsapp_url): ?>
                            <a
                                href="<?php echo e($siteSetting->whatsapp_url); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                WhatsApp:
                                <?php echo e($siteSetting->whatsapp); ?>

                            </a>
                        <?php endif; ?>

                        <?php if($siteSetting?->email): ?>
                            <a
                                href="mailto:<?php echo e($siteSetting->email); ?>"
                            >
                                <?php echo e($siteSetting->email); ?>

                            </a>
                        <?php endif; ?>

                        <?php if($siteSetting?->instagram): ?>
                            <a
                                href="<?php echo e($siteSetting->instagram); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                Instagram
                            </a>
                        <?php endif; ?>

                        <?php if($siteSetting?->address): ?>
                            <span
                                style="
                                    color: rgba(255, 255, 255, 0.72);
                                "
                            >
                                <?php echo e($siteSetting->address); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="copyright">
                &copy; <?php echo e(date('Y')); ?>

                <?php echo e($siteSetting?->organization_name
                    ?? 'Harapan Bangsa'); ?>.
                Seluruh hak dilindungi.
            </div>
        </div>
    </footer>

    <script>
        const mobileButton =
            document.getElementById('mobileButton');

        const navMenu =
            document.getElementById('navMenu');

        if (mobileButton && navMenu) {
            mobileButton.addEventListener('click', function () {
                const isOpen = navMenu.classList.toggle('open');

                mobileButton.setAttribute(
                    'aria-expanded',
                    isOpen ? 'true' : 'false'
                );

                mobileButton.textContent = isOpen ? '×' : '☰';
            });

            navMenu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    navMenu.classList.remove('open');
                    mobileButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );
                    mobileButton.textContent = '☰';
                });
            });
        }
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/frontend/layouts/app.blade.php ENDPATH**/ ?>