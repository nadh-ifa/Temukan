@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
<style>
    .form-page-wrap {
        max-width: 720px;
        margin: 0 auto;
    }

    /* Type picker tabs */
    .type-picker {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .type-card {
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s, transform 0.15s;
        background: white;
    }

    .type-card:hover {
        transform: translateY(-2px);
    }

    .type-card.selected-hilang {
        border-color: var(--red-400);
        background: var(--red-50);
    }

    .type-card.selected-ditemukan {
        border-color: var(--blue-400);
        background: var(--blue-50);
    }

    .type-card-icon { font-size: 2rem; margin-bottom: 0.5rem; }

    .type-card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.25rem;
    }

    .type-card-desc {
        font-size: 0.8rem;
        color: var(--gray-500);
        line-height: 1.4;
    }

    /* Form card */
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

    .form-card-header-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-800);
    }

    .form-card-header-sub {
        font-size: 0.8rem;
        color: var(--gray-500);
    }

    .form-card-body {
        padding: 1.75rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 600px) {
        .form-row { grid-template-columns: 1fr; }
        .type-picker { grid-template-columns: 1fr; }
    }

    /* Image upload area */
    .upload-area {
        border: 2px dashed var(--gray-200);
        border-radius: var(--radius-md);
        padding: 2rem;
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

    .upload-icon { font-size: 2rem; margin-bottom: 0.5rem; }

    .upload-text {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gray-600);
        margin-bottom: 0.25rem;
    }

    .upload-sub {
        font-size: 0.78rem;
        color: var(--gray-400);
    }

    #image-preview {
        max-width: 100%;
        max-height: 220px;
        border-radius: var(--radius-md);
        object-fit: contain;
        display: none;
        margin-top: 1rem;
    }

    /* Submit area */
    .form-submit-row {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--gray-100);
        margin-top: 1.5rem;
    }
</style>

<div class="form-page-wrap">

    <div class="page-heading">
        <h1>📝 Buat Laporan Baru</h1>
        <p>Isi informasi lengkap agar barang mudah ditemukan atau diidentifikasi.</p>
    </div>

    {{-- VALIDATION ERRORS --}}
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

    {{-- TYPE PICKER --}}
    <div class="type-picker">
        <div class="type-card {{ old('type', request('type')) == 'hilang' ? 'selected-hilang' : '' }}"
             onclick="selectType('hilang')" id="card-hilang">
            <div class="type-card-icon">🔴</div>
            <div class="type-card-title">Saya Kehilangan Barang</div>
            <div class="type-card-desc">Laporkan barang yang hilang agar orang lain bisa membantu.</div>
        </div>
        <div class="type-card {{ old('type', request('type')) == 'ditemukan' ? 'selected-ditemukan' : '' }}"
             onclick="selectType('ditemukan')" id="card-ditemukan">
            <div class="type-card-icon">🔵</div>
            <div class="type-card-title">Saya Menemukan Barang</div>
            <div class="type-card-desc">Laporkan barang yang kamu temukan agar pemiliknya bisa mengambil.</div>
        </div>
    </div>

    {{-- FORM --}}
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" id="type-input" value="{{ old('type', request('type', 'hilang')) }}">

        <div class="form-card">
            <div class="form-card-header">
                <span style="font-size:1.2rem;">📦</span>
                <div>
                    <div class="form-card-header-title">Informasi Barang</div>
                    <div class="form-card-header-sub">Isi semua kolom yang bertanda bintang (*)</div>
                </div>
            </div>

            <div class="form-card-body">
                {{-- Nama barang --}}
                <div class="form-group">
                    <label for="title" class="form-label">Nama Barang <span class="required">*</span></label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        placeholder="Contoh: Dompet hitam, Kunci motor Honda"
                        value="{{ old('title') }}"
                        required
                        maxlength="150"
                    >
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi <span class="required">*</span></label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Jelaskan detail barang, ciri-ciri khusus, isi, warna, merek, dll."
                        required
                    >{{ old('description') }}</textarea>
                    <span class="form-hint">Semakin detail semakin baik!</span>
                </div>

                <div class="form-row">
                    {{-- Lokasi --}}
                    <div class="form-group">
                        <label for="location" class="form-label">Lokasi <span class="required">*</span></label>
                        <input
                            type="text"
                            id="location"
                            name="location"
                            class="form-control"
                            placeholder="Contoh: Gedung F, Kantin FIK"
                            value="{{ old('location') }}"
                            required
                            maxlength="150"
                        >
                    </div>

                    {{-- Tanggal --}}
                    <div class="form-group">
                        <label for="date_event" class="form-label">
                            Tanggal {{ request('type') == 'ditemukan' ? 'Ditemukan' : 'Hilang' }} <span class="required">*</span>
                        </label>
                        <input
                            type="date"
                            id="date_event"
                            name="date_event"
                            class="form-control"
                            value="{{ old('date_event', date('Y-m-d')) }}"
                            max="{{ date('Y-m-d') }}"
                            required
                        >
                    </div>
                </div>

                {{-- Upload foto --}}
                <div class="form-group">
                    <label class="form-label">Foto Barang <span style="font-weight:400; color:var(--gray-400);">(opsional)</span></label>
                    <div class="upload-area" id="upload-area">
                        <input type="file" name="image" id="image-input" accept="image/*">
                        <div class="upload-icon" id="upload-icon">📷</div>
                        <div class="upload-text">Klik atau seret foto ke sini</div>
                        <div class="upload-sub">JPG, PNG, GIF – Maks. 2MB</div>
                    </div>
                    <img id="image-preview" src="" alt="Preview">
                    <span class="form-hint">Upload foto agar laporan lebih mudah dikenali.</span>
                </div>

                <div class="form-submit-row">
                    <a href="{{ route('items.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary btn-lg">Kirim Laporan 🚀</button>
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    function selectType(type) {
        document.getElementById('type-input').value = type;

        const cardH = document.getElementById('card-hilang');
        const cardD = document.getElementById('card-ditemukan');

        cardH.className = 'type-card' + (type === 'hilang' ? ' selected-hilang' : '');
        cardD.className = 'type-card' + (type === 'ditemukan' ? ' selected-ditemukan' : '');

        const label = document.querySelector('label[for="date_event"]');
        if (label) {
            label.innerHTML = (type === 'ditemukan' ? 'Tanggal Ditemukan' : 'Tanggal Hilang') + ' <span class="required">*</span>';
        }
    }

    // Image preview
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

    // Init type from URL
    const urlType = new URLSearchParams(window.location.search).get('type');
    if (urlType) selectType(urlType);
</script>
@endsection