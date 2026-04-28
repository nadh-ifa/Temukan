@extends('layouts.app')

@section('title', 'Semua Laporan')

@section('content')
<style>
    /* ===== HERO ===== */
    .hero {
        background: var(--red);
        border-radius: var(--radius-xl);
        padding: 2.25rem 2.5rem;
        margin-bottom: 1.75rem;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
        pointer-events: none;
    }

    .hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: 40%;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        pointer-events: none;
    }

    .hero-inner {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .hero h1 {
        font-size: 1.7rem;
        font-weight: 800;
        color: var(--white);
        letter-spacing: -0.5px;
        margin-bottom: 0.35rem;
    }

    .hero p {
        font-size: 0.88rem;
        color: rgba(255,255,255,0.78);
        margin-bottom: 1.25rem;
    }

    .hero-btns { display: flex; gap: 0.6rem; flex-wrap: wrap; }

    .btn-hero {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--white);
        color: var(--red);
        font-family: var(--font);
        font-size: 0.85rem;
        font-weight: 700;
        padding: 0.58rem 1.2rem;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: transform 0.15s, box-shadow 0.15s;
    }

    .btn-hero:hover { transform: translateY(-2px); box-shadow: 0 5px 16px rgba(0,0,0,0.2); }

    .btn-hero-outline {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255,255,255,0.15);
        color: var(--white);
        font-family: var(--font);
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.58rem 1.2rem;
        border-radius: 8px;
        text-decoration: none;
        border: 1.5px solid rgba(255,255,255,0.4);
        transition: background 0.15s;
    }

    .btn-hero-outline:hover { background: rgba(255,255,255,0.25); }

    /* ===== STATS ROW ===== */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 700px) { .stats-row { grid-template-columns: repeat(2, 1fr); } }

    .stat-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1.1rem 1.25rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

    .stat-icon-wrap {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
    }

    .stat-icon-wrap svg { width: 18px; height: 18px; }

    .stat-icon-wrap.red    { background: var(--red-pale); }
    .stat-icon-wrap.red    svg { fill: var(--red); }
    .stat-icon-wrap.blue   { background: var(--blue-pale); }
    .stat-icon-wrap.blue   svg { fill: var(--blue); }
    .stat-icon-wrap.green  { background: #E8F5E9; }
    .stat-icon-wrap.green  svg { fill: #2E7D32; }
    .stat-icon-wrap.yellow { background: var(--yellow-pale); }
    .stat-icon-wrap.yellow svg { fill: #92720A; }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1;
        margin-bottom: 3px;
    }

    .stat-label {
        font-size: 0.78rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    /* ===== FILTER BAR ===== */
    .filter-bar {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }

    .filter-form {
        display: flex;
        gap: 0.75rem;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .filter-field {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .filter-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-field-search { flex: 2; min-width: 200px; }
    .filter-field-select { flex: 1; min-width: 130px; }

    .search-wrap { position: relative; }

    .search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .search-icon svg { width: 14px; height: 14px; fill: var(--text-light); }

    .search-wrap .form-control { padding-left: 32px; background: var(--cream); }

    .filter-actions { display: flex; gap: 0.5rem; align-items: flex-end; }

    /* ===== ITEMS GRID ===== */
    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1rem;
    }

    .item-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-md);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .item-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }

    .item-card-img {
        width: 100%;
        height: 168px;
        object-fit: cover;
    }

    .item-card-img-placeholder {
        width: 100%;
        height: 168px;
        background: var(--cream-dark);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .item-card-img-placeholder svg {
        width: 48px;
        height: 48px;
        fill: var(--border);
    }

    .item-card-body {
        padding: 1rem 1.1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .item-card-meta {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .type-badge {
        font-size: 0.68rem;
        font-weight: 700;
        padding: 0.2rem 0.55rem;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .type-hilang    { background: var(--red-pale); color: var(--red); border: 1px solid var(--red-border); }
    .type-ditemukan { background: var(--blue-pale); color: var(--blue); border: 1px solid var(--blue-border); }

    .item-card-date {
        font-size: 0.73rem;
        color: var(--text-light);
        margin-left: auto;
    }

    .item-card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.35;
    }

    .item-card-desc {
        font-size: 0.82rem;
        color: var(--text-muted);
        line-height: 1.55;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .item-card-footer {
        padding: 0.75rem 1.1rem;
        border-top: 1.5px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .item-location {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.78rem;
        color: var(--text-muted);
    }

    .item-location svg { width: 13px; height: 13px; fill: var(--text-light); flex-shrink: 0; }

    .item-detail-link {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--red);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 3px;
        transition: gap 0.15s;
    }

    .item-detail-link:hover { gap: 6px; }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-muted);
        grid-column: 1 / -1;
    }

    .empty-icon {
        width: 72px;
        height: 72px;
        background: var(--cream-dark);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .empty-icon svg { width: 32px; height: 32px; fill: var(--text-light); }

    .empty-state h3 { font-size: 1rem; font-weight: 700; color: var(--text-mid); margin-bottom: 0.3rem; }
    .empty-state p { font-size: 0.85rem; margin-bottom: 1.25rem; }

    /* ===== PAGINATION ===== */
    .pagination-wrap { margin-top: 1.75rem; display: flex; justify-content: center; }
</style>

{{-- HERO --}}
<div class="hero">
    <div class="hero-inner">
        <div>
            <h1>Semua Laporan</h1>
            <p>Cari barang yang hilang atau lihat barang yang ditemukan di FILKOM UB.</p>
            @auth
            <div class="hero-btns">
                <a href="{{ route('items.create', ['type' => 'hilang']) }}" class="btn-hero">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                    Kehilangan Barang
                </a>
                <a href="{{ route('items.create', ['type' => 'ditemukan']) }}" class="btn-hero-outline">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                    Menemukan Barang
                </a>
            </div>
            @else
            <div class="hero-btns">
                <a href="{{ route('login') }}" class="btn-hero">Masuk untuk Melaporkan</a>
            </div>
            @endauth
        </div>
    </div>
</div>

{{-- STATS --}}
<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon-wrap yellow">
            <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
        </div>
        <div class="stat-number">{{ $stats['total'] ?? 0 }}</div>
        <div class="stat-label">Total Laporan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap red">
            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
        </div>
        <div class="stat-number">{{ $stats['hilang'] ?? 0 }}</div>
        <div class="stat-label">Barang Hilang</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap blue">
            <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
        </div>
        <div class="stat-number">{{ $stats['ditemukan'] ?? 0 }}</div>
        <div class="stat-label">Barang Ditemukan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap green">
            <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
        </div>
        <div class="stat-number">{{ $stats['sudah_diambil'] ?? 0 }}</div>
        <div class="stat-label">Sudah Diambil</div>
    </div>
</div>

{{-- FILTER --}}
<div class="filter-bar">
    <form method="GET" action="{{ route('items.index') }}" class="filter-form">
        <div class="filter-field filter-field-search">
            <span class="filter-label">Cari</span>
            <div class="search-wrap">
                <span class="search-icon"><svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg></span>
                <input type="text" name="search" class="form-control" placeholder="Nama barang, lokasi..." value="{{ request('search') }}">
            </div>
        </div>

        <div class="filter-field filter-field-select">
            <span class="filter-label">Tipe</span>
            <select name="type" class="form-control">
                <option value="">Semua Tipe</option>
                <option value="hilang"    {{ request('type') == 'hilang'    ? 'selected' : '' }}>Hilang</option>
                <option value="ditemukan" {{ request('type') == 'ditemukan' ? 'selected' : '' }}>Ditemukan</option>
            </select>
        </div>

        <div class="filter-field filter-field-select">
            <span class="filter-label">Status</span>
            <select name="status" class="form-control">
                <option value="">Semua Status</option>
                <option value="dilaporkan"         {{ request('status') == 'dilaporkan'         ? 'selected' : '' }}>Dilaporkan</option>
                <option value="ada_di_resepsionis" {{ request('status') == 'ada_di_resepsionis' ? 'selected' : '' }}>Di Resepsionis</option>
                <option value="sudah_diambil"      {{ request('status') == 'sudah_diambil'      ? 'selected' : '' }}>Sudah Diambil</option>
                <option value="ditutup"            {{ request('status') == 'ditutup'            ? 'selected' : '' }}>Ditutup</option>
            </select>
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="{{ route('items.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
</div>

{{-- GRID --}}
<div class="items-grid">
    @forelse($items as $item)
    <div class="item-card">
        @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="item-card-img">
        @else
            <div class="item-card-img-placeholder">
                <svg viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
            </div>
        @endif

        <div class="item-card-body">
            <div class="item-card-meta">
                <span class="type-badge {{ $item->type === 'hilang' ? 'type-hilang' : 'type-ditemukan' }}">
                    {{ $item->type === 'hilang' ? 'Hilang' : 'Ditemukan' }}
                </span>
                <span class="badge status-{{ $item->status }}">
                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                </span>
                <span class="item-card-date">{{ \Carbon\Carbon::parse($item->date_event)->format('d M Y') }}</span>
            </div>
            <div class="item-card-title">{{ $item->title }}</div>
            <div class="item-card-desc">{{ $item->description }}</div>
        </div>

        <div class="item-card-footer">
            <span class="item-location">
                <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                {{ Str::limit($item->location, 26) }}
            </span>
            <a href="{{ route('items.show', $item->id) }}" class="item-detail-link">
                Detail
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
            </a>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-icon">
            <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
        </div>
        <h3>Tidak ada laporan</h3>
        <p>Tidak ditemukan laporan yang sesuai dengan pencarian.</p>
        @auth
        <a href="{{ route('items.create') }}" class="btn btn-primary">Buat Laporan</a>
        @else
        <a href="{{ route('login') }}" class="btn btn-primary">Masuk untuk Melaporkan</a>
        @endauth
    </div>
    @endforelse
</div>

@if($items->hasPages())
<div class="pagination-wrap">
    {{ $items->withQueryString()->links() }}
</div>
@endif

@endsection