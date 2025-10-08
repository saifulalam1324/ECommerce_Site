@extends('USER.User')
@section('title', 'User Info')
@section('content')
    <div class="container">
        <div class="container d-flex justify-content-center align-items-center mt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="justify-content-start"><i
                                class="fa-solid fa-circle-user"></i>{{Auth::guard('customer')->user()->full_name}}</h1>
                    </div>
                </div>
                <div class="container my-4">
                    <div class="row g-4 text-center">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('Orders') }}" class=" text-decoration-none">
                                <div class="card shadow-lg h-100 btn">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                                        <h6 class="fw-bold">Orders</h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('Showupdateprofile') }}" class=" text-decoration-none">
                                <div class="card shadow-lg h-100 btn">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                                        <h6 class="fw-bold">Edit Profile</h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('Passpagec') }}" class=" text-decoration-none">
                                <div class="card shadow-lg h-100 btn">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                                        <h6 class="fw-bold">Change Password</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('Trans') }}" class=" text-decoration-none">
                                <div class="card shadow-lg h-100 btn">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                                        <h6 class="fw-bold">Your Transaction</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('Paymentpage') }}" class=" text-decoration-none">
                                <div class="card shadow-lg h-100 btn">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-5">
                                        <h6 class="fw-bold">Pending Payments</h6>
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
