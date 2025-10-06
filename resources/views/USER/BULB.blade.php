@extends('USER.User')
@section('title', 'Bulb List')
@section('content')
    <div class="container text-center">
        <h1>Bulb</h1>
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
                            @if ($data->discount > 0)
                                <span class="badge position-absolute text-white"
                                    style="inset-block-start: 10px; inset-inline-start: 10px; font-size: 0.8rem; background-color: #081621;">
                                    -{{ $data->discount }}%
                                </span>
                            @endif
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
                                        @if ($data->discount > 0)
                                            <p><strong>Discount:</strong> {{ $data->discount }}%</p>
                                        @endif
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
