@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
<style>
    .create-wrap { max-width: 700px; margin: 0 auto; }

    /* Type picker */
    .type-picker {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.85rem;
        margin-bottom: 1.75rem;
    }

    @media (max-width: 500px) { .type-picker { grid-template-columns: 1fr; } }

    .type-option {
        border: 2px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1.25rem;
        cursor: pointer;
        transition: border-color 0.18s, background 0.18s, transform 0.15s;
        background: var(--white);
        text-align: center;
        user-select: none;
    }

    .type-option:hover { transform: translateY(-2px); }

    .type-option.selected-hilang    { border-color: var(--red); background: var(--red-pale); }
    .type-option.selected-ditemukan { border-color: var(--blue); background: var(--blue-pale); }

    .type-option-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
    }

    .type-option-icon svg { width: 22px; height: 22px; }
    .type-option-icon.red  { background: var(--red-pale); }
    .type-option-icon.red  svg { fill: var(--red); }
    .type-option-icon.blue { background: var(--blue-pale); }
    .type-option-icon.blue svg { fill: var(--blue); }

    .selected-hilang    .type-option-icon.red  { background: var(--red); }
    .selected-hilang    .type-option-icon.red  svg { fill: var(--white); }
    .selected-ditemukan .type-option-icon.blue { background: var(--blue); }
    .selected-ditemukan .type-option-icon.blue svg { fill: var(--white); }

    .type-option-title { font-size: 0.9rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.25rem; }
    .type-option-desc  { font-size: 0.78rem; color: var(--text-muted); line-height: 1.4; }

    /* Form card */
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
        background: var(--red);
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

    /* Upload area */
    .upload-area {
        border: 2px dashed var(--border);
        border-radius: var(--radius-sm);
        padding: 1.75rem;
        text-align: center;
        cursor: pointer;
        position: relative;
        background: var(--cream);
        transition: border-color 0.18s, background 0.18s;
    }

    .upload-area:hover { border-color: var(--red); background: var(--red-pale); }

    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-area-icon {
        width: 42px;
        height: 42px;
        background: var(--border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.65rem;
    }

    .upload-area-icon svg { width: 20px; height: 20px; fill: var(--text-muted); }

    .upload-area-text { font-size: 0.85rem; font-weight: 600; color: var(--text-mid); margin-bottom: 3px; }
    .upload-area-sub  { font-size: 0.75rem; color: var(--text-light); }

    #image-preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: var(--radius-sm);
        object-fit: contain;
        display: none;
        margin-top: 1rem;
        border: 1.5px solid var(--border);
    }

    /* Form footer */
    .form-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1.25rem;
        border-top: 1.5px solid var(--border);
        margin-top: 1.5rem;
    }

    /* Error box */
    .error-box {
        background: var(--red-pale);
        border: 1.5px solid var(--red-border);
        border-radius: var(--radius-sm);
        padding: 0.9rem 1.1rem;
        margin-bottom: 1.25rem;
    }

    .error-box-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--red);
        margin-bottom: 0.4rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .error-box-title svg { width: 15px; height: 15px; fill: var(--red); }

    .error-box ul { margin: 0; padding-left: 1.2rem; font-size: 0.82rem; color: var(--red); }
</style>

<div class="create-wrap">
    <div class="page-heading">
        <h1>Buat Laporan Baru</h1>
        <p>Lengkapi informasi barang agar mudah dikenali dan ditemukan.</p>
    </div>

    @if($errors->any())
    <div class="error-box">
        <div class="error-box-title">
            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            Ada beberapa kesalahan
        </div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Type Picker -->
    <div class="type-picker">
        <div class="type-option {{ old('type', request('type')) == 'hilang' ? 'selected-hilang' : '' }}"
             id="opt-hilang" onclick="selectType('hilang')">
            <div class="type-option-icon red">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
            </div>
            <div class="type-option-title">Saya Kehilangan Barang</div>
            <div class="type-option-desc">Laporkan agar orang lain dapat membantu.</div>
        </div>
        <div class="type-option {{ old('type', request('type')) == 'ditemukan' ? 'selected-ditemukan' : '' }}"
             id="opt-ditemukan" onclick="selectType('ditemukan')">
            <div class="type-option-icon blue">
                <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
            </div>
            <div class="type-option-title">Saya Menemukan Barang</div>
            <div class="type-option-desc">Laporkan agar pemiliknya bisa mengambil.</div>
        </div>
    </div>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" id="type-input" value="{{ old('type', request('type', 'hilang')) }}">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 6h-2.18c.07-.44.18-.88.18-1.36C18 2.09 15.96 0 13.5 0c-1.23 0-2.36.5-3.16 1.32L9 2.67 7.66 1.32C6.86.5 5.73 0 4.5 0 2.04 0 0 2.09 0 4.64c0 .48.11.92.18 1.36H0c-1.1 0-2 .9-2 2v4c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-5-.18c-.02.06-.02.12-.06.18h-3.16l3.14-3.14c.24-.24.54-.36.84-.36.69 0 1.24.56 1.24 1.25 0 .09-.01.19-.02.28L15 5.82zM4.5 2C5.19 2 5.72 2.56 5.72 3.25c0 .09-.01.19-.02.28L5.68 3.6l-.06.22H2.46C2.2 3.42 2 3.05 2 2.64 2 2.28 2.31 2 4.5 2zM20 14H4v6h16v-6z"/></svg>
                </div>
                <div>
                    <div class="form-card-header-title">Informasi Barang</div>
                    <div class="form-card-header-sub">Isi semua kolom bertanda (*)</div>
                </div>
            </div>

            <div class="form-card-body">
                <div class="form-group">
                    <label for="title" class="form-label">Nama Barang <span class="required">*</span></label>
                    <input type="text" id="title" name="title" class="form-control"
                           placeholder="Contoh: Dompet hitam, Kunci motor Honda"
                           value="{{ old('title') }}" required maxlength="150">
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi <span class="required">*</span></label>
                    <textarea id="description" name="description" class="form-control" rows="4"
                              placeholder="Jelaskan ciri-ciri, warna, merek, isi barang, dll." required>{{ old('description') }}</textarea>
                    <span class="form-hint">Semakin detail semakin mudah dikenali.</span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="location" class="form-label">Lokasi <span class="required">*</span></label>
                        <input type="text" id="location" name="location" class="form-control"
                               placeholder="Contoh: Gedung F, Kantin FILKOM"
                               value="{{ old('location') }}" required maxlength="150">
                    </div>
                    <div class="form-group">
                        <label for="date_event" class="form-label" id="date-label">
                            Tanggal {{ request('type') == 'ditemukan' ? 'Ditemukan' : 'Hilang' }} <span class="required">*</span>
                        </label>
                        <input type="date" id="date_event" name="date_event" class="form-control"
                               value="{{ old('date_event', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Foto Barang
                        <span style="font-weight:400; color:var(--text-light);">(opsional)</span>
                    </label>
                    <div class="upload-area" id="upload-area">
                        <input type="file" name="image" id="image-input" accept="image/*">
                        <div class="upload-area-icon" id="upload-icon-wrap">
                            <svg viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                        </div>
                        <div class="upload-area-text">Klik atau seret foto ke sini</div>
                        <div class="upload-area-sub">JPG, PNG — Maks. 2MB</div>
                    </div>
                    <img id="image-preview" src="" alt="Preview">
                </div>

                <div class="form-footer">
                    <a href="{{ route('items.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary btn-lg">Kirim Laporan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function selectType(type) {
    document.getElementById('type-input').value = type;

    const optH = document.getElementById('opt-hilang');
    const optD = document.getElementById('opt-ditemukan');

    optH.className = 'type-option' + (type === 'hilang' ? ' selected-hilang' : '');
    optD.className = 'type-option' + (type === 'ditemukan' ? ' selected-ditemukan' : '');

    const dateLabel = document.getElementById('date-label');
    if (dateLabel) {
        dateLabel.innerHTML = (type === 'ditemukan' ? 'Tanggal Ditemukan' : 'Tanggal Hilang')
            + ' <span class="required">*</span>';
    }
}

// Image preview
const imageInput   = document.getElementById('image-input');
const imagePreview = document.getElementById('image-preview');
const uploadArea   = document.getElementById('upload-area');

if (imageInput) {
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                imagePreview.src = ev.target.result;
                imagePreview.style.display = 'block';
                document.getElementById('upload-icon-wrap').querySelector('svg').style.fill = '#2E7D32';
            };
            reader.readAsDataURL(file);
        }
    });
}

// Init from URL param
const urlType = new URLSearchParams(window.location.search).get('type');
if (urlType) selectType(urlType);
</script>
@endsection