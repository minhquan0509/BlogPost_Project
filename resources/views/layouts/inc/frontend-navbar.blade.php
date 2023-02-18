<div class="global-navbar bg-white">
    <div class="container">
        <div class="row">

            {{-- Hiển thị cái logo ở trang home --}}
            <div class="col-md-3 d-none d-sm-none d-md-inline">
                <img src="{{ asset('assets/images/logo.png') }}" class="w-100" alt="logo">
            </div>

            {{-- Hiển thị phần nội dung bên cạnh cái logo --}}
            <div class="col-md-9 my-auto">
                <div class="border text-center p-2">
                    <form action="/search-post" method="get">
                        <div class="input-group">
                            <input type="search" class="form-control rounded" placeholder="Search"
                                name="search_string" />
                            <button type="submit" class="btn btn-outline-primary">search</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-white bg-green">
        <div class="container">
            @php
                // Lấy tất cả dữ liệu của categories trong hệ thống
                $categories = \App\Models\Category::where('navbar_status', '0')
                    ->where('status', '0')
                    ->get();
            @endphp

            {{-- <a href="" class="navbar-brand d-inline d-sm-inline d-md-none">Navbar</a> --}}

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Hiển thị thanh nav bar để show tất cả các categories --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Category list
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ url('tutorial/' . $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    {{-- For questions list --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Questions list
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item"
                                    href="/questions">All</a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ url('questions/' . $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>


                    @if (Auth::check())

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('questions/my-questions') }}">My questions</a>
                        </li>

                        <li>
                            <a class="nav-link btn-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                @csrf
                            </form>

                        </li>


                        @if (Auth::user()->role_as == '1')
                            <li>
                                <a class="nav-link btn-danger" href="{{ url('admin/dashboard') }}"
                                    onclick="event.preventDefault(); document.getElementById('system-form').submit();">System
                                    Management</a>

                                <form id="system-form" action="{{ url('admin/dashboard') }}" method="get"
                                    class="d-none">
                                    @csrf
                                </form>

                            </li>
                        @endif
                    @else
                        <li>
                            <a class="nav-link btn-danger" href="{{ route('login') }}"
                                onclick="event.preventDefault(); document.getElementById('login-form').submit();">Login</a>

                            <form id="login-form" action="{{ route('login') }}" method="get" class="d-none">
                                @csrf
                            </form>
                        </li>

                        <li>
                            <a class="nav-link btn-danger" href="{{ route('register') }}"
                                onclick="event.preventDefault(); document.getElementById('register-form').submit();">Register</a>

                            <form id="register-form" action="{{ route('register') }}" method="get" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>
</div>
