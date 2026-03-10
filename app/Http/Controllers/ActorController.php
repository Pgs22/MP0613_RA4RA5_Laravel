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

        $actors = \App\Models\Actor::whereBetween('birthdate', [$start, $end])
                                    ->orderBy('birthdate', 'asc')
                                    ->get();

        return view('actors.list', compact('actors', 'title'));
    }

}
