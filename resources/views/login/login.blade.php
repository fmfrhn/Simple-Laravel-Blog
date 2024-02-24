@extends('layout/main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <main class="form-signin w-100 m-auto">
                <h1 class="h3 mb-3 fw-normal text-center">Please login!</h1>
                <form action="{{ route('halamanlogin') }}" method="POST">
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

                <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>

            </main>
        </div>
    </div>
@endsection
