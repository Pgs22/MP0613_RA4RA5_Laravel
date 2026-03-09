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

}
