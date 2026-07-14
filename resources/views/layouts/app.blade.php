<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Vite (jQuery + SweetAlert2 + SASS) --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <header>
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">Clientes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}" href="{{ route('categorias.index') }}">Categorías</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}" href="{{ route('productos.index') }}">Productos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('compras.*') ? 'active' : '' }}" href="{{ route('compras.index') }}">Compras</a>
                                    </li>
                                </ul>
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search"
                                        aria-label="Search" />
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </header>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <main>
                    @yield('alert')
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <footer>

                </footer>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>