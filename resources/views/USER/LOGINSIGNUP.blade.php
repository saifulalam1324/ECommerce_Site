@extends('USER.User')
@section('title', 'Login/Signup')
@section('content')
  <link rel="stylesheet" href="{{ asset('ASSATS/CSS/LOGINSIGNUP.css') }}">
  <div class="container-fluied mt-lg-1 my-5 p-5">

    <div class="container" id="container">
    <div class="form-container sign-up">
      <form>
      <h1>Create Account</h1>
      <div class="social-icons">

      </div>
      <span>or use your email for registeration</span>
      <input type="text" placeholder="Name" />
      <input type="email" placeholder="Email" />
      <input type="password" placeholder="Password" />
      <button>Sign Up</button>
      </form>
    </div>
    <div class="form-container sign-in">
      <form>
      <h1>Sign In</h1>
      <div class="social-icons">
      </div>
      <span>or use your email password</span>
      <input type="email" placeholder="Email" />
      <input type="password" placeholder="Password" />
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