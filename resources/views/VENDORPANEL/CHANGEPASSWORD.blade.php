@extends('VENDORPANEL.Vendor')
@section('title', 'Change Password')
@section('content')
    <div class="container mt-5 justify-content-center align-items-center d-flex">
        <div class="card p-4" style="inline-size: 500px; block-size: 380px;">
            <h3 class="mb-3 text-center">Change Password</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('Passchangev') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="current_password" required>
                    @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" required>
                    @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="new_password_confirmation" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn text-white" style="background-color:#081621">Update Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
