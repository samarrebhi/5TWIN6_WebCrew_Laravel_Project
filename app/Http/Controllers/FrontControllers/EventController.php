<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\EvenementCollecte; // Correctly importing your model
use Illuminate\Http\Request;
use PDF;

class EventController extends Controller
{
    public function index()
    {
        $evenements = EvenementCollecte::paginate(10);
        return view('front.event.listevent', compact('evenements'));
    }

    public function show($id)
    {
        // Find the event by ID
        $event = EvenementCollecte::findOrFail($id); // Correct model here
        
        // Return the view with event data
        return view('Front.event.details', compact('event')); // Ensure the view is also correct
    }

    public function exportPdf($id)
    {
        $event = EvenementCollecte::findOrFail($id);
        $pdf = PDF::loadView('Front.event_pdf', compact('event')); // Create a view for PDF

        return $pdf->download('event_details.pdf');
    }

}
