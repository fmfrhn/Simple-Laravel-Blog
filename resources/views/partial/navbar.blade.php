<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Farhan Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ $title === 'Home' ? 'active ' : '' }}" aria-current="page"
                        href="{{ route('halamanhome') }}">Home</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ $title === 'About' ? 'active ' : '' }}"
                        href="{{ route('halamanabout') }}">About</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ $title === 'Posts' ? 'active ' : '' }}" aria-current="page"
                        href="{{ route('halamanblog') }}">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $title === 'Daftar Kategori' ? 'active ' : '' }}" aria-current="page"
                        href="{{ route('kategoriall') }}">Category</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $title === 'Daftar Author' ? 'active ' : '' }}" aria-current="page"
                        href="{{ route('authors') }}">Author</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Welcome back, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"> <i
                                        class="bi bi-layout-text-window"></i> &nbsp;My Dashboard</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('halamanlogout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left"></i>&nbsp;
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('halamanlogin') }}" class="nav-link"> <i
                                class="bi bi-arrow-right-square-fill"></i>&nbsp; Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
