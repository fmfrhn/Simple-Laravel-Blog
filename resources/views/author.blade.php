@extends('layout/main')

@section('container')
    <h1 class="text-center mb-3">Post By Author: {{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="{{ route('author', ['author' => $title]) }}">
                <div class="input-group mb-3">
                    <input type="hidden" name="author" value="{{ $title }}">

                    <input type="text" class="form-control" placeholder="Search.." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        <div class="card mb-3">
            @if ($posts[0]->image)
                <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top"
                    alt="{{ $posts[0]->category->name }}" style="max-height: 400px; object-fit: cover;">
            @else
                <img src="https://picsum.photos/seed/{{ $posts[0]->id }}/1200/400" class="card-img-top"
                    alt="{{ $posts[0]->category->name }}">
            @endif

            <div class="card-body text-center">
                <h3 class="card-title"> <a href="{{ route('postdetail', $posts[0]->slug) }}"
                        class="text-decoration-none text-dark">{{ $posts[0]->title }}</a>
                </h3>

                <small class="text-muted">
                    Categories : <a href="{{ route('kategori', ['slug' => $posts[0]->Category->slug]) }}"
                        class="text-decoration-none">{{ is_null($posts[0]->Category) ? 'No Category' : $posts[0]->Category->name }}</a>
                    By: <a href="{{ route('author', ['author' => $posts[0]->user->name]) }}"
                        class="text-decoration-none">{{ $posts[0]->user->name }}</a>
                    <p></p>
                </small>

                <p class="card-text">{{ $posts[0]->excerpt }}</p>
                <p class="card-text"><small
                        class="text-body-secondary">{{ $posts[0]->created_at->diffForHumans() }}</small>
                </p>
                <a href="{{ route('postdetail', $posts[0]->slug) }}" class="text-decoration-none btn btn-primary">Read
                    more...</a>
            </div>
        </div>
    @else
        <p class="text-center fs-4">Post not found.</p>
    @endif

    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute bg-dark p-2 text-white" style="background-color: rgba(0, 0, 0, 0.5)">
                            <a href="{{ route('kategori', ['slug' => $post->Category->name]) }}"
                                class="text-decoration-none text-white">{{ is_null($post->Category) ? 'No Category' : $post->Category->name }}</a>
                        </div>
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top"
                                alt="{{ $post->category->name }}"
                                style="max-height: 300px; max-width: 500px; object-fit: cover;">
                        @else
                            <img src="https://picsum.photos/seed/{{ $post->id }}/500/300" class="card-img-top"
                                alt="{{ $post->category->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-decoration-none text-dark"><a
                                    href="{{ route('postdetail', $post->slug) }}"
                                    class="text-decoration-none">{{ $post->title }}</a></h5>

                            By: <a href="{{ route('author', ['author' => $post->user->name]) }}"
                                class="text-decoration-none">{{ $post->user->name }}</a>

                            <p class="card-text">{{ $post->excerpt }}.</p>

                            <p class="card-text"><small
                                    class="text-body-secondary">{{ $post->created_at->diffForHumans() }}</small>
                            </p>

                            <a href="{{ route('postdetail', $post->slug) }}"
                                class="text-decoration-none btn btn-primary">Read
                                more...</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
