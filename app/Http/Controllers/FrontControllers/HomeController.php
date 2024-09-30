<?php

namespace App\Http\Controllers\FrontControllers;
use App\Models\EvenementCollecte; // Correctly importing your model

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $evenements = EvenementCollecte::paginate(10); // Change the number to your desired items per page
    
        // Return the view with the events
        return view('Front.home', compact('evenements'));
    }
}
