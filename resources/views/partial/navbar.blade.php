<header class="navbar navbar-expand-md d-print-none navbar-dark bg-dark">
    <div class="container-xl">
        <a class="navbar-brand" href="#">
            Farhan Blog
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar-nav flex-grow-1">
                {{-- <a class="nav-item nav-link {{ $title === 'Home' ? 'active' : '' }}" href="{{ route('halamanhome') }}">
                    Home
                </a> --}}
                <a class="nav-item nav-link {{ $title === 'Posts' ? 'active' : '' }}" href="{{ route('halamanblog') }}">
                    Blog
                </a>
                <a class="nav-item nav-link {{ $title === 'Daftar Kategori' ? 'active' : '' }}"
                    href="{{ route('kategoriall') }}">
                    Category
                </a>
                <a class="nav-item nav-link {{ $title === 'Daftar Author' ? 'active' : '' }}"
                    href="{{ route('authors') }}">
                    Author
                </a>
            </div>

            <div class="navbar-nav ms-auto">
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                            aria-expanded="false">
                            Welcome back, {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="ti ti-layout-dashboard"></i> &nbsp;My Dashboard
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('halamanlogout') }}" method="POST" class="dropdown-item p-0">
                                @csrf
                                <button type="submit" class="btn btn-link dropdown-item text-start">
                                    <i class="ti ti-logout"></i>&nbsp; Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('halamanlogin') }}" class="nav-item nav-link">
                        <i class="ti ti-login"></i>&nbsp; Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
