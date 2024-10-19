<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquippementdeCollecte;

class EquippementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equippements=EquippementdeCollecte::all();
        return view('Back.EquippementdeRecyclageB.showallEquipments',compact('equippements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Back.EquippementdeRecyclageB.createEquipment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
    {
        // Validation de la requête
        $request->validate([
            'nom' => 'required',
            'statut' => 'required',
            'capacite' => 'required|numeric',
            'emplacement' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Créer un nouvel équipement sans l'image pour l'instant
        $equippement = EquippementdeCollecte::create($request->except('image'));

        // Gérer l'upload de l'image si elle est présente
        if ($request->hasFile('image')) {
            $equippement->image = $this->uploadImage($request->file('image')); // Appel de la méthode pour uploader l'image
            $equippement->save(); // Sauvegarde après l'attribution du chemin de l'image
        }

        return redirect()->route('equipments.index')
                         ->with('success', 'Équipement ajouté avec succès.');
    }

    
    private function uploadImage($image)
    {
        // Stocke l'image et renvoie son chemin
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/Equipments'), $filename); // Stocker dans le dossier 'public/uploads/Equipments'
        return $filename; // Retourne le nom du fichier
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = EquippementdeCollecte::find($id);
    
        if (!$equipment) {
            return redirect()->route('equipments.index')->with('error', 'Équipement non trouvé.');
        }
    
        return view('Back.EquippementdeRecyclageB.showEquipment', compact('equipment'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieve the equipment by ID
        $equipment = EquippementdeCollecte::findOrFail($id);
        return view('Back.EquippementdeRecyclageB.editEquipment', compact('equipment'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'nom' => 'required',
            'statut' => 'required',
            'capacite' => 'required|numeric',
            'emplacement' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Retrieve the equipment by ID
        $equippement = EquippementdeCollecte::findOrFail($id);
    
        // Update the fields
        $equippement->nom = $request->input('nom');
        $equippement->statut = $request->input('statut');
        $equippement->capacite = $request->input('capacite');
        $equippement->emplacement = $request->input('emplacement');
    
        // If a new image is uploaded, handle it
        if ($request->hasFile('image')) {
            // Optionally delete the old image if you want
            if ($equippement->image) {
                $this->deleteOldImage($equippement->image);
            }
            
            // Upload the new image
            $equippement->image = $this->uploadImage($request->file('image'));
        }
    
        // Save the updated equipment
        $equippement->save();
    
        return redirect()->route('equipments.index')
                         ->with('success', 'Équipement mis à jour avec succès.');
    }
    
    /**
     * Delete the old image if it exists.
     *
     * @param string $imageName
     */
    private function deleteOldImage($imageName)
    {
        if ($imageName) {
            $path = public_path('uploads/Equipments/' . $imageName);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipment = EquippementdeCollecte::find($id); // Find the equipment by ID
    
        if ($equipment) {
            $equipment->delete(); // Delete the equipment
            return redirect()->route('equipments.index')->with('success', 'Equipment deleted successfully.');
        }
    
        return redirect()->route('equipments.index')->with('error', 'Equipment not found.');
    }
    
}