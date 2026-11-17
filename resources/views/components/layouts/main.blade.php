<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' :: ' : '' }}{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ url('img/favicon.png') }}">

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>

<body>
    <a class="visually-hidden-focusable" href="#main-content">Saltar al contenido</a>

    <div id="app">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary" aria-label="Navegación principal">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu"
                        aria-controls="main-menu" aria-expanded="false" aria-label="Mostrar u ocultar el menú">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main-menu">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <i class="bi bi-house me-1" aria-hidden="true"></i>Inicio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('blog.index') }}">
                                    <i class="bi bi-journal-text me-1" aria-hidden="true"></i>Blog
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rides.index') }}">
                                    <i class="bi bi-compass me-1" aria-hidden="true"></i>Cabalgatas
                                </a>
                            </li>
                        </ul>

                        <ul class="navbar-nav align-items-lg-center">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('auth.login.form') }}">
                                        <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i>Ingresar
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('auth.register.form') }}">
                                        <i class="bi bi-person-plus me-1" aria-hidden="true"></i>Registrate
                                    </a>
                                </li>
                            @endguest

                            @auth
                                @if (auth()->user()->isAdmin())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-gear me-1" aria-hidden="true"></i>Panel de
                                            administración
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <span class="navbar-text">
                                        <i class="bi bi-person-circle me-1" aria-hidden="true"></i>{{ auth()->user()->name }}
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <form action="{{ route('auth.logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="nav-link">
                                            <i class="bi bi-box-arrow-right me-1" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </li>
                            @endauth

                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="container" id="main-content">
            @if (session()->has('feedback.message'))
                <div class="alert alert-success" role="status">
                    <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>{{ session('feedback.message') }}
                </div>
            @endif

            {{ $slot }}
        </main>

        <footer class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
        </footer>
    </div>

    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
