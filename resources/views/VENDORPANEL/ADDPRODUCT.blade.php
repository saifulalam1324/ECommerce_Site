@extends('VENDORPANEL.Vendor')
@section('title', 'Add Product')
@section('content')
    <div class="container mt-1 ">
        <div class="card shadow-lg">
            <div class="card-header text-white" style="background-color:#081621">
                <h3 class="text-center">Add New Product</h3>
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
            <form action="{{ route('Store product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control"
                            value="{{ old('product_name') }}">
                        <span class="text-danger">
                            @error('product_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control"
                            value="{{ old('price') }}">
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
                    <input type="text" name="model" id="product_model" class="form-control"
                        value="{{ old('model') }}">
                    <span class="text-danger">
                        @error('model')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="stock">Quantity</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                            value="{{ old('stock') }}">
                        <span class="text-danger">
                            @error('stock')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="stock">Discount</label>
                        <input type="number" name="discount" id="discount" class="form-control"
                            value="{{ old('discount') }}">
                        <span class="text-danger">
                            @error('discount')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control" value="{{ old('category') }}">
                            <option value="">Select Category</option>
                            <option value="Ac">AC</option>
                            <option value="Air Cooler">Air Cooler</option>
                            <option value="Tv">TV</option>
                            <option value="Fridge">Fridge</option>
                            <option value="Washing Machine">Washing Machine</option>
                            <option value="Oven">Oven</option>
                            <option value="Blender">Blender</option>
                            <option value="Dish Washer">Dish Washer</option>
                            <option value="Chimney">Chimney</option>
                            <option value="Electric Stove">Electric Stove</option>
                            <option value="Rice Cooker">Rice Cooker</option>
                            <option value="Ceiling Fan">Ceiling Fan</option>
                            <option value="Toaster">Toaster</option>
                            <option value="Vacuum Cleaner">Vacuum Cleaner</option>
                            <option value="Water Heater">Water Heater</option>
                            <option value="Bulb">Bulb</option>
                            <option value="Iron">Iron</option>
                            <option value="Air Purifier">Air Purifier</option>
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
                    <input type="file" name="image" id="image" class="form-control-file" accept="image/*"
                        value="{{ old('image') }}">
                    <span class="text-danger">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn text-white" style="background-color:#081621">
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
