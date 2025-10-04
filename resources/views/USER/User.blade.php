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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="" onclick="openSidebar()">
            <i class="fa-solid fa-bars" style="color: white"></i>
        </a>
        <div class="container-fluid">
            <a class="navbar-brand mr-5" href="{{ route('User home') }}">YOUR MARKET</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container-fluid collapse navbar-collapse mt-1 mb-1 justify-content-center" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2 d-flex nav-item justify-content-center align-items-center">
                        <div class="search-container w-75">
                            <form class="search-form d-flex" action="#" method="get">
                                @csrf
                                <input type="search" id="search" class="form-control search-input"
                                    placeholder="Search products..." aria-label="Search" aria-describedby="search"
                                    name="search">
                                <button type="submit" class="btn btn-outline-light ml-1" style="border-radius: 10%">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="container-fluid collapse navbar-collapse mt-1 mb-1 justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item justify-content-center align-items-center">
                        @if (Auth::guard('customer')->check())
                            <div class="dropdown justifyF-content-center text-center">
                                <a class="btn btn-outline-light dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i> {{Auth::guard('customer')->user()->full_name}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-center custom-dropdown bg-transparent">
                                    <div class="d-flex justify-content-center">
                                        <form id="logoutForm" action="{{ route('UserLogout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                            </button>
                                        </form>
                                        <script>
                                            document.getElementById('logoutForm').addEventListener('submit', function (event) {
                                                event.preventDefault();
                                                if (confirm("Are you sure you want to logout?")) {
                                                    this.submit();
                                                }
                                            });
                                        </script>
                                        <a class="btn btn-success ml-1" href="{{ route('UserInfo') }}"><i
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
    </nav>
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center">
            <a onclick="closeSidebar()"><i class="fa-solid fa-circle-xmark fa-2x"></i></a>
        </div>
        <div class="sidebar-content">
            <h5>Category</h5>
            <div class="container">
                <div class="row">
                    <div class="col-6 d-flex flex-column">
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Ac</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Air Cooler</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>TV</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Fridge</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Washing Machine</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Rice Cooker</a>
                    </div>
                    <div class="col-6 d-flex flex-column">
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Oven</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Blender</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Dish Washer</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Chimney</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Electric Stove</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Ceiling Fan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-content mt-3">
            <h5>Company</h5>
            <div class="container">
                <div class="row">
                    <div class="col-6 d-flex flex-column">
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Ac</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Air Cooler</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>TV</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Fridge</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Washing Machine</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Rice Cooker</a>
                    </div>
                    <div class="col-6 d-flex flex-column">
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Oven</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Blender</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Dish Washer</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Chimney</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Electric Stove</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Ceiling Fan</a>
                    </div>
                    <div class="col-6 d-flex flex-column">
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Toaster</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Blender</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Dish Washer</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Chimney</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Electric Stove</a>
                        <a href="#" class="text-decoration-none mb-2" style="color: black;"><i
                                class="fa-solid fa-square"></i>Ceiling Fan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div id="overlay" class="overlay" onclick="closeSidebar()">
    </div>
    <div class="fixed-bottom d-flex flex-column align-items-end">
        <div>
            <a href="{{ route('Orders') }}"
                class="d-flex justify-content-center align-items-center position-fixed bg-transparent border-0 mb-2"
                style="inset-inline-end:10px; inset-block-end:85px; color:#081621; z-index:1030;">
                <div class="btn-box text-center">
                    <i class="fa-solid fa-bag-shopping fa-2x"></i>
                    <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill text-white bg-danger"
                        style="transform: translate(1%, -60%);">
                    </span>
                    <p class="fw-bold">Orders</p>
                </div>
            </a>
        </div>

        <div>
            <a href="{{ route('Cart') }}"
                class="d-flex jus   -mt-pxtify-content-center align-items-center position-fixed bg-transparent border-0 mb-2"
                style="inset-inline-end:10px; inset-block-end:10px; color:#081621; z-index:1030;">
                <div class="btn-box text-center position-relative">
                    <i class="fa-solid fa-cart-plus fa-2x"></i>
                    <span id="cartCount"
                        class="position-absolute top-0 end-0 translate-middle badge rounded-pill text-white bg-danger"
                        style="transform: translate(1%, -60%);">
                        {{ count(session('cart', [])) }}
                    </span>
                    <p class="fw-bold">Cartss</p>
                </div>
            </a>

        </div>
    </div>


    <div class="container-fluid mt-5">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('ASSATS/JS/LOGINSIGNUP.js') }}"></script>
    <script src="{{ asset('ASSATS/JS/SCRIPT.js') }}"></script>
</body>

</html>
