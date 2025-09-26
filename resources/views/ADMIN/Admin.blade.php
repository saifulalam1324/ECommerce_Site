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
                    style="inline-size:180px; inset-inline-start:0; inset-block-start:0; background-color:#7a4eb0;">
                    <div class="container-fluid p-0 d-flex flex-column h-100 ">
                        <ul class="navbar-nav flex-column w-100 pl-3 pt-3 mt-5">
                            <li class="nav-item"><a class="nav-link text-white" href="{{route('Admin home')}}">Home</a>
                            </li>
                            <li class="nav-item"><a class="nav-link text-white" href="{{route('All users')}}">Users</a>
                            </li>
                            <li class="nav-item"><a class="nav-link text-white"
                                    href="{{route('All vendors')}}">Vendors</a></li>
                            <li class="nav-item"><a class="nav-link text-white"
                                    href="{{route('VendorsRequests')}}">Vendors Requests</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="{{route('AllOrders')}}">Pending
                                    Orders</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="{{route('ShippedOrders')}}">Shipped
                                    Orders</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="{{route('CompletedOrders')}}">Completed
                                    Orders</a></li>
                        </ul>
                        <div class="mt-auto w-100 bg-dark">
                            <ul class="navbar-nav flex-column w-100 p-2">
                                <li class="nav-item">
                                    <h4 class="text-white">Your Market</h4>
                                </li>
                                <li class="nav-item"><a class="nav-link NAV" href="{{ route('AdminProfile') }}">
                                        <p><i class="fa-solid fa-user" style="color:white;"></i>
                                            {{Auth::guard('admin')->user()->admin_name}}</p>
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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</body>

</html>
