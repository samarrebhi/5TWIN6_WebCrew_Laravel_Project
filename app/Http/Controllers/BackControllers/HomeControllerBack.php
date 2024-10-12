<?php

namespace App\Http\Controllers\BackControllers;
use App\Models\EvenementCollecte;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeControllerBack extends Controller
{
        // Get the list of events, for example

    public function index()  {
        $events = EvenementCollecte::all();

        return view('/Back/homeback', compact('events'));
    }
}
