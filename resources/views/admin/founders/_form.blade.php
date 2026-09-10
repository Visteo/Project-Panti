@php
    $currentFounder = $founder ?? null;
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
        Informasi Pendiri
    </h2>

    <div class="founder-form-grid">
        <div class="form-group">
            <label for="name" class="form-label">
                Nama Lengkap
                <span class="required">*</span>
            </label>

            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name', $currentFounder?->name) }}"
                maxlength="150"
                required
            >
        </div>

        <div class="form-group">
            <label for="position" class="form-label">
                Jabatan
            </label>

            <input
                type="text"
                id="position"
                name="position"
                class="form-control"
                value="{{ old(
                    'position',
                    $currentFounder?->position
                ) }}"
                placeholder="Contoh: Pendiri dan Ketua Yayasan"
            >
        </div>

        <div class="form-group">
            <label for="joined_year" class="form-label">
                Tahun Bergabung
            </label>

            <input
                type="number"
                id="joined_year"
                name="joined_year"
                class="form-control"
                value="{{ old(
                    'joined_year',
                    $currentFounder?->joined_year
                ) }}"
                min="1900"
                max="{{ now()->year }}"
                placeholder="{{ now()->year }}"
            >
        </div>

        <div class="form-group">
            <label for="display_order" class="form-label">
                Urutan Tampilan
                <span class="required">*</span>
            </label>

            <input
                type="number"
                id="display_order"
                name="display_order"
                class="form-control"
                value="{{ old(
                    'display_order',
                    $currentFounder?->display_order ?? 0
                ) }}"
                min="0"
                max="999"
                required
            >

            <small class="form-help">
                Angka terkecil akan ditampilkan terlebih dahulu.
            </small>
        </div>
    </div>

    <div class="form-group">
        <label for="biography" class="form-label">
            Biografi Singkat
        </label>

        <textarea
            id="biography"
            name="biography"
            class="form-control"
            style="min-height: 170px;"
            maxlength="3000"
            placeholder="Ceritakan peran dan kontribusi pendiri"
        >{{ old(
            'biography',
            $currentFounder?->biography
        ) }}</textarea>
    </div>
</section>

<section class="card" style="margin-bottom: 22px;">
    <h2 style="margin-bottom: 22px;">
        Foto dan Media Sosial
    </h2>

    <div class="form-group">
        <label for="photo" class="form-label">
            Foto Pendiri
            @if (!$currentFounder)
                <span class="required">*</span>
            @endif
        </label>

        @if ($currentFounder?->photo)
            <div style="margin-bottom: 14px;">
                <img
                    src="{{ asset(
                        'storage/' . $currentFounder->photo
                    ) }}"
                    alt="{{ $currentFounder->name }}"
                    style="
                        width: 180px;
                        height: 210px;
                        border-radius: 18px;
                        object-fit: cover;
                    "
                >
            </div>
        @endif

        <input
            type="file"
            id="photo"
            name="photo"
            class="form-control"
            accept=".jpg,.jpeg,.png,.webp"
            @required(!$currentFounder)
        >

        <small class="form-help">
            Gunakan foto potret. JPG, PNG, atau WEBP,
            maksimal 4 MB.
        </small>
    </div>

    <div class="founder-form-grid">
        <div class="form-group">
            <label for="instagram_url" class="form-label">
                URL Instagram
            </label>

            <input
                type="url"
                id="instagram_url"
                name="instagram_url"
                class="form-control"
                value="{{ old(
                    'instagram_url',
                    $currentFounder?->instagram_url
                ) }}"
                placeholder="https://instagram.com/username"
            >
        </div>

        <div class="form-group">
            <label for="linkedin_url" class="form-label">
                URL LinkedIn
            </label>

            <input
                type="url"
                id="linkedin_url"
                name="linkedin_url"
                class="form-control"
                value="{{ old(
                    'linkedin_url',
                    $currentFounder?->linkedin_url
                ) }}"
                placeholder="https://linkedin.com/in/username"
            >
        </div>
    </div>
</section>

<section class="card" style="margin-bottom: 22px;">
    <h2 style="margin-bottom: 14px;">
        Status Penampilan
    </h2>

    <label class="active-option">
        <input
            type="checkbox"
            name="is_active"
            value="1"
            @checked(
                old(
                    'is_active',
                    $currentFounder?->is_active ?? true
                )
            )
        >

        <span>
            Tampilkan pendiri ini di landing page
        </span>
    </label>
</section>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        {{ $submitLabel }}
    </button>

    <a
        href="{{ route('admin.founders.index') }}"
        class="btn"
    >
        Batal
    </a>
</div>

@push('styles')
    <style>
        .founder-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-help {
            display: block;
            margin-top: 7px;
            color: #6b7280;
        }

        .active-option {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .active-option input {
            width: 18px;
            height: 18px;
            accent-color: #0f766e;
        }

        @media (max-width: 650px) {
            .founder-form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush