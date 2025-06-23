@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Posts, {{ auth()->user()->name }}</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('dashboard.post.create') }}" class="btn btn-primary mb-3">Create New Post</a>

    <div class="d-flex mb-3 col-lg-12 gap-2">
        <form method="GET" action="{{ route('dashboard.post.index') }}"
            class="d-flex gap-2 flex-wrap flex-md-nowrap align-items-end">
            <div>
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ request('start_date') }}">
            </div>
            <div>
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div>
                <button type="submit" class="btn btn-outline-primary">Filter</button>
                <a href="{{ route('dashboard.post.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>

        @if (auth()->user()->is_admin)
            <div class="ms-auto">
                <form method="GET" action="{{ route('dashboard.post.exportPdf') }}">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <button type="submit" class="btn btn-danger">Export PDF</button>
                </form>
            </div>
        @endif
    </div>


    <div class="d-flex mb-3 col-lg-8 gap-2">
        <form method="GET" action="{{ route('dashboard.post.index') }}" class="flex-grow-1">
            <input type="text" name="search" class="form-control" placeholder="Search posts..."
                value="{{ request('search') }}">
        </form>

        @if (request('search'))
            <a href="{{ route('dashboard.post.index') }}" class="btn btn-outline-secondary">
                Clear
            </a>
        @endif
    </div>


    <div class="table-responsive small">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    @if (auth()->user()->is_admin)
                        <th scope="col">Author</th>
                    @endif
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-thumbnail"
                                    width="80">
                            @else
                                <img src="https://via.placeholder.com/80x60?text=No+Image" alt="No Image"
                                    class="img-thumbnail" width="80">
                            @endif
                        </td>
                        <td>
                            {!! request('search')
                                ? str_ireplace(request('search'), '<mark>' . request('search') . '</mark>', e($post->title))
                                : e($post->title) !!}
                        </td>
                        <td>{{ $post->category->name }}</td>
                        @if (auth()->user()->is_admin)
                            <td>{{ $post->user->name }}</td>
                        @endif
                        <td>
                            <a href="{{ route('dashboard.post.show', $post->slug) }}"
                                class="badge bg-info text-decoration-none">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('dashboard.post.edit', $post->slug) }}"
                                class="badge bg-warning text-decoration-none">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('dashboard.post.destroy', $post->slug) }}" class="d-inline"
                                method="POST">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $posts->links() }}
    </div>
@endsection
