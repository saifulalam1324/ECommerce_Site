@extends('USER.User')
@section('title', 'HOME')
@section('content')

    <div class="container-fluid mt-lg-3">
        <div class="row">
            @foreach ($products as $id => $data)
                <div class="col-2">
                    <div class="card product-card shadow-lg">
                        <div class="position-relative">
                            <div>
                                <img src="{{ asset('storage/' . $data->image_url) }}" class="product-img card-img-top"
                                    alt="{{ $data->product_name }}">
                            </div>
                            <div class="d-flex justify-content-end card-img-overlay">
                                <a href="#"><i class="fa-regular fa-heart" style="color: #7a4eb0;"></i></a>
                                <a href="{{ route('Each Product', $data->product_id) }}"><i class="fa-solid fa-eye"
                                        style="color: #7a4eb0;"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <p class="product-title">{{$data->product_name}}</p>
                                <p class="product-price ">price:{{ $data->price}}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                    <a href="#"><i class="fa-solid fa-cart-shopping" style="color:#7a4eb0;"></i></a>

                                    @if ($data->stock_quantity == 0)
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
@endsection
