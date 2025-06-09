@extends('layout.main')

@section('container')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="row g-4 align-items-center">

                    {{-- Form --}}
                    <div class="col-12 col-lg-6 order-2 order-lg-1">
                        <p class="text-center h2 fw-bold mb-4">Sign up</p>

                        {{-- Notifikasi error --}}
                        @if (session('loginError'))
                            <div class="alert alert-danger">
                                {{ session('loginError') }}
                            </div>
                        @endif

                        <form action="{{ route('registrasi') }}" method="POST" enctype="multipart/form-data" class="px-2">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-3 d-flex align-items-center">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="flex-fill">
                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Your name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Username --}}
                            <div class="mb-3 d-flex align-items-center">
                                <i class="fas fa-user-circle fa-lg me-3 fa-fw"></i>
                                <div class="flex-fill">
                                    <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Username" value="{{ old('username') }}">
                                    @error('username')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3 d-flex align-items-center">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <div class="flex-fill">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Profile Image --}}
                            <div class="mb-3 d-flex align-items-center">
                                <i class="fas fa-image fa-lg me-3 fa-fw"></i>
                                <div class="flex-fill">
                                    <label for="profile_image" class="form-label">Profile Image</label>
                                    <input type="file" name="profile_image" id="profile_image" class="form-control"
                                        accept="image/*">
                                    @error('profile_image')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="mb-3 d-flex align-items-center">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="flex-fill">
                                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password">
                                    @error('password')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Confirm Password --}}
                            <div class="mb-3 d-flex align-items-center">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="flex-fill">
                                    <label for="password_confirmation" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Link ke login --}}
                            <div class="form-check d-flex justify-content-center mb-3">
                                <label class="form-check-label">
                                    Already have an account? <a href="{{ route('halamanlogin') }}">Log in!</a>
                                </label>
                            </div>

                            {{-- Tombol Submit --}}
                            <div class="d-flex justify-content-center mb-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Register</button>
                            </div>
                        </form>
                    </div>

                    {{-- Gambar --}}
                    <div class="col-12 col-lg-6 order-1 order-lg-2 text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                            class="img-fluid" style="max-height: 350px;" alt="Sample image">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
