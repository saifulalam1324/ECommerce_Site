@extends('USER.User')
@section('title', 'HOME')

@section('content')
    <div class="container-fluid mt-lg-4">
        <div class="row">
            @if ($products->isEmpty())
                <div class="alert alert-danger mt-5">
                    No Products Available.
                </div>
            @endif

            @foreach ($products as $id => $data)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                    <div class="card product-card shadow-lg">
                        <div class="position-relative">
                            <span class="badge badge-danger position-absolute"
                                style="inset-block-start: 10px; inset-inline-start: 10px; font-size: 0.8rem;">
                                -20%
                            </span>
                            <div>
                                <img src="{{ asset('storage/' . $data->image_url) }}" class="product-img card-img-top img-fluid"
                                    alt="{{ $data->product_name ?? 'Product image' }}">
                            </div>
                            <div class="d-flex justify-content-end card-img-overlay">
                                <a href="{{ route('Each Product', $data->product_id) }}">
                                    <i class="fa-solid fa-eye" style="color: #7a4eb0;"></i>
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <span><strong>{{ $data->product_name }}</strong></span>
                            <span>Price: $<strong>{{ $data->price }}</strong></span>
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($data->stock_quantity <= 0)
                                    <button class="btn border-0 disabled" title="Add to cart">
                                        <i class="fa-solid fa-cart-shopping" style="color:#7a4eb0;"></i>
                                    </button>
                                @elseif (session('cart') && array_key_exists($data->product_id, session('cart')))
                                    <a href="{{ route('Cart') }}" class="btn border-0" title="Go to cart">
                                        <i class="fa-solid fa-cart-shopping" style="color:#7a4eb0;"></i>
                                    </a>
                                @else
                                    <form action="{{ route('Addtocart', $data->product_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn border-0 bg-transparent" title="Add to cart">
                                            <i class="fa-solid fa-cart-shopping" style="color:#7a4eb0;"></i>
                                        </button>
                                    </form>
                                @endif
                                @if ($data->stock_quantity <= 0)
                                    <h6><span class="badge badge-danger">Stock Out</span></h6>
                                @else
                                    <h6><span class="badge badge-success">Available</span></h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container my-4">
        <div class="row g-4 text-center">
            <div class="container justify-content-center">
                <h1>Featured Category</h1>
                <p>Get Your Desired Product from Featured Category</p>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
                    <div class="card shadow-lg h-100 btn">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                            <div class="mb-2">
                                <img src="{{ asset('ASSATS/PICTURE/vacuum_17954620.png') }}" alt=""
                                    style="inline-size: 40px; block-size: 40px;">
                            </div>
                            <h6 class="fw-bold">Vacuum clener</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-4">
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
                <a href="#" class=" text-decoration-none">
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
@endsection
