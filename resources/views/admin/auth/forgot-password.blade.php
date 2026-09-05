<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Lupa Password | Harapan Bangsa</title>

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
            margin: 0 0 10px;
        }

        .description {
            margin-bottom: 24px;
            color: #6b7280;
            line-height: 1.6;
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
            margin-top: 18px;
            padding: 12px;
            border: 0;
            border-radius: 10px;
            background: #0f766e;
            color: white;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            background: #115e59;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px;
            border-radius: 9px;
        }

        .alert-success {
            background: #ecfdf5;
            color: #047857;
        }

        .alert-error {
            background: #fef2f2;
            color: #b91c1c;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: #0f766e;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main class="auth-card">
        <h1>Lupa Password</h1>

        <p class="description">
            Masukkan email admin. Kami akan mengirimkan
            tautan untuk membuat password baru.
        </p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @error('email')
            <div class="alert alert-error">
                {{ $message }}
            </div>
        @enderror

        <form
            action="{{ route('admin.password.email') }}"
            method="POST"
        >
            @csrf

            <label for="email">Email Admin</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email"
                required
                autofocus
            >

            <button type="submit">
                Kirim Tautan Reset
            </button>
        </form>

        <a
            href="{{ route('admin.login') }}"
            class="back-link"
        >
            Kembali ke halaman login
        </a>
    </main>
</body>
</html>