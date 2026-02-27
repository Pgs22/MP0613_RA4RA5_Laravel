<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{

    /**
     * Read films from database using Eloquent
     * Retorna una colección de modelos Film
     */
    public static function readFilms()
    {
        // Antes: lectura desde JSON en storage. Ahora: Eloquent
        return Film::all();
    }
    /**
     * Number films from storage
     */
    public function countFilms() {
        // $films = FilmController::readFilms();
        // $number = count($films);
        $number = Film::count(); // Contamos directamente los registros en la base de datos usando Eloquent
        return view('films.count', [
        'number' => $number 
    ]);
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        // $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        // $films = FilmController::readFilms();
        // Con Eloquent
        $old_films = Film::where('year', '<', $year)->orderBy('year', 'desc')->get();
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        // $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        // $films = FilmController::readFilms();

        // foreach ($films as $film) {
        //     if ($film['year'] >= $year)
        //         $new_films[] = $film;
        // }
        
        // Con Eloquent
        $new_films = Film::where('year', '>=', $year)->orderBy('year')->get();
        return view('films.list', ["films" => $new_films, "title" => $title]);

    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null, $duration = null, $country = null)
    {
        // Nueva implementación usando Eloquent
        $title = "Listado de todas las pelis ordenadas por año";
        $query = Film::query();

        if (!is_null($year)) {
            $query->where('year', $year);
            $title = "Listado de todas las pelis filtrado x año";
        }

        if (!is_null($genre)) {
            $query->whereRaw('LOWER(genre) = ?', [strtolower($genre)]);
            $title = is_null($year) ? "Listado de todas las pelis filtrado x categoria" : "Listado de todas las pelis filtrado x categoria y año";
        }

        if (!is_null($country)) {
            $query->whereRaw('LOWER(country) = ?', [strtolower($country)]);
            if (is_null($year) && is_null($genre) && is_null($duration)) {
                $title = "Listado de todas las pelis filtrado x país";
            }
        }

        if (!is_null($duration)) {
            $query->where('duration', $duration);
            if (is_null($year) && is_null($genre) && is_null($country)) {
                $title = "Listado de todas las pelis filtrado x duración";
            } elseif (is_null($year) && is_null($genre) && !is_null($country)) {
                $title = "Listado de todas las pelis filtrado x país y duración";
            }
        }

        $films = $query->orderBy('year')->get();

        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function listFilmsByYear($year = null)
    {
        $title = "Listado de todas las pelis";
        if (is_null($year)) {
            $films = Film::orderBy('year')->get();
            return view('films.list', ["films" => $films, "title" => $title]);
        }
        $films = Film::where('year', $year)->orderBy('year')->get();
        $title = "Listado de todas las pelis filtrado x año";
        return view('films.list', ["films" => $films, "title" => $title]);
    }
    
    public function listFilmsByGenre($genre = null)
    {
        $title = "Listado de todas las pelis";
        if (is_null($genre)) {
            $films = Film::orderBy('year')->get();
            return view('films.list', ["films" => $films, "title" => $title]);
        }
        $films = Film::whereRaw('LOWER(genre) = ?', [strtolower($genre)])->orderBy('year')->get();
        $title = "Listado de todas las pelis filtrado x categoria";
        return view('films.list', ["films" => $films, "title" => $title]);
    }
    /**
     * List films for duration
     */
    public function listFilmsDuration($duration = null)
        {
        $title = "Listado de todas las pelis";
        if (is_null($duration)) {
            $films = Film::orderBy('year')->get();
            return view('films.list', ["films" => $films, "title" => $title]);
        }
        $films = Film::where('duration', $duration)->orderBy('year')->get();
        $title = "Listado de todas las pelis filtrado x duración";
        return view('films.list', ["films" => $films, "title" => $title]);
    }
        /**
     * List films for country
     */
    public function listFilmsCountry($country = null)
    {
        $title = "Listado de todas las pelis";
        if (is_null($country)) {
            $films = Film::orderBy('year')->get();
            return view('films.list', ["films" => $films, "title" => $title]);
        }
        $films = Film::whereRaw('LOWER(country) = ?', [strtolower($country)])->orderBy('year')->get();
        $title = "Listado de todas las pelis filtrado x país";
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    /**
     * Sort films for year
     */
    public function sortFilms($year = null)
    {
        $title = "Listado de todas las pelis";
        // Si no se indica año, devolvemos todas las pelis ordenadas desc por año
        if (is_null($year)) {
            $films = Film::orderBy('year', 'desc')->get();
            $title = "Listado de todas las pelis ordenadas x año";
            return view('films.list', ["films" => $films, "title" => $title]);
        }
        // Si se indica año, filtramos por ese año
        $films = Film::where('year', $year)->orderBy('year', 'desc')->get();
        $title = "Listado de todas las pelis filtrado x año";
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    /**
     * Antes de crear la pelicula comprobamos si existe
     * Si existe o no exite: retorna boolean
     */
    public function isFilm($name): bool 
    {
        // Usar Eloquent para comprobar existencia (case-insensitive)
        return Film::whereRaw('LOWER(name) = ?', [strtolower($name)])->exists();
    }
    /**
     * a. Crear pelicula: createFilm
     */
    public function createFilm(Request $request) 
    {
        // 1. Capturamos TODOS los campos usando el atributo 'name' del formulario
        $name = $request->input('nombre');
        $year = $request->input('year');
        $genre = $request->input('genre');
        $country = $request->input('country');
        $duration = $request->input('duration');
        $url = $request->input('imagen_url');

        // 2. Comprobar si la película ya existe (Punto 5.a.i)
        if ($this->isFilm($name)) {
            return redirect('/')
                ->withInput()
                ->with('error', "La película '$name' ya se encuentra en el catálogo.");
        }

        $film = new Film();
        $film->name = $name;
        $film->year = $year;
        $film->genre = $genre;
        $film->country = $country;
        $film->duration = $duration;
        $film->img_url = $url;
        $film->save();

        return redirect()->action([FilmController::class, 'listFilms'])
                        ->with('success', "¡'$name' se ha añadido correctamente!");

    }

}  