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

                @auth
                    <form action="{{ route('posts.toggleLike', $post->slug) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit"
                            class="btn btn-sm {{ $post->isLikedBy(auth()->user()) ? 'btn-danger' : 'btn-outline-danger' }}">
                            ❤️ {{ $post->likes()->count() }} Like{{ $post->likes()->count() != 1 ? 's' : '' }}
                        </button>
                    </form>
                @else
                    <p class="text-muted">❤️ {{ $post->likes()->count() }} Like{{ $post->likes()->count() != 1 ? 's' : '' }}
                    </p>
                @endauth

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
                    @foreach ($post->comments()->whereNull('parent_id')->latest()->get() as $comment)
                        <div class="mb-3 p-3 border rounded shadow-sm bg-light">

                            {{-- Header Komentar Utama --}}
                            <div class="d-flex align-items-center mb-2">
                                @if ($comment->user->profile_image)
                                    <img src="{{ asset('storage/' . $comment->user->profile_image) }}"
                                        alt="{{ $comment->user->name }}" width="40" height="40"
                                        class="rounded-circle me-2">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}"
                                        alt="{{ $comment->user->name }}" width="40" height="40"
                                        class="rounded-circle me-2">
                                @endif
                                <div>
                                    <strong>{{ $comment->user->name }}</strong>
                                    @if ($comment->user_id === $post->user_id)
                                        <span class="badge bg-success">Penulis</span>
                                    @endif
                                    <br>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>

                            {{-- Isi Komentar Utama --}}
                            <p class="mb-2">{{ $comment->content }}</p>

                            {{-- Tombol Reply --}}
                            @auth
                                <button class="btn btn-sm btn-link text-primary reply-toggle" data-id="{{ $comment->id }}"
                                    data-username="{{ $comment->user->name }}">
                                    Balas
                                </button>

                                {{-- Form Reply --}}
                                <form action="{{ route('comment.store', $post->slug) }}" method="POST"
                                    class="mb-3 d-none reply-form-{{ $comment->id }}">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea name="content" rows="2" class="form-control mb-2"
                                        placeholder="Balas komentar untuk {{ $comment->user->name }}..."></textarea>
                                    <button type="submit" class="btn btn-sm btn-secondary">Kirim</button>
                                </form>
                            @endauth

                            {{-- List Reply (Tanpa Card Terpisah) --}}
                            @foreach ($comment->replies as $reply)
                                <div class="ps-4 pt-3 mt-3 border-top border-2 border-light-subtle">

                                    <div class="d-flex align-items-center mb-2">
                                        @if ($reply->user->profile_image)
                                            <img src="{{ asset('storage/' . $reply->user->profile_image) }}"
                                                alt="{{ $reply->user->name }}" width="35" height="35"
                                                class="rounded-circle me-2">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->name) }}"
                                                alt="{{ $reply->user->name }}" width="35" height="35"
                                                class="rounded-circle me-2">
                                        @endif
                                        <div>
                                            <strong>{{ $reply->user->name }}</strong>
                                            @if ($reply->user_id === $post->user_id)
                                                <span class="badge bg-success">Penulis</span>
                                            @endif
                                            <br>
                                            <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>

                                    <p class="mb-0">
                                        <span class="text-muted">Membalas {{ $comment->user->name }}:</span><br>
                                        {{ $reply->content }}
                                    </p>
                                </div>
                            @endforeach

                        </div>
                    @endforeach
                </section>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.reply-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const username = button.getAttribute('data-username');
                const form = document.querySelector('.reply-form-' + id);
                const textarea = form.querySelector('textarea');

                form.classList.toggle('d-none');

                if (!textarea.value.trim()) {
                    textarea.value = `@${username} `;
                    textarea.focus();
                }
            });
        });
    </script>
@endsection
