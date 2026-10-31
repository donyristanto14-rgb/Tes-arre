Product Management System

Aplikasi web sederhana untuk mengelola data produk berbasis Laravel. Proyek ini dibuat untuk memenuhi tugas seleksi magang ARRE Tech.

Fitur

- Registrasi akun pengguna.
- Login dan logout menggunakan Laravel Breeze.
- Menampilkan daftar produk.
- Menambahkan produk baru.
- Melihat detail produk.
- Mengedit data produk.
- Menghapus data produk.
- Validasi input produk.
- Proteksi halaman manajemen produk menggunakan autentikasi.
- Tampilan responsif dengan desain sederhana dan modern.

Teknologi

- PHP
- Laravel
- Laravel Breeze
- Blade
- Bootstrap 5
- SQLite
- Git

Cara Instalasi

1. Clone repository:

git clone URL_REPOSITORY

2. Masuk ke direktori proyek:

cd CrudArre

3. Install dependency:

composer install
npm install

4. Buat file konfigurasi:

cp .env.example .env
php artisan key:generate

5. Konfigurasikan database SQLite pada file ".env":

DB_CONNECTION=sqlite

Pastikan file "database/database.sqlite" tersedia.

6. Jalankan migration:

php artisan migrate

7. Build frontend:

npm run build

8. Jalankan aplikasi:

php artisan serve

Cara Menggunakan

1. Buka aplikasi melalui browser.
2. Pilih Register untuk membuat akun baru.
3. Login menggunakan email dan password yang telah didaftarkan.
4. Setelah login, pengguna dapat mengakses halaman manajemen produk.
5. Pilih Tambah Produk untuk memasukkan data produk.
6. Pilih Detail untuk melihat informasi produk.
7. Pilih Edit untuk memperbarui data produk.
8. Pilih Hapus untuk menghapus produk.
9. Gunakan tombol Logout untuk keluar dari aplikasi.

Struktur Database

1. Tabel Produk ("produk")

Digunakan untuk menyimpan informasi produk.

Kolom| Keterangan
"id"| Identitas unik produk
"nama_produk"| Nama produk
"kategori"| Kategori produk
"harga"| Harga produk
"stok"| Jumlah persediaan produk
"deskripsi"| Keterangan produk
"created_at"| Waktu data dibuat
"updated_at"| Waktu terakhir data diperbarui

2. Tabel Pengguna ("users")

Digunakan untuk menyimpan informasi akun pengguna.

Kolom| Keterangan
"id"| Identitas unik pengguna
"name"| Nama pengguna
"email"| Alamat email pengguna
"password"| Kata sandi yang disimpan menggunakan hashing
"created_at"| Waktu akun dibuat
"updated_at"| Waktu terakhir akun diperbarui

Struktur Proyek

File / Folder| Fungsi
"app/Models/Product.php"| Model data produk
"app/Http/Controllers/ProductController.php"| Mengatur proses CRUD produk
"database/migrations/"| Mengatur struktur tabel database
"database/seeders/"| Menyediakan data awal produk jika tersedia
"resources/views/products/"| Menyimpan halaman manajemen produk
"resources/views/auth/"| Menyimpan halaman autentikasi
"resources/views/layouts/"| Menyimpan layout utama aplikasi
"routes/web.php"| Mengatur route aplikasi
"routes/auth.php"| Mengatur route autentikasi Breeze
"README.md"| Dokumentasi proyek

Pembuat

Dony Dwi Ristanto (donyristanto14@gmail.com)

Project: Product Management System
Keperluan: Tes Magang ARRE Tech