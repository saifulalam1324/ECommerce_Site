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
    <div class="container-fluid fixed-top border-0 p-2 mb-5" style="background-color: #081621;">
        <h2 class="text-white text-center">Admin Dashboards</h2>
    </div>
    <div class="container-fluid overflow-hidden">
        <div class="row">
            <div class="col-1 p-0">
                <nav class="navbar navbar-light flex-column vh-100 p-0 position-fixed shadow-lg"
                    style="inline-size:180px; inset-inline-start:0; inset-block-start:0; background-color:#081621;">
                    <div class="container-fluid p-0 d-flex flex-column h-100 ">
                        <ul class="navbar-nav flex-column w-100 pt-3 mt-5">
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('Admin home') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('Admin home') }}">Home</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1  mb-1 {{ request()->routeIs('All users') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('All users') }}">Users</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1  mb-1 {{ request()->routeIs('All vendors') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('All vendors') }}">Vendors</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1  mb-1 {{ request()->routeIs('VendorsRequests') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('VendorsRequests') }}">Vendors Requests</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1  mb-1 {{ request()->routeIs('AllOrders') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('AllOrders') }}">Pending Orders</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1  mb-1 {{ request()->routeIs('ShippedOrdersadmin') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('ShippedOrdersadmin') }}">Shipped Orders</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1  mb-1 {{ request()->routeIs('CompletedOrders') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('CompletedOrders') }}">Completed Orders</a>
                            </li>
                            <li class="nav-item mb-2">
                                <div class="dropdown ml-1" style="inline-size: 170px;">
                                    <button class="btn btn-outline-light w-100 text-start dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                        <p>Your Market</p>
                                        {{ Auth::guard('admin')->user()->admin_name }}
                                    </button>
                                    <div class="w-100 dropdown-menu dropdown-menu-center custom-dropdown bg-transparent"
                                        style="max-block-size: 200px; overflow-y: auto;"
                                        aria-labelledby="dropdownMenuButton">
                                        <form id="logoutForm" action="{{ route('AdminLogout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                            </button>
                                            <script>
                                                document.getElementById('logoutForm').addEventListener('submit', function (event) {
                                                    event.preventDefault();
                                                    if (confirm("Are you sure you want to logout?")) {
                                                        this.submit();
                                                    }
                                                });
                                            </script>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
