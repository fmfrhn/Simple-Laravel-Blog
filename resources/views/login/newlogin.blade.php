@extends('layout.main')

@section('container')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="row g-4 align-items-center">

                    {{-- Gambar --}}
                    <div class="col-12 col-lg-6 text-center order-1 order-lg-1">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                            class="img-fluid" style="max-height: 350px;" alt="Login image">
                    </div>

                    {{-- Form Login --}}
                    <div class="col-12 col-lg-6 order-2 order-lg-2">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any() && !session('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('autentikasi') }}">
                            @csrf
                            <p class="h3 text-center fw-bold mb-4">Sign in</p>

                            <!-- Email input -->
                            <div class="form-outline mb-3">
                                <input type="username" id="form3Example3" class="form-control form-control-lg"
                                    name="username" placeholder="Enter Username" />
                                <label class="form-label" for="form3Example3">Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input type="password" id="form3Example4" class="form-control form-control-lg"
                                    name="password" placeholder="Enter password" />
                                <label class="form-label" for="form3Example4">Password</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                    Forgot password?
                                </a>
                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
                            </div>

                            <p class="small text-center fw-bold mb-0">Don't have an account? <a
                                    href="{{ route('halamanregister') }}" class="link-primary">Register</a></p>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Forgot Password Modal -->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('forgot-password.send') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="forgotEmail" class="form-label">Enter your email address</label>
                                <input type="email" class="form-control" id="forgotEmail" name="email"
                                    placeholder="you@example.com" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Send Reset Link</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
