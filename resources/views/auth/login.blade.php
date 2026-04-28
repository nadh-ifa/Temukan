@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
<div class="auth-box">
    <div class="auth-brand">
        <div class="auth-brand-icon">🔍</div>
        <div class="auth-brand-name">Temu<span>kan</span></div>
        <div class="auth-brand-sub">Sistem Lost &amp; Found FILKOM UB</div>
    </div>

    <div class="auth-title">Selamat datang kembali!</div>
    <div class="auth-subtitle">Masuk untuk melanjutkan ke akun kamu.</div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email <span class="required">*</span></label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                placeholder="nama@filkom.ub.ac.id"
                value="{{ old('email') }}"
                required
                autofocus
            >
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password <span class="required">*</span></label>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="••••••••"
                required
            >
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group" style="display:flex; align-items:center; justify-content:space-between;">
            <div class="form-check">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   style="font-size:0.82rem; color:var(--blue-600); text-decoration:none; font-weight:500;">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-auth">Masuk →</button>
    </form>

    <div class="auth-switch">
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>
</div>
@endsection