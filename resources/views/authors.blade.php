@extends('layout/main')

@section('container')
    <h1 class="text-center mb-3">{{ $title }}</h1>

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach ($authors as $author)
                <div class="col">
                    <div class="card text-bg-dark h-100 border-0 overflow-hidden position-relative">
                        <img src="https://picsum.photos/seed/{{ $author->id }}/500/500"
                            class="card-img-top object-fit-cover" alt="{{ $author->name }}"
                            style="height: 250px; width: 100%;">
    
                        {{-- Overlay center with button --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                            <a href="{{ route('author', $author->name) }}"
                                class="btn btn-primary px-4 py-2"
                                style="background-color: rgba(0, 0, 0, 0.6); border: none;">
                                {{ $author->name }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
@endsection
