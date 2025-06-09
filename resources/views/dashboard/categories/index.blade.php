@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Categories</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger col-lg-6" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive small col-lg-6">
        <a href="{{ route('administrator.category.create') }}" class="btn btn-primary mb-3">Create New Category</a>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            {{-- Tombol Edit --}}
                            <a href="{{ route('administrator.category.edit', $category->id) }}" class="badge bg-warning text-decoration-none">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            {{-- Tombol Delete --}}
                            <form action="{{ route('administrator.category.destroy', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure you want to delete this category?')">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
