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
                    <h5>Content Here</h5>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-white bg-green">
        <div class="container">

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

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}

                    @php
                        // Lấy tất cả dữ liệu của categories trong hệ thống
                        $categories = \App\Models\Category::where('navbar_status', '0')
                            ->where('status', '0')
                            ->get();
                    @endphp

                    {{-- Đưa tất cả các categories để hiển thị ra trên thanh nav bar ở trang home --}}

                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ url('tutorial/' . $category->slug) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach


                    @if (Auth::check())
                        <li>
                            <a class="nav-link btn-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                @csrf
                            </form>

                        </li>
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
