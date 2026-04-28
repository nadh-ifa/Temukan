@extends('layouts.app')

@section('title', $item->title)

@section('content')
<style>
    .detail-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 860px) {
        .detail-layout { grid-template-columns: 1fr; }
    }

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }

    .breadcrumb a { color: var(--text-muted); text-decoration: none; transition: color 0.15s; }
    .breadcrumb a:hover { color: var(--red); }
    .breadcrumb svg { width: 12px; height: 12px; fill: var(--text-light); }
    .breadcrumb-current { color: var(--text-dark); font-weight: 500; }

    /* Main card */
    .detail-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    .detail-img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
    }

    .detail-img-placeholder {
        width: 100%;
        height: 240px;
        background: var(--cream-dark);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-img-placeholder svg { width: 64px; height: 64px; fill: var(--border); }

    .detail-body { padding: 1.75rem; }

    .detail-tags {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .detail-type-badge {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.3rem 0.8rem;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .type-hilang    { background: var(--red-pale); color: var(--red); border: 1px solid var(--red-border); }
    .type-ditemukan { background: var(--blue-pale); color: var(--blue); border: 1px solid var(--blue-border); }

    .detail-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -0.3px;
        line-height: 1.3;
        margin-bottom: 1.25rem;
    }

    .detail-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem 1.5rem;
        padding-bottom: 1.25rem;
        border-bottom: 1.5px solid var(--border);
        margin-bottom: 1.25rem;
    }

    @media (max-width: 500px) { .detail-meta-grid { grid-template-columns: 1fr; } }

    .meta-label {
        font-size: 0.73rem;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 3px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .meta-label svg { width: 12px; height: 12px; fill: var(--text-light); }

    .meta-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .detail-desc-label {
        font-size: 0.73rem;
        font-weight: 700;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.6rem;
    }

    .detail-desc {
        font-size: 0.9rem;
        color: var(--text-mid);
        line-height: 1.8;
    }

    /* ===== SIDEBAR ===== */
    .sidebar-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }

    .sidebar-section {
        padding: 1.1rem 1.25rem;
        border-bottom: 1.5px solid var(--border);
    }

    .sidebar-section:last-child { border-bottom: none; }

    .sidebar-section-title {
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 0.85rem;
    }

    .reporter-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .reporter-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: var(--red);
        color: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .reporter-name { font-size: 0.88rem; font-weight: 700; color: var(--text-dark); }
    .reporter-role { font-size: 0.75rem; color: var(--text-muted); margin-top: 1px; }

    /* Info list */
    .info-list { display: flex; flex-direction: column; gap: 9px; }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.83rem;
    }

    .info-row-label { color: var(--text-muted); }
    .info-row-value { font-weight: 600; color: var(--text-dark); }

    /* Action buttons */
    .action-btns { display: flex; flex-direction: column; gap: 8px; }

    /* ===== COMMENTS ===== */
    .comments-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-top: 1.25rem;
    }

    .comments-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1.1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1.5px solid var(--border);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .comments-title svg { width: 16px; height: 16px; fill: var(--text-muted); }

    .comment-count {
        font-size: 0.75rem;
        font-weight: 600;
        background: var(--cream-dark);
        color: var(--text-muted);
        padding: 0.15rem 0.55rem;
        border-radius: 999px;
    }

    .comment-item {
        display: flex;
        gap: 10px;
        padding: 0.9rem 0;
        border-bottom: 1px solid var(--cream-dark);
    }

    .comment-item:last-of-type { border-bottom: none; }

    .comment-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--cream-dark);
        color: var(--brown);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.72rem;
        font-weight: 700;
        flex-shrink: 0;
        border: 1.5px solid var(--border);
    }

    .comment-author { font-size: 0.83rem; font-weight: 700; color: var(--text-dark); }
    .comment-date   { font-size: 0.73rem; color: var(--text-light); margin-left: 8px; }
    .comment-text   { font-size: 0.85rem; color: var(--text-mid); margin-top: 3px; line-height: 1.55; }

    .comment-form {
        display: flex;
        gap: 8px;
        margin-top: 1rem;
        align-items: flex-end;
        padding-top: 0.75rem;
        border-top: 1.5px solid var(--border);
    }

    .comment-form .form-control { flex: 1; background: var(--cream); }

    /* Proof images */
    .proof-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }

    .proof-grid img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 9px;
        border: 1.5px solid var(--border);
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <a href="{{ route('items.index') }}">Laporan</a>
    <svg viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
    <span class="breadcrumb-current">{{ Str::limit($item->title, 40) }}</span>
</div>

<div class="detail-layout">

    <!-- MAIN -->
    <div>
        <div class="detail-card">
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="detail-img">
            @else
                <div class="detail-img-placeholder">
                    <svg viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                </div>
            @endif

            <div class="detail-body">
                <div class="detail-tags">
                    <span class="detail-type-badge {{ $item->type === 'hilang' ? 'type-hilang' : 'type-ditemukan' }}">
                        {{ $item->type === 'hilang' ? 'Barang Hilang' : 'Barang Ditemukan' }}
                    </span>
                    <span class="badge status-{{ $item->status }}">
                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                    </span>
                </div>

                <h1 class="detail-title">{{ $item->title }}</h1>

                <div class="detail-meta-grid">
                    <div>
                        <div class="meta-label">
                            <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            Lokasi
                        </div>
                        <div class="meta-value">{{ $item->location }}</div>
                    </div>
                    <div>
                        <div class="meta-label">
                            <svg viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
                            Tanggal Kejadian
                        </div>
                        <div class="meta-value">{{ \Carbon\Carbon::parse($item->date_event)->format('d F Y') }}</div>
                    </div>
                    <div>
                        <div class="meta-label">
                            <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            Dilaporkan oleh
                        </div>
                        <div class="meta-value">{{ $item->user->name }}</div>
                    </div>
                    <div>
                        <div class="meta-label">
                            <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg>
                            Dibuat pada
                        </div>
                        <div class="meta-value">{{ $item->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>

                <div class="detail-desc-label">Deskripsi</div>
                <p class="detail-desc">{{ $item->description }}</p>
            </div>
        </div>

        <!-- COMMENTS -->
        @if(isset($item->comments))
        <div class="comments-card">
            <div class="comments-title">
                <svg viewBox="0 0 24 24"><path d="M21 6.5C21 5.12 19.88 4 18.5 4h-13C4.12 4 3 5.12 3 6.5v8C3 15.88 4.12 17 5.5 17H8l3 3 3-3h4.5c1.38 0 2.5-1.12 2.5-2.5v-8z"/></svg>
                Komentar
                <span class="comment-count">{{ $item->comments->count() }}</span>
            </div>

            @forelse($item->comments as $comment)
            <div class="comment-item">
                <div class="comment-avatar">{{ strtoupper(substr($comment->user->name, 0, 2)) }}</div>
                <div>
                    <span class="comment-author">{{ $comment->user->name }}</span>
                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                    <p class="comment-text">{{ $comment->comment }}</p>
                </div>
            </div>
            @empty
            <p style="font-size:0.85rem; color:var(--text-light); text-align:center; padding:1rem 0;">
                Belum ada komentar.
            </p>
            @endforelse

            @auth
            <form action="{{ route('comments.store', $item->id) }}" method="POST" class="comment-form">
                @csrf
                <input type="text" name="comment" class="form-control" placeholder="Tulis komentar..." maxlength="500" required>
                <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
            </form>
            @else
            <p style="font-size:0.82rem; color:var(--text-light); margin-top:0.75rem;">
                <a href="{{ route('login') }}" style="color:var(--red);">Masuk</a> untuk menulis komentar.
            </p>
            @endauth
        </div>
        @endif
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar-card">
        <!-- Reporter -->
        <div class="sidebar-section">
            <div class="sidebar-section-title">Pelapor</div>
            <div class="reporter-info">
                <div class="reporter-avatar">{{ strtoupper(substr($item->user->name, 0, 2)) }}</div>
                <div>
                    <div class="reporter-name">{{ $item->user->name }}</div>
                    <div class="reporter-role">{{ ucfirst($item->user->role) }}</div>
                </div>
            </div>
        </div>

        <!-- Status update (resepsionis only) -->
        @auth
        @if(auth()->user()->role === 'resepsionis')
        <div class="sidebar-section">
            <div class="sidebar-section-title">Perbarui Status</div>
            <form action="{{ route('resepsionis.updateStatus', $item->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="dilaporkan"         {{ $item->status == 'dilaporkan'         ? 'selected' : '' }}>Dilaporkan</option>
                        <option value="ada_di_resepsionis" {{ $item->status == 'ada_di_resepsionis' ? 'selected' : '' }}>Ada di Resepsionis</option>
                        <option value="sudah_diambil"      {{ $item->status == 'sudah_diambil'      ? 'selected' : '' }}>Sudah Diambil</option>
                        <option value="ditutup"            {{ $item->status == 'ditutup'            ? 'selected' : '' }}>Ditutup</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Simpan Status</button>
            </form>
        </div>
        @endif

        <!-- Owner actions -->
        @if(auth()->id() === $item->user_id)
        <div class="sidebar-section">
            <div class="sidebar-section-title">Kelola Laporan</div>
            <div class="action-btns">
                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-outline" style="justify-content:center;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                    Edit Laporan
                </a>
                <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width:100%; justify-content:center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                        Hapus Laporan
                    </button>
                </form>
            </div>
        </div>
        @endif
        @endauth

        <!-- Proof images -->
        @if(isset($item->proofImages) && $item->proofImages->count() > 0)
        <div class="sidebar-section">
            <div class="sidebar-section-title">Foto Bukti</div>
            <div class="proof-grid">
                @foreach($item->proofImages as $proof)
                    <img src="{{ asset('storage/' . $proof->image) }}" alt="{{ $proof->description ?? 'Bukti' }}">
                @endforeach
            </div>
        </div>
        @endif

        <!-- Quick info -->
        <div class="sidebar-section">
            <div class="sidebar-section-title">Info Singkat</div>
            <div class="info-list">
                <div class="info-row">
                    <span class="info-row-label">Tipe</span>
                    <span class="type-badge {{ $item->type === 'hilang' ? 'type-hilang' : 'type-ditemukan' }}">
                        {{ $item->type === 'hilang' ? 'Hilang' : 'Ditemukan' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-row-label">Status</span>
                    <span class="badge status-{{ $item->status }}">{{ ucfirst(str_replace('_', ' ', $item->status)) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-row-label">Komentar</span>
                    <span class="info-row-value">{{ $item->comments->count() ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection