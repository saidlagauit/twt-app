<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <div class="container">
            @guest
                <a class="navbar-brand" href="/">Tweet</a>
            @endguest
            @auth
                <a class="navbar-brand" href="{{ route('tweets.index') }}">Tweet</a>
            @endauth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar"
                aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="myNavbar">

                <ul class="navbar-nav ms-auto">

                    @auth
                        <!-- <li class="nav-item"><a class="nav-link" href="{{ route('tweets.index') }}">Home</a></li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="img-avatar" width="32" height="32" src="{{ asset('uploads/pic_profile.webp') }}" alt="Avatar">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if (auth()->user())
                                    <li><a class="dropdown-item"
                                            href="{{ route('users.profile', ['username' => auth()->user()->username]) }}">Profile</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('tweets.create') }}">Create New</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li class="ms-2">
                                        <form method="POST" action="{{ route('users.logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Logout</button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endguest

                </ul>

            </div>

        </div>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success w-100">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>
