<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#f5f4ef">
        <title>@yield('title', 'Katalog Buku') | Perpustakaan</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="page-shell">
            <header class="site-header">
                <a class="brand" href="{{ route('buku.index') }}">
                    <span class="brand-mark" aria-hidden="true">P</span>
                    <span>
                        <strong>Pustaka</strong>
                        <small>Pengelolaan koleksi buku</small>
                    </span>
                </a>

                <nav class="site-nav" aria-label="Navigasi utama">
                    <a class="nav-link" href="{{ route('buku.index') }}">Koleksi buku</a>
                    <a class="button button-primary button-small" href="{{ route('buku.create') }}">
                        <span aria-hidden="true">＋</span> Tambah buku
                    </a>
                </nav>
            </header>

            <main class="main-content">
                @if (session('success'))
                    <div class="flash-message" role="status">
                        <span class="flash-icon" aria-hidden="true">✓</span>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="site-footer">
                <span>Data koleksi dan stok untuk mendukung layanan peminjaman.</span>
                <span>UTS Pemrograman Berorientasi Objek</span>
            </footer>
        </div>
    </body>
</html>
