<?php

namespace App\Http\Controllers;

use App\Models\EvenementCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EvenementCollecteController extends Controller
{
    public function index()
    {
        $evenements = EvenementCollecte::paginate(10); // Adjust pagination as needed
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
            $evenement->save();
        }

        return redirect()->route('evenement_collecte.list')->with('success', 'Événement ajouté avec succès.');
    }

    public function edit($id)
    {
        $evenement = EvenementCollecte::findOrFail($id);
        return view('evenement_collecte.edit', compact('evenement'));
    }

    public function update(Request $request, EvenementCollecte $evenement)
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

        return redirect()->route('evenement_collecte.list')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $evenement = EvenementCollecte::findOrFail($id);
        $this->deleteOldImage($evenement->image);
        $evenement->delete();
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
}
