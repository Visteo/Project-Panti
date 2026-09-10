@extends('frontend.layouts.app')

@section('title', 'Campaign Donasi | Harapan Bangsa')

@section(
    'meta_description',
    'Pilih campaign donasi dan ikut menghadirkan harapan bersama Harapan Bangsa.'
)

@push('styles')
    <style>
        .campaign-page-hero {
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

        .campaign-page-hero::before {
            position: absolute;
            top: -160px;
            right: -110px;
            width: 430px;
            height: 430px;
            border: 80px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            content: "";
        }

        .campaign-page-hero::after {
            position: absolute;
            bottom: -150px;
            left: -90px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(239, 106, 91, 0.12);
            content: "";
        }

        .campaign-page-hero-content {
            position: relative;
            z-index: 2;
            max-width: 760px;
        }

        .campaign-page-label {
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

        .campaign-page-label::before {
            width: 30px;
            height: 3px;
            border-radius: 5px;
            background: #fbbf24;
            content: "";
        }

        .campaign-page-hero h1 {
            margin-bottom: 18px;
            color: white;
            font-size: clamp(42px, 6vw, 68px);
            line-height: 1.08;
        }

        .campaign-page-hero p {
            max-width: 650px;
            color: rgba(255, 255, 255, 0.76);
            font-size: 18px;
            line-height: 1.8;
        }

        .campaign-page-content {
            position: relative;
            z-index: 3;
            margin-top: -70px;
            padding: 0 24px 105px;
        }

        .campaign-page-wrapper {
            padding: 45px;
            border-radius: 38px;
            background: #f4f8ff;
            box-shadow: 0 25px 60px rgba(18, 53, 91, 0.13);
        }

        .campaign-filter {
            display: grid;
            grid-template-columns: 1fr 260px auto;
            align-items: end;
            gap: 14px;
            margin-bottom: 40px;
            padding: 23px;
            border: 1px solid rgba(18, 53, 91, 0.09);
            border-radius: 22px;
            background: white;
        }

        .campaign-filter-group label {
            display: block;
            margin-bottom: 8px;
            color: #172033;
            font-size: 12px;
            font-weight: 800;
        }

        .campaign-filter-control {
            width: 100%;
            min-height: 47px;
            padding: 11px 14px;
            border: 1px solid #d8dee8;
            border-radius: 11px;
            background: white;
            color: #172033;
            outline: none;
        }

        .campaign-filter-control:focus {
            border-color: #12355b;
            box-shadow: 0 0 0 4px rgba(18, 53, 91, 0.09);
        }

        .campaign-filter-actions {
            display: flex;
            gap: 9px;
        }

        .campaign-filter-button {
            min-height: 47px;
            padding: 11px 20px;
            border: 0;
            border-radius: 11px;
            background: #12355b;
            color: white;
            font-weight: 800;
            cursor: pointer;
        }

        .campaign-filter-button:hover {
            background: #0c2947;
        }

        .campaign-filter-reset {
            min-height: 47px;
            border: 1px solid #d8dee8;
            background: white;
            color: #172033;
        }

        .campaign-result-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .campaign-result-heading h2 {
            color: #172033;
            font-size: 27px;
        }

        .campaign-result-heading span {
            color: #6b7280;
            font-size: 13px;
        }

        .campaign-list-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 25px;
        }

        .campaign-list-card {
            overflow: hidden;
            border-radius: 25px;
            background: white;
            box-shadow: 0 14px 38px rgba(18, 53, 91, 0.09);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .campaign-list-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 22px 46px rgba(18, 53, 91, 0.16);
        }

        .campaign-list-image {
            position: relative;
            height: 235px;
            overflow: hidden;
            background: #dbeafe;
        }

        .campaign-list-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s;
        }

        .campaign-list-card:hover img {
            transform: scale(1.06);
        }

        .campaign-list-placeholder {
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
            font-size: 55px;
            font-weight: 900;
        }

        .campaign-list-category {
            position: absolute;
            top: 16px;
            left: 16px;
            padding: 7px 11px;
            border-radius: 20px;
            background: #f59e0b;
            color: #172033;
            font-size: 11px;
            font-weight: 800;
        }

        .campaign-list-content {
            padding: 25px;
        }

        .campaign-list-content h3 {
            min-height: 58px;
            margin-bottom: 10px;
            color: #172033;
            font-size: 21px;
            line-height: 1.4;
        }

        .campaign-list-description {
            min-height: 68px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.65;
        }

        .campaign-list-progress {
            height: 9px;
            margin: 20px 0 17px;
            overflow: hidden;
            border-radius: 20px;
            background: #e5e7eb;
        }

        .campaign-list-progress-bar {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(
                90deg,
                #ef6a5b,
                #f59e0b
            );
        }

        .campaign-list-nominal {
            display: flex;
            justify-content: space-between;
            gap: 14px;
        }

        .campaign-list-nominal strong,
        .campaign-list-nominal span {
            display: block;
        }

        .campaign-list-nominal strong {
            color: #172033;
            font-size: 14px;
        }

        .campaign-list-nominal span {
            margin-top: 4px;
            color: #9ca3af;
            font-size: 11px;
        }

        .campaign-list-target {
            text-align: right;
        }

        .campaign-list-action {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 20px;
            padding: 12px 17px;
            border-radius: 11px;
            background: #12355b;
            color: white;
            font-weight: 800;
            text-decoration: none;
            transition: background 0.2s;
        }

        .campaign-list-action:hover {
            background: #0c2947;
        }

        .campaign-page-empty {
            grid-column: 1 / -1;
            padding: 65px 25px;
            border: 2px dashed #cbd5e1;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.7);
            text-align: center;
        }

        .campaign-page-empty h3 {
            margin-bottom: 8px;
            color: #172033;
        }

        .campaign-page-empty p {
            color: #6b7280;
        }

        .campaign-pagination {
            margin-top: 40px;
        }

        @media (max-width: 1000px) {
            .campaign-list-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .campaign-filter {
                grid-template-columns: 1fr 220px;
            }

            .campaign-filter-actions {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 680px) {
            .campaign-page-hero {
                padding: 75px 0 120px;
            }

            .campaign-page-content {
                margin-top: -55px;
                padding: 0 12px 75px;
            }

            .campaign-page-wrapper {
                padding: 28px 18px;
                border-radius: 27px;
            }

            .campaign-filter {
                grid-template-columns: 1fr;
                padding: 18px;
            }

            .campaign-filter-actions {
                grid-column: auto;
            }

            .campaign-filter-actions > * {
                flex: 1;
            }

            .campaign-result-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .campaign-list-grid {
                grid-template-columns: 1fr;
            }

            .campaign-list-content h3,
            .campaign-list-description {
                min-height: auto;
            }
        }
    </style>
@endpush

@section('content')
    <section class="campaign-page-hero">
        <div class="container">
            <div class="campaign-page-hero-content">
                <span class="campaign-page-label">
                    Berbagi Harapan
                </span>

                <h1>Campaign Donasi</h1>

                <p>
                    Pilih campaign yang ingin kamu dukung dan
                    jadilah bagian dari perubahan nyata bersama
                    Harapan Bangsa.
                </p>
            </div>
        </div>
    </section>

    <section class="campaign-page-content">
        <div class="container">
            <div class="campaign-page-wrapper">
                <form
                    action="{{ route('campaigns.index') }}"
                    method="GET"
                    class="campaign-filter"
                >
                    <div class="campaign-filter-group">
                        <label for="search">
                            Cari Campaign
                        </label>

                        <input
                            type="search"
                            id="search"
                            name="search"
                            class="campaign-filter-control"
                            value="{{ request('search') }}"
                            placeholder="Masukkan nama campaign..."
                        >
                    </div>

                    <div class="campaign-filter-group">
                        <label for="category">
                            Kategori
                        </label>

                        <select
                            id="category"
                            name="category"
                            class="campaign-filter-control"
                        >
                            <option value="">
                                Semua kategori
                            </option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->slug }}"
                                    @selected(
                                        request('category')
                                            === $category->slug
                                    )
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campaign-filter-actions">
                        <button
                            type="submit"
                            class="campaign-filter-button"
                        >
                            Cari
                        </button>

                        @if (
                            request('search')
                            || request('category')
                        )
                            <a
                                href="{{ route('campaigns.index') }}"
                                class="btn campaign-filter-reset"
                            >
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                <div class="campaign-result-heading">
                    <h2>Campaign Tersedia</h2>

                    <span>
                        {{ $campaigns->total() }} campaign ditemukan
                    </span>
                </div>

                <div class="campaign-list-grid">
                    @forelse ($campaigns as $campaign)
                        @php
                            $collected =
                                $campaign->collected_amount ?? 0;

                            $percentage =
                                $campaign->target_amount > 0
                                    ? min(
                                        (
                                            $collected
                                            / $campaign->target_amount
                                        ) * 100,
                                        100
                                    )
                                    : 0;
                        @endphp

                        <article class="campaign-list-card">
                            <a
                                href="{{ route(
                                    'campaigns.show',
                                    $campaign->slug
                                ) }}"
                            >
                                <div class="campaign-list-image">
                                    @if ($campaign->thumbnail)
                                        <img
                                            src="{{ asset(
                                                'storage/' .
                                                $campaign->thumbnail
                                            ) }}"
                                            alt="{{ $campaign->title }}"
                                        >
                                    @else
                                        <div
                                            class="campaign-list-placeholder"
                                        >
                                            HB
                                        </div>
                                    @endif

                                    <span
                                        class="campaign-list-category"
                                    >
                                        {{ $campaign->category?->name
                                            ?? 'Umum' }}
                                    </span>
                                </div>
                            </a>

                            <div class="campaign-list-content">
                                <a
                                    href="{{ route(
                                        'campaigns.show',
                                        $campaign->slug
                                    ) }}"
                                >
                                    <h3>
                                        {{ $campaign->title }}
                                    </h3>
                                </a>

                                <p class="campaign-list-description">
                                    {{ Str::limit(
                                        $campaign->short_description,
                                        110
                                    ) }}
                                </p>

                                <div class="campaign-list-progress">
                                    <div
                                        class="campaign-list-progress-bar"
                                        style="
                                            width: {{
                                                number_format(
                                                    $percentage,
                                                    2,
                                                    '.',
                                                    ''
                                                )
                                            }}%;
                                        "
                                    ></div>
                                </div>

                                <div class="campaign-list-nominal">
                                    <div>
                                        <strong>
                                            Rp {{ number_format(
                                                $collected,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </strong>

                                        <span>Terkumpul</span>
                                    </div>

                                    <div class="campaign-list-target">
                                        <strong>
                                            Rp {{ number_format(
                                                $campaign->target_amount,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </strong>

                                        <span>Target</span>
                                    </div>
                                </div>

                                <a
                                    href="{{ route(
                                        'campaigns.show',
                                        $campaign->slug
                                    ) }}"
                                    class="campaign-list-action"
                                >
                                    Lihat dan Donasi →
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="campaign-page-empty">
                            <h3>Campaign tidak ditemukan</h3>

                            <p>
                                Coba gunakan kata kunci atau
                                kategori yang berbeda.
                            </p>
                        </div>
                    @endforelse
                </div>

                @if ($campaigns->hasPages())
                    <div class="campaign-pagination">
                        {{ $campaigns->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection