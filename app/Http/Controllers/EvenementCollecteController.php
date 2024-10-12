<?php

namespace App\Http\Controllers;

use App\Models\EvenementCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EvenementCollecteController extends Controller
{



    public function __construct()
    {
     $this->middleware( 'role:admin');
    }

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
        $evenements = $query->paginate();

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
    
        // Create new event and assign user_id
        $evenement = new EvenementCollecte($request->except('image'));
        $evenement->user_id = auth()->id(); // Assign user ID
        $evenement->save();
    ////
        // Handle image upload
        if ($request->hasFile('image')) {
            $evenement->image = $this->uploadImage($request->file('image'));
            $evenement->save(); // Save again after image assignment
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
            'heure' => 'date_format:H:i',
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
        // Validation
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'lieu' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        // Récupérer l'événement
        $evenement = EvenementCollecte::findOrFail($id);
    
        // Mise à jour des champs
        $evenement->titre = $request->input('titre');
        $evenement->description = $request->input('description');
        $evenement->lieu = $request->input('lieu');
        $evenement->date = $request->input('date');
        $evenement->heure = $request->input('heure');
    
        // Si une nouvelle image est téléchargée, remplacer l'ancienne
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            $this->deleteOldImage($evenement->image);
    
            // Enregistrer la nouvelle image
            $evenement->image = $this->uploadImage($request->file('image'));
        }
    
        // Sauvegarder l'événement
        $evenement->save();
    
        // Rediriger avec succès
        return redirect()->route('evenement_collecte.list')->with('success', 'Événement mis à jour avec succès.');
    }
    


    public function show($id)
{
    $evenement = EvenementCollecte::findOrFail($id);
    return view('evenement_collecte.showDet', compact('evenement'));
}

}    