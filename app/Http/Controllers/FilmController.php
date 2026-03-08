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
        return Film::all();
    }
    /**
     * Number films from storage
     */
    public function countFilms() {
        $number = Film::count();
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
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $old_films = Film::where('year', '<', $year)->get();
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";

        $new_films = Film::where('year', '>=', $year)->orderBy('year')->get();
        return view('films.list', ["films" => $new_films, "title" => $title]);

    }
    /**
     * List films for year, genre, duration and country
     */
    public function listFilms($year = null, $genre = null, $duration = null, $country = null)
    {
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

    /**
     * Summary of listFilmsByYear
     */
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
    
    /**
     * List films for genre
    */
    public function listFilmsByGenre($genre = null)
    {

        $title = "Listado de todas las pelis por categoría";

        $customOrder = "FIELD(genre, 'action', 'drama', 'romance', 'suspense')";

        if (is_null($genre)) {
            $films = Film::orderByRaw($customOrder)->get();
            return view('films.list', ["films" => $films, "title" => $title]);
        }
        $films = Film::whereRaw('LOWER(genre) = ?', [strtolower($genre)])->orderBy('genre')->get();
        $title = "Listado de todas las pelis filtrado x categoría";
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    /**
     * List films for duration
     */
    public function listFilmsDuration($duration = null)
        {
        $title = "Listado de todas las pelis";
        if (is_null($duration)) {
            $films = Film::orderBy('duration')->get();
            return view('films.list', ["films" => $films, "title" => $title]);
        }
        $films = Film::where('duration', $duration)->orderBy('duration')->get();
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
            $films = Film::orderBy('country')->get();
            return view('films.list', ["films" => $films, "title" => $title]);
        }
        $films = Film::whereRaw('LOWER(country) = ?', [strtolower($country)])->orderBy('country')->get();
        $title = "Listado de todas las pelis filtrado x país";
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    /**
     * Sort films for year
     */
    public function sortFilms($year = null)
    {
        $title = "Listado de todas las pelis";
        if (is_null($year)) {
            $films = Film::orderBy('year', 'desc')->get();
            $title = "Listado de todas las pelis ordenadas x año";
            return view('films.list', ["films" => $films, "title" => $title]);
        }
        $films = Film::where('year', $year)->orderBy('year', 'desc')->get();
        $title = "Listado de todas las pelis filtrado x año";
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    /**
     * Before create a film, check if it already exists in the database
     * If it exists: return true, otherwise: return false
     */
    public function isFilm($name): bool 
    {
        return Film::whereRaw('LOWER(name) = ?', [strtolower($name)])->exists();
    }

    /**
     * Create film: capture data from form, create a new film and save it in the database.
     */
    public function createFilm(Request $request) 
    {
        $name = $request->input('nombre');
        $year = $request->input('year');
        $genre = $request->input('genre');
        $country = $request->input('country');
        $duration = $request->input('duration');
        $url = $request->input('imagen_url');

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