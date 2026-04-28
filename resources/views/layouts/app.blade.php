<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temukan – @yield('title', 'Lost & Found FILKOM')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Lora:ital,wght@0,400;0,600;1,400&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue-50:  #EFF6FF;
            --blue-100: #DBEAFE;
            --blue-200: #BFDBFE;
            --blue-400: #60A5FA;
            --blue-500: #3B82F6;
            --blue-600: #2563EB;
            --blue-700: #1D4ED8;
            --blue-800: #1E40AF;

            --cream-50:  #FFFDF5;
            --cream-100: #FFF8E7;
            --cream-200: #FFF0C2;
            --cream-400: #F5D87A;

            --red-50:   #FFF1F1;
            --red-100:  #FFE0E0;
            --red-400:  #F87171;
            --red-500:  #EF4444;
            --red-600:  #DC2626;

            --gray-50:  #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-300: #CBD5E1;
            --gray-400: #94A3B8;
            --gray-500: #64748B;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1E293B;
            --gray-900: #0F172A;

            --font-sans: 'Plus Jakarta Sans', sans-serif;
            --font-serif: 'Lora', serif;

            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08), 0 2px 4px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.10), 0 4px 8px rgba(0,0,0,0.06);

            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--gray-50);
            color: var(--gray-800);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.65;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--blue-100);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 0 1.5rem;
        }

        .navbar-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            box-shadow: 0 3px 8px rgba(37,99,235,0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .navbar-brand:hover .brand-icon {
            transform: rotate(-5deg) scale(1.05);
            box-shadow: 0 5px 14px rgba(37,99,235,0.4);
        }

        .brand-text {
            font-family: var(--font-serif);
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--blue-700);
            letter-spacing: -0.3px;
        }

        .brand-text span {
            color: var(--red-500);
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--gray-600);
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.45rem 0.85rem;
            border-radius: var(--radius-sm);
            transition: background 0.18s ease, color 0.18s ease;
        }

        .nav-link:hover {
            background: var(--blue-50);
            color: var(--blue-600);
        }

        .nav-link.active {
            background: var(--blue-100);
            color: var(--blue-700);
        }

        .btn-nav-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--blue-600);
            color: white;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.45rem 1.1rem;
            border-radius: var(--radius-sm);
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.18s ease, transform 0.15s ease, box-shadow 0.18s ease;
            box-shadow: 0 2px 6px rgba(37,99,235,0.25);
        }

        .btn-nav-primary:hover {
            background: var(--blue-700);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(37,99,235,0.35);
        }

        .btn-nav-primary:active {
            transform: translateY(0);
        }

        .btn-nav-ghost {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: var(--gray-600);
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.45rem 0.9rem;
            border-radius: var(--radius-sm);
            text-decoration: none;
            border: 1px solid var(--gray-200);
            cursor: pointer;
            transition: background 0.18s ease, border-color 0.18s ease, color 0.18s ease;
        }

        .btn-nav-ghost:hover {
            background: var(--gray-100);
            border-color: var(--gray-300);
            color: var(--gray-800);
        }

        .nav-divider {
            width: 1px;
            height: 20px;
            background: var(--gray-200);
            margin: 0 0.25rem;
        }

        /* User avatar dropdown area */
        .nav-user {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 0.3rem 0.6rem;
            border-radius: var(--radius-sm);
            transition: background 0.18s ease;
        }

        .nav-user:hover { background: var(--gray-100); }

        .nav-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue-400), var(--blue-600));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 600;
        }

        .nav-user-name {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--gray-700);
        }

        /* ===== FLASH MESSAGES ===== */
        .flash-wrapper {
            max-width: 1100px;
            margin: 1rem auto 0;
            padding: 0 1.5rem;
        }

        .flash {
            padding: 0.75rem 1.1rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: slideDown 0.3s ease;
        }

        .flash-success {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            color: #166534;
        }

        .flash-error {
            background: var(--red-50);
            border: 1px solid var(--red-100);
            color: var(--red-600);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex: 1;
            max-width: 1100px;
            margin: 0 auto;
            width: 100%;
            padding: 2rem 1.5rem;
        }

        /* ===== FOOTER ===== */
        footer {
            background: white;
            border-top: 1px solid var(--gray-100);
            padding: 1.25rem 1.5rem;
            margin-top: auto;
        }

        .footer-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .footer-copy {
            font-size: 0.75rem;
            color: var(--gray-400);
        }

        .footer-links {
            display: flex;
            gap: 1rem;
        }

        .footer-links a {
            font-size: 0.75rem;
            color: var(--gray-400);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .footer-links a:hover { color: var(--blue-500); }

        /* ===== GLOBAL BUTTON UTILITIES ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-family: var(--font-sans);
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.55rem 1.2rem;
            border-radius: var(--radius-sm);
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.18s ease, transform 0.15s ease, box-shadow 0.18s ease, border-color 0.18s ease;
            white-space: nowrap;
        }

        .btn:active { transform: scale(0.98); }

        .btn-primary {
            background: var(--blue-600);
            color: white;
            box-shadow: 0 2px 6px rgba(37,99,235,0.22);
        }
        .btn-primary:hover {
            background: var(--blue-700);
            box-shadow: 0 4px 12px rgba(37,99,235,0.32);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--cream-100);
            color: var(--gray-700);
            border: 1px solid var(--cream-200);
        }
        .btn-secondary:hover {
            background: var(--cream-200);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: var(--red-500);
            color: white;
            box-shadow: 0 2px 6px rgba(239,68,68,0.22);
        }
        .btn-danger:hover {
            background: var(--red-600);
            box-shadow: 0 4px 12px rgba(239,68,68,0.3);
            transform: translateY(-1px);
        }

        .btn-outline {
            background: white;
            color: var(--blue-600);
            border: 1.5px solid var(--blue-200);
        }
        .btn-outline:hover {
            background: var(--blue-50);
            border-color: var(--blue-400);
            transform: translateY(-1px);
        }

        .btn-sm {
            font-size: 0.8rem;
            padding: 0.38rem 0.9rem;
        }

        .btn-lg {
            font-size: 0.95rem;
            padding: 0.75rem 1.75rem;
        }

        /* ===== GLOBAL CARD ===== */
        .card {
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-100);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-body { padding: 1.5rem; }

        /* ===== BADGE ===== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .badge-blue    { background: var(--blue-100);  color: var(--blue-800); }
        .badge-cream   { background: var(--cream-200); color: #7A6010; }
        .badge-red     { background: var(--red-100);   color: var(--red-600); }
        .badge-green   { background: #DCFCE7; color: #166534; }
        .badge-gray    { background: var(--gray-100);  color: var(--gray-600); }

        /* ===== FORM GLOBAL ===== */
        .form-group { margin-bottom: 1.2rem; }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.45rem;
        }

        .form-label .required { color: var(--red-500); margin-left: 2px; }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.6rem 0.9rem;
            font-family: var(--font-sans);
            font-size: 0.9rem;
            color: var(--gray-800);
            background: white;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
            line-height: 1.5;
        }

        .form-control:focus {
            border-color: var(--blue-400);
            box-shadow: 0 0 0 3px rgba(96,165,250,0.18);
        }

        .form-control::placeholder { color: var(--gray-400); }

        select.form-control { cursor: pointer; }
        textarea.form-control { resize: vertical; min-height: 90px; }

        .form-error {
            font-size: 0.78rem;
            color: var(--red-500);
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-hint {
            font-size: 0.78rem;
            color: var(--gray-400);
            margin-top: 0.3rem;
        }

        /* ===== PAGE HEADING ===== */
        .page-heading {
            margin-bottom: 1.75rem;
        }

        .page-heading h1 {
            font-family: var(--font-serif);
            font-size: 1.7rem;
            font-weight: 600;
            color: var(--gray-900);
            line-height: 1.25;
        }

        .page-heading p {
            font-size: 0.9rem;
            color: var(--gray-500);
            margin-top: 0.3rem;
        }

        /* ===== STATUS BADGES ===== */
        .status-dilaporkan       { background: #FEF9C3; color: #854D0E; }
        .status-ada_di_resepsionis { background: var(--blue-100); color: var(--blue-800); }
        .status-sudah_diambil    { background: #DCFCE7; color: #166534; }
        .status-ditutup          { background: var(--gray-100); color: var(--gray-500); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar-links .nav-link { display: none; }
            .main-content { padding: 1.25rem 1rem; }
        }
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('items.index') }}" class="navbar-brand">
                <div class="brand-icon">🔍</div>
                <span class="brand-text">Temu<span>kan</span></span>
            </a>

            <div class="navbar-links">
                @auth
                    <a href="{{ route('items.index') }}"
                       class="nav-link {{ request()->routeIs('items.index') ? 'active' : '' }}">
                        Semua Laporan
                    </a>
                    <a href="{{ route('items.create') }}"
                       class="nav-link {{ request()->routeIs('items.create') ? 'active' : '' }}">
                        Buat Laporan
                    </a>

                    @if(auth()->user()->role === 'resepsionis')
                        <a href="{{ route('resepsionis.dashboard') }}"
                           class="nav-link {{ request()->routeIs('resepsionis.*') ? 'active' : '' }}">
                            Dashboard
                        </a>
                    @endif

                    <div class="nav-divider"></div>

                    <div class="nav-user">
                        <div class="nav-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <span class="nav-user-name">{{ auth()->user()->name }}</span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-nav-ghost">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-nav-ghost">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-nav-primary">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ===== FLASH MESSAGES ===== --}}
    @if(session('success') || session('error'))
    <div class="flash-wrapper">
        @if(session('success'))
            <div class="flash flash-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash flash-error">⚠️ {{ session('error') }}</div>
        @endif
    </div>
    @endif

    {{-- ===== CONTENT ===== --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer>
        <div class="footer-inner">
            <p class="footer-copy">© 2026 Group 3 – Developed for Advanced Web Application Development Assignment, FILKOM UB</p>
            <div class="footer-links">
                <a href="{{ route('items.index') }}">Laporan</a>
                @auth
                    <a href="{{ route('items.create') }}">Buat Laporan</a>
                @endauth
            </div>
        </div>
    </footer>

</body>
</html>