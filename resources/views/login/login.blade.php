@extends('layout/main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin w-100 m-auto">
                <h1 class="h3 mb-3 fw-normal text-center">Please login!</h1>
                <form action="{{ route('autentikasi') }}" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="username" placeholder="username" required autofocus>
                        <label for="username">Username</label>
                        @error('username')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="password" name="password" class="form-control rounded-bottom" id="password"
                            placeholder="password" required>
                        <label for="password">Password</label>
                    </div>

                    <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
                </form>
                <small class="d-block text-center mt-3">Not registered ? <a href="{{ route('halamanregister') }}">register
                        now!</a></small>

                <small class="d-block text-center mt-3">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot password?</a>
                </small>

                <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>

            </main>

            <!-- Forgot Password Modal -->
            <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('forgot-password.send') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Masukkan alamat email Anda, kami akan mengirimkan link untuk reset password.</p>
                                <div class="mb-3">
                                    <label for="resetEmail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="resetEmail" name="email" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Kirim Link Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
