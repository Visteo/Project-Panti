

<?php $__env->startSection(
    'title',
    'Tentang Kami | ' .
    ($siteSetting?->organization_name ?? 'Harapan Bangsa')
); ?>

<?php $__env->startSection(
    'meta_description',
    $siteSetting?->short_description
        ?? 'Mengenal lebih dekat Yayasan Harapan Bangsa.'
); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .about-hero {
            position: relative;
            padding: 95px 24px 165px;
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

        .about-hero::before {
            position: absolute;
            top: -150px;
            right: -100px;
            width: 390px;
            height: 390px;
            border: 75px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            content: "";
        }

        .about-hero::after {
            position: absolute;
            bottom: -160px;
            left: -90px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(245, 158, 11, 0.14);
            content: "";
        }

        .about-hero-content {
            position: relative;
            z-index: 2;
            max-width: 850px;
        }

        .about-hero-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 21px;
            color: #fbbf24;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .about-hero-label::before {
            width: 31px;
            height: 3px;
            border-radius: 5px;
            background: #fbbf24;
            content: "";
        }

        .about-hero h1 {
            max-width: 790px;
            margin-bottom: 22px;
            color: white;
            font-size: clamp(42px, 6vw, 72px);
            line-height: 1.08;
            letter-spacing: -1.7px;
        }

        .about-hero p {
            max-width: 690px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 18px;
            line-height: 1.8;
        }

        .about-profile-section {
            position: relative;
            z-index: 4;
            margin-top: -95px;
            padding: 0 24px 105px;
        }

        .about-profile-wrapper {
            display: grid;
            align-items: stretch;
            grid-template-columns: 0.95fr 1.05fr;
            overflow: hidden;
            border-radius: 40px;
            background: white;
            box-shadow: 0 27px 70px rgba(18, 53, 91, 0.15);
        }

        .about-photo {
            position: relative;
            min-height: 560px;
            overflow: hidden;
            background:
                linear-gradient(
                    135deg,
                    #12355b,
                    #256b8f
                );
        }

        .about-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .about-photo::after {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    to top,
                    rgba(12, 41, 71, 0.45),
                    transparent 55%
                );
            content: "";
        }

        .about-photo-placeholder {
            display: grid;
            width: 100%;
            height: 100%;
            min-height: 560px;
            place-items: center;
            color: rgba(255, 255, 255, 0.25);
            font-size: 100px;
            font-weight: 900;
        }

        .about-photo-label {
            position: absolute;
            z-index: 2;
            right: 27px;
            bottom: 27px;
            left: 27px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 18px;
            background: rgba(12, 41, 71, 0.65);
            color: white;
            backdrop-filter: blur(12px);
        }

        .about-photo-label strong {
            display: block;
            margin-bottom: 5px;
            font-size: 18px;
        }

        .about-photo-label span {
            color: rgba(255, 255, 255, 0.72);
            font-size: 13px;
        }

        .about-profile-content {
            padding: 60px 55px;
        }

        .about-profile-label {
            display: inline-block;
            margin-bottom: 13px;
            color: #ef6a5b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .about-profile-content h2 {
            margin-bottom: 24px;
            color: #172033;
            font-size: clamp(31px, 4vw, 46px);
            line-height: 1.16;
        }

        .about-profile-text {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.9;
            white-space: pre-line;
        }

        .about-address {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-top: 30px;
            padding: 19px;
            border-radius: 17px;
            background: #fff8ed;
        }

        .about-address-icon {
            display: grid;
            width: 43px;
            height: 43px;
            flex: 0 0 43px;
            place-items: center;
            border-radius: 13px;
            background: #f59e0b;
            color: #172033;
            font-weight: 900;
        }

        .about-address strong {
            display: block;
            margin-bottom: 5px;
            color: #172033;
        }

        .about-address p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.65;
        }

        .about-identity-section {
            padding: 0 24px 105px;
        }

        .about-identity-wrapper {
            position: relative;
            overflow: hidden;
            padding: 65px;
            border-radius: 45px;
            background:
                linear-gradient(
                    135deg,
                    #12355b,
                    #194b76
                );
            color: white;
        }

        .about-section-heading {
            position: relative;
            z-index: 2;
            max-width: 680px;
            margin-bottom: 40px;
        }

        .about-section-heading span {
            display: block;
            margin-bottom: 10px;
            color: #fbbf24;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .about-section-heading h2 {
            margin-bottom: 13px;
            color: white;
            font-size: clamp(31px, 4vw, 46px);
        }

        .about-section-heading p {
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.75;
        }

        .about-identity-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 0.85fr 1.15fr;
            gap: 24px;
        }

        .about-vision,
        .about-mission {
            padding: 35px;
            border-radius: 28px;
        }

        .about-vision {
            background: #f59e0b;
            color: #172033;
        }

        .about-vision-icon {
            display: grid;
            width: 58px;
            height: 58px;
            margin-bottom: 45px;
            place-items: center;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.45);
            font-size: 26px;
        }

        .about-vision h3,
        .about-mission h3 {
            margin-bottom: 17px;
            font-size: 27px;
        }

        .about-vision p {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.75;
        }

        .about-mission {
            border: 1px solid rgba(255, 255, 255, 0.17);
            background: rgba(255, 255, 255, 0.09);
        }

        .about-mission h3 {
            color: white;
        }

        .about-mission-list {
            display: grid;
            gap: 12px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .about-mission-item {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 14px 16px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        .about-mission-number {
            display: grid;
            width: 30px;
            height: 30px;
            flex: 0 0 30px;
            place-items: center;
            border-radius: 50%;
            background: #f59e0b;
            color: #172033;
            font-size: 11px;
            font-weight: 900;
        }

        .about-founders-section {
            padding: 0 24px 110px;
        }

        .about-founders-wrapper {
            padding: 65px;
            border-radius: 45px;
            background:
                linear-gradient(
                    145deg,
                    #eaf4ff,
                    #fff8ed
                );
        }

        .about-founders-heading {
            max-width: 700px;
            margin: 0 auto 43px;
            text-align: center;
        }

        .about-founders-heading span {
            color: #ef6a5b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .about-founders-heading h2 {
            margin: 12px 0;
            color: #172033;
            font-size: clamp(31px, 4vw, 46px);
        }

        .about-founders-heading p {
            color: #6b7280;
            line-height: 1.75;
        }

        .about-founders-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .about-founder-card {
            overflow: hidden;
            border-radius: 25px;
            background: white;
            box-shadow: 0 15px 38px rgba(18, 53, 91, 0.1);
            transition: 0.3s;
        }

        .about-founder-card:hover {
            transform: translateY(-7px);
        }

        .about-founder-photo {
            height: 310px;
            overflow: hidden;
            background: #12355b;
        }

        .about-founder-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            transition: transform 0.4s;
        }

        .about-founder-card:hover img {
            transform: scale(1.05);
        }

        .about-founder-placeholder {
            display: grid;
            width: 100%;
            height: 100%;
            place-items: center;
            color: rgba(255, 255, 255, 0.75);
            font-size: 55px;
            font-weight: 900;
        }

        .about-founder-content {
            padding: 24px;
        }

        .about-founder-position {
            display: block;
            margin-bottom: 7px;
            color: #ef6a5b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .about-founder-content h3 {
            margin-bottom: 10px;
            color: #172033;
            font-size: 21px;
        }

        .about-founder-content p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.7;
        }

        @media (max-width: 950px) {
            .about-profile-wrapper,
            .about-identity-grid {
                grid-template-columns: 1fr;
            }

            .about-photo {
                min-height: 450px;
            }

            .about-founders-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .about-hero {
                padding: 70px 12px 130px;
            }

            .about-hero h1 {
                font-size: 42px;
            }

            .about-profile-section {
                margin-top: -70px;
                padding: 0 12px 75px;
            }

            .about-profile-wrapper {
                border-radius: 27px;
            }

            .about-photo,
            .about-photo-placeholder {
                min-height: 330px;
            }

            .about-profile-content {
                padding: 36px 23px;
            }

            .about-identity-section,
            .about-founders-section {
                padding-right: 12px;
                padding-bottom: 75px;
                padding-left: 12px;
            }

            .about-identity-wrapper,
            .about-founders-wrapper {
                padding: 40px 20px;
                border-radius: 28px;
            }

            .about-vision,
            .about-mission {
                padding: 26px 21px;
            }

            .about-founders-grid {
                grid-template-columns: 1fr;
            }

            .about-founder-photo {
                height: 350px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="about-hero">
        <div class="container">
            <div class="about-hero-content">
                <span class="about-hero-label">
                    Mengenal Kami
                </span>

                <h1>
                    Bertumbuh Bersama,
                    Menghadirkan Harapan
                </h1>

                <p>
                    <?php echo e($siteSetting?->short_description
                        ?? 'Kami hadir untuk mendukung kebutuhan, pendidikan, dan masa depan anak-anak.'); ?>

                </p>
            </div>
        </div>
    </section>

    <section class="about-profile-section">
        <div class="container">
            <article class="about-profile-wrapper">
                <div class="about-photo">
                    <?php if($siteSetting?->about_image): ?>
                        <img
                            src="<?php echo e(asset(
                                'storage/' .
                                $siteSetting->about_image
                            )); ?>"
                            alt="Tentang <?php echo e($siteSetting->organization_name); ?>"
                        >
                    <?php else: ?>
                        <div class="about-photo-placeholder">
                            HB
                        </div>
                    <?php endif; ?>

                    <div class="about-photo-label">
                        <strong>
                            <?php echo e($siteSetting?->organization_name
                                ?? 'Harapan Bangsa'); ?>

                        </strong>

                        <span>
                            Berbagi kebaikan dan menumbuhkan harapan.
                        </span>
                    </div>
                </div>

                <div class="about-profile-content">
                    <span class="about-profile-label">
                        Tentang Yayasan
                    </span>

                    <h2>
                        Perjalanan Kebaikan yang Terus Bertumbuh
                    </h2>

                    <div class="about-profile-text">
                        <?php echo e($siteSetting?->about
                            ?? 'Informasi tentang organisasi belum tersedia.'); ?>

                    </div>

                    <?php if($siteSetting?->address): ?>
                        <div class="about-address">
                            <span class="about-address-icon">⌖</span>

                            <div>
                                <strong>Alamat Organisasi</strong>

                                <p><?php echo e($siteSetting->address); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
    </section>

    <?php if($siteSetting?->vision || $siteSetting?->mission): ?>
        <?php
            $missions = collect(
                preg_split(
                    '/\r\n|\r|\n/',
                    $siteSetting->mission ?? ''
                )
            )
                ->map(fn ($mission) => trim($mission))
                ->filter();
        ?>

        <section class="about-identity-section">
            <div class="container">
                <div class="about-identity-wrapper">
                    <div class="about-section-heading">
                        <span>Landasan Kami</span>

                        <h2>Visi dan Misi Harapan Bangsa</h2>

                        <p>
                            Landasan dalam memberikan pelayanan,
                            perhatian, dan kesempatan terbaik.
                        </p>
                    </div>

                    <div class="about-identity-grid">
                        <?php if($siteSetting->vision): ?>
                            <article class="about-vision">
                                <div class="about-vision-icon">◎</div>

                                <h3>Visi Kami</h3>

                                <p><?php echo e($siteSetting->vision); ?></p>
                            </article>
                        <?php endif; ?>

                        <?php if($missions->isNotEmpty()): ?>
                            <article class="about-mission">
                                <h3>Misi Kami</h3>

                                <ul class="about-mission-list">
                                    <?php $__currentLoopData = $missions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="about-mission-item">
                                            <span
                                                class="about-mission-number"
                                            >
                                                <?php echo e(str_pad(
                                                    $loop->iteration,
                                                    2,
                                                    '0',
                                                    STR_PAD_LEFT
                                                )); ?>

                                            </span>

                                            <span><?php echo e($mission); ?></span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </article>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($founders->isNotEmpty()): ?>
        <section class="about-founders-section">
            <div class="container">
                <div class="about-founders-wrapper">
                    <div class="about-founders-heading">
                        <span>Sosok di Balik Harapan</span>

                        <h2>Pendiri Yayasan</h2>

                        <p>
                            Mengenal sosok yang mengawali dan
                            menggerakkan perjalanan Harapan Bangsa.
                        </p>
                    </div>

                    <div class="about-founders-grid">
                        <?php $__currentLoopData = $founders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $founder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="about-founder-card">
                                <div class="about-founder-photo">
                                    <?php if($founder->photo): ?>
                                        <img
                                            src="<?php echo e(asset(
                                                'storage/' .
                                                $founder->photo
                                            )); ?>"
                                            alt="<?php echo e($founder->name); ?>"
                                        >
                                    <?php else: ?>
                                        <div
                                            class="about-founder-placeholder"
                                        >
                                            <?php echo e(strtoupper(
                                                substr(
                                                    $founder->name,
                                                    0,
                                                    2
                                                )
                                            )); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="about-founder-content">
                                    <?php if($founder->position): ?>
                                        <span
                                            class="about-founder-position"
                                        >
                                            <?php echo e($founder->position); ?>

                                        </span>
                                    <?php endif; ?>

                                    <h3><?php echo e($founder->name); ?></h3>

                                    <?php if($founder->biography): ?>
                                        <p>
                                            <?php echo e(Str::limit(
                                                $founder->biography,
                                                160
                                            )); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/frontend/pages/about.blade.php ENDPATH**/ ?>