@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <article>
                    <h2 class="mb-5">{{ $post->title }}</h2>

                    <a href="{{ route('dashboard.post.index') }}" class="btn btn-success">
                        <i class="bi bi-box-arrow-left"></i>
                        Back to my Posts
                    </a>
                    <a href="{{ route('dashboard.post.edit', ['post' => $post->slug]) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i>
                        Edit
                    </a>

                    <form action="{{ route('dashboard.post.destroy', ['post' => $post->slug]) }}" class="d-inline"
                        method="POST">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure ?')">
                            <i class="bi bi-x-circle-fill"></i>
                            Delete
                        </button>
                        </a>
                    </form>

                    @if ($post->image)
                        <div style="max-height: 350px; overflow:hidden">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                class="img-fluid mt-3"
                                alt="{{ $post->category->name }}">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x450?{{ $post->category->name }}" class="img-fluid mt-3"
                            alt="{{ $post->category->name }}">
                    @endif

                    <article class="my-3 fs-5">
                        {!! $post->body !!}
                    </article>
                    {{-- //kurung kurawa 1 digunakan untuk print yang membatalkan htmlspecialchars --}}
                </article>
            </div>
        </div>
    </div>
@endsection
