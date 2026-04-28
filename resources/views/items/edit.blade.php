@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<style>
    .edit-wrap { max-width: 700px; margin: 0 auto; }

    .form-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    .form-card-header {
        padding: 1.1rem 1.5rem;
        border-bottom: 1.5px solid var(--border);
        background: var(--cream);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-card-header-icon {
        width: 34px;
        height: 34px;
        background: var(--blue);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .form-card-header-icon svg { width: 16px; height: 16px; fill: var(--white); }

    .form-card-header-title { font-size: 0.95rem; font-weight: 700; color: var(--text-dark); }
    .form-card-header-sub   { font-size: 0.78rem; color: var(--text-muted); }

    .form-card-body { padding: 1.5rem; }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 500px) { .form-row { grid-template-columns: 1fr; } }

    /* Current image preview */
    .current-img-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        background: var(--cream);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-xs);
        margin-bottom: 0.75rem;
    }

    .current-img-row img {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }

    .current-img-info p:first-child { font-size: 0.82rem; font-weight: 600; color: var(--text-mid); }
    .current-img-info p:last-child  { font-size: 0.75rem; color: var(--text-light); margin-top: 2px; }

    /* Upload area */
    .upload-area {
        border: 2px dashed var(--border);
        border-radius: var(--radius-sm);
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        position: relative;
        background: var(--cream);
        transition: border-color 0.18s, background 0.18s;
    }

    .upload-area:hover { border-color: var(--blue); background: var(--blue-pale); }

    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-area-icon {
        width: 38px;
        height: 38px;
        background: var(--border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
    }

    .upload-area-icon svg { width: 18px; height: 18px; fill: var(--text-muted); }
    .upload-area-text { font-size: 0.83rem; font-weight: 600; color: var(--text-mid); }
    .upload-area-sub  { font-size: 0.74rem; color: var(--text-light); margin-top: 2px; }

    #image-preview {
        max-width: 100%;
        max-height: 180px;
        border-radius: var(--radius-xs);
        object-fit: contain;
        display: none;
        margin-top: 0.75rem;
        border: 1.5px solid var(--border);
    }

    .form-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1.25rem;
        border-top: 1.5px solid var(--border);
        margin-top: 1.5rem;
    }

    .type-chip {
        display: inline-flex;
        align-items: center;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.28rem 0.75rem;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .chip-hilang    { background: var(--red-pale); color: var(--red); border: 1px solid var(--red-border); }
    .chip-ditemukan { background: var(--blue-pale); color: var(--blue); border: 1px solid var(--blue-border); }

    .error-box {
        background: var(--red-pale);
        border: 1.5px solid var(--red-border);
        border-radius: var(--radius-sm);
        padding: 0.9rem 1.1rem;
        margin-bottom: 1.25rem;
    }

    .error-box-title { font-size: 0.85rem; font-weight: 700; color: var(--red); margin-bottom: 0.35rem; }
    .error-box ul { margin: 0; padding-left: 1.2rem; font-size: 0.82rem; color: var(--red); }
</style>

<div class="edit-wrap">
    <!-- Back + heading -->
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('items.show', $item->id) }}"
           style="display:inline-flex; align-items:center; gap:5px; font-size:0.82rem; color:var(--text-muted); text-decoration:none; margin-bottom:0.5rem; transition:color 0.15s;"
           onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--text-muted)'">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
            Kembali ke Detail
        </a>
        <div style="display:flex; align-items:center; gap:10px;">
            <h1 style="font-size:1.5rem; font-weight:800; color:var(--text-dark); letter-spacing:-0.3px;">Edit Laporan</h1>
            <span class="type-chip {{ $item->type === 'hilang' ? 'chip-hilang' : 'chip-ditemukan' }}">
                {{ $item->type === 'hilang' ? 'Hilang' : 'Ditemukan' }}
            </span>
        </div>
    </div>

    @if($errors->any())
    <div class="error-box">
        <div class="error-box-title">Ada beberapa kesalahan</div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon">
                    <svg viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                </div>
                <div>
                    <div class="form-card-header-title">Edit Informasi Barang</div>
                    <div class="form-card-header-sub">Perbarui detail laporan di bawah ini.</div>
                </div>
            </div>

            <div class="form-card-body">
                <div class="form-group">
                    <label for="title" class="form-label">Nama Barang <span class="required">*</span></label>
                    <input type="text" id="title" name="title" class="form-control"
                           value="{{ old('title', $item->title) }}" required maxlength="150">
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi <span class="required">*</span></label>
                    <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $item->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="location" class="form-label">Lokasi <span class="required">*</span></label>
                        <input type="text" id="location" name="location" class="form-control"
                               value="{{ old('location', $item->location) }}" required maxlength="150">
                    </div>
                    <div class="form-group">
                        <label for="date_event" class="form-label">Tanggal Kejadian <span class="required">*</span></label>
                        <input type="date" id="date_event" name="date_event" class="form-control"
                               value="{{ old('date_event', $item->date_event) }}" max="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Barang</label>

                    @if($item->image)
                    <div class="current-img-row">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Foto saat ini">
                        <div class="current-img-info">
                            <p>Foto saat ini</p>
                            <p>Upload foto baru untuk mengganti</p>
                        </div>
                    </div>
                    @endif

                    <div class="upload-area">
                        <input type="file" name="image" id="image-input" accept="image/*">
                        <div class="upload-area-icon">
                            <svg viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                        </div>
                        <div class="upload-area-text">{{ $item->image ? 'Ganti foto' : 'Upload foto' }}</div>
                        <div class="upload-area-sub">JPG, PNG — Maks. 2MB</div>
                    </div>
                    <img id="image-preview" src="" alt="Preview">
                </div>

                <div class="form-footer">
                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
const imageInput   = document.getElementById('image-input');
const imagePreview = document.getElementById('image-preview');

if (imageInput) {
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                imagePreview.src = ev.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
}
</script>
@endsection