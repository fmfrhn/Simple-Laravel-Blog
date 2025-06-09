@extends('dashboard.layouts.main')

@section('container')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img class="img-account-profile rounded-circle mb-2"
                            src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'http://bootdey.com/img/Content/avatar/avatar1.png' }}"
                            alt="User Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                        <h5 class="my-3">
                            {{ explode(' ', $user->name)[0] ?? $user->name }}
                        </h5>

                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Username</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->username }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Password</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-0">***</p>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ route('dashboards.user-update-password-form') }}">
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-danger btn-sm">Update
                                        Password</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <a href="{{ route('dashboards.user-update-form') }}">
                        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Update
                            User</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
