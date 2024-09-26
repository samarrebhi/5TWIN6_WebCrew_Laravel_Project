<?php

namespace App\Http\Controllers;

use App\Models\EvenementCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EvenementCollecteController extends Controller
{
    public function index()
    {
        $evenements = EvenementCollecte::paginate(10); // Adjust pagination as needed
        return view('evenement_collecte.list', compact('evenements'));
    }
    

    public function create()
    {
        // Return view for creating a new event
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
            $evenement->save();
        }

        // Redirect with success message
        return redirect()->route('evenement_collecte.list')->with('success', 'Événement ajouté avec succès.');
    }
public function edit($id)
{
    $evenement = EvenementCollecte::findOrFail($id);
    return view('evenement_collecte.edit', compact('evenement'));
}

    public function update(EvenementCollecte $evenement, Request $request)
    {
        // Validate the request
        $this->validateEvent($request);
        
        // Update event details
        $evenement->fill($request->except('image'))->save();

        // Handle new image upload
        if ($request->hasFile('image')) {
            $this->deleteOldImage($evenement->image);
            $evenement->image = $this->uploadImage($request->file('image'));
            $evenement->save();
        }

        // Redirect with success message
        return redirect()->route('evenement_collecte.list')->with('success', 'Événement mis à jour avec succès.');
    }

    public function show(EvenementCollecte $evenement)
    {
        // Return view for showing the event
        return view('evenement_collecte.show', compact('evenement'));
    }

   
/*    public function destroy(EvenementCollecte $evenement)
    {
        try {
            // Optionally delete the old image if you have a method for it
            $this->deleteOldImage($evenement->image);
            $evenement->delete(); // Delete the evenement
    
            // Return success response
            return response()->json(['message' => 'Événement supprimé avec succès.'], 200);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la suppression de l\'événement: '.$e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression de l\'événement.'], 500);
        }
    }
*/
    public function destroy($id)
    {
        $evenement = EvenementCollecte::findOrFail($id);
        $evenement->delete();
        return response()->json(['message' => 'Événement supprimé avec succès.']);
    }
    
    // Helper method to delete the old image
    private function deleteOldImage($imageName)
    {
        if ($imageName) {
            $path = public_path('uploads/evenements/' . $imageName);
            if (file_exists($path)) {
                unlink($path); // Delete the image file
            }
        }
    }
    private function validateEvent(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required',
            'lieu' => 'required|max:255',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i', // Validate time format
            'image' => 'sometimes|mimes:gif,png,jpeg,jpg|max:2048' // Limit image size to 2MB
        ]);
    }

    private function uploadImage($image)
    {
        // Store image and return its path
        return $image->store('uploads/evenements', 'public');
    }

}
