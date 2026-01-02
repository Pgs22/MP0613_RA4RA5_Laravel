@extends('layouts.master')

@section('header_title', 'Movies List')

@section('content')
    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
        <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
        <li><a href="/filmout/films">Pelis</a></li>
        <li><a href="/filmout/filmsByYear">Pelis por año</a></li>
        <li><a href="/filmout/sort">Pelis ordenadas por año</a></li>
        <li><a href="/filmout/filmsByGenre">Pelis por genero</a></li>
        <li><a href="/filmout/filmsDuration">Pelis por duración</a></li>
        <li><a href="/filmout/filmsCountry">Pelis por país</a></li>
        <li><a href="/filmout/count">Numero total de pelis</a></li>
    </ul>

    {{-- Bloque Añadir Pelicula (El Formulario) --}}
    <hr>   
    <h2>Añadir Pelicula</h2>
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="cursor: pointer;" onclick="this.style.display='none'">
            <strong>¡Error!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- El formulario apunta a la ruta 'film' --}}
    <form method="POST" action="{{ route('film') }}" class="form-horizontal">
        @csrf {{-- ¡IMPORTANTE! Token CSRF --}}

        {{-- Campo Nombre --}}
        <div class="form-group row mb-2">
            <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Blade" value="{{ old('nombre') }}" required>
            </div>
        </div>

        {{-- Campo Año --}}
        <div class="form-group row mb-2">
            <label for="year" class="col-sm-3 col-form-label">Año</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="year" name="year" placeholder="Ej: 2020" value="{{ old('year') }}" required>
            </div>
        </div>
        
        {{-- Campo Género --}}
        <div class="form-group row mb-2">
            <label for="genre" class="col-sm-3 col-form-label">Género</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="genre" name="genre" placeholder="Ej: Ciencia Ficción" value="{{ old('genre') }}"required>
            </div>
        </div>

        {{-- Campo País --}}
        <div class="form-group row mb-2">
            <label for="country" class="col-sm-3 col-form-label">País</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="country" name="country" placeholder="Ej: EE.UU." value="{{ old('country') }}" required>
            </div>
        </div>

        {{-- Campo Duración --}}
        <div class="form-group row mb-2">
            <label for="duration" class="col-sm-3 col-form-label">Duración (min)</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="duration" name="duration" placeholder="Ej: 120" value="{{ old('duration') }}" required>
            </div>
        </div>

        {{-- Campo Imagen URL (Crucial para el futuro middleware) --}}
        <div class="form-group row mb-3">
            <label for="imagen_url" class="col-sm-3 col-form-label">Imagen URL</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="imagen_url" name="imagen_url" placeholder="Ej: http://web.com ó https://web.com" value="{{ old('imagen_url') }}" required>
            </div>
        </div>

        {{-- Botón Enviar --}}
        <div class="form-group row">
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </form>
@endsection