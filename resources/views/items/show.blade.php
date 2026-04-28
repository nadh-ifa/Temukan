@extends('layouts.app')

@section('title', $item->title)

@section('content')
<style>
    .detail-wrap {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 820px) {
        .detail-wrap { grid-template-columns: 1fr; }
    }

    /* ===== BACK LINK ===== */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--gray-500);
        text-decoration: none;
        margin-bottom: 1.25rem;
        transition: color 0.15s;
    }

    .back-link:hover { color: var(--blue-600); }

    /* ===== MAIN DETAIL CARD ===== */
    .detail-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .detail-img {
        width: 100%;
        max-height: 380px;
        object-fit: cover;
    }

    .detail-img-placeholder {
        width: 100%;
        height: 260px;
        background: linear-gradient(135deg, var(--blue-50), var(--cream-100));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 72px;
    }

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
        padding: 0.28rem 0.75rem;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    .type-hilang    { background: var(--red-100);  color: var(--red-600); }
    .type-ditemukan { background: var(--blue-100); color: var(--blue-800); }

    .detail-title {
        font-family: var(--font-serif);
        font-size: 1.6rem;
        font-weight: 600;
        color: var(--gray-900);
        line-height: 1.3;
        margin-bottom: 1.25rem;
    }

    .detail-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem 1.5rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--gray-100);
    }

    .meta-item {}

    .meta-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .meta-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--gray-800);
    }

    .detail-desc-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .detail-desc {
        font-size: 0.92rem;
        color: var(--gray-700);
        line-height: 1.75;
    }

    /* ===== SIDEBAR ===== */
    .sidebar-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }

    .sidebar-section {
        padding: 1.25rem 1.4rem;
        border-bottom: 1px solid var(--gray-100);
    }

    .sidebar-section:last-child { border-bottom: none; }

    .sidebar-section-title {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--gray-400);
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
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--blue-400), var(--blue-600));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .reporter-name { font-size: 0.9rem; font-weight: 600; color: var(--gray-800); }
    .reporter-role { font-size: 0.75rem; color: var(--gray-400); }

    .status-update-form select {
        margin-bottom: 0.75rem;
    }

    /* ===== COMMENTS ===== */
    .comments-section { margin-top: 1.5rem; }

    .comments-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 1rem;
        padding-bottom: 0.6rem;
        border-bottom: 1px solid var(--gray-100);
    }

    .comment-item {
        display: flex;
        gap: 10px;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--gray-50);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn { from { opacity:0; transform: translateY(4px); } to { opacity:1; transform:none; } }

    .comment-item:last-child { border-bottom: none; }

    .comment-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--cream-200);
        color: #7A6010;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .comment-body {}
    .comment-author { font-size: 0.82rem; font-weight: 700; color: var(--gray-800); }
    .comment-date   { font-size: 0.75rem; color: var(--gray-400); margin-left: 6px; }
    .comment-text   { font-size: 0.875rem; color: var(--gray-600); margin-top: 2px; line-height: 1.5; }

    .comment-form {
        display: flex;
        gap: 8px;
        margin-top: 1rem;
        align-items: flex-end;
    }

    .comment-input-wrap { flex: 1; }

    /* Proof images */
    .proof-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        margin-top: 0.5rem;
    }

    .proof-grid img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--gray-100);
        transition: opacity 0.15s;
        cursor: pointer;
    }

    .proof-grid img:hover { opacity: 0.85; }
</style>

<a href="{{ route('items.index') }}" class="back-link">← Kembali ke Semua Laporan</a>

<div class="detail-wrap">

    {{-- MAIN CONTENT --}}
    <div>
        <div class="detail-card">
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="detail-img">
            @else
                <div class="detail-img-placeholder">
                    {{ $item->type === 'hilang' ? '🔴' : '🔵' }}
                </div>
            @endif

            <div class="detail-body">
                <div class="detail-tags">
                    <span class="detail-type-badge {{ $item->type === 'hilang' ? 'type-hilang' : 'type-ditemukan' }}">
                        {{ $item->type === 'hilang' ? '🔴 Barang Hilang' : '🔵 Barang Ditemukan' }}
                    </span>
                    <span class="badge status-{{ $item->status }}">
                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                    </span>
                </div>

                <h1 class="detail-title">{{ $item->title }}</h1>

                <div class="detail-meta-grid">
                    <div class="meta-item">
                        <div class="meta-label">📍 Lokasi</div>
                        <div class="meta-value">{{ $item->location }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">📅 Tanggal Kejadian</div>
                        <div class="meta-value">{{ \Carbon\Carbon::parse($item->date_event)->format('d F Y') }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">👤 Dilaporkan oleh</div>
                        <div class="meta-value">{{ $item->user->name }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">🕐 Dibuat pada</div>
                        <div class="meta-value">{{ $item->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>

                <div class="detail-desc-label">Deskripsi Lengkap</div>
                <p class="detail-desc">{{ $item->description }}</p>
            </div>
        </div>

        {{-- COMMENTS --}}
        @if(isset($item->comments))
        <div class="card comments-section" style="padding: 1.5rem; margin-top: 1.25rem;">
            <div class="comments-title">💬 Komentar ({{ $item->comments->count() }})</div>

            @forelse($item->comments as $comment)
            <div class="comment-item">
                <div class="comment-avatar">
                    {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                </div>
                <div class="comment-body">
                    <span class="comment-author">{{ $comment->user->name }}</span>
                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                    <p class="comment-text">{{ $comment->comment }}</p>
                </div>
            </div>
            @empty
            <p style="font-size:0.875rem; color:var(--gray-400); text-align:center; padding:1rem 0;">
                Belum ada komentar. Jadilah yang pertama! 💬
            </p>
            @endforelse

            @auth
            <form action="{{ route('comments.store', $item->id) }}" method="POST" class="comment-form">
                @csrf
                <div class="comment-input-wrap">
                    <input
                        type="text"
                        name="comment"
                        class="form-control"
                        placeholder="Tulis komentar kamu..."
                        maxlength="500"
                        required
                    >
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
            </form>
            @else
            <p style="font-size:0.82rem; color:var(--gray-400); margin-top:0.75rem;">
                <a href="{{ route('login') }}" style="color:var(--blue-600);">Masuk</a> untuk menulis komentar.
            </p>
            @endauth
        </div>
        @endif
    </div>

    {{-- SIDEBAR --}}
    <div class="sidebar-card">
        {{-- Reporter --}}
        <div class="sidebar-section">
            <div class="sidebar-section-title">Pelapor</div>
            <div class="reporter-info">
                <div class="reporter-avatar">
                    {{ strtoupper(substr($item->user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="reporter-name">{{ $item->user->name }}</div>
                    <div class="reporter-role">{{ ucfirst($item->user->role) }}</div>
                </div>
            </div>
        </div>

        {{-- Status update (resepsionis only) --}}
        @auth
        @if(auth()->user()->role === 'resepsionis')
        <div class="sidebar-section">
            <div class="sidebar-section-title">Update Status</div>
            <form action="{{ route('resepsionis.updateStatus', $item->id) }}" method="POST" class="status-update-form">
                @csrf
                @method('PATCH')
                <select name="status" class="form-control">
                    <option value="dilaporkan"         {{ $item->status == 'dilaporkan'         ? 'selected' : '' }}>Dilaporkan</option>
                    <option value="ada_di_resepsionis" {{ $item->status == 'ada_di_resepsionis' ? 'selected' : '' }}>Ada di Resepsionis</option>
                    <option value="sudah_diambil"      {{ $item->status == 'sudah_diambil'      ? 'selected' : '' }}>Sudah Diambil</option>
                    <option value="ditutup"            {{ $item->status == 'ditutup'            ? 'selected' : '' }}>Ditutup</option>
                </select>
                <button type="submit" class="btn btn-primary" style="width:100%;">Simpan Status</button>
            </form>
        </div>
        @endif

        {{-- Owner actions --}}
        @if(auth()->id() === $item->user_id)
        <div class="sidebar-section">
            <div class="sidebar-section-title">Kelola Laporan</div>
            <div style="display:flex; gap:8px; flex-direction:column;">
                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-outline" style="width:100%; justify-content:center;">✏️ Edit Laporan</a>
                <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width:100%;">🗑 Hapus Laporan</button>
                </form>
            </div>
        </div>
        @endif
        @endauth

        {{-- Proof images --}}
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

        {{-- Quick info --}}
        <div class="sidebar-section">
            <div class="sidebar-section-title">Info Cepat</div>
            <div style="display:flex; flex-direction:column; gap:8px;">
                <div style="display:flex; justify-content:space-between; font-size:0.83rem;">
                    <span style="color:var(--gray-500);">Tipe</span>
                    <span style="font-weight:600; color:var(--gray-800);">
                        {{ $item->type === 'hilang' ? '🔴 Hilang' : '🔵 Ditemukan' }}
                    </span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:0.83rem;">
                    <span style="color:var(--gray-500);">Status</span>
                    <span class="badge status-{{ $item->status }}">
                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                    </span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:0.83rem;">
                    <span style="color:var(--gray-500);">Komentar</span>
                    <span style="font-weight:600; color:var(--gray-800);">{{ $item->comments->count() ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection