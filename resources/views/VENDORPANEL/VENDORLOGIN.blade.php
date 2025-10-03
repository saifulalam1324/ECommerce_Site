<!doctype html>
<html lang="en">
  <head>
    <title>Vendor Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container first">
        <div class="row">
            <div class="container d-flex justify-content-center align-items-center" style="min-block-size:100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <h1 class="mb-3 text-center">Please log in</h1>
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('VendorLogin') }}" method="POST" class="mb-3">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" id="E-mail" placeholder="E-mail" name="email" />
                             <span class="text-danger">
                                @error('email') {{ $message }} @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="Password" placeholder="Password"
                                name="password" />
                             <span class="text-danger">
                                @error('password') {{ $message }} @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-block" style="background-color:#081621; color: white;">
                            Login
                        </button>
                    </form>
                    <div class="text-center">
                        <p>or..</p>
                        <a href="{{ route('VendorSignupPage') }}" id="showSignup">Create
                            Account</a>
                        <p class="small">
                            <a href="#">Have you forgotten your account details?</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
