@extends('layout/main')

@section('container')
    <div class="container my-5">

        <div class="mt-4">
            <a href="{{ route('halamanblog') }}" class="btn btn-outline-secondary">← Back To Blog</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- ===== Post Content ===== --}}
                <article class="mb-5">
                    <h2 class="mb-3 fw-bold">{{ $post->title }}</h2>

                    <div class="text-muted mb-3">
                        By <a href="{{ route('author', ['author' => $post->user->name]) }}" class="text-decoration-none">
                            {{ $post->user->name }}
                        </a>
                        in
                        <a href="{{ route('kategori', ['slug' => $post->Category->name]) }}" class="text-decoration-none">
                            {{ $post->Category->name ?? 'No Category' }}
                        </a>
                    </div>

                    @if ($post->image)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded shadow"
                                style="max-height: 350px; object-fit: cover;" alt="{{ $post->category->name }}">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x450?{{ $post->category->name }}"
                            class="img-fluid rounded shadow mb-4" alt="{{ $post->category->name }}">
                    @endif

                    <div class="fs-5">
                        {!! $post->body !!}
                    </div>
                </article>

                {{-- ===== Komentar Section ===== --}}
                <hr>
                <section>
                    <h5 class="mb-3">💬 Komentar ({{ $post->comments->count() }})</h5>

                    {{-- Form Komentar --}}
                    @auth
                        <form action="{{ route('comment.store', $post->slug) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="form-group mb-2">
                                <textarea name="content" rows="3" class="form-control" placeholder="Tulis komentar..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    @else
                        <p><a href="{{ route('halamanlogin') }}">Login</a> untuk berkomentar.</p>
                    @endauth

                    {{-- Daftar Komentar --}}
                    @if ($post->comments->count())
                        @foreach ($post->comments()->latest()->get() as $comment)
                            <div class="mb-3 p-3 border rounded shadow-sm bg-light">
                                <div class="d-flex align-items-center mb-2">
                                    @if ($comment->user->profile_image)
                                        <img src="{{ asset('storage/' . $comment->user->profile_image) }}"
                                            alt="{{ $comment->user->name }}" width="40" height="40"
                                            class="rounded-circle me-2">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=0D8ABC&color=fff"
                                            alt="{{ $comment->user->name }}" width="40" height="40"
                                            class="rounded-circle me-2">
                                    @endif
                                    <div>
                                        <strong>{{ $comment->user->name }}</strong><br>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            Belum ada komentar. Jadilah yang pertama berkomentar!
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
@endsection
