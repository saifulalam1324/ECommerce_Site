@extends('USER.User')
@section('title', 'product Details')
@section('content')
    <div class="container-fluid pl-5 pt-4 ml-3 justify-content-center align-items-center">
        <div class="card text-left">
            <div class="card-body">
                @foreach ($product1s as $id => $data1)
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">{{$data1->product_name}}</p>
                    <p class="card-text">{{$data1->description}}</p>
                    <p class="card-text">{{$data1->price}}</p>
                    <p class="card-text">{{$data1->stock_quantity}}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
