@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
<div class="auth-box">
    <div class="auth-brand">
        <div class="auth-brand-icon">🔍</div>
        <div class="auth-brand-name">Temu<span>kan</span></div>
        <div class="auth-brand-sub">Sistem Lost &amp; Found FILKOM UB</div>
    </div>

    <div class="auth-title">Buat akun baru</div>
    <div class="auth-subtitle">Bergabung dan mulai laporkan barang hilang atau temukan.</div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                placeholder="Masukkan nama lengkap kamu"
                value="{{ old('name') }}"
                required
                autofocus
            >
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

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
                placeholder="Minimal 8 karakter"
                required
            >
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="required">*</span></label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                placeholder="Ulangi password kamu"
                required
            >
        </div>

        <button type="submit" class="btn-auth">Buat Akun →</button>
    </form>

    <div class="auth-switch">
        Sudah punya akun?
        <a href="{{ route('login') }}">Masuk di sini</a>
    </div>
</div>
@endsection