@extends('VENDORPANEL.Vendor')
@section('title', 'profile')
@section('content')
    <div class="container">
        <div class="container d-flex justify-content-center align-items-center mt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="justify-content-start"><i
                                class="fa-solid fa-circle-user"></i>{{Auth::guard('vendor')->user()->company_name}}</h1>
                    </div>
                </div>
                <div class="container my-4">

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('Passpagev') }}" class=" text-decoration-none">
                            <div class="card shadow-lg h-100 btn">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                                    <h6 class="fw-bold">Change Password</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
