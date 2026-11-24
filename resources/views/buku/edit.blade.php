@extends('layouts.app')

@section('title', 'Ubah Buku')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('buku.index') }}">Koleksi buku</a>
        <span aria-hidden="true">/</span>
        <a href="{{ route('buku.show', $buku['kode']) }}">{{ $buku['judul'] }}</a>
        <span aria-hidden="true">/</span>
        <span>Ubah</span>
    </div>

    <section class="form-card">
        <div class="form-heading">
            <p class="eyebrow">KODE {{ $buku['kode'] }}</p>
            <h1>Ubah data buku</h1>
            <p>Perbarui informasi koleksi. Nilai yang sudah ada ditampilkan sebagai nilai awal.</p>
        </div>

        <form method="POST" action="{{ route('buku.update', $buku['kode']) }}">
            @csrf
            @method('PUT')
            @include('buku._form', ['labelTombol' => 'Simpan perubahan'])
        </form>
    </section>
@endsection
