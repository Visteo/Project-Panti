@extends('frontend.layouts.app')

@section('title', 'Campaign Donasi | Harapan Bangsa')

@push('styles')
    <style>
        .page-hero {
            padding: 65px 0;
            background: linear-gradient(135deg, #0f766e, #34d399);
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

        .filter-card {
            display: grid;
            grid-template-columns: 1fr 250px auto;
            gap: 12px;
            margin-bottom: 32px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 15px;
            background: white;
        }

        .form-control {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            outline: none;
        }

        .form-control:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        .filter-actions {
            display: flex;
            gap: 9px;
        }

        .pagination-wrapper {
            margin-top: 30px;
        }

        @media (max-width: 760px) {
            .filter-card {
                grid-template-columns: 1fr;
            }

            .filter-actions .btn {
                flex: 1;
            }
        }
    </style>
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>Campaign Donasi</h1>

            <p>
                Pilih campaign yang ingin kamu dukung dan
                hadirkan harapan bagi anak-anak Harapan Bangsa.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <form
                action="{{ route('campaigns.index') }}"
                method="GET"
                class="filter-card"
            >
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    value="{{ request('search') }}"
                    placeholder="Cari campaign..."
                >

                <select name="category" class="form-control">
                    <option value="">Semua kategori</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->slug }}"
                            {{
                                request('category') === $category->slug
                                    ? 'selected'
                                    : ''
                            }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>

                    @if (request('search') || request('category'))
                        <a
                            href="{{ route('campaigns.index') }}"
                            class="btn btn-outline"
                        >
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <div class="campaign-grid">
                @forelse ($campaigns as $campaign)
                    @php
                        $collected = $campaign->collected_amount ?? 0;

                        $percentage = $campaign->target_amount > 0
                            ? min(
                                ($collected / $campaign->target_amount) * 100,
                                100
                            )
                            : 0;
                    @endphp

                    <article class="campaign-card">
                        <a
                            href="{{ route(
                                'campaigns.show',
                                $campaign->slug
                            ) }}"
                        >
                            <div class="campaign-image">
                                <img
                                    src="{{ asset(
                                        'storage/' . $campaign->thumbnail
                                    ) }}"
                                    alt="{{ $campaign->title }}"
                                >

                                <span class="category-badge">
                                    {{ $campaign->category->name }}
                                </span>
                            </div>
                        </a>

                        <div class="campaign-content">
                            <a
                                href="{{ route(
                                    'campaigns.show',
                                    $campaign->slug
                                ) }}"
                            >
                                <h3>{{ $campaign->title }}</h3>
                            </a>

                            <p>
                                {{ Str::limit(
                                    $campaign->short_description,
                                    100
                                ) }}
                            </p>

                            <div class="progress">
                                <div
                                    class="progress-bar"
                                    style="width: {{ $percentage }}%;"
                                ></div>
                            </div>

                            <div class="campaign-nominal">
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

                                <div class="campaign-target">
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

                            <div style="margin-top: 18px;">
                                <a
                                    href="{{ route(
                                        'campaigns.show',
                                        $campaign->slug
                                    ) }}"
                                    class="btn btn-primary"
                                    style="width: 100%;"
                                >
                                    Lihat dan Donasi
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <h3>Campaign tidak ditemukan</h3>

                        <p style="margin-top: 7px;">
                            Coba gunakan kata kunci atau kategori lain.
                        </p>
                    </div>
                @endforelse
            </div>

            @if ($campaigns->hasPages())
                <div class="pagination-wrapper">
                    {{ $campaigns->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection