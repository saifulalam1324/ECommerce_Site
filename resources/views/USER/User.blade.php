<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('ASSATS/CSS/STYLE.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="" onclick="openSidebar()">
            <i class="fa-solid fa-bars" style="color: white"></i>
        </a>
        <div class="container-fluid">
            <a class="navbar-brand mr-5" href="{{ route('User home') }}">YOUR MARKET</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2 mb-2" id="navbarNav">
                <div class="container-fluid">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item mx-2 w-100 d-flex justify-content-center">
                            <div class="search-container w-75 justify-content-center">
                                <form class="search-form d-flex" action="#" method="get">
                                    @csrf
                                    <input type="text" class="form-control search-input"
                                        placeholder="Search products..." aria-label="Search" aria-describedby="search"
                                        name="search">
                                    <button type="submit" class="btn btn-outline-light ml-1">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="contaier-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            @if (Auth::guard('customer')->check())
                                <div class="dropdown justify-content-center text-center">
                                    <a class="btn btn-outline-light dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user"></i> {{Auth::guard('customer')->user()->full_name}}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-center custom-dropdown bg-transparent">
                                        <div class="d-flex justify-content-center">
                                            <form action="{{ route('UserLogout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa-solid fa-right-from-bracket"></i>
                                                </button>
                                            </form>
                                            <a class="btn btn-success ml-1" href="#"><i
                                                    class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                </div>

                            @else
                                <a class="btn btn-outline-light" href="{{ route('LoginSignup') }}">Sign In</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center">
            <a class="" onclick="closeSidebar()"><i class="fa-solid fa-circle-xmark fa-2x"></i>
        </div>
        <div class="sidebar-content">

        </div>
    </div>
    <div id="overlay" class="overlay" onclick="closeSidebar()">
    </div>
    <a href="{{ route('Cart') }}"
        class="d-flex justify-content-center align-items-center position-fixed bg-transparent border-0 mb-4"
        style="inset-inline-end:20px; inset-block-end:20px; color:#7a4eb0; z-index:1030;">
        <i class="fa-solid fa-cart-plus fa-3x"></i>
    </a>
    <div class="container-fluid">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="{{ asset('ASSATS/JS/LOGINSIGNUP.js') }}"></script>
    <script src="{{ asset('ASSATS/JS/SCRIPT.js') }}"></script>
</body>

</html>
