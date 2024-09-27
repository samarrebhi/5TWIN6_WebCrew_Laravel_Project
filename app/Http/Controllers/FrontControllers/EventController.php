<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\EvenementCollecte; // Correctly importing your model
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $evenements = EvenementCollecte::paginate(10);
        return view('front.event.listevent', compact('evenements'));
    }

    public function sh($id)
    {
        // Find the event by ID
        $event = EvenementCollecte::findOrFail($id); // Correct model here
        
        // Return the view with event data
        return view('Front.event.details', compact('event')); // Ensure the view is also correct
    }
}
