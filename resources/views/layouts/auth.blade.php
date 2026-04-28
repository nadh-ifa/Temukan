<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Temukan') – FILKOM UB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Lora:ital,wght@0,400;0,600;1,400&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue-50: #EFF6FF; --blue-100: #DBEAFE; --blue-200: #BFDBFE;
            --blue-400: #60A5FA; --blue-500: #3B82F6; --blue-600: #2563EB; --blue-700: #1D4ED8; --blue-800: #1E40AF;
            --cream-50: #FFFDF5; --cream-100: #FFF8E7; --cream-200: #FFF0C2;
            --red-50: #FFF1F1; --red-100: #FFE0E0; --red-400: #F87171; --red-500: #EF4444; --red-600: #DC2626;
            --gray-50: #F8FAFC; --gray-100: #F1F5F9; --gray-200: #E2E8F0; --gray-300: #CBD5E1;
            --gray-400: #94A3B8; --gray-500: #64748B; --gray-600: #475569; --gray-700: #334155; --gray-800: #1E293B; --gray-900: #0F172A;
            --font-sans: 'Plus Jakarta Sans', sans-serif;
            --font-serif: 'Lora', serif;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--blue-50);
            background-image:
                radial-gradient(ellipse at 20% 20%, rgba(219,234,254,0.7) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 80%, rgba(255,248,231,0.6) 0%, transparent 55%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .auth-box {
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(37,99,235,0.09), 0 4px 12px rgba(0,0,0,0.06);
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            animation: fadeUp 0.4s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .auth-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }

        .auth-brand-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 6px 18px rgba(37,99,235,0.3);
            margin-bottom: 0.75rem;
        }

        .auth-brand-name {
            font-family: var(--font-serif);
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--blue-800);
        }

        .auth-brand-name span { color: var(--red-500); }

        .auth-brand-sub {
            font-size: 0.8rem;
            color: var(--gray-400);
            margin-top: 2px;
            text-align: center;
        }

        .auth-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.3rem;
        }

        .auth-subtitle {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin-bottom: 1.75rem;
        }

        .divider {
            height: 1px;
            background: var(--gray-100);
            margin: 1.5rem 0;
        }

        /* Form elements */
        .form-group { margin-bottom: 1.1rem; }

        .form-label {
            display: block;
            font-size: 0.83rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.4rem;
        }

        .form-label .required { color: var(--red-500); margin-left: 2px; }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.62rem 0.9rem;
            font-family: var(--font-sans);
            font-size: 0.9rem;
            color: var(--gray-800);
            background: var(--gray-50);
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
        }

        .form-control:focus {
            border-color: var(--blue-400);
            box-shadow: 0 0 0 3px rgba(96,165,250,0.18);
            background: white;
        }

        .form-control::placeholder { color: var(--gray-400); }

        .form-error {
            font-size: 0.78rem;
            color: var(--red-500);
            margin-top: 0.3rem;
        }

        /* Submit button */
        .btn-auth {
            display: block;
            width: 100%;
            padding: 0.72rem;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
            color: white;
            font-family: var(--font-sans);
            font-size: 0.9rem;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: opacity 0.18s, transform 0.15s, box-shadow 0.18s;
            box-shadow: 0 3px 10px rgba(37,99,235,0.3);
            letter-spacing: 0.2px;
            margin-top: 0.5rem;
        }

        .btn-auth:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37,99,235,0.35);
        }

        .btn-auth:active { transform: scale(0.99); }

        .auth-switch {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.85rem;
            color: var(--gray-500);
        }

        .auth-switch a {
            color: var(--blue-600);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.15s;
        }

        .auth-switch a:hover { color: var(--blue-800); text-decoration: underline; }

        footer {
            padding: 1rem 1.5rem;
            text-align: center;
        }

        .footer-copy {
            font-size: 0.72rem;
            color: var(--gray-400);
        }

        /* Checkbox */
        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--blue-600);
            cursor: pointer;
        }

        .form-check label {
            font-size: 0.83rem;
            color: var(--gray-600);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        @yield('content')
    </div>

    <footer>
        <p class="footer-copy">© 2026 Group 3 – Developed for Advanced Web Application Development Assignment, FILKOM UB</p>
    </footer>
</body>
</html>