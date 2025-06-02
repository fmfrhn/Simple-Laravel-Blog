@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Post, {{ auth()->user()->name }}</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="{{ route('dashboard.post.index') }}" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control title @error('title') is-invalid @enderror" name="title" required
                    id="title" autofocus value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">slug</label>
                <input type="slug" class="form-control slug @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" required
                    id="slug">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" name="category_id">
                    @foreach ($categories as $category)
                        @if(old('category_id') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label @error('image') is-invalid @enderror">Post image</label>
                <img src="" class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

            <div class="mb-3">
                <label for="editor" class="form-label">Write your body here..</label>
                <textarea name="body" id="editor">{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
        title.addEventListener('change', function() {
            fetch('{{ route('dashboard.post.checkslug') }}?title=' + title.value)
                .then(response => response.json())
                // .then (data => slug.value = data.slug)
                .then(function(data) {
                    slug.value = data.slug;
                    console.log(data.var2)
                })
        });

        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
