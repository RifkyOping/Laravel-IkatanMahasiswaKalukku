# Website Ikatan Mahasiswa Kalukku (IMK)

Website resmi Ikatan Mahasiswa Kalukku (IMK) Kabupaten Majene. 
Platform ini merupakan pusat informasi, publikasi kegiatan, serta pengelolaan administrasi dan pendaftaran bagi organisasi IMK.

## 🚀 Fitur Utama

* **Halaman Publik Dinamis:** Menampilkan informasi umum, berita terbaru, struktur organisasi lengkap, galeri kegiatan (terintegrasi link Drive dokumentasi), dan repositori lampiran.
* **Dashboard Admin (CMS):** 
  * Kelola Berita & Galeri
  * Kelola Lampiran Dokumen (dengan fitur visibilitas / *hide-show*)
  * Kelola Data Pengurus & Struktur Organisasi
  * Kelola Data Pendaftar (Penerimaan Anggota Baru)
  * Kelola Akun Admin
  * Pengaturan Beranda (Edit teks periode, kontak, tautan media sosial, serta nama dan *crop* foto pengurus inti)
* **Pendaftaran Anggota Baru:** Formulir *online* modern dengan antarmuka dinamis untuk mempermudah rekrutmen mahasiswa Kalukku.

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel 11.x (PHP >= 8.2)
* **Frontend:** TailwindCSS, Alpine.js, Laravel Blade
* **Database:** MySQL / MariaDB
* **Ekstensi Tambahan:** Cropper.js (Pemotongan foto), SweetAlert2 (Notifikasi elegan), AOS (Animasi *scroll*)

## 💻 Panduan Instalasi (Lokal)

Pastikan Anda telah menginstal PHP, Composer, Node.js, dan database server (XAMPP/Laragon) di komputer Anda.

1. **Clone Repositori & Masuk ke Direktori**
   ```bash
   git clone <link-repositori-anda>
   cd Ikatan-Mahasiswa-Kalukku
   ```

2. **Instal Dependensi Backend (PHP)**
   ```bash
   composer install
   ```

3. **Instal Dependensi Frontend (Node.js)**
   ```bash
   npm install
   npm run build
   ```

4. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env`.
   ```bash
   cp .env.example .env
   ```
   Sesuaikan baris koneksi database pada file `.env` dengan kredensial database lokal Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database**
   ```bash
   php artisan migrate
   ```

7. **Hubungkan Folder Storage (Sangat Penting)**
   Perintah ini wajib dijalankan agar file foto, dokumen, dan media yang diunggah dari Dashboard Admin bisa ditampilkan di website.
   ```bash
   php artisan storage:link
   ```

8. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Aplikasi sekarang dapat diakses melalui browser di alamat: `http://localhost:8000`.

## 🔐 Akses Admin (Dashboard)

Untuk mengakses halaman Admin, Anda perlu login di rute `/login`. Jika aplikasi belum memiliki akun admin sama sekali, silakan daftarkan satu akun melalui rute pendaftaran bawaan Laravel (jika aktif) atau tambahkan secara manual melalui database.

## 📄 Lisensi

Hak cipta (C) Website ini dirancang dan dikembangkan secara khusus untuk kebutuhan organisasi **Ikatan Mahasiswa Kalukku (IMK)**.
