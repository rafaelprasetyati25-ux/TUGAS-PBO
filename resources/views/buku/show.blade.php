@extends('layouts.app')

@section('content')
    <h3>Detail Buku</h3>
    <p>id: {{ $id }}</p>
    <p>judul: {{ $buku['judul'] }}</p>
    <p>author: {{ $buku['penulis'] }}</p>
    <a href="{{ route('buku.index') }}">Kembali ke daftar</a>
@endsection
