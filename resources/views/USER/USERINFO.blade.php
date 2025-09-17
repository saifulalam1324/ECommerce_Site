@extends('USER.User')
@section('title', 'User Info')
@section('content')
    <div class="container">
        <div class="container d-flex justify-content-center align-items-start flex-column mt-5">
            <h1 class="justify-content-start">{{Auth::guard('customer')->user()->full_name}}</h1>
        </div>
        <div class="container d-flex justify-content-center align-items-center flex-column mt-1">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <p><strong>Email:</strong> {{ Auth::guard('customer')->user()->email }}</p>
                    </div>
                    <div class="col-4">
                        <p><strong>Phone:</strong> {{ Auth::guard('customer')->user()->phone }}</p>
                    </div>
                    <div class="col-4">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
