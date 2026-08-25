@extends('admin.layouts.app')

@section('title', 'Pengaturan Website')

@section('content')
    <section class="page-header">
        <div>
            <h1>Pengaturan Website</h1>

            <p>
                Kelola profil organisasi, kontak, dan rekening donasi.
            </p>
        </div>
    </section>

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

    <form
        action="{{ route('admin.settings.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <section class="card" style="margin-bottom: 22px;">
            <h2 style="margin-bottom: 22px;">
                Profil Organisasi
            </h2>

            <div class="form-group">
                <label
                    for="organization_name"
                    class="form-label"
                >
                    Nama Organisasi
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="organization_name"
                    name="organization_name"
                    class="form-control"
                    value="{{ old(
                        'organization_name',
                        $setting->organization_name
                    ) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="tagline" class="form-label">
                    Tagline
                </label>

                <input
                    type="text"
                    id="tagline"
                    name="tagline"
                    class="form-control"
                    value="{{ old(
                        'tagline',
                        $setting->tagline
                    ) }}"
                    placeholder="Berbagi Kebaikan, Menumbuhkan Harapan"
                >
            </div>

            <div class="form-group">
                <label
                    for="short_description"
                    class="form-label"
                >
                    Deskripsi Singkat
                </label>

                <textarea
                    id="short_description"
                    name="short_description"
                    class="form-control"
                    placeholder="Deskripsi singkat organisasi"
                >{{ old(
                    'short_description',
                    $setting->short_description
                ) }}</textarea>
            </div>

            <div class="form-group">
                <label for="about" class="form-label">
                    Tentang Organisasi
                </label>

                <textarea
                    id="about"
                    name="about"
                    class="form-control"
                    style="min-height: 250px;"
                    placeholder="Ceritakan sejarah, visi, dan kegiatan organisasi"
                >{{ old('about', $setting->about) }}</textarea>
            </div>

            <div class="form-group">
                <label for="logo" class="form-label">
                    Logo
                </label>

                @if ($setting->logo)
                    <div style="margin-bottom: 12px;">
                        <img
                            src="{{ asset(
                                'storage/' . $setting->logo
                            ) }}"
                            alt="{{ $setting->organization_name }}"
                            style="
                                max-width: 180px;
                                max-height: 120px;
                                object-fit: contain;
                                border: 1px solid #e5e7eb;
                                border-radius: 10px;
                                padding: 8px;
                            "
                        >
                    </div>
                @endif

                <input
                    type="file"
                    id="logo"
                    name="logo"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small
                    style="
                        display: block;
                        margin-top: 7px;
                        color: #6b7280;
                    "
                >
                    Format JPG, PNG, atau WEBP. Maksimal 2 MB.
                </small>
            </div>
        </section>

        <section class="card" style="margin-bottom: 22px;">
            <h2 style="margin-bottom: 22px;">
                Informasi Kontak
            </h2>

            <div
                class="setting-grid"
                style="
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 18px;
                "
            >
                <div class="form-group">
                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $setting->email) }}"
                    >
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone', $setting->phone) }}"
                    >
                </div>

                <div class="form-group">
                    <label for="whatsapp" class="form-label">
                        Nomor WhatsApp
                    </label>

                    <input
                        type="text"
                        id="whatsapp"
                        name="whatsapp"
                        class="form-control"
                        value="{{ old(
                            'whatsapp',
                            $setting->whatsapp
                        ) }}"
                        placeholder="08xxxxxxxxxx"
                    >
                </div>

                <div class="form-group">
                    <label for="instagram" class="form-label">
                        URL Instagram
                    </label>

                    <input
                        type="url"
                        id="instagram"
                        name="instagram"
                        class="form-control"
                        value="{{ old(
                            'instagram',
                            $setting->instagram
                        ) }}"
                        placeholder="https://instagram.com/username"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">
                    Alamat
                </label>

                <textarea
                    id="address"
                    name="address"
                    class="form-control"
                    placeholder="Alamat lengkap organisasi"
                >{{ old('address', $setting->address) }}</textarea>
            </div>
        </section>

        <section class="card" style="margin-bottom: 22px;">
            <h2 style="margin-bottom: 8px;">
                Rekening Donasi
            </h2>

            <p
                style="
                    margin-bottom: 22px;
                    color: #6b7280;
                "
            >
                Rekening ini ditampilkan pada metode transfer manual.
            </p>

            @foreach ([
                'bca' => 'BCA',
                'bri' => 'BRI',
                'mandiri' => 'Mandiri',
            ] as $key => $bank)
                <div
                    class="setting-grid"
                    style="
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 18px;
                        margin-bottom: 18px;
                        padding-bottom: 18px;
                        border-bottom: 1px solid #e5e7eb;
                    "
                >
                    <div class="form-group">
                        <label
                            for="{{ $key }}_account_number"
                            class="form-label"
                        >
                            Nomor Rekening {{ $bank }}
                        </label>

                        <input
                            type="text"
                            id="{{ $key }}_account_number"
                            name="{{ $key }}_account_number"
                            class="form-control"
                            value="{{ old(
                                $key . '_account_number',
                                $setting->{$key . '_account_number'}
                            ) }}"
                        >
                    </div>

                    <div class="form-group">
                        <label
                            for="{{ $key }}_account_name"
                            class="form-label"
                        >
                            Nama Pemilik Rekening
                        </label>

                        <input
                            type="text"
                            id="{{ $key }}_account_name"
                            name="{{ $key }}_account_name"
                            class="form-control"
                            value="{{ old(
                                $key . '_account_name',
                                $setting->{$key . '_account_name'}
                            ) }}"
                        >
                    </div>
                </div>
            @endforeach
        </section>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                Simpan Pengaturan
            </button>
        </div>
    </form>
@endsection

@push('styles')
    <style>
        @media (max-width: 650px) {
            .setting-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endpush