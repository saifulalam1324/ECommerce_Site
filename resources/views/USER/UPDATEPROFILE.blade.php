@extends('USER.User')
@section('title', 'Update Profile')
@section('content')
    <div class="container mt-5 justify-content-center align-items-center d-flex">
        <div class="card p-4" style="inline-size: 500px; block-size: auto;">
            <h3 class="mb-3 text-center">Update Info</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('Updateprofile') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name"
                        value="{{ old('name', Auth::guard('customer')->user()->full_name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="Address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address"
                        value="{{ old('address', Auth::guard('customer')->user()->address) }}" required>
                </div>
                <div class="mb-3">
                    <label for="Phone Number" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" name="phone"
                        value="{{ old('phone', Auth::guard('customer')->user()->phone_number) }}" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn text-white" style="background-color:#081621">
                        Update Info
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
