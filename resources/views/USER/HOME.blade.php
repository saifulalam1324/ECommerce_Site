@extends('USER.User')
@section('title', 'HOME')

@section('content')

    <div class="container mt-lg-5" style="border-radius: 10px">
        <div class="row">
            <div class="col-9">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"
                            style="background-color:#081621; inline-size: 60px;"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"
                            style="background-color:#081621 ;inline-size: 60px;"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"
                            style="background-color:#081621 ;inline-size: 60px;"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('ASSATS/PICTURE/banner2.png') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('ASSATS/PICTURE/banner3.png') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('ASSATS/PICTURE/banner5.png') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 bg-dark align-content-center">
                <h5 class="text-white text-center">Your Market</h5>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="row g-4 text-center">
            <div class="container justify-content-center">
                <h1>Featured Category</h1>
                <p>Get Your Desired Product from Featured Category</p>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('ACC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/ac_11036490.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Ac</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-4">
                <a href="{{ route('AirCoolerC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/air-cooler_17844831.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Air Cooler</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-4">
                <a href="{{ route('TVC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/television_2593966.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Tv</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('FridgeC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/fridge_5909568.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Fridge</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('WashingMachineC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/washing-machine_1104590.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Wasing Machine</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('OvenC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/oven_18766209.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Oven</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="row g-4 text-center">
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('BlenderC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/blender_15447781.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Blender</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-4">
                <a href="{{ route('DishWasherC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/dishwasher_3095436.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Dish Washer</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-4">
                <a href="{{ route('ChimneyC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/extractor_1098332.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Chymni</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('ElectricStoveC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/electric-stove_8426510.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Electric Stove</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('RiceCookerC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/rice-cooker_8354616.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Rice Cooker</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('CeilingFanC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/ceiling_16431236.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Celling Fan</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="row g-4 text-center">
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('ToasterC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/food_13645721.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Toaster</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-4">
                <a href="{{ route('VacuumCleanerC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/vacuum_17954620.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Vacuum Cleaner</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-4">
                <a href="{{ route('WaterHeaterC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/kitchen_13638980.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Water Heater</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('BulbC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/light-bulb_148561.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Bulb</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('IronC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/iron_6524411.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Iron</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="{{ route('AirPurifierC') }}" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/smart_15730603.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Air Purifier</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container text-center mt-5">
        <h1>Featured Discounts</h1>
        <p>Get Your Desired Product With Discount</p>
    </div>
    <div class="container-fluid mt-lg-4">
        <div class="row">
            @if ($products->isEmpty())
                <div class="alert alert-danger mt-5 w-100 text-center">
                    No Products Available.
                </div>
            @endif
            @foreach ($products as $id => $data)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4">
                    <div class="card product-card shadow-sm h-100">
                        <div class="position-relative">
                            <span class="badge badge-danger position-absolute"
                                style="inset-block-start: 10px; inset-inline-start: 10px; font-size: 0.8rem;">
                                -{{ $data->discount }}%
                            </span>
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $data->image_url) }}" class="product-img card-img-top img-fluid"
                                    alt="{{ $data->product_name ?? 'Product image' }}"
                                    style="object-fit: contain; max-block-size: 180px;">
                            </div>
                            <div class="d-flex justify-content-end card-img-overlay">
                                <a href="javascript:void(0)" data-toggle="modal"
                                    data-target="#productModal{{ $data->product_id }}">
                                    <i class="fa-solid fa-eye fs-5" style="color: #081621"></i>
                                </a>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="mb-2">
                                <span class="d-block fw-bold text-truncate">{{ $data->product_name }}</span>
                                <small>Price: $<strong>{{ $data->price }}</strong></small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                @if (Auth::guard('customer')->check())
                                    @if ($data->stock_quantity <= 0)
                                        <button class="btn border-0 disabled" title="Add to cart">
                                            <i class="fa-solid fa-cart-shopping" style="color:#081621;"></i>
                                        </button>
                                    @elseif (session('cart') && array_key_exists($data->product_id, session('cart')))
                                        <a href="{{ route('Cart') }}" class="btn border-0" title="Go to cart">
                                            <i class="fa-solid fa-cart-shopping" style="color:#081621;"></i>
                                        </a>
                                    @else
                                        <form action="{{ route('Addtocart', $data->product_id) }}" method="POST"
                                            class="ajaxAddToCartForm d-inline">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn add-to-cart-btn border-0 bg-transparent"
                                                title="Add to cart">
                                                <i class="fa-solid fa-cart-shopping" style="color:#081621;"></i>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <button class="btn border-0 disabled" title="Login To Buy">
                                        <i class="fa-solid fa-cart-shopping" style="color:#081621;"></i>
                                    </button>
                                @endif
                                @if ($data->stock_quantity <= 0)
                                    <span class="badge badge-danger">Stock Out</span>
                                @else
                                    <span class="badge badge-success">Available</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade m-5" id="productModal{{ $data->product_id }}" tabindex="-1" role="dialog"
                    aria-labelledby="productModalLabel{{ $data->product_id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#081621;">
                                <h5 class="modal-title text-white" id="productModalLabel{{ $data->product_id }}">
                                    {{ $data->product_name }}
                                </h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-5 text-center">
                                        <img src="{{ asset('storage/' . $data->image_url) }}" class="img-fluid"
                                            alt="{{ $data->product_name }}">
                                    </div>
                                    <div class="col-md-7">
                                        <h4>${{ $data->price }}</h4>
                                        <p><strong>Discount:</strong> {{ $data->discount }}%</p>
                                        <p><strong>Stock:</strong>
                                            @if($data->stock_quantity > 0)
                                                <span class="text-success">Available</span>
                                            @else
                                                <span class="text-danger">Out of stock</span>
                                            @endif
                                        </p>
                                        <p><strong>Description:</strong></p>
                                        <p>{{ $data->description ?? 'No description available.' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                @if (Auth::guard('customer')->check())
                                    @if ($data->stock_quantity <= 0)
                                        <button class="btn border-0 disabled" title="Add to cart">
                                            <i class="fa-solid fa-cart-shopping" style="color:#081621;"></i>
                                        </button>
                                    @elseif (session('cart') && array_key_exists($data->product_id, session('cart')))
                                        <a href="{{ route('Cart') }}" class="btn border-0" title="Go to cart">
                                            <i class="fa-solid fa-cart-shopping" style="color:#081621;"></i>
                                        </a>
                                    @else
                                        <form action="{{ route('Addtocart', $data->product_id) }}" method="POST"
                                            class="ajaxAddToCartForm d-inline">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn add-to-cart-btn border-0 bg-transparent"
                                                title="Add to cart">
                                                <i class="fa-solid fa-cart-shopping" style="color:#081621;"></i>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <button class="btn border-0 disabled" title="Login To Buy">
                                        <i class="fa-solid fa-cart-shopping" style="color:#081621;"></i>
                                    </button>
                                @endif
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".ajaxAddToCartForm").on("submit", function (e) {
                e.preventDefault();
                let form = $(this);
                let button = form.find("button");
                let url = form.attr("action");
                button.prop("disabled", true);
                $.ajax({
                    url: url,
                    method: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        alert("Product added to cart!");
                        let countEl = $("#cartCount");
                        let count = parseInt(countEl.text()) || 0;
                        countEl.text(count + 1);
                        form.replaceWith(`
                        <a href="{{ route('Cart') }}" class="btn border-0" title="Go to cart">
                        <i class="fa-solid fa-cart-shopping" style="color:#081621;"></i></a>
                    `);
                    },
                    error: function (xhr) {
                        if (xhr.status === 401 && xhr.responseJSON?.login === false) {
                            window.location.href = xhr.responseJSON.redirect;
                        } else if (xhr.status === 404) {
                            alert("Product not found!");
                        } else {
                            alert("Something went wrong!");
                        }
                    },
                    complete: function () {
                        button.prop("disabled", false);
                    }
                });
            });
        });
    </script>
@endsection
