<?php

namespace App\Http\Controllers;

use App\Models\EvenementCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EvenementCollecteController extends Controller
{

    public function index(Request $request)
    {
        $query = EvenementCollecte::query();

        // Apply filters if search fields are provided
        if ($request->filled('titre')) {
            $query->where('titre', 'like', '%' . $request->input('titre') . '%');
        }

        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->input('description') . '%');
        }

        if ($request->filled('lieu')) {
            $query->where('lieu', 'like', '%' . $request->input('lieu') . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->input('date'));
        }

        // Paginate the filtered results
        $evenements = $query->paginate(10);

        if ($request->ajax()) {
            return view('evenement_collecte.partials.event_table', compact('evenements'));
        }

        return view('evenement_collecte.list', compact('evenements'));
    }

    public function create()
    {
        return view('evenement_collecte.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $this->validateEvent($request);
    
        // Create new event
        $evenement = EvenementCollecte::create($request->except('image'));
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $evenement->image = $this->uploadImage($request->file('image'));
            $evenement->save(); // Ensure save after image assignment
        }
    
        return redirect()->route('evenement_collecte.list')->with('success', 'Événement ajouté avec succès.');
    }

    public function edit($id)
    {
        $evenement = EvenementCollecte::findOrFail($id);
        return view('evenement_collecte.edit', compact('evenement'));
    }
    
    public function destroy($id)
    {
        $evenement = EvenementCollecte::findOrFail($id);
        $this->deleteOldImage($evenement->image); // Delete the old image
        $evenement->delete(); // Then delete the event
        return response()->json(['message' => 'Événement supprimé avec succès.']);
    }
        

   

    private function validateEvent(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required',
            'lieu' => 'required|max:255',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Ensure image is valid
        ]);
    }

    private function uploadImage($image)
    {
        // Store image and return its path
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/evenements'), $filename);
        return $filename;
    }

    private function deleteOldImage($imageName)
    {
        if ($imageName) {
            $path = public_path('uploads/evenements/' . $imageName);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
    public function update(Request $request, $id)
    {
        // Valider la requête entrante
        $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'lieu' => 'required|string',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        // Trouver la ressource par ID et la mettre à jour
        $evenementCollecte = EvenementCollecte::findOrFail($id);
    
        // Mettre à jour tous les champs
        $evenementCollecte->titre = $request->input('titre');
        $evenementCollecte->description = $request->input('description');
        $evenementCollecte->lieu = $request->input('lieu');
        $evenementCollecte->date = $request->input('date');
        $evenementCollecte->heure = $request->input('heure');
    
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si une nouvelle est téléchargée
            $this->deleteOldImage($evenementCollecte->image);
            // Télécharger la nouvelle image
            $evenementCollecte->image = $this->uploadImage($request->file('image'));
        }
    
        // Sauvegarder les données mises à jour
        $evenementCollecte->save();
    
        // Rediriger ou retourner une réponse
        return redirect()->route('evenement_collecte.list')->with('success', 'Événement mis à jour avec succès.');
    }
}    