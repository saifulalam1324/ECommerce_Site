@extends('VENDORPANEL.Vendor')
@section('title', 'Washing Machine List')
@section('content')
    <div class="container text-center">
        <h2>Washing Machine</h2>
    </div>
    <div class="container-fluid ml-3 justify-content-center align-items-center">
        <div class="container-fluid fixed-top border-0 p-2 mb-5" style="background-color:#081621;">
            <h2 class="text-white text-center">Products</h2>
        </div>

        @if (session('info'))
            <div class="alert alert-info mt-5">
                {{ session('info') }}
            </div>
        @endif

        @if ($products->isEmpty())
            <div class="alert alert-danger mt-5 container">
                No Product found. Add Some!
            </div>
        @endif


        @foreach ($products as $product)
            <div class="container mt-4 card p-3">
                <div class="card-header text-white" style="background-color:#081621;">
                    <strong>Product ID:</strong> {{ $product->product_id ?? 'N/A' }}
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> {{ $product->product_name }}</li>
                        <li class="list-group-item"><strong>Quantity:</strong> {{ $product->stock_quantity }}</li>
                    </ul>
                    <div class="text-end mt-3 d-flex">
                        <form action="{{ route('Deleteproduct', $product->product_id) }}" method="Post">
                            @csrf
                            <button class="btn text-white" type="submit" style="background-color: #081621;">Wipe Out</button>
                        </form>
                        <a href="{{ route('viewupdatepage', $product->product_id) }}" class="btn text-white ml-1"
                            style="background-color: #081621;">
                            Update Products Info
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>

@endsection
