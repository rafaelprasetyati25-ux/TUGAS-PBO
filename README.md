# Pustaka — Manajemen Koleksi Buku

Aplikasi Laravel untuk mencatat koleksi dan stok buku perpustakaan sebagai data pendukung layanan peminjaman. Aplikasi mengikuti alur **Route → Controller → Blade** dan menyimpan data koleksi pada session, tanpa memerlukan database.

## Fitur

- Menampilkan daftar buku beserta kode, nama, kategori, lokasi, jumlah, kondisi, dan aksi.
- Menambah, melihat detail, mengubah, dan menghapus data buku.
- Membuat kode buku secara otomatis.
- Memvalidasi input dan menampilkan pesan status serta kesalahan form.
- Meminta konfirmasi sebelum menghapus data.

## Teknologi

- Laravel 13
- PHP
- Session driver `file`
- Blade dan CSS

## Persyaratan

- PHP **8.4.1 atau lebih baru** untuk memasang paket yang saat ini terkunci di `composer.lock`.
- Composer

> Catatan: nilai PHP pada `composer.json` saat ini masih `^8.3`, tetapi beberapa paket dalam `composer.lock` meminta PHP 8.4.1+. Samakan versi PHP lingkungan dengan kebutuhan lock sebelum menjalankan `composer install`.

## Menjalankan aplikasi

1. Pasang dependency:

   ~~~bash
   composer install
   ~~~

2. Salin `.env.example` menjadi `.env` jika file `.env` belum tersedia.
3. Buat application key:

   ~~~bash
   php artisan key:generate
   ~~~

4. Pastikan konfigurasi session memakai driver file:

   ~~~dotenv
   SESSION_DRIVER=file
   ~~~

5. Jalankan server lokal:

   ~~~bash
   php artisan serve
   ~~~

6. Buka alamat lokal yang ditampilkan Artisan, biasanya `http://127.0.0.1:8000`.

CSS disajikan langsung dari `public/css/app.css`; proses build frontend tidak diperlukan. Pastikan direktori `storage/framework/sessions` dapat ditulisi oleh PHP.

## Catatan penyimpanan

Data disimpan pada session browser yang sedang digunakan. Data tidak dibagikan ke browser lain dan akan mengikuti masa berlaku session Laravel. Aplikasi ini berfokus pada CRUD master koleksi dan stok buku; transaksi peminjaman anggota belum dicatat sebagai data terpisah.
