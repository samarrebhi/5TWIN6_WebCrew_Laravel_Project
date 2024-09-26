<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\EvenementCollecte;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Use pagination
        $evenements = EvenementCollecte::paginate(10); // Adjust the number of items per page as needed

        // Pass the paginated events to the view
        return view('Front.event.listevent', compact('evenements'));
    }
}
