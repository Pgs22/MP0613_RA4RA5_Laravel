<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        // $films = Storage::json('/public/films.json');

        // en ejemplo: $films = Film::all(); // Esto devuelve una colección de objetos Film
        $films = Film::all()->toArray(); // Convertimos la colección a un array de arrays asociativos
        dd($films);
        return $films;
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

        // foreach ($films as $film) {
        // //foreach ($this->datasource as $film) {
        //     if ($film['year'] < $year)
        //         $old_films[] = $film;
        // }

        //Con eloquent, podríamos hacer algo como: $old_films = Film::where('year', '<', $year)->get()->toArray();
        $old_films = Film::where('year', '<', $year)->get();

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
        
        //Con eloquent
        $new_films = Film::where('year', '>=', $year)->get()->toArray();
        return view('films.list', ["films" => $new_films, "title" => $title]);

    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null, $duration = null, $country = null)
    {
        // $films_filtered = [];

        $title = "Listado de todas las pelis ordenadas por año";
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

    /**
     * Sort films for year
     */
    public function sortFilms($year = null)
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
                $films_filtered[] = $film;
            }
        }
        if (!empty($films_filtered)) {
            $years = array_column($films_filtered, 'year');
            array_multisort($years, SORT_DESC, $films_filtered);
            $title = "Listado de todas las pelis ordenadas x año";
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    /**
     * Antes de crear la pelicula comprobamos si existe
     * Si existe o no exite: retorna boolean
     */
    public function isFilm($name): bool 
    {
        $films = self::readFilms(); // Usamos la funcion para leer las peliculas existentes
        foreach ($films as $film) {
            // Comparamos en minúsculas para evitar duplicados por mayúsculas
            if (strtolower($film['name']) === strtolower($name)) {
                return true;
            }
        }
        return false;
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
        if ($this->isFilm($name)) { // Aqui usamos el metodo que retorna un booolean
            // Si existe, volvemos a 'welcome' con el error (Punto 5.a.iii.1)
            return redirect('/')
                ->withInput()
                ->with('error', "La película '$name' ya se encuentra en el catálogo.");
        }

        // 2. Adaptado a Eloquent, creamos una nueva instancia del modelo Film
        if (Film::where('name', $name)->exists()) { 
            return redirect('/')
                ->withInput()
                ->with('error', "La película '$name' ya se encuentra en el catálogo.");
        }   

        // 3. Si no existe, preparamos el nuevo registro (Punto 5.a.ii)
        $films = self::readFilms();       
        $newFilm = [
            "name"     => $name,
            "year"     => $year,
            "genre"    => $genre,
            "country"  => $country,
            "duration" => $duration,
            "img_url"  => $url
        ];
        // Añadimos al array
        $films[] = $newFilm;

        // 3. Adaptado a Eloquent, creamos una nueva instancia del modelo Film y asignamos los valores
        $film = new Film();
        $film->name = $name;
        $film->year = $year;
        $film->genre = $genre;
        $film->country = $country;
        $film->duration = $duration;
        $film->img_url = $url;

        // 4. Guardamos en el archivo storage/app/public/films.json
        Storage::put('/public/films.json', json_encode($films, JSON_PRETTY_PRINT));

        // 4. Adaptado a Eloquent, guardamos el nuevo registro en la base de datos
        $film->save();

        // 5. Redirigimos al listado total (Punto 5.a.ii.1) con json de peliculas actualizado
        return redirect()->action([FilmController::class, 'listFilms'])
                        ->with('success', "¡'$name' se ha añadido correctamente!");

    }

}  