@extends('layouts.app')

@section('title', 'Dashboard Resepsionis')

@section('content')
<style>
    /* ===== HEADER ===== */
    .resep-header {
        background: linear-gradient(135deg, #1E40AF, #1D4ED8);
        border-radius: var(--radius-xl);
        padding: 2rem 2.25rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .resep-header::after {
        content: '🗂️';
        position: absolute;
        right: 2rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 64px;
        opacity: 0.1;
    }

    .resep-header h1 {
        font-family: var(--font-serif);
        font-size: 1.6rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.3rem;
    }

    .resep-header p { font-size: 0.88rem; color: rgba(255,255,255,0.7); }

    .resep-badge {
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.25);
        color: white;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 0.4rem 0.9rem;
        border-radius: 999px;
        white-space: nowrap;
    }

    /* ===== STATS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(148px, 1fr));
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
        gap: 6px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

    .stat-icon-wrap {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 4px;
    }

    .icon-blue   { background: var(--blue-50); }
    .icon-red    { background: var(--red-50); }
    .icon-yellow { background: #FEF9C3; }
    .icon-green  { background: #DCFCE7; }
    .icon-gray   { background: var(--gray-100); }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1;
    }

    .stat-label { font-size: 0.78rem; color: var(--gray-500); font-weight: 500; }

    /* ===== MAIN LAYOUT ===== */
    .resep-grid {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 900px) { .resep-grid { grid-template-columns: 1fr; } }

    /* ===== TABLE ===== */
    .table-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .table-card-header {
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--gray-50);
    }

    .table-title { font-size: 0.92rem; font-weight: 700; color: var(--gray-800); }

    .filter-tabs {
        display: flex;
        gap: 4px;
        background: var(--gray-100);
        border-radius: 999px;
        padding: 3px;
    }

    .filter-tab {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        border: none;
        background: transparent;
        color: var(--gray-500);
        cursor: pointer;
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
    }

    .filter-tab.active, .filter-tab:hover {
        background: white;
        color: var(--blue-700);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .data-table th {
        text-align: left;
        padding: 0.75rem 1.2rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-100);
    }

    .data-table td {
        padding: 0.85rem 1.2rem;
        border-bottom: 1px solid var(--gray-50);
        vertical-align: middle;
        color: var(--gray-700);
    }

    .data-table tr:last-child td { border-bottom: none; }

    .data-table tr:hover td { background: var(--gray-50); }

    .td-title {
        font-weight: 600;
        color: var(--gray-900);
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .td-meta {
        font-size: 0.78rem;
        color: var(--gray-400);
        margin-top: 1px;
    }

    .type-pill {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.22rem 0.55rem;
        border-radius: 999px;
        text-transform: uppercase;
    }

    .type-hilang    { background: var(--red-100);  color: var(--red-600); }
    .type-ditemukan { background: var(--blue-100); color: var(--blue-800); }

    /* Status select in table */
    .status-select {
        font-family: var(--font-sans);
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        border: 1.5px solid var(--gray-200);
        background: white;
        color: var(--gray-700);
        cursor: pointer;
        outline: none;
        transition: border-color 0.15s;
    }

    .status-select:focus { border-color: var(--blue-400); }

    .btn-table-action {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.3rem 0.75rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.15s, transform 0.12s;
    }

    .btn-table-action:active { transform: scale(0.97); }

    .btn-view {
        background: var(--blue-50);
        color: var(--blue-700);
    }

    .btn-view:hover { background: var(--blue-100); }

    .btn-save {
        background: var(--gray-100);
        color: var(--gray-700);
    }

    .btn-save:hover { background: var(--gray-200); }

    /* ===== SIDEBAR ===== */
    .sidebar-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin-bottom: 1rem;
        position: sticky;
        top: 80px;
    }

    .sidebar-header {
        padding: 0.9rem 1.2rem;
        border-bottom: 1px solid var(--gray-100);
        font-size: 0.83rem;
        font-weight: 700;
        color: var(--gray-700);
        background: var(--gray-50);
    }

    .sidebar-body { padding: 1.1rem 1.2rem; }

    .pending-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.6rem 0;
        border-bottom: 1px solid var(--gray-50);
        text-decoration: none;
        transition: opacity 0.15s;
    }

    .pending-item:last-child { border-bottom: none; }
    .pending-item:hover { opacity: 0.75; }

    .pending-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .dot-red    { background: var(--red-400); }
    .dot-blue   { background: var(--blue-400); }
    .dot-yellow { background: #EAB308; }

    .pending-title {
        font-size: 0.83rem;
        font-weight: 600;
        color: var(--gray-800);
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pending-time { font-size: 0.72rem; color: var(--gray-400); }
</style>

{{-- HEADER --}}
<div class="resep-header">
    <div>
        <h1>🗂️ Dashboard Resepsionis</h1>
        <p>Kelola dan validasi laporan barang hilang & ditemukan.</p>
    </div>
    <span class="resep-badge">👩‍💼 {{ auth()->user()->name }}</span>
</div>

{{-- STATS --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon-wrap icon-blue">📋</div>
        <span class="stat-value">{{ $stats['total'] }}</span>
        <span class="stat-label">Total Laporan</span>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap icon-yellow">⏳</div>
        <span class="stat-value" style="color:#854D0E;">{{ $stats['dilaporkan'] }}</span>
        <span class="stat-label">Menunggu Proses</span>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap icon-blue">🏢</div>
        <span class="stat-value" style="color:var(--blue-600);">{{ $stats['ada_di_resepsionis'] }}</span>
        <span class="stat-label">Di Resepsionis</span>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap icon-green">✅</div>
        <span class="stat-value" style="color:#16A34A;">{{ $stats['sudah_diambil'] }}</span>
        <span class="stat-label">Sudah Diambil</span>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap icon-gray">🔒</div>
        <span class="stat-value" style="color:var(--gray-500);">{{ $stats['ditutup'] }}</span>
        <span class="stat-label">Ditutup</span>
    </div>
</div>

{{-- GRID --}}
<div class="resep-grid">

    {{-- TABEL LAPORAN --}}
    <div>
        <div class="table-card">
            <div class="table-card-header">
                <span class="table-title">Semua Laporan</span>
                <div class="filter-tabs">
                    <a href="{{ route('resepsionis.dashboard') }}"
                       class="filter-tab {{ !request('status') ? 'active' : '' }}">Semua</a>
                    <a href="{{ route('resepsionis.dashboard', ['status' => 'dilaporkan']) }}"
                       class="filter-tab {{ request('status') == 'dilaporkan' ? 'active' : '' }}">Baru</a>
                    <a href="{{ route('resepsionis.dashboard', ['status' => 'ada_di_resepsionis']) }}"
                       class="filter-tab {{ request('status') == 'ada_di_resepsionis' ? 'active' : '' }}">Di Sini</a>
                    <a href="{{ route('resepsionis.dashboard', ['status' => 'sudah_diambil']) }}"
                       class="filter-tab {{ request('status') == 'sudah_diambil' ? 'active' : '' }}">Selesai</a>
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Tipe</th>
                            <th>Lokasi</th>
                            <th>Pelapor</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="td-title">{{ $item->title }}</div>
                                <div class="td-meta">{{ \Carbon\Carbon::parse($item->date_event)->format('d M Y') }}</div>
                            </td>
                            <td>
                                <span class="type-pill {{ $item->type === 'hilang' ? 'type-hilang' : 'type-ditemukan' }}">
                                    {{ $item->type }}
                                </span>
                            </td>
                            <td style="font-size:0.83rem; max-width:120px;">{{ Str::limit($item->location, 22) }}</td>
                            <td style="font-size:0.83rem;">{{ $item->user->name }}</td>
                            <td>
                                <form action="{{ route('resepsionis.updateStatus', $item->id) }}" method="POST"
                                      style="display:flex; align-items:center; gap:6px;">
                                    @csrf @method('PATCH')
                                    <select name="status" class="status-select" onchange="this.form.submit()">
                                        <option value="dilaporkan"         {{ $item->status == 'dilaporkan'         ? 'selected' : '' }}>Dilaporkan</option>
                                        <option value="ada_di_resepsionis" {{ $item->status == 'ada_di_resepsionis' ? 'selected' : '' }}>Di Resepsionis</option>
                                        <option value="sudah_diambil"      {{ $item->status == 'sudah_diambil'      ? 'selected' : '' }}>Sudah Diambil</option>
                                        <option value="ditutup"            {{ $item->status == 'ditutup'            ? 'selected' : '' }}>Ditutup</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('items.show', $item->id) }}" class="btn-table-action btn-view">
                                    Detail →
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:3rem; color:var(--gray-400);">
                                <div style="font-size:2rem; margin-bottom:0.5rem;">📭</div>
                                Tidak ada laporan yang cocok.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($items->hasPages())
            <div style="padding:1rem 1.5rem; border-top:1px solid var(--gray-100);">
                {{ $items->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>

    {{-- SIDEBAR --}}
    <div>
        {{-- Perlu tindakan segera --}}
        <div class="sidebar-card">
            <div class="sidebar-header">⚡ Perlu Tindakan</div>
            <div class="sidebar-body" style="padding:0.5rem 0;">
                @forelse($pendingItems as $pi)
                <a href="{{ route('items.show', $pi->id) }}" class="pending-item" style="padding:0.6rem 1.2rem;">
                    <span class="pending-dot {{ $pi->type === 'hilang' ? 'dot-red' : 'dot-blue' }}"></span>
                    <span class="pending-title">{{ $pi->title }}</span>
                    <span class="pending-time">{{ $pi->created_at->diffForHumans(null, true) }}</span>
                </a>
                @empty
                <p style="font-size:0.82rem; color:var(--gray-400); text-align:center; padding:1rem 1.2rem;">
                    ✅ Semua laporan sudah diproses!
                </p>
                @endforelse
            </div>
        </div>

        {{-- Quick stats by type --}}
        <div class="sidebar-card">
            <div class="sidebar-header">📊 Ringkasan Tipe</div>
            <div class="sidebar-body">
                <div style="margin-bottom:1rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                        <span style="font-size:0.83rem; color:var(--gray-600); font-weight:600;">🔴 Barang Hilang</span>
                        <span style="font-size:0.83rem; font-weight:700; color:var(--gray-800);">{{ $stats['hilang'] ?? 0 }}</span>
                    </div>
                    <div style="height:8px; background:var(--gray-100); border-radius:999px; overflow:hidden;">
                        <div style="height:100%; width:{{ $stats['total'] > 0 ? round(($stats['hilang'] ?? 0) / $stats['total'] * 100) : 0 }}%; background:var(--red-400); border-radius:999px; transition:width 0.5s;"></div>
                    </div>
                </div>
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                        <span style="font-size:0.83rem; color:var(--gray-600); font-weight:600;">🔵 Barang Ditemukan</span>
                        <span style="font-size:0.83rem; font-weight:700; color:var(--gray-800);">{{ $stats['ditemukan'] ?? 0 }}</span>
                    </div>
                    <div style="height:8px; background:var(--gray-100); border-radius:999px; overflow:hidden;">
                        <div style="height:100%; width:{{ $stats['total'] > 0 ? round(($stats['ditemukan'] ?? 0) / $stats['total'] * 100) : 0 }}%; background:var(--blue-400); border-radius:999px; transition:width 0.5s;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lihat semua --}}
        <a href="{{ route('items.index') }}" class="btn btn-outline" style="width:100%; justify-content:center;">
            🔍 Lihat Semua Laporan
        </a>
    </div>

</div>
@endsection