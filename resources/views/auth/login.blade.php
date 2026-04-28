@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
<div class="auth-box">
<div class="auth-brand">
    <div>
        <div class="auth-brand-name">temuk<em>a</em>n.</div>
        <div class="auth-brand-sub">Temukan — Sistem Barang Hilang</div>
    </div>
</div>

    <div class="auth-divider"></div>

    <div class="auth-title">Selamat datang kembali</div>
    <div class="auth-subtitle">Masuk ke akun kamu untuk melanjutkan.</div>

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
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password <span class="required">*</span></label>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="Masukkan password kamu"
                required
            >
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-row-inline">
                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                @endif
            </div>
        </div>

        <button type="submit" class="btn-auth">Masuk</button>
    </form>

    <div class="auth-switch">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>
</div>
@endsection