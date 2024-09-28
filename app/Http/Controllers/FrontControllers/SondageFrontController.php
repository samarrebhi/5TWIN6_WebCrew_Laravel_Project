<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\Sondage; // Correctly importing your model
use Illuminate\Http\Request;

class SondageFrontController extends Controller
{
    public function index()
    {
        $sondages=sondage::all();
        return view('Front.Sondages affichage.getallsondage',compact('sondages'));
    }

    public function sh($id)
    {
        // Find the event by ID
        $event = EvenementCollecte::findOrFail($id); // Correct model here

        // Return the view with event data
        return view('Front.event.details', compact('event')); // Ensure the view is also correct
    }
}
