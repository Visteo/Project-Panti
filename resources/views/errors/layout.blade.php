<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('code') | Harapan Bangsa
    </title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 25px;
            background: linear-gradient(
                135deg,
                #f0fdfa,
                #ecfdf5
            );
            color: #1f2937;
        }

        .error-card {
            width: 100%;
            max-width: 650px;
            padding: 45px 35px;
            border: 1px solid #d1fae5;
            border-radius: 24px;
            background: white;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .error-icon {
            width: 80px;
            height: 80px;
            display: grid;
            place-items: center;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #ccfbf1;
            color: #0f766e;
            font-size: 37px;
        }

        .error-code {
            color: #0f766e;
            font-size: clamp(65px, 14vw, 110px);
            line-height: 1;
        }

        .error-title {
            margin: 15px 0 10px;
            font-size: 28px;
        }

        .error-description {
            max-width: 480px;
            margin: 0 auto;
            color: #6b7280;
            line-height: 1.7;
        }

        .error-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 27px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 17px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: white;
            color: #1f2937;
            text-decoration: none;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-primary {
            border-color: #0f766e;
            background: #0f766e;
            color: white;
        }

        .btn-primary:hover {
            background: #115e59;
        }

        @media (max-width: 500px) {
            .error-card {
                padding: 35px 22px;
            }

            .error-actions {
                align-items: stretch;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <main class="error-card">
        <div class="error-icon">
            @yield('icon', '!')
        </div>

        <div class="error-code">
            @yield('code')
        </div>

        <h1 class="error-title">
            @yield('title')
        </h1>

        <p class="error-description">
            @yield('message')
        </p>

        <div class="error-actions">
            <a
                href="{{ url('/') }}"
                class="btn btn-primary"
            >
                Kembali ke Beranda
            </a>

            <button
                type="button"
                class="btn"
                onclick="history.back()"
            >
                Kembali
            </button>
        </div>
    </main>
</body>
</html>