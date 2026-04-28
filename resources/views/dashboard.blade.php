@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* ===== WELCOME SECTION ===== */
    .welcome-section {
        background: linear-gradient(135deg, var(--blue-600), var(--blue-800));
        border-radius: var(--radius-xl);
        padding: 2rem 2.25rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
    }

    .welcome-section::after {
        content: '🔍';
        position: absolute;
        right: 2.5rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 72px;
        opacity: 0.12;
    }

    .welcome-left h1 {
        font-family: var(--font-serif);
        font-size: 1.6rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.3rem;
    }

    .welcome-left p {
        font-size: 0.88rem;
        color: rgba(255,255,255,0.72);
    }

    .welcome-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-welcome {
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
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        white-space: nowrap;
    }

    .btn-welcome:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.2); }

    .btn-welcome-outline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.12);
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border-radius: var(--radius-sm);
        text-decoration: none;
        border: 1.5px solid rgba(255,255,255,0.3);
        transition: background 0.15s;
        white-space: nowrap;
    }

    .btn-welcome-outline:hover { background: rgba(255,255,255,0.22); }

    /* ===== STATS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
    }

    .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

    .stat-icon {
        font-size: 1.6rem;
        line-height: 1;
    }

    .stat-value {
        font-size: 1.9rem;
        font-weight: 700;
        color: var(--blue-600);
        line-height: 1;
    }

    .stat-label {
        font-size: 0.8rem;
        color: var(--gray-500);
        font-weight: 500;
    }

    /* ===== CONTENT GRID ===== */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 900px) {
        .dashboard-grid { grid-template-columns: 1fr; }
        .welcome-section { flex-direction: column; align-items: flex-start; }
        .welcome-section::after { display: none; }
    }

    /* ===== REPORT LIST ===== */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-800);
    }

    .section-link {
        font-size: 0.82rem;
        color: var(--blue-600);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.15s;
    }

    .section-link:hover { color: var(--blue-800); text-decoration: underline; }

    .report-list { display: flex; flex-direction: column; gap: 0.75rem; }

    .report-item {
        background: white;
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-100);
        padding: 1rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: box-shadow 0.2s, transform 0.2s;
        text-decoration: none;
        box-shadow: var(--shadow-sm);
    }

    .report-item:hover { transform: translateY(-1px); box-shadow: var(--shadow-md); }

    .report-item-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .icon-hilang    { background: var(--red-50); }
    .icon-ditemukan { background: var(--blue-50); }

    .report-item-info { flex: 1; min-width: 0; }

    .report-item-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--gray-900);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 2px;
    }

    .report-item-meta {
        font-size: 0.77rem;
        color: var(--gray-400);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .report-item-status {
        display: inline-flex;
        align-items: center;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.2rem 0.55rem;
        border-radius: 999px;
        flex-shrink: 0;
    }

    /* ===== SIDEBAR CARDS ===== */
    .info-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .info-card-header {
        padding: 0.9rem 1.2rem;
        border-bottom: 1px solid var(--gray-100);
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--gray-700);
        background: var(--gray-50);
    }

    .info-card-body { padding: 1.1rem 1.2rem; }

    .profile-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1rem;
    }

    .profile-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--blue-400), var(--blue-600));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .profile-name { font-size: 0.95rem; font-weight: 700; color: var(--gray-900); }
    .profile-email { font-size: 0.78rem; color: var(--gray-400); }
    .profile-role {
        display: inline-flex;
        align-items: center;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.2rem 0.6rem;
        border-radius: 999px;
        background: var(--blue-100);
        color: var(--blue-800);
        text-transform: uppercase;
        margin-top: 4px;
    }

    /* Quick actions */
    .quick-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 0.6rem; }

    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        background: var(--gray-50);
        border: 1px solid var(--gray-100);
        border-radius: var(--radius-md);
        padding: 0.9rem 0.5rem;
        text-decoration: none;
        transition: background 0.18s, transform 0.15s;
        cursor: pointer;
    }

    .quick-action-btn:hover { background: var(--blue-50); border-color: var(--blue-200); transform: translateY(-2px); }

    .qa-icon { font-size: 1.4rem; }
    .qa-label { font-size: 0.75rem; font-weight: 600; color: var(--gray-600); text-align: center; }

    /* Empty */
    .empty-mini {
        text-align: center;
        padding: 2rem 1rem;
        color: var(--gray-400);
    }

    .empty-mini .empty-icon { font-size: 2.5rem; margin-bottom: 0.5rem; }
    .empty-mini p { font-size: 0.83rem; }
</style>

{{-- WELCOME --}}
<div class="welcome-section">
    <div class="welcome-left">
        <h1>Halo, {{ auth()->user()->name }}! 👋</h1>
        <p>Selamat datang di Temukan – sistem Lost &amp; Found FILKOM UB.</p>
    </div>
    <div class="welcome-actions">
        <a href="{{ route('items.create', ['type' => 'hilang']) }}" class="btn-welcome">🔴 Laporan Hilang</a>
        <a href="{{ route('items.create', ['type' => 'ditemukan']) }}" class="btn-welcome-outline">🔵 Laporan Temuan</a>
    </div>
</div>

{{-- STATS --}}
<div class="stats-grid">
    <a href="{{ route('items.index', ['user' => auth()->id()]) }}" class="stat-card">
        <span class="stat-icon">📋</span>
        <span class="stat-value">{{ $myItems->total() ?? $myItems->count() }}</span>
        <span class="stat-label">Total Laporan Saya</span>
    </a>
    <a href="{{ route('items.index', ['user' => auth()->id(), 'type' => 'hilang']) }}" class="stat-card">
        <span class="stat-icon">🔴</span>
        <span class="stat-value" style="color:var(--red-500);">{{ $myItems->where('type','hilang')->count() }}</span>
        <span class="stat-label">Barang Hilang</span>
    </a>
    <a href="{{ route('items.index', ['user' => auth()->id(), 'type' => 'ditemukan']) }}" class="stat-card">
        <span class="stat-icon">🔵</span>
        <span class="stat-value">{{ $myItems->where('type','ditemukan')->count() }}</span>
        <span class="stat-label">Barang Ditemukan</span>
    </a>
    <div class="stat-card" style="cursor:default;">
        <span class="stat-icon">✅</span>
        <span class="stat-value" style="color:#16A34A;">{{ $myItems->whereIn('status', ['sudah_diambil','ditutup'])->count() }}</span>
        <span class="stat-label">Selesai</span>
    </div>
</div>

{{-- MAIN GRID --}}
<div class="dashboard-grid">

    {{-- LAPORAN SAYA --}}
    <div>
        <div class="section-header">
            <span class="section-title">📋 Laporan Saya Terbaru</span>
            <a href="{{ route('items.index') }}" class="section-link">Lihat semua →</a>
        </div>

        <div class="report-list">
            @forelse($myItems->take(5) as $item)
            <a href="{{ route('items.show', $item->id) }}" class="report-item">
                <div class="report-item-icon {{ $item->type === 'hilang' ? 'icon-hilang' : 'icon-ditemukan' }}">
                    {{ $item->type === 'hilang' ? '🔴' : '🔵' }}
                </div>
                <div class="report-item-info">
                    <div class="report-item-title">{{ $item->title }}</div>
                    <div class="report-item-meta">
                        <span>📍 {{ Str::limit($item->location, 22) }}</span>
                        <span>{{ \Carbon\Carbon::parse($item->date_event)->format('d M Y') }}</span>
                    </div>
                </div>
                <span class="report-item-status status-{{ $item->status }}">
                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                </span>
            </a>
            @empty
            <div class="empty-mini">
                <div class="empty-icon">📭</div>
                <p>Belum ada laporan.</p>
                <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm" style="margin-top:0.75rem;">Buat Laporan</a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- SIDEBAR --}}
    <div>
        {{-- Profile Card --}}
        <div class="info-card">
            <div class="info-card-header">👤 Profil Saya</div>
            <div class="info-card-body">
                <div class="profile-row">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="profile-name">{{ auth()->user()->name }}</div>
                        <div class="profile-email">{{ auth()->user()->email }}</div>
                        <span class="profile-role">{{ auth()->user()->role }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="info-card">
            <div class="info-card-header">⚡ Aksi Cepat</div>
            <div class="info-card-body">
                <div class="quick-actions">
                    <a href="{{ route('items.create', ['type' => 'hilang']) }}" class="quick-action-btn">
                        <span class="qa-icon">🔴</span>
                        <span class="qa-label">Laporan Hilang</span>
                    </a>
                    <a href="{{ route('items.create', ['type' => 'ditemukan']) }}" class="quick-action-btn">
                        <span class="qa-icon">🔵</span>
                        <span class="qa-label">Laporan Temuan</span>
                    </a>
                    <a href="{{ route('items.index') }}" class="quick-action-btn">
                        <span class="qa-icon">🔍</span>
                        <span class="qa-label">Cari Laporan</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="quick-action-btn" style="width:100%; border:none; cursor:pointer;">
                            <span class="qa-icon">🚪</span>
                            <span class="qa-label">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Recent global activity --}}
        <div class="info-card">
            <div class="info-card-header">🌐 Laporan Terbaru</div>
            <div class="info-card-body" style="padding:0.5rem 0;">
                @forelse($recentItems as $ri)
                <a href="{{ route('items.show', $ri->id) }}"
                   style="display:flex; align-items:center; gap:10px; padding:0.65rem 1.2rem; text-decoration:none; transition:background 0.15s; border-radius:var(--radius-sm);"
                   onmouseover="this.style.background='var(--gray-50)'"
                   onmouseout="this.style.background=''">
                    <span style="font-size:1.1rem;">{{ $ri->type === 'hilang' ? '🔴' : '🔵' }}</span>
                    <div style="flex:1; min-width:0;">
                        <div style="font-size:0.83rem; font-weight:600; color:var(--gray-800); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $ri->title }}
                        </div>
                        <div style="font-size:0.73rem; color:var(--gray-400);">
                            {{ $ri->created_at->diffForHumans() }}
                        </div>
                    </div>
                </a>
                @empty
                <p style="font-size:0.82rem; color:var(--gray-400); text-align:center; padding:1rem;">Belum ada laporan.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection