<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    /**
     * Number films from storage
     */
    public function countFilms() {
        $films = FilmController::readFilms();
        $number = count($films);
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
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null, $duration = null, $country = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year + genre + country + durantion are null
        if (is_null($year) && is_null($genre) && is_null($country) && is_null($duration))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre or country or duration informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre) && is_null($country) && is_null($duration)) && 
            $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre) && is_null($country) && is_null($duration)) && 
            strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            } else if ((is_null($year) && is_null($genre) && !is_null($country) && is_null($duration)) && 
            strtolower($film['country']) == strtolower($country)) {
                $title = "Listado de todas las pelis filtrado x país";
                $films_filtered[] = $film;
            } else if ((is_null($year) && is_null($genre) && is_null($country) && !is_null($duration)) && 
            $film['duration'] == $duration) {
                $title = "Listado de todas las pelis filtrado x duración";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && is_null($country) && is_null($duration) && 
            strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            } else if (is_null($year) && is_null($genre) && !is_null($country) && !is_null($duration) && 
            strtolower($film['country']) == strtolower($country) && $film['duration'] == $duration) {
                $title = "Listado de todas las pelis filtrado x país y duración";
                $films_filtered[] = $film;
            }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
        }
    }

    public function listFilmsByYear($year = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year are null
        if (is_null($year))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year informed
        foreach ($films as $film) {
            if ($film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    
    public function listFilmsByGenre($genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if genre are null
        if (is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on genre informed
        foreach ($films as $film) {
            if(strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    /**
     * List films for duration
     */
    public function listFilmsDuration($duration = null)
        {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if duration are null
        if (is_null($duration))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on duration informed
        foreach ($films as $film) {
            if ($film['duration'] == $duration){
                $title = "Listado de todas las pelis filtrado x duración";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
        /**
     * List films for country
     */
    public function listFilmsCountry($country = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if country are null
        if (is_null($country))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on country informed
        foreach ($films as $film) {
            if(strtolower($film['country']) == strtolower($country)){
                $title = "Listado de todas las pelis filtrado x país";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
}
