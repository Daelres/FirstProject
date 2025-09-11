<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Aplicación')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f6f8fb;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: .3px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
            color: #fff;
        }

        .hero:before {
            content: "";
            position: absolute;
            inset: -50% -20% auto auto;
            width: 60%;
            height: 200%;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, .25), rgba(255, 255, 255, 0) 60%);
            transform: rotate(15deg);
        }

        .hero h1 {
            font-weight: 700;
        }

        .hero .breadcrumb {
            --bs-breadcrumb-divider: '›';
        }

        .hero .lead {
            opacity: .85;
        }

        .card {
            border: 0;
            border-radius: .75rem;
        }

        .card .card-header {
            background: transparent;
            font-weight: 600;
        }

        footer {
            color: #6c757d;
        }

        code.kbd {
            background: rgba(13, 110, 253, .1);
            padding: .15rem .35rem;
            border-radius: .25rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Mi App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('calculator.view') ? 'active' : '' }}"
                       href="{{ route('calculator.view') }}">Calculadora</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('currency.view') ? 'active' : '' }}"
                       href="{{ route('currency.view') }}">Moneda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('binary.view') ? 'active' : '' }}"
                       href="{{ route('binary.view') }}">Binario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('todos.view') ? 'active' : '' }}"
                       href="{{ route('todos.view') }}">Tareas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@hasSection('header')
    <section class="hero py-4 py-md-5 mb-4">
        <div class="container position-relative">
            @yield('header')
        </div>
    </section>
@endif
<main class="container pb-4">
    @yield('content')
</main>
<footer class="border-top py-3">
    <div class="container small d-flex justify-content-between">
        <span>© {{ date('Y') }} Mi App </span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
