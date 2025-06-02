@extends('layout/main')

@section('container')
    <h1>{{ $title }}</h1> <br>

    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4">
                    <div class="card text-bg-dark">
                        <img src="https://loremflickr.com/500/500/{{ urlencode($category->name) }}" class="card-img"
                            alt="{{ $category->name }}">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h5 class="card-title text-center flex-fill p-5 fs-4"
                                style="background-color: rgba(0, 0, 0, 0.7)">
                                <a href="{{ route('kategori', $category->name) }}" class="text-decoration-none text-white"
                                    style="">{{ $category->name }}</a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
