@extends('USER.User')
@section('title', 'Login/Signup')

@section('content')
    <link rel="stylesheet" href="{{ asset('ASSATS/CSS/LOGINSIGNUP.css') }}">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show div container" role="alert">
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
    <div class="container-fluid mt-lg-1 my-5 p-5">
        <div class="container overflow-hidden" id="container">

            <div class="form-container sign-up">
                <form action="{{ route('UserSignup') }}" method="POST">
                    @csrf
                    <h1>Create Account</h1>
                    <input type="text" name="name" placeholder="Name" required value="{{ old('name') }}" />
                    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}" />
                    <input type="password" name="password" placeholder="Password" required value="{{ old('password') }}" />
                    <input type="tel" name="phone" placeholder="Phone Number" required value="{{ old('phone') }}" />
                    <input type="text" name="address" placeholder="Address" required value="{{ old('address') }}" />
                    <button type="submit">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in">
                <form action="{{ route('UserLogin') }}" method="POST">
                    @csrf
                    <h1>Sign In</h1>
                    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}" />
                    <input type="password" name="password" placeholder="Password" required value="{{ old('password') }}" />
                    <a href="#">Forget Your Password?</a>
                    <button type="submit">Sign In</button>
                </form>
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome Back!</h1>
                        <p>Enter your personal details to use all of site features</p>
                        <button class="hidden" id="login">Sign In</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Hello, Friend!</h1>
                        <p>Register with your personal details to use all of site features</p>
                        <button class="hidden" id="register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('ASSATS/JS/LOGINSIGNUP.js') }}"></script>
@endsection
