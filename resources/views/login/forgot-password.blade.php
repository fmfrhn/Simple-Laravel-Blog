@extends('layout.main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center mb-3">Reset Password</h3>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            </form>
        </div>
    </div>
@endsection
