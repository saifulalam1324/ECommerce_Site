@extends('USER.User')
@section('title', 'Login/Signup')
@section('content')
    <link rel="stylesheet" href="{{ asset('ASSATS/CSS/LOGINSIGNUP.css') }}">
    <div class="container-fluied mt-lg-1 my-5 p-5">

        <div class="container" id="container">
            <div class="form-container sign-up">
                <form action="{{ route('UserSignup') }}" method="POST">
                    @csrf
                    <h1>Create Account</h1>
                    <div class="social-icons">
                    </div>
                    <input type="text" placeholder="Name" name="name" required />
                    <input type="email" placeholder="Email" name="email" required />
                    <input type="password" placeholder="Password" name="password" required />
                    <input type="tel" placeholder="Phone Number" name="phone" required />
                    <input type="text" placeholder="Address" name="address" required />
                    <button type="submit">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in">
                <form action="{{ route('UserLogin') }}" method="POST">
                    @csrf
                    <h1>Sign In</h1>
                    <div class="social-icons">
                    </div>
                    <input type="email" placeholder="Email" name="email" required />
                    <input type="password" placeholder="Password" name="password" required />
                    <a href="#">Forget Your Password?</a>
                    <button>Sign In</button>
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
                        <p>
                            Register with your personal details to use all of site features
                        </p>
                        <button class="hidden" id="register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
