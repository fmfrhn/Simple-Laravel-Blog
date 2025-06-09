@extends('dashboard.layouts.main')

@section('container')
    <div class="container-xl px-4 mt-4">
        <a href="{{ route('dashboards.user-setting') }}">
            <button class="btn btn-danger mb-5">Back</button>
        </a>
        <form action="{{ route('dashboards.user.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card -->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <img class="img-account-profile rounded-circle mb-2"
                                src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'http://bootdey.com/img/Content/avatar/avatar1.png' }}"
                                alt="User Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <input type="file" name="profile_image"
                                class="form-control @error('profile_image') is-invalid @enderror">
                            @error('profile_image')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <!-- Account details card -->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <!-- Username -->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" id="inputUsername"
                                    type="text" name="username" value="{{ old('username', $user->username) }}">
                                @error('username')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputName">Full Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="inputName"
                                    type="text" name="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmail">Email address</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="inputEmail"
                                    type="email" name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($errors->any() && !$errors->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
@endsection
