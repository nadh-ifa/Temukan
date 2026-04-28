<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Temukan') - FILKOM UB</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream:        #FDF6EC;
            --cream-dark:   #F5EBDA;
            --red:          #C94040;
            --red-light:    #E05252;
            --red-pale:     #FCEAEA;
            --red-border:   #F0C4C4;
            --blue:         #4A7FB5;
            --blue-light:   #5B92CC;
            --blue-pale:    #EAF2FB;
            --blue-border:  #C4D9F0;
            --yellow:       #E8C547;
            --yellow-pale:  #FDF6D6;
            --brown:        #5C3D2E;
            --brown-light:  #7A5540;
            --text-dark:    #2C1A0E;
            --text-mid:     #5C3D2E;
            --text-muted:   #9B7B6A;
            --text-light:   #C4A898;
            --border:       #E8D5C4;
            --white:        #FFFFFF;
            --shadow-sm:    0 1px 4px rgba(44,26,14,0.07);
            --shadow-md:    0 4px 16px rgba(44,26,14,0.10);
            --shadow-lg:    0 8px 32px rgba(44,26,14,0.13);
            --radius-xs:    6px;
            --radius-sm:    10px;
            --radius-md:    16px;
            --radius-lg:    22px;
            --radius-xl:    32px;
            --font:         'Poppins', sans-serif;
        }

        body {
            font-family: var(--font);
            background-color: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: var(--white);
            border-bottom: 1.5px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            height: 64px;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }

.navbar-logo-text {
    font-size: 1.45rem;
    font-weight: 800;
    color: var(--red);
    letter-spacing: -0.8px;
    line-height: 1;
    text-transform: lowercase;
}

.navbar-logo-text em {
    font-style: italic;
    color: var(--red);
}

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-left: auto;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.45rem 0.85rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-mid);
            text-decoration: none;
            border-radius: var(--radius-xs);
            transition: background 0.15s, color 0.15s;
        }

        .nav-link:hover { background: var(--cream-dark); color: var(--text-dark); }
        .nav-link.active { background: var(--red-pale); color: var(--red); font-weight: 600; }

        .nav-divider {
            width: 1px;
            height: 20px;
            background: var(--border);
            margin: 0 0.25rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-family: var(--font);
            font-size: 0.875rem;
            font-weight: 600;
            border: none;
            border-radius: var(--radius-xs);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s;
            padding: 0.55rem 1.1rem;
            line-height: 1;
        }

        .btn-primary {
            background: var(--red);
            color: var(--white);
            box-shadow: 0 2px 8px rgba(201,64,64,0.3);
        }
        .btn-primary:hover { background: var(--red-light); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(201,64,64,0.35); }

        .btn-secondary {
            background: var(--cream-dark);
            color: var(--text-mid);
            border: 1.5px solid var(--border);
        }
        .btn-secondary:hover { background: var(--border); color: var(--text-dark); }

        .btn-outline {
            background: transparent;
            color: var(--blue);
            border: 1.5px solid var(--blue);
        }
        .btn-outline:hover { background: var(--blue-pale); }

        .btn-danger {
            background: var(--red-pale);
            color: var(--red);
            border: 1.5px solid var(--red-border);
        }
        .btn-danger:hover { background: var(--red); color: var(--white); }

        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.8rem; }
        .btn-lg { padding: 0.72rem 1.5rem; font-size: 0.95rem; }

        /* User dropdown */
        .nav-user {
            position: relative;
        }

        .nav-user-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.38rem 0.75rem 0.38rem 0.4rem;
            background: var(--cream-dark);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: background 0.15s;
            font-family: var(--font);
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .nav-user-btn:hover { background: var(--border); }

        .nav-user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--red);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .nav-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            min-width: 180px;
            padding: 6px;
            display: none;
            z-index: 200;
        }

        .nav-user:hover .nav-dropdown { display: block; }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.55rem 0.75rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-mid);
            text-decoration: none;
            border-radius: var(--radius-xs);
            transition: background 0.15s;
            border: none;
            background: transparent;
            width: 100%;
            cursor: pointer;
            font-family: var(--font);
            text-align: left;
        }

        .dropdown-item:hover { background: var(--cream-dark); color: var(--text-dark); }
        .dropdown-item.danger:hover { background: var(--red-pale); color: var(--red); }

        .dropdown-divider {
            height: 1px;
            background: var(--border);
            margin: 4px 0;
        }

        /* ===== PAGE CONTAINER ===== */
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
            flex: 1;
        }

        /* ===== PAGE HEADING ===== */
        .page-heading {
            margin-bottom: 1.75rem;
        }

        .page-heading h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.5px;
            margin-bottom: 0.25rem;
        }

        .page-heading p {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--white);
            border-radius: var(--radius-md);
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        /* ===== BADGE ===== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.22rem 0.6rem;
            border-radius: 999px;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .status-dilaporkan        { background: var(--yellow-pale); color: #92720A; border: 1px solid #E8C54750; }
        .status-ada_di_resepsionis{ background: var(--blue-pale); color: var(--blue); border: 1px solid var(--blue-border); }
        .status-sudah_diambil     { background: #E8F5E9; color: #2E7D32; border: 1px solid #A5D6A7; }
        .status-ditutup           { background: var(--cream-dark); color: var(--text-muted); border: 1px solid var(--border); }

        /* ===== FORM ELEMENTS ===== */
        .form-group { margin-bottom: 1.1rem; }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 0.4rem;
        }

        .required { color: var(--red); margin-left: 2px; }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.62rem 0.9rem;
            font-family: var(--font);
            font-size: 0.875rem;
            color: var(--text-dark);
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-xs);
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s;
        }

        .form-control:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(201,64,64,0.1);
        }

        .form-control::placeholder { color: var(--text-light); }

        .form-hint {
            display: block;
            font-size: 0.77rem;
            color: var(--text-light);
            margin-top: 4px;
        }

        .form-error {
            display: block;
            font-size: 0.78rem;
            color: var(--red);
            margin-top: 4px;
        }

        textarea.form-control { resize: vertical; min-height: 100px; }

        /* ===== FLASH MESSAGES ===== */
        .alert {
            padding: 0.85rem 1.1rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success { background: #E8F5E9; color: #2E7D32; border: 1.5px solid #A5D6A7; }
        .alert-error   { background: var(--red-pale); color: var(--red); border: 1.5px solid var(--red-border); }

        /* ===== FOOTER ===== */
        footer {
            background: var(--white);
            border-top: 1.5px solid var(--border);
            padding: 1.25rem 1.5rem;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .footer-copy {
            font-size: 0.78rem;
            color: var(--text-light);
        }

        .footer-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .footer-links a {
            font-size: 0.78rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.15s;
        }

        .footer-links a:hover { color: var(--red); }

        /* ===== MOBILE MENU ===== */
        .nav-mobile-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            color: var(--text-mid);
            margin-left: auto;
        }

        @media (max-width: 768px) {
            .nav-mobile-toggle { display: flex; }

            .navbar-nav {
                display: none;
                position: absolute;
                top: 64px;
                left: 0;
                right: 0;
                background: var(--white);
                border-bottom: 1.5px solid var(--border);
                padding: 1rem 1.5rem;
                flex-direction: column;
                align-items: stretch;
                gap: 4px;
                box-shadow: var(--shadow-md);
                z-index: 99;
            }

            .navbar-nav.open { display: flex; }

            .nav-link { padding: 0.6rem 0.75rem; }

            .nav-user { position: static; }
            .nav-dropdown { position: static; display: block; box-shadow: none; border: none; border-radius: 0; padding: 0; }
            .nav-user:hover .nav-dropdown { display: block; }

            .page-container { padding: 1.25rem 1rem; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-inner">
<a href="{{ route('items.index') }}" class="navbar-logo">
    <span class="navbar-logo-text">temuk<em>a</em>n.</span>
</a>

            <button class="nav-mobile-toggle" onclick="this.closest('.navbar').querySelector('.navbar-nav').classList.toggle('open')" aria-label="Menu">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
            </button>

            <div class="navbar-nav">
                <a href="{{ route('items.index') }}" class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    Laporan
                </a>

                @auth
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    Dashboard
                </a>

                @if(auth()->user()->role === 'resepsionis')
                <a href="{{ route('resepsionis.dashboard') }}" class="nav-link {{ request()->routeIs('resepsionis.*') ? 'active' : '' }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
                    Resepsionis
                </a>
                @endif

                <div class="nav-divider"></div>

                <div class="nav-user">
                    <button class="nav-user-btn">
                        <div class="nav-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                        {{ Str::limit(auth()->user()->name, 14) }}
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div class="nav-dropdown">
                        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>

                @else
                <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="page-container">
        @if(session('success'))
        <div class="alert alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <p class="footer-copy">© 2026 Group 3 – Developed for Advanced Web Application Development Assignment, FILKOM UB</p>
            <div class="footer-links">
                <a href="{{ route('items.index') }}">Laporan</a>
                @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                @endauth
            </div>
        </div>
    </footer>

</body>
</html>