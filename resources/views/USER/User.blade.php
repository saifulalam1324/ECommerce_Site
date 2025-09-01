<!doctype html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('ASSATS/CSS/STYLE.css') }}">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class=""  onclick="openSidebar()">
      <i class="fa-solid fa-bars" style="color: white"></i>
    </a>
    <div class="container-fluid">
      <a class="navbar-brand mr-5" href="{{ route('home') }}">YOUR MARKET</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse mt-2 mb-2" id="navbarNav">
        <ul class="navbar-nav d-flex align-items-center mx-auto my-auto">
          <li class="nav-item mx-2">
            <div class="search-container">
              <form class="search-form" action="#" method="get">
                <input type="text" class="form-control search-input"
                  placeholder="Search for Tv, Fridge, Washing machine or Air Conditioner" name="search">
                <a href="" class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></a>
              </form>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link NAV" href="#">Orders</a></li>
          <li class="nav-item"><a class="nav-link NAV" href="#">Favorites</a></li>
          <li class="nav-item"><a class="nav-link NAV" href="#">Cart</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="btn btn-outline-light" href="{{ route('LoginSignup') }}">Sign In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Sidebar -->
  <div id="sidebar" class="sidebar">
    <div class="sidebar-header d-flex justify-content-between align-items-center">
      <a class="" onclick="closeSidebar()"><i class="fa-solid fa-circle-xmark fa-2x"></i>
    </div>
    <div class="sidebar-content">

    </div>
  </div>
  <div id="overlay" class="overlay" onclick="closeSidebar()"></div>
  <div class="container-fluied">
    @yield('content')
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="{{ asset('ASSATS/JS/LOGINSIGNUP.js') }}"></script>
  <script src="{{ asset('ASSATS/JS/SCRIPT.js') }}"></script>
</body>

</html>