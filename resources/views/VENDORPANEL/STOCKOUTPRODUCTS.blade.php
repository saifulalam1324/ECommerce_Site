@extends('VENDORPANEL.Vendor')
@section('title', 'Stockouted Products')

@section('content')
    @if (session('info'))
        <div class="alert alert-info mt-5">
            {{ session('info') }}
        </div>
    @endif

    @if ($Products->isEmpty())
        <div class="alert alert-danger container">
            <p>No Product found</p>
        </div>
    @endif

    @foreach ($Products as $product)
        <div class="container mt-4 card p-3">
            <div class="card-header text-white" style="background-color: #081621;">
                <strong>Product ID:</strong> {{ $product->product_id ?? 'N/A' }}
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name:</strong> {{ $product->product_name }}</li>
                    <li class="list-group-item"><strong>Quantity:</strong><strong class="text-danger">
                            {{ $product->stock_quantity }}</strong></li>
                    <li class="list-group-item">
                        <div class="mt-3 d-flex">
                            <form action="{{ route('restocked', $product->product_id)}}" class="d-flex" method="Post">
                                @csrf
                                <input type="number" name="stock" id="stock" class="form-control" placeholder="Enter Quantity">
                                <button class="btn btn-success w-100 text-white ml-2" type="submit">re stock</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center mt-4">
        {{ $Products->links() }}
    </div>
    </div>
@endsection