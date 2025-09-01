@extends('VENDORPANEL.Vendor')
@section('title', 'Add Product')
@section('content')
    <div class="container pt-5">
        <div class="card shadow-lg">
            <div class="card-header" style="background-color: #7a4eb0;">
                <h5 class="text-center text-white">Add New Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('Store product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control">
                            <span class="text-danger">
                                @error('product_name')
                                    {{ $message }}
                                @enderror

                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control">
                            <span class="text-danger">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control"
                            style="block-size: 100px; resize: none;"></textarea>
                        <span class="text-danger">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </span>                    
                    </div>
                    <div class="form-group">
                        <label for="product_model">Model</label>
                        <input type="text" name="model" id="product_model" class="form-control">
                        <span class="text-danger">
                            @error('model')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="stock">Quantity</label>
                            <input type="number" name="stock" id="stock" class="form-control">
                            <span class="text-danger">
                                @error('stock')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                <option value="TV">TV</option>
                                <option value="AC">AC</option>
                                <option value="Fridge">Fridge</option>
                                <option value="Fridge">Smart Watch</option>
                            </select>
                            <span class="text-danger">
                                @error('category')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Picture</label>
                        <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                        <span class="text-danger">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn text-white" style="background-color: #7a4eb0;">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection