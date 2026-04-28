@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
<div class="auth-box">
<div class="auth-brand">
    <div>
        <div class="auth-brand-name">temuk<em>a</em>n.</div>
        <div class="auth-brand-sub">Temukan — Sistem Barang Hilang</div>
    </div>
</div>

    <div class="auth-divider"></div>

    <div class="auth-title">Buat akun baru</div>
    <div class="auth-subtitle">Bergabung dan mulai gunakan layanan Temukan.</div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                placeholder="Masukkan nama lengkap"
                value="{{ old('name') }}"
                required
                autofocus
            >
            @error('name')
                <span class="form-error">{{ $message }}</span>
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
                placeholder="Minimal 8 karakter"
                required
            >
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="required">*</span></label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                placeholder="Ulangi password"
                required
            >
        </div>

        <button type="submit" class="btn-auth">Buat Akun</button>
    </form>

    <div class="auth-switch">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>
</div>
@endsection