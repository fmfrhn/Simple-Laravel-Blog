@extends('layout/main')

@section('container')
    <div class="container">
        <h1>{{ $title }}</h1> <br>
        <div class="row g-3">
            @foreach ($categories as $category)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <div class="position-relative" style="height: 250px;">
                            <img src="https://picsum.photos/seed/{{ urlencode($category->name . $category->id) }}/500/500"
                                class="w-100 h-100 object-cover position-absolute top-0 start-0" alt="{{ $category->name }}">

                            {{-- Strip shadow tengah --}}
                            <div class="position-absolute top-50 start-50 translate-middle-x"
                                style="
                                     background-color: rgba(0, 0, 0, 0.5);
                                     padding: 0.75rem 1.25rem;
                                     border-radius: 0.5rem;
                                     box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                                 ">
                                <a href="{{ route('kategori', $category->name) }}"
                                    class="text-white text-decoration-none fs-5 fw-semibold">
                                    {{ $category->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
