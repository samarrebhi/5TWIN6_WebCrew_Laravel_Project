<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvenementCollecteController extends Controller
{
    public function create()
    {
        return view('Front.create'); // Ensure this matches your view file name
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'nom' => 'required|string|max:100',
            'date' => 'required|date',
            'lieu' => 'required|string|max:255',
            'organisateur_id' => 'required|exists:utilisateurs,id', // Assuming utilisateurs is the name of your users table
        ]);

        // Create the event
        // EvenementCollecte::create($request->all());

        return redirect()->route('evenement_collectes.index')->with('success', 'Événement de collecte ajouté avec succès!');
    }
}
