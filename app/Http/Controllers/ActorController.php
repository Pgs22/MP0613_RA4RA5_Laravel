<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actor;

class ActorController extends Controller
{
    public function listActors()
    {
        $title = "Listado de Actores";
        $actors = Actor::all();
        
        return view('actors.list', compact('actors', 'title'));
    }

    public function listActorsByDecade($year)
    {
        $start = $year . "-01-01";
        $end = ($year + 9) . "-12-31";
        
        $title = "Actores nacidos en la década de $year";

        $actors = Actor::whereBetween('birthdate', [$start, $end])
                                    ->orderBy('birthdate', 'asc')
                                    ->get();

        return view('actors.list', compact('actors', 'title'));
    }

    public function countActors()
    {
        $number = Actor::count();
        return view('actors.count', [
            'number' => $number 
        ]);
    }


    public function destroy($id)
    {
        $actor = Actor::find($id);

        if ($actor) {
            $result = $actor::destroy($id); //Nos devuelve 0 si no se ha eliminado nada, o 1 si se ha eliminado el registro
            $status = $result > 0; // Para convertir el resultado en un booleano
        } else { $status = false; }

        return response()->json([
            "action" => "delete", // Para indicar a Postman la acción borrar que tenemos en la ruta api.php
            "status" => $status
        ]);
    }
}
