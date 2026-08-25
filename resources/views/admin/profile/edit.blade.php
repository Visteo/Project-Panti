@extends('admin.layouts.app')

@section('title', 'Profil Admin')

@section('content')
    <section class="page-header">
        <div>
            <h1>Profil Admin</h1>

            <p>
                Kelola nama, email, dan keamanan akun admin.
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
        action="{{ route('admin.profile.update') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <section
            class="card"
            style="
                max-width: 750px;
                margin-bottom: 22px;
            "
        >
            <h2 style="margin-bottom: 22px;">
                Informasi Akun
            </h2>

            <div class="form-group">
                <label for="name" class="form-label">
                    Nama Admin
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $user->name) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email" class="form-label">
                    Email
                    <span class="required">*</span>
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $user->email) }}"
                    required
                >
            </div>
        </section>

        <section
            class="card"
            style="
                max-width: 750px;
                margin-bottom: 22px;
            "
        >
            <h2 style="margin-bottom: 8px;">
                Ganti Password
            </h2>

            <p
                style="
                    margin-bottom: 22px;
                    color: #6b7280;
                "
            >
                Kosongkan bagian ini jika tidak ingin mengganti password.
            </p>

            <div class="form-group">
                <label
                    for="current_password"
                    class="form-label"
                >
                    Password Saat Ini
                </label>

                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    class="form-control"
                    autocomplete="current-password"
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    Password Baru
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    autocomplete="new-password"
                >

                <small
                    style="
                        display: block;
                        margin-top: 7px;
                        color: #6b7280;
                    "
                >
                    Minimal 8 karakter, mengandung huruf besar,
                    huruf kecil, dan angka.
                </small>
            </div>

            <div class="form-group">
                <label
                    for="password_confirmation"
                    class="form-label"
                >
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    autocomplete="new-password"
                >
            </div>
        </section>

        <button type="submit" class="btn btn-primary">
            Simpan Profil
        </button>
    </form>
@endsection