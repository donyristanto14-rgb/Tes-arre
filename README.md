# Product Management System

Aplikasi web berbasis Laravel untuk mencatat dan mengelola data produk.

Dibuat untuk **Tes Magang ARRE Tech**.

## Fitur

- **Autentikasi:** registrasi, login, dan logout.
- **Manajemen produk:** daftar, tambah, detail, edit, dan hapus produk.
- **Validasi:** pemeriksaan data produk sebelum disimpan.
- **Keamanan:** halaman produk hanya dapat diakses setelah login; kata sandi disimpan menggunakan hashing.
- **Tampilan:** antarmuka sederhana dan responsif dengan Bootstrap 5.

## Teknologi

| Teknologi | Penggunaan |
|---|---|
| PHP | Bahasa pemrograman |
| Laravel | Kerangka kerja aplikasi |
| SQLite | Basis data |
| Bootstrap 5 | Tampilan antarmuka |
| Laravel Breeze | Autentikasi |

## Cara Menggunakan

1. Daftarkan akun melalui halaman **Register**, lalu login.
2. Setelah login, aplikasi akan membuka halaman daftar produk.
3. Gunakan **Tambah Produk** untuk memasukkan produk baru.
4. Pilih **Detail** untuk melihat informasi produk.
5. Pilih **Edit** untuk memperbarui data produk.
6. Pilih **Hapus** untuk menghapus produk.
7. Pilih **Logout** untuk keluar dari aplikasi.

## Struktur Proyek

| File atau folder | Fungsi |
|---|---|
| `app/Models/Product.php` | Model untuk data produk |
| `app/Http/Controllers/ProductController.php` | Mengelola proses CRUD produk |
| `database/migrations/` | Mendefinisikan struktur basis data |
| `database/seeders/` | Menyediakan data awal produk |
| `resources/views/products/` | Tampilan daftar, tambah, detail, dan edit produk |
| `resources/views/auth/` | Tampilan autentikasi |
| `resources/views/layouts/` | Layout aplikasi |
| `routes/web.php` | Route aplikasi |
| `routes/auth.php` | Route autentikasi |

## Struktur Database

### Tabel `produk`

| Kolom | Keterangan |
|---|---|
| `id` | Identitas unik produk |
| `nama_produk` | Nama produk |
| `kategori` | Kategori produk |
| `harga` | Harga produk |
| `stok` | Jumlah stok produk |
| `deskripsi` | Deskripsi produk; boleh dikosongkan |
| `created_at` | Waktu data dibuat |
| `updated_at` | Waktu terakhir data diperbarui |

### Tabel `users`

| Kolom | Keterangan |
|---|---|
| `id` | Identitas unik pengguna |
| `name` | Nama pengguna |
| `email` | Alamat email pengguna |
| `password` | Kata sandi yang disimpan dalam bentuk hash |
| `created_at` | Waktu akun dibuat |
| `updated_at` | Waktu terakhir akun diperbarui |

## Pembuat

**Dony Dwi Ristanto** · [donyristanto14@gmail.com]
