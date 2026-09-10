

<?php $__env->startSection('title', 'Berita dan Kegiatan | Harapan Bangsa'); ?>

<?php $__env->startSection(
    'meta_description',
    'Ikuti berita, kegiatan, dan cerita terbaru dari Yayasan Harapan Bangsa.'
); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .news-page-hero {
            position: relative;
            padding: 100px 0 145px;
            overflow: hidden;
            background: linear-gradient(
                135deg,
                #0c2947,
                #12355b 55%,
                #256b8f
            );
            color: white;
        }

        .news-page-hero::before {
            position: absolute;
            top: -150px;
            right: -100px;
            width: 420px;
            height: 420px;
            border: 80px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            content: "";
        }

        .news-page-hero::after {
            position: absolute;
            bottom: -140px;
            left: -80px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(239, 106, 91, 0.12);
            content: "";
        }

        .news-page-heading {
            position: relative;
            z-index: 2;
            max-width: 760px;
        }

        .news-page-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 15px;
            color: #fbbf24;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .news-page-label::before {
            width: 30px;
            height: 3px;
            border-radius: 5px;
            background: #fbbf24;
            content: "";
        }

        .news-page-hero h1 {
            margin-bottom: 18px;
            color: white;
            font-size: clamp(42px, 6vw, 68px);
            line-height: 1.08;
        }

        .news-page-hero p {
            max-width: 650px;
            color: rgba(255, 255, 255, 0.76);
            font-size: 18px;
            line-height: 1.8;
        }

        .news-page-content {
            position: relative;
            z-index: 3;
            margin-top: -70px;
            padding: 0 24px 105px;
        }

        .news-page-wrapper {
            padding: 45px;
            border-radius: 38px;
            background: #fff8ed;
            box-shadow: 0 25px 60px rgba(18, 53, 91, 0.13);
        }

        .news-page-search {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
            margin-bottom: 40px;
            padding: 21px;
            border: 1px solid rgba(18, 53, 91, 0.09);
            border-radius: 20px;
            background: white;
        }

        .news-search-input {
            width: 100%;
            min-height: 47px;
            padding: 11px 14px;
            border: 1px solid #d8dee8;
            border-radius: 11px;
            color: #172033;
            outline: none;
        }

        .news-search-input:focus {
            border-color: #12355b;
            box-shadow: 0 0 0 4px rgba(18, 53, 91, 0.09);
        }

        .news-search-actions {
            display: flex;
            gap: 9px;
        }

        .news-search-button {
            min-height: 47px;
            padding: 11px 22px;
            border: 0;
            border-radius: 11px;
            background: #12355b;
            color: white;
            font-weight: 800;
            cursor: pointer;
        }

        .news-search-button:hover {
            background: #0c2947;
        }

        .news-search-reset {
            min-height: 47px;
            border: 1px solid #d8dee8;
            background: white;
            color: #172033;
        }

        .news-result-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .news-result-heading h2 {
            color: #172033;
            font-size: 28px;
        }

        .news-result-heading span {
            color: #6b7280;
            font-size: 13px;
        }

        .news-page-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 25px;
        }

        .news-page-card {
            overflow: hidden;
            border-radius: 25px;
            background: white;
            box-shadow: 0 14px 38px rgba(18, 53, 91, 0.09);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .news-page-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 22px 46px rgba(18, 53, 91, 0.16);
        }

        .news-page-image {
            position: relative;
            height: 235px;
            overflow: hidden;
            background: #dbeafe;
        }

        .news-page-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s;
        }

        .news-page-card:hover img {
            transform: scale(1.06);
        }

        .news-page-placeholder {
            display: grid;
            width: 100%;
            height: 100%;
            place-items: center;
            background: linear-gradient(
                135deg,
                #12355b,
                #256b8f
            );
            color: rgba(255, 255, 255, 0.3);
            font-size: 54px;
            font-weight: 900;
        }

        .news-page-date {
            position: absolute;
            bottom: 15px;
            left: 15px;
            padding: 8px 12px;
            border-radius: 20px;
            background: #f59e0b;
            color: #172033;
            font-size: 11px;
            font-weight: 800;
        }

        .news-page-card-content {
            padding: 25px;
        }

        .news-page-author {
            display: block;
            margin-bottom: 9px;
            color: #ef6a5b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .news-page-card h2 {
            min-height: 59px;
            margin-bottom: 10px;
            color: #172033;
            font-size: 21px;
            line-height: 1.4;
        }

        .news-page-excerpt {
            min-height: 69px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.65;
        }

        .news-page-link {
            display: inline-flex;
            margin-top: 19px;
            color: #12355b;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
        }

        .news-page-link:hover {
            color: #ef6a5b;
        }

        .news-page-empty {
            grid-column: 1 / -1;
            padding: 65px 25px;
            border: 2px dashed #d8dee8;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.7);
            text-align: center;
        }

        .news-page-empty h3 {
            margin-bottom: 8px;
            color: #172033;
        }

        .news-page-empty p {
            color: #6b7280;
        }

        .news-page-pagination {
            margin-top: 40px;
        }

        @media (max-width: 1000px) {
            .news-page-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 680px) {
            .news-page-hero {
                padding: 75px 0 120px;
            }

            .news-page-content {
                margin-top: -55px;
                padding: 0 12px 75px;
            }

            .news-page-wrapper {
                padding: 28px 18px;
                border-radius: 27px;
            }

            .news-page-search {
                grid-template-columns: 1fr;
                padding: 17px;
            }

            .news-search-actions > * {
                flex: 1;
            }

            .news-result-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .news-page-grid {
                grid-template-columns: 1fr;
            }

            .news-page-card h2,
            .news-page-excerpt {
                min-height: auto;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="news-page-hero">
        <div class="container">
            <div class="news-page-heading">
                <span class="news-page-label">
                    Kabar Harapan Bangsa
                </span>

                <h1>Berita dan Kegiatan</h1>

                <p>
                    Ikuti informasi, kegiatan, dan cerita terbaru
                    dari perjalanan Yayasan Harapan Bangsa.
                </p>
            </div>
        </div>
    </section>

    <section class="news-page-content">
        <div class="container">
            <div class="news-page-wrapper">
                <form
                    action="<?php echo e(route('news.index')); ?>"
                    method="GET"
                    class="news-page-search"
                >
                    <input
                        type="search"
                        name="search"
                        class="news-search-input"
                        value="<?php echo e(request('search')); ?>"
                        placeholder="Cari berita atau kegiatan..."
                        aria-label="Cari berita"
                    >

                    <div class="news-search-actions">
                        <button
                            type="submit"
                            class="news-search-button"
                        >
                            Cari
                        </button>

                        <?php if(request('search')): ?>
                            <a
                                href="<?php echo e(route('news.index')); ?>"
                                class="btn news-search-reset"
                            >
                                Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </form>

                <div class="news-result-heading">
                    <h2>Berita Terbaru</h2>

                    <span>
                        <?php echo e($news->total()); ?> berita ditemukan
                    </span>
                </div>

                <div class="news-page-grid">
                    <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <article class="news-page-card">
                            <a
                                href="<?php echo e(route(
                                    'news.show',
                                    $item->slug
                                )); ?>"
                            >
                                <div class="news-page-image">
                                    <?php if($item->thumbnail): ?>
                                        <img
                                            src="<?php echo e(asset(
                                                'storage/' .
                                                $item->thumbnail
                                            )); ?>"
                                            alt="<?php echo e($item->title); ?>"
                                        >
                                    <?php else: ?>
                                        <div
                                            class="news-page-placeholder"
                                        >
                                            HB
                                        </div>
                                    <?php endif; ?>

                                    <span class="news-page-date">
                                        <?php echo e($item->published_at
                                            ->translatedFormat(
                                                'd M Y'
                                            )); ?>

                                    </span>
                                </div>
                            </a>

                            <div class="news-page-card-content">
                                <?php if($item->author): ?>
                                    <span class="news-page-author">
                                        Oleh <?php echo e($item->author->name); ?>

                                    </span>
                                <?php endif; ?>

                                <a
                                    href="<?php echo e(route(
                                        'news.show',
                                        $item->slug
                                    )); ?>"
                                >
                                    <h2><?php echo e($item->title); ?></h2>
                                </a>

                                <p class="news-page-excerpt">
                                    <?php echo e(Str::limit(
                                        $item->excerpt,
                                        125
                                    )); ?>

                                </p>

                                <a
                                    href="<?php echo e(route(
                                        'news.show',
                                        $item->slug
                                    )); ?>"
                                    class="news-page-link"
                                >
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="news-page-empty">
                            <h3>Berita tidak ditemukan</h3>

                            <p>
                                Belum ada berita yang sesuai
                                dengan pencarian.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if($news->hasPages()): ?>
                    <div class="news-page-pagination">
                        <?php echo e($news->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/frontend/news/index.blade.php ENDPATH**/ ?>