@extends('ADMIN.Admin')
@section('title', 'Admin Home')

@section('content')
    <div class="container-fluid pl-5 pt-4 ml-3 justify-content-center align-items-center">
        <div class="card card-body">
            <div class="container d-flex justify-content-between" style="border:2px solid border-radius: 15px;">
                <div class="">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()->admin_name) }}&background=7a4eb0&color=fff&size=100"
                        class="rounded-circle mb-3" alt="Profile Picture">

                    <h4 class="">{{ Auth::guard('admin')->user()->admin_name }}</h4>
                    <p class="text">{{ Auth::guard('admin')->user()->email }}</p>
                </div>
                <div>
                    <form action="{{ route('AdminLogout') }}" method="POST">
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

