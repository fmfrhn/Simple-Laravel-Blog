@extends('layout/main')

@section('container')
    <h1>Halaman About</h1>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p><br>
    <img src="{{ $gambar }}" alt=" {{ $name }}" width="200" class="img-thumbnail rounded-circle">
    <a href="<?php echo route('halamanhome');?>">Link Halaman 2</a>
@endsection