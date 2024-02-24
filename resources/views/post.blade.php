@extends('layout/main')

@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <article>
                    <h2 class="mb-5">{{ $post->title }}</h2>
                    <h5 class="mb-3">By <a
                            href="{{ route('author', ['author' => $post->user->name]) }}">{{ $post->user->name }}</a> in <a
                            href="{{ route('kategori', ['slug' => $post->Category->name]) }}"
                            class="text-decoration-none">{{ is_null($post->Category) ? 'No Category' : $post->Category->name }}</a>
                    </h5>

                    @if ($post->image)
                        <div class="d-flex justify-content-center align-items-center" style="max-height: 350px; overflow:hidden">
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid"
                                alt="{{ $post->category->name }}">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x450?{{ $post->category->name }}" class="img-fluid"
                            alt="{{ $post->category->name }}">
                    @endif
                        
                    <article class="my-3 fs-5">
                        {!! $post->body !!}
                    </article>
                    {{-- //kurung kurawa 1 digunakan untuk print yang membatalkan htmlspecialchars --}}
                    <div class="mt-3"> <a href="{{ route('halamanblog') }}">Back To Blog!</a></div>

                </article>
            </div>
        </div>
    </div>
@endsection
