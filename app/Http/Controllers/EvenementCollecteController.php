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
        // Get the authenticated user's ID
        $userId = auth()->id();
    
        // Query only the events that belong to the authenticated user
        $query = EvenementCollecte::where('user_id', $userId);
    
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
        // Validation côté serveur
        $validatedData = $request->validate([
            'titre' => 'required|string|min:3|max:25',
            'description' => 'required|string|min:10|max:30',
            'lieu' => 'required|string|min:3|max:25',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i',
            'image' => 'required|nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        // Créer un nouvel événement
        $evenement = new EvenementCollecte($validatedData);
        $evenement->user_id = auth()->id();
        $evenement->created_by = auth()->id(); // Assign created_by to the authenticated user
 
        $evenement->save();
    
        // Gestion de l'image si elle est présente
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
    // Validation rules for updating
    $validatedData = $request->validate([
        'titre' => 'required|string|min:3|max:25',
        'description' => 'required|string|min:10|max:30',
        'lieu' => 'required|string|min:3|max:25',
        'date' => 'required|date',
        'heure' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Find the event to update
    $evenement = EvenementCollecte::findOrFail($id);

    // Update event data
    $evenement->update($validatedData);

    // If a new image is uploaded, delete the old one and upload the new one
    if ($request->hasFile('image')) {
        // Delete old image
        $this->deleteOldImage($evenement->image);

        // Upload new image and save path
        $evenement->image = $this->uploadImage($request->file('image'));
    }

    // Save updated event
    $evenement->save();

    // Redirect with success message
    return redirect()->route('evenement_collecte.list')->with('success', 'Événement mis à jour avec succès.');
}



    public function show($id)
{
    $evenement = EvenementCollecte::findOrFail($id);
    return view('evenement_collecte.showDet', compact('evenement'));
}
public function participantsList($id)
{
    $event = EvenementCollecte::findOrFail($id);

    // Fetch participants user details
    $participantIds = json_decode($event->participants, true);
    $participants = User::whereIn('id', $participantIds)->get();

    return view('Front.event.participants', compact('event', 'participants'));
}

}    