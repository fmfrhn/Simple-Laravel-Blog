@extends('layout/main')

@section('container')
    <h1 class="text-center mb-3">{{ $title }}</h1>


    <div class="container">
        <div class="row">
            @foreach ($authors as $author)
                <div class="col-md-4 m-3">
                    <div class="card text-bg-dark">
                        <img src="https://source.unsplash.com/500x500/?random&{{ $author->id }}" class="card-img" alt="{{ $author->name }}">

                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h5 class="card-title text-center flex-fill p-5 fs-4" style="background-color: rgba(0, 0, 0, 0.7)"> 
                                <a href="{{ route('author', $author->name) }}" class="text-decoration-none text-white" style="">{{ $author->name }}</a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    

@endsection