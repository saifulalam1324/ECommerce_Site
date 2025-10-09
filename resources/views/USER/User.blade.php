<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('ASSATS/CSS/STYLE.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <style>
        .ui-autocomplete {
            z-index: 2000;
            background: white;
            border-radius: 8px;
            padding: 5px;
        }

        .ui-menu-item-wrapper:hover {
            background: #081621;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #081621;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center justify-content-start">
                <button class="btn text-white mr-3" onclick="openSidebar()" style="border: none;">
                    <i class="fa-solid fa-bars fa-lg"></i>
                </button>
                <a class="navbar-brand text-white font-weight-bold" href="{{ route('User home') }}">
                    YOUR MARKET
                </a>
            </div>
            <div class="d-none d-lg-block w-50 text-center">
                <form class="search-form d-flex justify-content-center" action="#" method="get">
                    @csrf
                    <input type="search" id="search" class="form-control search-input w-75"
                        placeholder="Search products..." aria-label="Search" aria-describedby="search" name="search">
                    <button type="submit" class="btn btn-outline-light ml-1" style="border-radius: 10%;">
                        <i class="fa fa-search"></i>
                    </button>
                </form>

            </div>
            <div id="content" class="mt-4"></div>
            <div class="d-flex align-items-center">
                @if (Auth::guard('customer')->check())
                    <div class="dropdown text-center">
                        <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user"></i> {{ Auth::guard('customer')->user()->full_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right bg-transparent border-0">
                            <div class="d-flex justify-content-center">
                                <form id="logoutForm" action="{{ route('UserLogout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" title="Logout">
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
                                <a class="btn btn-success ml-2" href="{{ route('UserInfo') }}" title="Profile Info">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <a class="btn btn-outline-light ml-2" href="{{ route('LoginSignup') }}">Sign In</a>
                @endif
            </div>
        </div>
    </nav>

    <div id="sidebar" class="sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center">
            <a onclick="closeSidebar()"><i class="fa-solid fa-circle-xmark fa-2x"></i></a>
        </div>
        <div class="sidebar-content">
            <h2>Companys</h2>
            @php
                $i = 1;
            @endphp
            @foreach ($company as $item)
                <p><strong>{{ $i++ }}: {{$item->company_name}}</strong></p>
            @endforeach
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
                        {{$counts}}
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
    <footer class="text-white pt-4 pb-3 mt-5" style="background-color:#081621;">
        <div class="container">
            <div class="row text-center text-md-left">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Your Market</h5>
                    <p>Your trusted online marketplace for electronics, home appliances, and more.
                        Fast delivery and quality products—every time.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('User home') }}" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="{{ route('Cart') }}" class="text-white text-decoration-none">Cart</a></li>
                        <li><a href="{{ route('Orders') }}" class="text-white text-decoration-none">Orders</a></li>
                        <li><a href="{{ route('LoginSignup') }}" class="text-white text-decoration-none">Sign In</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Contact Us</h5>
                    <p><i class="fa-solid fa-location-dot"></i> Chittagong, Bangladesh</p>
                    <p><i class="fa-solid fa-envelope"></i> support@yourmarket.com</p>
                    <p><i class="fa-solid fa-phone"></i> +880 1625 933020</p>
                    <div class="mt-2">
                        <a href="#" class="text-white mr-2"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white mr-2"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white mr-2"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
            </div>

            <hr class="bg-light">

            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Your Market. All Rights Reserved.</p>
            </div>
        </div>
    </footer>


    <script>
        $(document).ready(function () {
            $("#search").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('Search') }}",
                        data: { term: request.term },
                        dataType: "json",
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                minLength: 1,
                select: function (event, ui) {
                    window.location.href = "/product/" + ui.item.id;
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('ASSATS/JS/LOGINSIGNUP.js') }}"></script>
    <script src="{{ asset('ASSATS/JS/SCRIPT.js') }}"></script>
</body>

</html>
