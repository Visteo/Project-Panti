<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Reset Password | Harapan Bangsa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            margin: 0;
            padding: 24px;
            background: #f0fdfa;
            color: #1f2937;
            font-family: Arial, sans-serif;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            padding: 34px;
            border: 1px solid #d1fae5;
            border-radius: 20px;
            background: white;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin: 0 0 22px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 15px;
        }

        input:focus {
            border-color: #0f766e;
            outline: 3px solid #ccfbf1;
        }

        button {
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 10px;
            background: #0f766e;
            color: white;
            font-weight: 700;
            cursor: pointer;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px;
            border-radius: 9px;
            background: #fef2f2;
            color: #b91c1c;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        small {
            display: block;
            margin-top: 7px;
            color: #6b7280;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <main class="auth-card">
        <h1>Buat Password Baru</h1>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.password.update') }}"
            method="POST"
        >
            @csrf

            <input
                type="hidden"
                name="token"
                value="{{ $token }}"
            >

            <div class="form-group">
                <label for="email">Email Admin</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $email) }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="new-password"
                    required
                >

                <small>
                    Minimal 8 karakter serta mengandung huruf besar,
                    huruf kecil, dan angka.
                </small>
            </div>

            <div class="form-group">
                <label for="password_confirmation">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit">
                Simpan Password Baru
            </button>
        </form>
    </main>
</body>
</html>