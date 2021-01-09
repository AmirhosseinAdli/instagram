<!doctype html>
<html lang="en">
<head>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
    </style>

    <title>Instagram</title>
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="col-md-4">
    <a class="navbar-brand" href="#"><img src="{{asset('img/insta.png')}}" alt=""></a>
    </div>
    <div class="col-md-4">
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <div class="col-md-4">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('posts.create')}}">Create new Post</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle" style="width: 25px;height: 25px" src="{{auth()->user()->profilePicture?->url}}">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('profile',auth()->user())}}">Profile</a>
                    <a class="dropdown-item" href="#">Saved</a>
                    <a class="dropdown-item" href="{{route('settings')}}">Settings</a>
                    <a class="dropdown-item" href="#">Switch Accounts</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('auth.logout')}}">Log Out</a>
                </div>
            </li>
        </ul>
    </div>
    </div>
</nav>
@yield('content')
</div>
</body>
</html>
