@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('buku.index') }}">Koleksi buku</a>
        <span aria-hidden="true">/</span>
        <span>Detail</span>
    </div>

    <section class="detail-card">
        <div class="detail-top">
            <div>
                <p class="eyebrow">INFORMASI KOLEKSI</p>
                <span class="book-code">{{ $buku['kode'] }}</span>
                <h1>{{ $buku['judul'] }}</h1>
                <p class="detail-author">Ditulis oleh {{ $buku['penulis'] }}</p>
            </div>
            <span class="condition-badge condition-{{ \Illuminate\Support\Str::slug($buku['kondisi']) }}">
                {{ $buku['kondisi'] }}
            </span>
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <span>Kategori</span>
                <strong>{{ $buku['kategori'] }}</strong>
            </div>
            <div class="detail-item">
                <span>Lokasi penyimpanan</span>
                <strong>{{ $buku['lokasi'] }}</strong>
            </div>
            <div class="detail-item">
                <span>Jumlah eksemplar</span>
                <strong>{{ $buku['jumlah'] }} buku</strong>
            </div>
            <div class="detail-item">
                <span>Kondisi</span>
                <strong>{{ $buku['kondisi'] }}</strong>
            </div>
        </div>

        <div class="detail-actions">
            <a class="button button-quiet" href="{{ route('buku.index') }}">Kembali ke daftar</a>
            <a class="button button-secondary" href="{{ route('buku.edit', $buku['kode']) }}">Ubah data</a>
            <form method="POST" action="{{ route('buku.destroy', $buku['kode']) }}" onsubmit="return confirm('Yakin ingin menghapus data buku ini?')">
                @csrf
                @method('DELETE')
                <button class="button button-danger" type="submit">Hapus buku</button>
            </form>
        </div>
    </section>
@endsection
