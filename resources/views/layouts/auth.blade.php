<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Temukan') — FILKOM UB</title>
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
            --blue-pale:    #EAF2FB;
            --blue-border:  #C4D9F0;
            --brown:        #5C3D2E;
            --text-dark:    #2C1A0E;
            --text-mid:     #5C3D2E;
            --text-muted:   #9B7B6A;
            --text-light:   #C4A898;
            --border:       #E8D5C4;
            --white:        #FFFFFF;
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

        /* Decorative background shapes */
        body::before {
            content: '';
            position: fixed;
            top: -120px;
            right: -120px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(201,64,64,0.08) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -100px;
            left: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(74,127,181,0.07) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .auth-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            z-index: 1;
        }

        .auth-box {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 16px 48px rgba(44,26,14,0.12);
            padding: 2.5rem 2.25rem;
            width: 100%;
            max-width: 420px;
            animation: slideUp 0.35s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.75rem;
        }

        .auth-brand-logo {
            width: 44px;
            height: 44px;
            background: var(--red);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .auth-brand-logo svg {
            width: 22px;
            height: 22px;
            fill: var(--white);
        }

        .auth-brand-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--red);
            letter-spacing: -0.8px;
            line-height: 1;
        }

        .auth-brand-name span { color: var(--red); }

        .auth-brand-sub {
            font-size: 0.73rem;
            color: var(--text-light);
            font-weight: 400;
            margin-top: 2px;
        }

        .auth-divider {
            height: 1.5px;
            background: var(--border);
            margin: 1.5rem 0;
            border-radius: 999px;
        }

        .auth-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .auth-subtitle {
            font-size: 0.84rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .form-group { margin-bottom: 1rem; }

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
            padding: 0.65rem 0.9rem;
            font-family: var(--font);
            font-size: 0.875rem;
            color: var(--text-dark);
            background: var(--cream);
            border: 1.5px solid var(--border);
            border-radius: 9px;
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
        }

        .form-control:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(201,64,64,0.1);
            background: var(--white);
        }

        .form-control::placeholder { color: var(--text-light); }

        .form-error {
            display: block;
            font-size: 0.78rem;
            color: var(--red);
            margin-top: 4px;
        }

        .btn-auth {
            display: block;
            width: 100%;
            padding: 0.72rem;
            background: var(--red);
            color: var(--white);
            font-family: var(--font);
            font-size: 0.9rem;
            font-weight: 700;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            transition: background 0.18s, transform 0.15s, box-shadow 0.18s;
            box-shadow: 0 3px 12px rgba(201,64,64,0.3);
            letter-spacing: 0.2px;
            margin-top: 0.5rem;
        }

        .btn-auth:hover {
            background: var(--red-light);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(201,64,64,0.35);
        }

        .btn-auth:active { transform: scale(0.99); }

        .auth-switch {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.84rem;
            color: var(--text-muted);
        }

        .auth-switch a {
            color: var(--red);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-switch a:hover { text-decoration: underline; }

        .form-row-inline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .form-check input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: var(--red);
            cursor: pointer;
            flex-shrink: 0;
        }

        .form-check label {
            font-size: 0.82rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.82rem;
            color: var(--blue);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover { text-decoration: underline; }

        footer {
            padding: 1.25rem 1.5rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .footer-copy {
            font-size: 0.72rem;
            color: var(--text-light);
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        @yield('content')
    </div>

    <footer>
        <p class="footer-copy">© 2026 Group 3 – Developed for Advanced Web Application Development Assignment, FILKOM UB</p>
    </footer>
</body>
</html>