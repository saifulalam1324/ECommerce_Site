<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('ASSATS/CSS/STYLE1.css') }}">

</head>

<body>
    <div class="container-fluid overflow-hidden">
        <div class="row">
            <div class="col-1 p-0">
                <nav class="navbar navbar-light flex-column vh-100 p-0 position-fixed shadow-lg"
                    style="inline-size:180px; inset-inline-start:0; inset-block-start:0; background-color:#081621;">
                    <div class="container-fluid p-0 d-flex flex-column h-100">
                        <ul class="navbar-nav flex-column w-100 pt-3 mt-5">
                            <li class="nav-item d-flex justify-content-center">
                                <a class="btn w-100 ml-1 mr-1 mb-1 btn-outline-light {{ request()->routeIs('Vendor home') ? 'active' : '' }}"
                                    href="{{ route('Vendor home') }}">Home</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="btn w-100 ml-1 mr-1 mb-1 text-center btn-outline-light {{ request()->routeIs('Add product') ? 'active' : '' }}"
                                    href="{{ route('Add product') }}">Add Product</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="btn w-100 ml-1 mr-1 mb-1 text-center btn-outline-light {{ request()->routeIs('BatchOrders') ? 'active' : '' }}"
                                    href="{{ route('BatchOrders') }}">Pending Orders</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="btn w-100 ml-1 mr-1 mb-1 text-center btn-outline-light {{ request()->routeIs('ShippedOrders') ? 'active' : '' }}"
                                    href="#">Shipped Orders</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="btn w-100 ml-1 mr-1 mb-1 text-center btn-outline-light {{ request()->routeIs('CompletedOrders') ? 'active' : '' }}"
                                    href="#">Completed Orders</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="btn w-100 ml-1 mr-1 mb-1 text-center btn-outline-light {{ request()->routeIs('Products') ? 'active' : '' }}"
                                    href="{{ route('Products') }}">Your Products</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="btn w-100 ml-1 mr-1 mb-1 text-center btn-outline-light {{ request()->routeIs('StockoutProducts') ? 'active' : '' }}"
                                    href="{{ route('Stockoutproduct') }}">Stock Out Items</a>
                            </li>

                        </ul>
                        <div class="mt-auto w-100 bg-dark">
                            <ul class="navbar-nav flex-column w-100 p-2">
                                <li class="nav-item">
                                    <h4 class="text-white">Your Market</h4>
                                </li>
                                <li class="nav-item"><a class="nav-link NAV" href="{{ route('VendorProfile') }}">
                                        <p><i class="fa-solid fa-user" style="color:white;"></i>
                                            {{Auth::guard('vendor')->user()->company_name}}</p>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-11 p-0">
                <div class="container-fluid overflow-hidden">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
