@php
    $currentEvent = $event ?? null;
@endphp

@if ($errors->any())
    <div class="alert alert-error">
        <strong>Data belum dapat disimpan:</strong>

        <ul
            style="
                margin-top: 8px;
                padding-left: 20px;
            "
        >
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="card" style="margin-bottom: 22px;">
    <h2 style="margin-bottom: 22px;">
        Informasi Acara
    </h2>

    <div class="form-group">
        <label for="title" class="form-label">
            Nama Acara
            <span class="required">*</span>
        </label>

        <input
            type="text"
            id="title"
            name="title"
            class="form-control"
            value="{{ old('title', $currentEvent?->title) }}"
            maxlength="200"
            required
        >
    </div>

    <div class="form-group">
        <label for="short_description" class="form-label">
            Deskripsi Singkat
        </label>

        <textarea
            id="short_description"
            name="short_description"
            class="form-control"
            maxlength="500"
            placeholder="Ringkasan singkat acara"
        >{{ old(
            'short_description',
            $currentEvent?->short_description
        ) }}</textarea>
    </div>

    <div class="form-group">
        <label for="description" class="form-label">
            Deskripsi Lengkap
            <span class="required">*</span>
        </label>

        <textarea
            id="description"
            name="description"
            class="form-control"
            style="min-height: 250px;"
            placeholder="Jelaskan detail acara atau kegiatan"
            required
        >{{ old(
            'description',
            $currentEvent?->description
        ) }}</textarea>
    </div>
</section>

<section class="card" style="margin-bottom: 22px;">
    <h2 style="margin-bottom: 22px;">
        Jadwal dan Lokasi
    </h2>

    <div class="event-form-grid">
        <div class="form-group">
            <label for="event_date" class="form-label">
                Tanggal Acara
                <span class="required">*</span>
            </label>

            <input
                type="date"
                id="event_date"
                name="event_date"
                class="form-control"
                value="{{ old(
                    'event_date',
                    $currentEvent?->event_date?->format('Y-m-d')
                ) }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="location" class="form-label">
                Lokasi
            </label>

            <input
                type="text"
                id="location"
                name="location"
                class="form-control"
                value="{{ old(
                    'location',
                    $currentEvent?->location
                ) }}"
                placeholder="Contoh: Aula Harapan Bangsa"
            >
        </div>

        <div class="form-group">
            <label for="start_time" class="form-label">
                Waktu Mulai
            </label>

            <input
                type="time"
                id="start_time"
                name="start_time"
                class="form-control"
                value="{{ old(
                    'start_time',
                    $currentEvent?->start_time
                        ? substr($currentEvent->start_time, 0, 5)
                        : null
                ) }}"
            >
        </div>

        <div class="form-group">
            <label for="end_time" class="form-label">
                Waktu Selesai
            </label>

            <input
                type="time"
                id="end_time"
                name="end_time"
                class="form-control"
                value="{{ old(
                    'end_time',
                    $currentEvent?->end_time
                        ? substr($currentEvent->end_time, 0, 5)
                        : null
                ) }}"
            >
        </div>
    </div>
</section>

<section class="card" style="margin-bottom: 22px;">
    <h2 style="margin-bottom: 22px;">
        Foto dan Publikasi
    </h2>

    <div class="form-group">
        <label for="thumbnail" class="form-label">
            Foto Acara
            @if (!$currentEvent)
                <span class="required">*</span>
            @endif
        </label>

        @if ($currentEvent?->thumbnail)
            <div style="margin-bottom: 14px;">
                <img
                    src="{{ asset(
                        'storage/' . $currentEvent->thumbnail
                    ) }}"
                    alt="{{ $currentEvent->title }}"
                    style="
                        width: 100%;
                        max-width: 420px;
                        max-height: 240px;
                        border-radius: 12px;
                        object-fit: cover;
                    "
                >
            </div>
        @endif

        <input
            type="file"
            id="thumbnail"
            name="thumbnail"
            class="form-control"
            accept=".jpg,.jpeg,.png,.webp"
            @required(!$currentEvent)
        >

        <small class="form-help">
            JPG, PNG, atau WEBP. Maksimal 4 MB.
        </small>
    </div>

    <div class="event-form-grid">
        <div class="form-group">
            <label for="status" class="form-label">
                Status
                <span class="required">*</span>
            </label>

            <select
                id="status"
                name="status"
                class="form-control"
                required
            >
                <option
                    value="draft"
                    @selected(
                        old(
                            'status',
                            $currentEvent?->status ?? 'draft'
                        ) === 'draft'
                    )
                >
                    Draft
                </option>

                <option
                    value="published"
                    @selected(
                        old(
                            'status',
                            $currentEvent?->status
                        ) === 'published'
                    )
                >
                    Publikasikan
                </option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">
                Penampilan
            </label>

            <label class="featured-option">
                <input
                    type="checkbox"
                    name="is_featured"
                    value="1"
                    @checked(
                        old(
                            'is_featured',
                            $currentEvent?->is_featured ?? false
                        )
                    )
                >

                <span>
                    Jadikan acara unggulan di landing page
                </span>
            </label>
        </div>
    </div>
</section>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        {{ $submitLabel }}
    </button>

    <a
        href="{{ route('admin.events.index') }}"
        class="btn"
    >
        Batal
    </a>
</div>

@push('styles')
    <style>
        .event-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-help {
            display: block;
            margin-top: 7px;
            color: #6b7280;
        }

        .featured-option {
            display: flex;
            align-items: center;
            min-height: 46px;
            gap: 10px;
            cursor: pointer;
        }

        .featured-option input {
            width: 18px;
            height: 18px;
            accent-color: #0f766e;
        }

        @media (max-width: 650px) {
            .event-form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush