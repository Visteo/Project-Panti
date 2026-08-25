<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin') | Harapan Bangsa
    </title>

    <style>
        :root {
            --primary: #0f766e;
            --primary-dark: #115e59;
            --primary-light: #ccfbf1;
            --background: #f3f4f6;
            --white: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
            --danger: #dc2626;
            --warning: #d97706;
            --success: #15803d;
            --sidebar-width: 250px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: var(--background);
            color: var(--text);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        textarea,
        select {
            font: inherit;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            width: var(--sidebar-width);
            padding: 24px 16px;
            overflow-y: auto;
            background: var(--primary-dark);
            color: white;
            transition: transform 0.25s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: white;
            color: var(--primary);
            font-size: 22px;
        }

        .brand h2 {
            font-size: 18px;
        }

        .brand small {
            color: rgba(255, 255, 255, 0.7);
        }

        .menu-label {
            margin: 24px 12px 10px;
            color: rgba(255, 255, 255, 0.55);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            transition: 0.2s;
        }

        .menu-link:hover,
        .menu-link.active {
            background: rgba(255, 255, 255, 0.14);
            color: white;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
        }

        .main-wrapper {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
        }

        .topbar {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 30px;
            border-bottom: 1px solid var(--border);
            background: white;
        }

        .menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 9px;
            background: var(--primary-light);
            color: var(--primary);
            cursor: pointer;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
        }

        .user-information strong,
        .user-information small {
            display: block;
        }

        .user-information small {
            margin-top: 3px;
            color: var(--muted);
        }

        .logout-button {
            padding: 9px 13px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
            color: var(--danger);
            cursor: pointer;
        }

        .content {
            width: min(1200px, calc(100% - 40px));
            margin: 30px auto;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .page-header h1 {
            margin-bottom: 6px;
            font-size: 27px;
        }

        .page-header p {
            color: var(--muted);
        }

        .card {
            padding: 24px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: white;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 15px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            border: 1px solid var(--border);
            background: white;
            color: var(--text);
        }

        .btn-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-sm {
            padding: 7px 10px;
            font-size: 13px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .field-error {
            margin-top: 6px;
            color: var(--danger);
            font-size: 13px;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            padding-top: 5px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            font-size: 14px;
            vertical-align: middle;
        }

        th {
            color: #4b5563;
            background: #f9fafb;
            font-size: 13px;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-secondary {
            background: #e5e7eb;
            color: #4b5563;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .empty-state {
            padding: 45px 20px;
            color: var(--muted);
            text-align: center;
        }

        .statistics {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .statistic-card p {
            margin-bottom: 12px;
            color: var(--muted);
        }

        .statistic-card h3 {
            color: var(--primary);
            font-size: 25px;
        }

        .pagination-wrapper {
            margin-top: 20px;
        }

        .overlay {
            display: none;
        }

        @media (max-width: 900px) {
            .donation-detail-grid {
                grid-template-columns: 1fr !important;
            }
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .overlay.show {
                position: fixed;
                inset: 0;
                z-index: 999;
                display: block;
                background: rgba(0, 0, 0, 0.4);
            }

            .statistics {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .content {
                width: min(100% - 24px, 1200px);
                margin: 20px auto;
            }

            .topbar {
                padding: 12px 16px;
            }

            .user-information {
                display: none;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .statistics {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-icon">♥</div>

            <div>
                <h2>Harapan Bangsa</h2>
                <small>Admin Panel</small>
            </div>
        </div>

        <p class="menu-label">MENU UTAMA</p>

        <nav class="menu">
            <a
                href="{{ route('admin.dashboard') }}"
                class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >
                <span class="menu-icon">⌂</span>
                Dashboard
            </a>

            <a
                href="{{ route('admin.categories.index') }}"
                class="menu-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
            >
                <span class="menu-icon">▦</span>
                Kategori
            </a>

            <a
                href="{{ route('admin.campaigns.index') }}"
                class="menu-link {{
                    request()->routeIs('admin.campaigns.*')
                        ? 'active'
                        : ''
                }}">
                <span class="menu-icon">☷</span>
                Campaign
            </a>

            <a
                href="{{ route('admin.news.index') }}"
                class="menu-link {{
                    request()->routeIs('admin.news.*')
                        ? 'active'
                        : ''
                }}"
            >
                <span class="menu-icon">▧</span>
                Berita
            </a>

            <a
                href="{{ route('admin.donations.index') }}"
                class="menu-link {{
                    request()->routeIs('admin.donations.*')
                        ? 'active'
                        : ''
                }}"
            >
                <span class="menu-icon">♥</span>
                Donasi
            </a>

            <a
                href="{{ route('admin.reports.index') }}"
                class="menu-link {{
                    request()->routeIs('admin.reports.*')
                        ? 'active'
                        : ''
                }}"
            >
                <span class="menu-icon">▤</span>
                Laporan
            </a>

            <a
                href="{{ route('admin.profile.edit') }}"
                class="menu-link {{
                    request()->routeIs('admin.profile.*')
                        ? 'active'
                        : ''
                }}"
            >
                <span class="menu-icon">●</span>
                Profil Admin
            </a>

            <a
                href="{{ route('admin.settings.edit') }}"
                class="menu-link {{
                    request()->routeIs('admin.settings.*')
                        ? 'active'
                        : ''
                }}"
            >
                <span class="menu-icon">⚙</span>
                Pengaturan
            </a>
        </nav>
    </aside>

    <div class="overlay" id="overlay"></div>

    <div class="main-wrapper">
        <header class="topbar">
            <button
                type="button"
                class="menu-toggle"
                id="menuToggle"
            >
                ☰
            </button>

            <div class="topbar-user">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="user-information">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>{{ ucfirst(auth()->user()->role) }}</small>
                </div>

                <form
                    action="{{ route('admin.logout') }}"
                    method="POST"
                >
                    @csrf

                    <button type="submit" class="logout-button">
                        Keluar
                    </button>
                </form>
            </div>
        </header>

        <main class="content">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menuToggle');

        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    </script>

    @stack('scripts')
</body>
</html>