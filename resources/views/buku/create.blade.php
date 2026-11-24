@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('buku.index') }}">Koleksi buku</a>
        <span aria-hidden="true">/</span>
        <span>Tambah buku</span>
    </div>

    <section class="form-card">
        <div class="form-heading">
            <p class="eyebrow">DATA KOLEKSI</p>
            <h1>Tambah buku</h1>
            <p>Lengkapi informasi buku. Kode koleksi akan dibuat otomatis setelah data disimpan.</p>
        </div>

        <form method="POST" action="{{ route('buku.store') }}">
            @csrf
            @include('buku._form', ['buku' => [], 'labelTombol' => 'Simpan buku'])
        </form>
    </section>
@endsection
