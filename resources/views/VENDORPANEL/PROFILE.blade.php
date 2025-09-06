@extends('VENDORPANEL.Vendor')
@section('title', 'Admin Home')

@section('content')
    <div class="container-fluid pl-5 pt-4 ml-3 justify-content-center align-items-center">
        <div class="card card-body">
            <div class="container d-flex justify-content-between" style="border:2px solid border-radius: 15px;">
                <div class="">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('vendor')->user()->admin_name) }}&background=7a4eb0&color=fff&size=100"
                        class="rounded-circle mb-3" alt="Profile Picture">

                    <h4 class="">{{ Auth::guard('vendor')->user()->company_name }}</h4>
                    <p class="text">{{ Auth::guard('vendor')->user()->email }}</p>
                </div>
                <div>
                    <form action="{{ route('VendorLogout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block mt-3"><i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

