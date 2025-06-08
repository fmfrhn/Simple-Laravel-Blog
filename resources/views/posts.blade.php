@extends('layout/main')

@section('container')
<div class="container">
    <h1 class="mb-4 text-center">📰 Halaman Blog</h1>

    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('halamanblog') }}">
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                        value="{{ request('search') }}">
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        {{-- Highlighted First Post --}}
        <div class="card mb-4 shadow-sm">
            @if ($posts[0]->image)
                <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top"
                    alt="{{ $posts[0]->category->name }}" style="max-height: 400px; object-fit: cover;">
            @else
                <img src="https://picsum.photos/seed/{{ $posts[0]->id }}/1200/400" class="card-img-top"
                    alt="{{ $posts[0]->category->name }}">
            @endif

            <div class="card-body text-center">
                <h3>
                    <a href="{{ route('postdetail', $posts[0]->slug) }}" class="text-decoration-none">
                        {{ $posts[0]->title }}
                    </a>
                </h3>
                <div class="mb-2">
                    <span class="badge bg-blue-lt">
                        <a href="{{ route('kategori', ['slug' => $posts[0]->Category->slug]) }}"
                            class="text-blue text-decoration-none">
                            {{ $posts[0]->Category->name ?? 'No Category' }}
                        </a>
                    </span>
                    <span class="mx-1">|</span>
                    <span class="text-muted">
                        By <a href="{{ route('author', ['author' => $posts[0]->user->name]) }}"
                            class="text-decoration-none">{{ $posts[0]->user->name }}</a>
                    </span>
                </div>

                <p class="text-muted">{{ $posts[0]->excerpt }}</p>
                <p class="text-secondary"><small>{{ $posts[0]->created_at->diffForHumans() }}</small></p>
                <a href="{{ route('postdetail', $posts[0]->slug) }}" class="btn btn-primary">Read more</a>
            </div>
        </div>

        {{-- Other Posts --}}
            <div class="row gx-3 gy-4">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="position-relative">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top"
                                        alt="{{ $post->category->name }}" style="max-height: 300px; max-width: 500px; object-fit: cover;">
                                @else
                                    <img src="https://picsum.photos/seed/{{ $post->id }}/500/300" class="card-img-top"
                                        alt="{{ $post->category->name }}">
                                @endif

                                <div class="badge bg-dark position-absolute top-0 start-0 m-2">
                                    <a href="{{ route('kategori', ['slug' => $post->Category->slug]) }}"
                                        class="text-white text-decoration-none">
                                        {{ $post->Category->name ?? 'No Category' }}
                                    </a>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                            {{-- <div class="card-body"> --}}
                                <h4 class="mb-2">
                                    <a href="{{ route('postdetail', $post->slug) }}"
                                        class="text-decoration-none">{{ $post->title }}</a>
                                </h4>

                                <div class="mb-2 text-muted">
                                    By <a href="{{ route('author', ['author' => $post->user->name]) }}"
                                        class="text-decoration-none">{{ $post->user->name }}</a>
                                </div>

                                <p class="text-muted">{{ $post->excerpt }}</p>

                                <div class="mt-auto">
                                    <p class="text-secondary mb-2"><small>{{ $post->created_at->diffForHumans() }}</small>
                                    </p>
                                    <a href="{{ route('postdetail', $post->slug) }}"
                                        class="btn btn-outline-primary btn-sm">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    @else
        <div class="text-center text-muted fs-4">Post not found.</div>
    @endif

    <div class="d-flex justify-content-center my-5 mb-5">
        {{ $posts->links() }}
    </div>
</div>
@endsection
