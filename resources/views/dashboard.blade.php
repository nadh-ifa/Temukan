@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Welcome banner */
    .welcome-banner {
        background: var(--red);
        border-radius: var(--radius-xl);
        padding: 2rem 2.25rem;
        margin-bottom: 1.75rem;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -60px; right: -40px;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
        pointer-events: none;
    }

    .welcome-text { position: relative; z-index: 1; }

    .welcome-text h1 {
        font-size: 1.45rem;
        font-weight: 800;
        color: var(--white);
        letter-spacing: -0.3px;
        margin-bottom: 0.3rem;
    }

    .welcome-text p { font-size: 0.87rem; color: rgba(255,255,255,0.75); }

    .welcome-actions {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .btn-w {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--white);
        color: var(--red);
        font-family: var(--font);
        font-size: 0.83rem;
        font-weight: 700;
        padding: 0.55rem 1.1rem;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: transform 0.15s;
    }

    .btn-w:hover { transform: translateY(-1px); }

    .btn-w-outline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.15);
        color: var(--white);
        font-family: var(--font);
        font-size: 0.83rem;
        font-weight: 600;
        padding: 0.55rem 1.1rem;
        border-radius: 8px;
        text-decoration: none;
        border: 1.5px solid rgba(255,255,255,0.35);
        transition: background 0.15s;
    }

    .btn-w-outline:hover { background: rgba(255,255,255,0.25); }

    /* Stats */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.75rem;
    }

    @media (max-width: 700px) { .stats-row { grid-template-columns: repeat(2, 1fr); } }

    .stat-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1.1rem 1.25rem;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
        display: block;
    }

    .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

    .stat-icon-wrap {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.65rem;
    }

    .stat-icon-wrap svg { width: 17px; height: 17px; }
    .ico-red   { background: var(--red-pale); }   .ico-red   svg { fill: var(--red); }
    .ico-blue  { background: var(--blue-pale); }  .ico-blue  svg { fill: var(--blue); }
    .ico-green { background: #E8F5E9; }           .ico-green svg { fill: #2E7D32; }
    .ico-yel   { background: var(--yellow-pale); }.ico-yel   svg { fill: #92720A; }

    .stat-number { font-size: 1.7rem; font-weight: 800; color: var(--text-dark); line-height: 1; margin-bottom: 3px; }
    .stat-label  { font-size: 0.77rem; color: var(--text-muted); font-weight: 500; }

    /* Main grid */
    .dash-grid {
        display: grid;
        grid-template-columns: 1fr 290px;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 900px) { .dash-grid { grid-template-columns: 1fr; } }

    /* Section header */
    .section-hd {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.85rem;
    }

    .section-hd-title { font-size: 0.95rem; font-weight: 700; color: var(--text-dark); }
    .section-hd-link  { font-size: 0.8rem; color: var(--red); text-decoration: none; font-weight: 600; }
    .section-hd-link:hover { text-decoration: underline; }

    /* Report items */
    .report-list { display: flex; flex-direction: column; gap: 0.6rem; }

    .report-item {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 0.9rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        text-decoration: none;
        transition: transform 0.18s, box-shadow 0.18s;
    }

    .report-item:hover { transform: translateY(-1px); box-shadow: var(--shadow-md); }

    .report-item-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .report-item-icon.hilang    { background: var(--red-pale); }
    .report-item-icon.hilang    svg { fill: var(--red); }
    .report-item-icon.ditemukan { background: var(--blue-pale); }
    .report-item-icon.ditemukan svg { fill: var(--blue); }
    .report-item-icon svg { width: 18px; height: 18px; }

    .report-item-info { flex: 1; min-width: 0; }

    .report-item-title {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--text-dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 2px;
    }

    .report-item-meta {
        font-size: 0.75rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Sidebar */
    .side-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-md);
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .side-card-hd {
        padding: 0.85rem 1.1rem;
        border-bottom: 1.5px solid var(--border);
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--text-mid);
        background: var(--cream);
    }

    .side-card-body { padding: 1rem 1.1rem; }

    /* Profile */
    .profile-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--red);
        color: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .profile-name  { font-size: 0.9rem; font-weight: 700; color: var(--text-dark); }
    .profile-email { font-size: 0.75rem; color: var(--text-muted); margin-top: 1px; }
    .profile-role  {
        display: inline-flex;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 0.18rem 0.55rem;
        border-radius: 999px;
        background: var(--blue-pale);
        color: var(--blue);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 4px;
    }

    /* Quick actions */
    .quick-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; }

    .qa-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        padding: 0.85rem 0.5rem;
        background: var(--cream);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        text-decoration: none;
        transition: background 0.15s, transform 0.15s;
        cursor: pointer;
        font-family: var(--font);
    }

    .qa-btn:hover { background: var(--red-pale); border-color: var(--red-border); transform: translateY(-2px); }

    .qa-icon { width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
    .qa-icon svg { width: 15px; height: 15px; }
    .qa-icon.r { background: var(--red-pale); }    .qa-icon.r svg { fill: var(--red); }
    .qa-icon.b { background: var(--blue-pale); }   .qa-icon.b svg { fill: var(--blue); }
    .qa-icon.g { background: var(--cream-dark); }  .qa-icon.g svg { fill: var(--text-muted); }

    .qa-label { font-size: 0.72rem; font-weight: 600; color: var(--text-mid); text-align: center; }

    /* Recent global */
    .recent-item-link {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 0.6rem 1.1rem;
        text-decoration: none;
        transition: background 0.15s;
        border-radius: var(--radius-xs);
    }

    .recent-item-link:hover { background: var(--cream); }

    .recent-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .dot-hilang    { background: var(--red); }
    .dot-ditemukan { background: var(--blue); }

    .ri-title { font-size: 0.82rem; font-weight: 600; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; flex: 1; min-width: 0; }
    .ri-time  { font-size: 0.72rem; color: var(--text-light); white-space: nowrap; }

    /* Empty */
    .empty-mini { text-align: center; padding: 1.5rem; }
    .empty-mini p { font-size: 0.83rem; color: var(--text-light); }
</style>

<!-- Welcome -->
<div class="welcome-banner">
    <div class="welcome-text">
        <h1>Halo, {{ auth()->user()->name }}!</h1>
        <p>Selamat datang di Temukan! pantau laporan kamu di sini.</p>
    </div>
    <div class="welcome-actions">
        <a href="{{ route('items.create', ['type' => 'hilang']) }}" class="btn-w">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
            Laporan Hilang
        </a>
        <a href="{{ route('items.create', ['type' => 'ditemukan']) }}" class="btn-w-outline">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
            Laporan Temuan
        </a>
    </div>
</div>

<!-- Stats -->
<div class="stats-row">
    <a href="{{ route('items.index') }}" class="stat-card">
        <div class="stat-icon-wrap ico-yel">
            <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
        </div>
        <div class="stat-number">{{ $myItems->total() ?? $myItems->count() }}</div>
        <div class="stat-label">Total Laporan</div>
    </a>
    <div class="stat-card">
        <div class="stat-icon-wrap ico-red">
            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
        </div>
        <div class="stat-number">{{ $myItems->where('type','hilang')->count() }}</div>
        <div class="stat-label">Barang Hilang</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap ico-blue">
            <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
        </div>
        <div class="stat-number">{{ $myItems->where('type','ditemukan')->count() }}</div>
        <div class="stat-label">Barang Temuan</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap ico-green">
            <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
        </div>
        <div class="stat-number">{{ $myItems->whereIn('status',['sudah_diambil','ditutup'])->count() }}</div>
        <div class="stat-label">Selesai</div>
    </div>
</div>

<!-- Main grid -->
<div class="dash-grid">

    <!-- My Reports -->
    <div>
        <div class="section-hd">
            <span class="section-hd-title">Laporan Saya Terbaru</span>
            <a href="{{ route('items.index') }}" class="section-hd-link">Lihat semua</a>
        </div>

        <div class="report-list">
            @forelse($myItems->take(5) as $item)
            <a href="{{ route('items.show', $item->id) }}" class="report-item">
                <div class="report-item-icon {{ $item->type === 'hilang' ? 'hilang' : 'ditemukan' }}">
                    @if($item->type === 'hilang')
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                    @else
                    <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    @endif
                </div>
                <div class="report-item-info">
                    <div class="report-item-title">{{ $item->title }}</div>
                    <div class="report-item-meta">
                        <span>{{ Str::limit($item->location, 22) }}</span>
                        <span>·</span>
                        <span>{{ \Carbon\Carbon::parse($item->date_event)->format('d M Y') }}</span>
                    </div>
                </div>
                <span class="badge status-{{ $item->status }}">{{ ucfirst(str_replace('_', ' ', $item->status)) }}</span>
            </a>
            @empty
            <div class="empty-mini">
                <p>Belum ada laporan.</p>
                <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm" style="margin-top:0.6rem;">Buat Laporan</a>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Profile -->
        <div class="side-card">
            <div class="side-card-hd">Profil Saya</div>
            <div class="side-card-body">
                <div class="profile-row">
                    <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                    <div>
                        <div class="profile-name">{{ auth()->user()->name }}</div>
                        <div class="profile-email">{{ auth()->user()->email }}</div>
                        <span class="profile-role">{{ auth()->user()->role }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick actions -->
        <div class="side-card">
            <div class="side-card-hd">Aksi Cepat</div>
            <div class="side-card-body">
                <div class="quick-grid">
                    <a href="{{ route('items.create', ['type' => 'hilang']) }}" class="qa-btn">
                        <div class="qa-icon r"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg></div>
                        <span class="qa-label">Laporan Hilang</span>
                    </a>
                    <a href="{{ route('items.create', ['type' => 'ditemukan']) }}" class="qa-btn">
                        <div class="qa-icon b"><svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg></div>
                        <span class="qa-label">Laporan Temuan</span>
                    </a>
                    <a href="{{ route('items.index') }}" class="qa-btn">
                        <div class="qa-icon g"><svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg></div>
                        <span class="qa-label">Cari Laporan</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="qa-btn" style="width:100%; border:none;">
                            <div class="qa-icon g"><svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg></div>
                            <span class="qa-label">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Recent global -->
        <div class="side-card">
            <div class="side-card-hd">Laporan Terbaru</div>
            <div style="padding: 0.4rem 0;">
                @forelse($recentItems as $ri)
                <a href="{{ route('items.show', $ri->id) }}" class="recent-item-link">
                    <div class="recent-dot {{ $ri->type === 'hilang' ? 'dot-hilang' : 'dot-ditemukan' }}"></div>
                    <span class="ri-title">{{ $ri->title }}</span>
                    <span class="ri-time">{{ $ri->created_at->diffForHumans() }}</span>
                </a>
                @empty
                <div class="empty-mini"><p>Belum ada laporan.</p></div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection