<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Muscle Planet') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts CDN -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <!-- jQuery UI CDN -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

    <!-- Sweet Alert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        @guest
                        @else
                        @if (Auth::user()->role_id==1)
                        <!-- Center Side Of Navbar -->
                        <ul class="navbar-nav">
                            <!-- Gym Users -->
                            <li class="nav-item">
                                <a class="nav-link" href="/users">Usuarios</a>
                            </li>
                            <!-- Gym Activities -->
                            <li class="nav-item">
                                <a class="nav-link" href="/activities">Actividades</a>
                            </li>
                            <!-- Gym Sessions -->
                            <li class="nav-item">
                                <a class="nav-link" href="/sesions">Sesiones</a>
                            </li>
                        </ul>
                        @else
                        <ul class="navbar-nav">
                            <!-- Gym Activities -->
                            <li class="nav-item">
                                <a class="nav-link" href="/activities">Actividades</a>
                            </li>
                            <!-- Gym Sessions -->
                            <li class="nav-item">
                                <a class="nav-link" href="/sesions">Sesiones</a>
                            </li>
                            <!-- Gym Reservations -->
                            <li class="nav-item">
                                <a class="nav-link" href="/reservations">Reservar</a>
                            </li>
                        </ul>
                        @endif
                        @endguest
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else

                        <!-- Dropdown list -->
                        <li class="nav-item dropdown dropstart">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item logout-user" href="{{ route('logout') }}" onclick="event.preventDefault();">
                                    <!-- document.getElementById('logout-form').submit(); -->
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <!-- <a class="dropdown-item logout-user" href="" onclick="event.preventDefault();">
                                    document.getElementById('logout-form').submit();
                                    {{ __('Mis reservas') }}
                                </a> -->
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

@yield('js')
<script>
    $(".logout-user").click(function(event) {
        event.preventDefault();
        Swal.fire(
            'Hasta luego!',
            'Has cerrado sesión correctamente.',
            'success'
        ).then(function() {
            $("#logout-form").submit();
        });
    });
</script>
<script src="https://unpkg.com/turbolinks"></script>
</html>