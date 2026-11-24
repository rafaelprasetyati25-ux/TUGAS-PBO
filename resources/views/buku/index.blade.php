@extends('layouts.app')

@section('title', 'Koleksi Buku')

@section('content')
    <section class="page-heading">
        <div>
            <p class="eyebrow">PERPUSTAKAAN · DATA MASTER</p>
            <h1>Koleksi buku</h1>
            <p class="page-description">Kelola judul, lokasi, jumlah, dan kondisi buku untuk mendukung proses peminjaman.</p>
        </div>
        <a class="button button-primary" href="{{ route('buku.create') }}">
            <span aria-hidden="true">＋</span> Tambah buku
        </a>
    </section>

    <section class="stat-grid" aria-label="Ringkasan koleksi">
        <article class="stat-card">
            <span class="stat-icon stat-icon-blue" aria-hidden="true">▤</span>
            <div>
                <p class="stat-label">Judul terdaftar</p>
                <p class="stat-value">{{ $jumlahJudul }}</p>
            </div>
        </article>
        <article class="stat-card">
            <span class="stat-icon stat-icon-green" aria-hidden="true">▣</span>
            <div>
                <p class="stat-label">Jumlah seluruh buku</p>
                <p class="stat-value">{{ $jumlahStok }} <span>eksemplar</span></p>
            </div>
        </article>
        <article class="stat-card">
            <span class="stat-icon stat-icon-amber" aria-hidden="true">!</span>
            <div>
                <p class="stat-label">Stok perlu perhatian</p>
                <p class="stat-value">{{ $stokMenipis }} <span>judul</span></p>
            </div>
        </article>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <p class="eyebrow">DAFTAR KOLEKSI</p>
                <h2>Data buku perpustakaan</h2>
            </div>
            <span class="record-count">{{ $jumlahJudul }} data</span>
        </div>

        @if (count($daftarBuku) > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama buku</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarBuku as $buku)
                            <tr>
                                <td><span class="book-code">{{ $buku['kode'] }}</span></td>
                                <td>
                                    <a class="book-title" href="{{ route('buku.show', $buku['kode']) }}">{{ $buku['judul'] }}</a>
                                    <span class="book-author">{{ $buku['penulis'] }}</span>
                                </td>
                                <td>{{ $buku['kategori'] }}</td>
                                <td>{{ $buku['lokasi'] }}</td>
                                <td><span class="quantity">{{ $buku['jumlah'] }}</span></td>
                                <td>
                                    <span class="condition-badge condition-{{ \Illuminate\Support\Str::slug($buku['kondisi']) }}">
                                        {{ $buku['kondisi'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a class="action-link" href="{{ route('buku.show', $buku['kode']) }}">Detail</a>
                                        <a class="action-link" href="{{ route('buku.edit', $buku['kode']) }}">Ubah</a>
                                        <form method="POST" action="{{ route('buku.destroy', $buku['kode']) }}" onsubmit="return confirm('Yakin ingin menghapus data buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="action-link action-danger" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <span class="empty-mark" aria-hidden="true">▤</span>
                <h3>Belum ada buku terdaftar</h3>
                <p>Tambahkan koleksi pertama agar data buku dan stoknya mulai tercatat.</p>
                <a class="button button-secondary" href="{{ route('buku.create') }}">Tambah buku pertama</a>
            </div>
        @endif
    </section>
@endsection
