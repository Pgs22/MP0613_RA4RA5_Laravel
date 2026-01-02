<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Movies List')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container">

    {{-- HEADER --}}
    <header class="py-3 mb-4 border-bottom">
        <div class="d-flex align-items-center">
            {{-- Añadimos la imagen desde public/img --}}
            <img src="{{ asset('img/default.png') }}" alt="Logo" width="150" class="mr-3 img-fluid shadow-sm rounded">
            <h1 class="h3"> @yield('header_title', 'PelisLaravel')</h1>
        </div>
    </header>

    {{-- CONTENIDO VARIABLE --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="mt-5 py-3 border-top text-center text-muted">
        <p>© 2026 - Proyecto de Gestión de Películas</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>