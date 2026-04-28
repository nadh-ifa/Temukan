@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<style>
    .form-page-wrap { max-width: 720px; margin: 0 auto; }

    .form-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .form-card-header {
        padding: 1.25rem 1.75rem;
        border-bottom: 1px solid var(--gray-100);
        background: var(--gray-50);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-card-header-title  { font-size: 1rem; font-weight: 700; color: var(--gray-800); }
    .form-card-header-sub    { font-size: 0.8rem; color: var(--gray-500); }
    .form-card-body          { padding: 1.75rem; }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }

    .current-img-wrap {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        background: var(--gray-50);
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-100);
        margin-bottom: 0.5rem;
    }

    .current-img-wrap img {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: var(--radius-sm);
    }

    .upload-area {
        border: 2px dashed var(--gray-200);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        position: relative;
        background: var(--gray-50);
    }

    .upload-area:hover {
        border-color: var(--blue-300);
        background: var(--blue-50);
    }

    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .form-submit-row {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--gray-100);
        margin-top: 1.5rem;
    }

    .type-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 0.28rem 0.75rem;
        border-radius: 999px;
        text-transform: uppercase;
    }

    .type-hilang    { background: var(--red-100); color: var(--red-600); }
    .type-ditemukan { background: var(--blue-100); color: var(--blue-800); }
</style>

<div class="form-page-wrap">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem;">
        <div>
            <a href="{{ route('items.show', $item->id) }}"
               style="font-size:0.83rem; color:var(--gray-500); text-decoration:none; display:inline-flex; align-items:center; gap:4px; margin-bottom:0.4rem;">
                ← Kembali ke Detail
            </a>
            <h1 style="font-family:var(--font-serif); font-size:1.5rem; font-weight:600; color:var(--gray-900);">
                ✏️ Edit Laporan
            </h1>
        </div>
        <span class="type-label {{ $item->type === 'hilang' ? 'type-hilang' : 'type-ditemukan' }}">
            {{ $item->type === 'hilang' ? '🔴 Hilang' : '🔵 Ditemukan' }}
        </span>
    </div>

    @if($errors->any())
    <div style="background:var(--red-50); border:1px solid var(--red-100); border-radius:var(--radius-md); padding:1rem 1.25rem; margin-bottom:1.25rem;">
        <p style="font-size:0.875rem; font-weight:700; color:var(--red-600); margin-bottom:0.4rem;">⚠️ Ada beberapa kesalahan:</p>
        <ul style="margin:0; padding-left:1.2rem; font-size:0.83rem; color:var(--red-500);">
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
                <span style="font-size:1.2rem;">📦</span>
                <div>
                    <div class="form-card-header-title">Edit Informasi Barang</div>
                    <div class="form-card-header-sub">Perbarui detail laporan kamu di bawah ini.</div>
                </div>
            </div>

            <div class="form-card-body">
                <div class="form-group">
                    <label for="title" class="form-label">Nama Barang <span class="required">*</span></label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        value="{{ old('title', $item->title) }}"
                        required
                        maxlength="150"
                    >
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi <span class="required">*</span></label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="4"
                        required
                    >{{ old('description', $item->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="location" class="form-label">Lokasi <span class="required">*</span></label>
                        <input
                            type="text"
                            id="location"
                            name="location"
                            class="form-control"
                            value="{{ old('location', $item->location) }}"
                            required
                            maxlength="150"
                        >
                    </div>
                    <div class="form-group">
                        <label for="date_event" class="form-label">Tanggal Kejadian <span class="required">*</span></label>
                        <input
                            type="date"
                            id="date_event"
                            name="date_event"
                            class="form-control"
                            value="{{ old('date_event', $item->date_event) }}"
                            max="{{ date('Y-m-d') }}"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Barang</label>

                    @if($item->image)
                    <div class="current-img-wrap">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Foto saat ini">
                        <div>
                            <p style="font-size:0.83rem; font-weight:600; color:var(--gray-700); margin-bottom:2px;">Foto saat ini</p>
                            <p style="font-size:0.78rem; color:var(--gray-400);">Upload foto baru untuk mengganti</p>
                        </div>
                    </div>
                    @endif

                    <div class="upload-area">
                        <input type="file" name="image" accept="image/*" id="image-input">
                        <div style="font-size:1.8rem; margin-bottom:0.4rem;" id="upload-icon">📷</div>
                        <div style="font-size:0.875rem; font-weight:600; color:var(--gray-600); margin-bottom:0.2rem;">
                            {{ $item->image ? 'Ganti foto' : 'Upload foto' }}
                        </div>
                        <div style="font-size:0.78rem; color:var(--gray-400);">JPG, PNG – Maks. 2MB</div>
                    </div>
                    <img id="image-preview" src="" alt="Preview"
                         style="display:none; max-width:100%; max-height:180px; object-fit:contain; border-radius:var(--radius-md); margin-top:0.75rem;">
                </div>

                <div class="form-submit-row">
                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan ✅</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    const imageInput = document.getElementById('image-input');
    const imagePreview = document.getElementById('image-preview');
    const uploadIcon = document.getElementById('upload-icon');

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    imagePreview.src = ev.target.result;
                    imagePreview.style.display = 'block';
                    uploadIcon.textContent = '✅';
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection