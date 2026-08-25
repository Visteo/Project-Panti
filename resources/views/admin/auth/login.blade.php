<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin | Harapan Bangsa</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background:
                linear-gradient(135deg, #0f766e, #34d399);
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 36px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.16);
        }

        .logo {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            border-radius: 18px;
            background: #0f766e;
            color: white;
            font-size: 30px;
        }

        h1 {
            color: #1f2937;
            text-align: center;
            font-size: 26px;
        }

        .subtitle {
            margin: 8px 0 28px;
            color: #6b7280;
            text-align: center;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }

        input:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            color: #4b5563;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: #0f766e;
            color: white;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #115e59;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 14px;
        }

        .alert-error {
            color: #991b1b;
            background: #fee2e2;
        }

        .alert-success {
            color: #166534;
            background: #dcfce7;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="logo">♥</div>

        <h1>Harapan Bangsa</h1>
        <p class="subtitle">Silakan masuk ke dashboard admin</p>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form
            action="{{ route('admin.login.process') }}"
            method="POST"
        >
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email admin"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <label class="remember">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                >

                Ingat saya
            </label>

            <button type="submit">
                Masuk ke Dashboard
            </button>
        </form>
    </div>
</body>
</html>