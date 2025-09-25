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
            <div class="col-2 p-0">
                <nav class="navbar navbar-light flex-column vh-100 p-0 position-fixed shadow-lg"
                    style="inline-size:200px; inset-inline-start:0; inset-block-start:0; background-color:#7a4eb0;">
                    <div class="container-fluid p-0 d-flex flex-column h-100">
                        <ul class="navbar-nav flex-column w-100 pl-5 pt-5">
                            <li class="nav-item"><a class="nav-link NAV" href="{{route('Vendor home')}}">Home</a></li>
                            <li class="nav-item"><a class="nav-link NAV" href="{{ route('Add product') }}">Add
                                    Product</a></li>
                            <li class="nav-item"><a class="nav-link NAV" href="{{ route('BatchOrders') }}">Orders</a></li>
                            <li class="nav-item"><a class="nav-link NAV" href="#">Cart</a></li>
                        </ul>
                        <div class="mt-auto w-100 bg-dark">
                            <ul class="navbar-nav flex-column w-100 p-2">
                                <li class="nav-item">
                                    <h2 class="text-white">Your Market</h2>
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
            <div class="col-10 p-0">
                <div class="container-fluid">
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
