@extends('layouts.app')

@section('title', 'Semua Laporan')

@section('content')
<style>
    /* ===== HERO BANNER ===== */
    .laporan-hero {
        background: linear-gradient(135deg, var(--blue-600) 0%, var(--blue-800) 100%);
        border-radius: var(--radius-xl);
        padding: 2.5rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .laporan-hero::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .laporan-hero::after {
        content: '';
        position: absolute;
        bottom: -60px; left: 30%;
        width: 280px; height: 280px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }

    .laporan-hero h1 {
        font-family: var(--font-serif);
        font-size: 1.8rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.4rem;
    }

    .laporan-hero p {
        color: rgba(255,255,255,0.75);
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .hero-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; }

    .btn-hero-primary {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: white;
        color: var(--blue-700);
        font-size: 0.875rem;
        font-weight: 700;
        padding: 0.6rem 1.25rem;
        border-radius: var(--radius-sm);
        text-decoration: none;
        transition: transform 0.15s, box-shadow 0.15s;
        box-shadow: 0 3px 8px rgba(0,0,0,0.18);
    }

    .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.22); }

    .btn-hero-outline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.15);
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border-radius: var(--radius-sm);
        text-decoration: none;
        border: 1.5px solid rgba(255,255,255,0.35);
        transition: background 0.15s;
    }

    .btn-hero-outline:hover { background: rgba(255,255,255,0.25); }

    /* ===== STATS ROW ===== */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 0.75rem;
        margin-bottom: 1.75rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-100);
        padding: 1rem 1.1rem;
        text-align: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: var(--shadow-sm);
    }

    .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

    .stat-number {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--blue-600);
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 0.78rem;
        color: var(--gray-500);
        font-weight: 500;
    }

    /* ===== FILTER BAR ===== */
    .filter-bar {
        background: white;
        border: 1px solid var(--gray-100);
        border-radius: var(--radius-lg);
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .filter-bar form {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        flex: 1;
        min-width: 150px;
    }

    .filter-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .search-wrap {
        flex: 2;
        min-width: 220px;
    }

    .search-input-wrap {
        position: relative;
    }

    .search-input-wrap .search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
        color: var(--gray-400);
        pointer-events: none;
    }

    .search-input-wrap input {
        padding-left: 32px;
    }

    .btn-filter {
        background: var(--blue-600);
        color: white;
        border: none;
        padding: 0.62rem 1.1rem;
        border-radius: 8px;
        font-family: var(--font-sans);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.18s, transform 0.15s;
        white-space: nowrap;
        align-self: flex-end;
    }

    .btn-filter:hover { background: var(--blue-700); transform: translateY(-1px); }

    .btn-reset {
        background: var(--gray-100);
        color: var(--gray-600);
        border: none;
        padding: 0.62rem 1rem;
        border-radius: 8px;
        font-family: var(--font-sans);
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background 0.18s;
        white-space: nowrap;
        align-self: flex-end;
    }

    .btn-reset:hover { background: var(--gray-200); }

    /* ===== ITEMS GRID ===== */
    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 1.1rem;
    }

    .item-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
        display: flex;
        flex-direction: column;
    }

    .item-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .item-card-img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        background: var(--gray-100);
    }

    .item-card-img-placeholder {
        width: 100%;
        height: 170px;
        background: linear-gradient(135deg, var(--blue-50), var(--cream-100));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: var(--blue-200);
    }

    .item-card-body {
        padding: 1.1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .item-card-meta {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 0.5rem;
    }

    .item-type-badge {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.2rem 0.55rem;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .type-hilang    { background: var(--red-100); color: var(--red-600); }
    .type-ditemukan { background: var(--blue-100); color: var(--blue-800); }

    .item-card-date {
        font-size: 0.75rem;
        color: var(--gray-400);
        margin-left: auto;
    }

    .item-card-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.35rem;
        line-height: 1.35;
    }

    .item-card-desc {
        font-size: 0.83rem;
        color: var(--gray-500);
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .item-card-footer {
        padding: 0.75rem 1.1rem;
        border-top: 1px solid var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .item-location {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 0.78rem;
        color: var(--gray-500);
    }

    .item-card-footer a {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--blue-600);
        text-decoration: none;
        transition: color 0.15s;
    }

    .item-card-footer a:hover { color: var(--blue-800); text-decoration: underline; }

    /* status badge inside card */
    .status-badge {
        display: inline-flex;
        align-items: center;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.22rem 0.6rem;
        border-radius: 999px;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--gray-400);
    }

    .empty-state .empty-icon {
        font-size: 56px;
        margin-bottom: 1rem;
        opacity: 0.6;
    }

    .empty-state h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--gray-600);
        margin-bottom: 0.35rem;
    }

    .empty-state p {
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
    }

    /* ===== PAGINATION ===== */
    .pagination-wrap {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }
</style>

{{-- HERO --}}
<div class="laporan-hero">
    <h1>📋 Semua Laporan</h1>
    <p>Temukan barang yang hilang atau laporkan barang yang kamu temukan di FILKOM UB.</p>
    @auth
    <div class="hero-actions">
        <a href="{{ route('items.create', ['type' => 'hilang']) }}" class="btn-hero-primary">🔴 Saya Kehilangan Barang</a>
        <a href="{{ route('items.create', ['type' => 'ditemukan']) }}" class="btn-hero-outline">🔵 Saya Menemukan Barang</a>
    </div>
    @else
    <div class="hero-actions">
        <a href="{{ route('login') }}" class="btn-hero-primary">Masuk untuk Melaporkan</a>
    </div>
    @endauth
</div>

{{-- STATS --}}
<div class="stats-row">
    <div class="stat-card">
        <div class="stat-number">{{ $stats['total'] ?? $items->total() }}</div>
        <div class="stat-label">Total Laporan</div>
    </div>
    <div class="stat-card">
        <div class="stat-number" style="color:var(--red-500);">{{ $stats['hilang'] ?? $items->where('type','hilang')->count() }}</div>
        <div class="stat-label">Barang Hilang</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $stats['ditemukan'] ?? $items->where('type','ditemukan')->count() }}</div>
        <div class="stat-label">Barang Ditemukan</div>
    </div>
    <div class="stat-card">
        <div class="stat-number" style="color:#16A34A;">{{ $stats['sudah_diambil'] ?? 0 }}</div>
        <div class="stat-label">Sudah Kembali</div>
    </div>
</div>

{{-- FILTER BAR --}}
<div class="filter-bar">
    <form method="GET" action="{{ route('items.index') }}">
        <div class="filter-group search-wrap">
            <span class="filter-label">Cari</span>
            <div class="search-input-wrap">
                <span class="search-icon">🔍</span>
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama barang, lokasi..."
                    value="{{ request('search') }}"
                >
            </div>
        </div>

        <div class="filter-group" style="min-width:130px; flex:0 1 130px;">
            <span class="filter-label">Tipe</span>
            <select name="type" class="form-control">
                <option value="">Semua Tipe</option>
                <option value="hilang"    {{ request('type') == 'hilang'    ? 'selected' : '' }}>Hilang</option>
                <option value="ditemukan" {{ request('type') == 'ditemukan' ? 'selected' : '' }}>Ditemukan</option>
            </select>
        </div>

        <div class="filter-group" style="min-width:160px; flex:0 1 160px;">
            <span class="filter-label">Status</span>
            <select name="status" class="form-control">
                <option value="">Semua Status</option>
                <option value="dilaporkan"           {{ request('status') == 'dilaporkan'           ? 'selected' : '' }}>Dilaporkan</option>
                <option value="ada_di_resepsionis"   {{ request('status') == 'ada_di_resepsionis'   ? 'selected' : '' }}>Di Resepsionis</option>
                <option value="sudah_diambil"        {{ request('status') == 'sudah_diambil'        ? 'selected' : '' }}>Sudah Diambil</option>
                <option value="ditutup"              {{ request('status') == 'ditutup'              ? 'selected' : '' }}>Ditutup</option>
            </select>
        </div>

        <button type="submit" class="btn-filter">Cari</button>
        <a href="{{ route('items.index') }}" class="btn-reset">Reset</a>
    </form>
</div>

{{-- ITEMS GRID --}}
@if($items->count() > 0)
<div class="items-grid">
    @foreach($items as $item)
    <div class="item-card">
        @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="item-card-img">
        @else
            <div class="item-card-img-placeholder">
                {{ $item->type === 'hilang' ? '🔴' : '🔵' }}
            </div>
        @endif

        <div class="item-card-body">
            <div class="item-card-meta">
                <span class="item-type-badge {{ $item->type === 'hilang' ? 'type-hilang' : 'type-ditemukan' }}">
                    {{ $item->type === 'hilang' ? '▲ Hilang' : '▼ Ditemukan' }}
                </span>
                <span class="status-badge status-{{ $item->status }}" style="margin-left:2px;">
                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                </span>
                <span class="item-card-date">{{ \Carbon\Carbon::parse($item->date_event)->format('d M Y') }}</span>
            </div>

            <div class="item-card-title">{{ $item->title }}</div>
            <div class="item-card-desc">{{ $item->description }}</div>
        </div>

        <div class="item-card-footer">
            <span class="item-location">📍 {{ Str::limit($item->location, 28) }}</span>
            <a href="{{ route('items.show', $item->id) }}">Lihat Detail →</a>
        </div>
    </div>
    @endforeach
</div>

<div class="pagination-wrap">
    {{ $items->withQueryString()->links() }}
</div>

@else
<div class="empty-state">
    <div class="empty-icon">📭</div>
    <h3>Belum ada laporan</h3>
    <p>Tidak ada laporan yang cocok dengan pencarian kamu.</p>
    @auth
    <a href="{{ route('items.create') }}" class="btn btn-primary">Buat Laporan Pertama</a>
    @else
    <a href="{{ route('login') }}" class="btn btn-primary">Masuk untuk Membuat Laporan</a>
    @endauth
</div>
@endif

@endsection