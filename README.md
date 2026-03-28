# 📦 Lost-Found 

## 📌 Deskripsi Proyek
Lost-Found adalah sistem berbasis web yang dirancang khusus untuk lingkungan Fakultas Ilmu Komputer guna membantu mahasiswa, dosen, dan staf dalam melaporkan, mencari, serta mengelola barang yang hilang maupun ditemukan.

Sistem ini membuat proses pencarian dan pengembalian barang menjadi lebih tertata, terdokumentasi, dan mudah dipantau.

Pengguna dapat membuat laporan dengan informasi lengkap seperti nama barang, deskripsi, lokasi kejadian di area fakultas, waktu, serta foto barang. Sementara itu, resepsionis fakultas berperan dalam memvalidasi dan memperbarui status barang.

---

## 👥 Anggota Kelompok
1. 245150700111038 – Adelia Swastika Dewi  
2. 245150700111039 – Devi Atika Putri  
3. NIM - Nama  

---

## 🎯 Fitur

### ✅ Fitur Wajib
- Autentifikasi (Login dan Register)
- Membuat laporan barang hilang
- Membuat laporan barang ditemukan
- Melihat daftar laporan
- Melihat detail laporan
- Validasi status barang oleh resepsionis

### ✨ Fitur Opsional
- Komentar pada laporan
- Upload bukti penyerahan ke resepsionis
- Filter laporan

---

## 👤 Role & Hak Akses

| Role         | Hak Akses |
|--------------|----------|
| User         | Login, membuat laporan, melihat dan mencari laporan, melihat detail barang, upload foto |
| Resepsionis  | Login, mengelola laporan, validasi barang, update status barang |

---

## 🔄 Alur Sistem

### 🟢 Alur 1: Penemuan Barang
1. Pengguna menemukan barang di lingkungan Fakultas Ilmu Komputer  
2. Login ke sistem Lost-Found  
3. Membuat laporan barang ditemukan  
4. Mengisi informasi:
   - Nama barang  
   - Deskripsi  
   - Lokasi ditemukan  
   - Tanggal ditemukan  
   - Foto barang  
5. Sistem menyimpan laporan dengan status **dilaporkan**  
6. Barang diserahkan ke resepsionis  
7. Resepsionis login  
8. Status diubah menjadi **ada di resepsionis**  
9. Pengguna lain dapat melihat laporan  
10. (Opsional) Memberikan komentar  
11. Status diubah menjadi **sudah diambil** setelah barang dikembalikan  

---

### 🔵 Alur 2: Pencarian Barang
1. Pengguna kehilangan barang  
2. Login ke sistem  
3. Membuat laporan barang hilang  
4. Mengisi:
   - Nama barang  
   - Deskripsi  
   - Lokasi terakhir  
   - Tanggal kehilangan  
   - Foto (opsional)  
5. Sistem menyimpan laporan  
6. Laporan dapat dilihat pengguna lain  
7. Pengguna lain dapat membantu melalui komentar / kontak  
8. Status diubah menjadi **ditutup** jika selesai  

---

## 🗂️ Desain Database

### 1. Tabel `users`
Menyimpan data pengguna dan resepsionis

- id (BIGINT, PK, Auto Increment)  
- name (VARCHAR 100, wajib)  
- email (VARCHAR 100, unik, wajib)  
- password (VARCHAR 255, wajib)  
- role (ENUM: user, resepsionis)  
- created_at (TIMESTAMP)  
- updated_at (TIMESTAMP)  

---

### 2. Tabel `items`
Menyimpan laporan barang

- id (BIGINT, PK, Auto Increment)  
- user_id (BIGINT, FK)  
- title (VARCHAR 150)  
- description (TEXT)  
- type (ENUM: hilang, ditemukan)  
- location (VARCHAR 150)  
- date_event (DATE)  
- image (VARCHAR 255, opsional)  
- status (ENUM: dilaporkan, ada_di_resepsionis, sudah_diambil, ditutup)  
- created_at (TIMESTAMP)  
- updated_at (TIMESTAMP)  

---

### 3. Tabel `comments` (Opsional)
Menyimpan komentar pada laporan

- id (BIGINT, PK, Auto Increment)  
- item_id (BIGINT, FK)  
- user_id (BIGINT, FK)  
- comment (VARCHAR 500)  
- created_at (TIMESTAMP)  
- updated_at (TIMESTAMP)  

---

### 4. Tabel `proof_images` (Opsional)
Menyimpan bukti foto tambahan

- id (BIGINT, PK, Auto Increment)  
- item_id (BIGINT, FK)  
- image (VARCHAR 255)  
- description (VARCHAR 150, opsional)  
- created_at (TIMESTAMP)  
- updated_at (TIMESTAMP)  
