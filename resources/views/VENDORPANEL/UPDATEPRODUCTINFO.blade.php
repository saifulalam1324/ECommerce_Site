@extends('VENDORPANEL.Vendor')
@section('title', 'Update Product')
@section('content')
<div class="container mt-1">
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color:#081621">
            <h3 class="text-center">Update Product</h3>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('Updateproduct', $product->product_id) }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" class="form-control"
                        value="{{ old('product_name', $product->product_name) }}">
                    @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control"
                        value="{{ old('price', $product->price) }}">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3" class="form-control"
                    style="block-size: 100px; resize: none;">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_model">Model</label>
                <input type="text" name="model" id="product_model" class="form-control"
                    value="{{ old('model', $product->model) }}">
                @error('model')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="stock">Add Quantity</label>
                    <input type="number" name="stock" id="stock" class="form-control"
                        value="{{ old('stock', 0) }}">
                    <small class="text-muted">Current stock: {{ $product->stock_quantity }}</small>
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="discount">Discount</label>
                    <input type="number" name="discount" id="discount" class="form-control"
                        value="{{ old('discount', $product->discount) }}">
                    @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn text-white btn-lg" style="background-color:#081621">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
