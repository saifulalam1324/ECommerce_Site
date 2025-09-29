@extends('VENDORPANEL.Vendor')
@section('title', 'Products')

@section('content')
    <div class="container-fluid pl-5 pt-4 mt-5 ml-3 justify-content-center align-items-center">
        <div class="container-fluid fixed-top border-0 p-2 mb-5" style="background-color: #7a4eb0;">
            <h2 class="text-white text-center">Products</h2>
        </div>

        @if (session('info'))
            <div class="alert alert-info mt-5">
                {{ session('info') }}
            </div>
        @endif

        @if ($products->isEmpty())
            <div class="alert alert-danger mt-5">
                No Product found. Add Some!
            </div>
        @endif

        @foreach ($products as $product)
            <div class="container mt-4 card p-3">
                <div class="card-header text-white" style="background-color: #7a4eb0;">
                    <strong>Product ID:</strong> {{ $product->product_id ?? 'N/A' }}
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> {{ $product->product_name }}</li>
                        <li class="list-group-item"><strong>Quantity:</strong> {{ $product->stock_quantity }}</li>
                        {{-- <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone_number }}</li> --}}
                    </ul>
                    <div class="text-end mt-3 d-flex">
                        <form action="{{ route('Deleteproduct',$product->product_id) }}" method="Post">
                            @csrf
                            <button class="btn btn-danger" type="submit">Wipe Out</button>
                        </form>
                        <a href="#" class="btn btn-success text-white ml-1">
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
