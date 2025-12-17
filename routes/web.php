<?php

use App\Http\Controllers\FilmController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::middleware('year')->group(function() {
Route::middleware('year')->prefix('filmout')->group(function() {
    // Routes included with prefix "filmout"       
    Route::get('oldFilms/{year?}',[FilmController::class, "listOldFilms"])->name('oldFilms');
    Route::get('newFilms/{year?}',[FilmController::class, "listNewFilms"])->name('newFilms');
    Route::get('films/{year?}/{genre?}',[FilmController::class, "listFilms"])->name('listFilms');
    Route::get('filmsByYear/{year?}',[FilmController::class, "listFilmsByYear"])->name('filmsByYear');
    Route::get('filmsByGenre/{genre?}',[FilmController::class, "listFilmsByGenre"])->name('filmsByGenre');
    Route::get('filmsDuration/{duration?}', [FilmController::class, 'listFilmsDuration'])->name('filmsDuration');
    Route::get('filmsCountry/{country?}', [FilmController::class, 'listFilmsCountry'])->name('filmsCountry');
    Route::get('count/', [FilmController::class, 'countFilms'])->name('countFilms');
    Route::get('sort/', [FilmController::class, 'sortFilms'])->name('sortFilms');
});

//Creamos nueva ruta para el formulario
Route::prefix('filmin')->group(function () {
    // La ruta POST para crear una película
    Route::post('/film', [FilmController::class, 'createFilm'])->name('film.create');
});

//Creamos nueva ruta para el formulario
Route::prefix('filmin')->group(callback: function () : void {
    // La ruta POST para crear una película
    Route::post('/film', [FilmController::class, 'createFilm'])->name('film.create');
});




