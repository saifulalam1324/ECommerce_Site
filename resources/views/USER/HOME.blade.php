@extends('USER.User')
@section('title', 'HOME')
@section('content')

    <div class="container-fluid mt-lg-3">
        <div class="row">
            @foreach ($products as $id => $data)
                <div class="col-2">
                    <div class="card product-card position-relative shadow-lg">
                        <div class="position-relative">
                            <img src="{{ asset('storage/'.$data->image_url) }}" class="product-img card-img-top"
                                alt="{{ $data->product_name }}">
                            <div class="d-flex justify-content-between card-img-overlay">
                                <a href="#"><i class="fa-solid fa-eye" style="color: #7a4eb0;"></i></a>
                                <a href="#"><i class="fa-regular fa-heart" style="color: #7a4eb0;"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid d-flex justify-content-between">
                            <h5 class="product-title">{{$data->product_name}}</h5>
                                <p class="product-price ">price:{{ $data->price}}</p>
                            </div>
                            <a href="#"><i class="fa-solid fa-cart-shopping"style="color:#7a4eb0;"></i></a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
@endsection