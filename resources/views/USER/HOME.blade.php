@extends('USER.User')
@section('title', 'HOME')

@section('content')
    <div class="container-fluid mt-lg-4">
        <div class="row">
            @foreach ($products as $id => $data)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                    <div class="card product-card shadow-lg">
                        <div class="position-relative">
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
                            <p class="product-title">{{ $data->product_name }}</p>
                            <p class="product-price">Price: {{ $data->price }}</p>

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
@endsection
