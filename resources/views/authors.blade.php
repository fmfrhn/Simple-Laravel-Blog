@extends('layout/main')

@section('container')
    <h1 class="text-center mb-4">{{ $title }}</h1>

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">
            @foreach ($authors as $author)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden rounded-4 text-center author-card">
                        {{-- Gambar Profil --}}
                        <div class="position-relative">
                            @if (!$author->profile_image)
                                <img src="https://picsum.photos/seed/{{ $author->id }}/500/500"
                                    class="card-img-top object-fit-cover" alt="{{ $author->name }}"
                                    style="height: 250px; width: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/' . $author->profile_image) }}"
                                    class="card-img-top object-fit-cover" alt="{{ $author->name }}"
                                    style="height: 250px; width: 100%; object-fit: cover;">
                            @endif

                            {{-- Tombol overlay tampil saat hover --}}
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                                <a href="{{ route('author', $author->name) }}"
                                    class="btn btn-primary px-4 py-2 fw-semibold">
                                    Lihat Post
                                </a>
                            </div>
                        </div>

                        {{-- Nama Author --}}
                        <div class="card-body">
                            <h5 class="card-title mb-0">
                                <a href="{{ route('author', $author->name) }}" class="text-decoration-none text-dark">
                                    {{ $author->name }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Tambahkan CSS --}}
    <style>
        .author-card {
            transition: transform 0.3s ease;
        }

        .author-card:hover {
            transform: scale(1.02);
        }

        .author-card .overlay {
            background-color: rgba(0, 0, 0, 0.55);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .author-card:hover .overlay {
            opacity: 1;
        }

        .author-card .overlay .btn {
            background-color: rgba(255, 255, 255, 0.9);
            color: #000;
            border: none;
            transition: background-color 0.3s ease;
        }

        .author-card .overlay .btn:hover {
            background-color: #0d6efd;
            color: #fff;
        }
    </style>
@endsection
