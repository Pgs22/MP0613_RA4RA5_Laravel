<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
</head>

<body class="container">

    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/films>Pelis</a></li>
        <li><a href=/filmout/filmsByYear>Pelis por año</a></li>
        <li><a href=/filmout/sort>Pelis ordenadas por año</a></li>
        <li><a href=/filmout/filmsByGenre>Pelis por genero</a></li>
        <li><a href=/filmout/filmsDuration>Pelis por duración</a></li>
        <li><a href=/filmout/filmsCountry>Pelis por país</a></li>
        <li><a href=/filmout/count>Numero total de pelis</a></li>
    </ul>
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

        {{-- Bloque Añadir Pelicula (El Formulario) --}}
    <hr>   
    <h2>Añadir Pelicula</h2>        
    {{-- El formulario apunta a la ruta 'film.create' --}}
    <form method="POST" action="{{ route('film.create') }}" class="form-horizontal">
        @csrf {{-- ¡IMPORTANTE! Token CSRF --}}

        {{-- Campo Nombre --}}
        <div class="form-group row mb-2">
            <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
        </div>

        {{-- Campo Año --}}
        <div class="form-group row mb-2">
            <label for="year" class="col-sm-3 col-form-label">Año</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
        </div>
        
        {{-- Campo Género --}}
        <div class="form-group row mb-2">
            <label for="genre" class="col-sm-3 col-form-label">Género</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="genre" name="genre" placeholder="Ej: Ciencia Ficción" required>
            </div>
        </div>

        {{-- Campo País --}}
        <div class="form-group row mb-2">
            <label for="country" class="col-sm-3 col-form-label">País</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="country" name="country" placeholder="Ej: EE.UU." required>
            </div>
        </div>

        {{-- Campo Duración --}}
        <div class="form-group row mb-2">
            <label for="duration" class="col-sm-3 col-form-label">Duración (min)</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="duration" name="duration" placeholder="Ej: 120" required>
            </div>
        </div>

        {{-- Campo Imagen URL (Crucial para el futuro middleware) --}}
        <div class="form-group row mb-3">
            <label for="imagen_url" class="col-sm-3 col-form-label">Imagen URL</label>
            <div class="col-sm-9">
                <input type="url" class="form-control" id="imagen_url" name="imagen_url" required>
            </div>
        </div>

        {{-- Botón Enviar --}}
        <div class="form-group row">
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </form>

</body>

</html>
