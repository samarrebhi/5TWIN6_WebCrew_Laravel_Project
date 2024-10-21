<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquippementdeCollecte;
use App\Models\Center;

class EquippementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
     // Appliquer la permission "manage blogBack" à toutes les actions de ce contrôleur
     $this->middleware( 'role:admin');
    }
    public function index()
    {

        // Get all equipment associated with the logged-in user
        $equippements = EquippementdeCollecte::where('user_id', auth()->id())->get();
        return view('Back.EquippementdeRecyclageB.showallEquipments', compact('equippements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centers = Center::all(); 
        return view('Back.EquippementdeRecyclageB.createEquipment', compact('centers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation avec messages personnalisés
        $request->validate([
            'nom' => 'required|string|max:50',
            'statut' => 'required|in:active,maintenance,out_of_service',
            'capacite' => 'required|numeric|min:1|max:1000',
            'emplacement' => 'required|string|min:3|max:20', // Mise à jour ici
            'center_id' => 'required|exists:centers,id', // Validation pour center_id

        ], [
            'nom.required' => 'Le nom de l\'équipement est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 50 caractères.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut doit être actif, en maintenance ou hors service.',
            'capacite.required' => 'La capacité est obligatoire.',
            'capacite.numeric' => 'La capacité doit être un nombre.',
            'capacite.min' => 'La capacité doit être d\'au moins 1.',
            'capacite.max' => 'La capacité ne doit pas dépasser 1000.',
            'emplacement.required' => 'L\'emplacement est obligatoire.',
            'emplacement.string' => 'L\'emplacement doit être une chaîne de caractères.',
            'emplacement.min' => 'L\'emplacement doit contenir au moins 3 caractères.',
            'emplacement.max' => 'L\'emplacement ne doit pas dépasser 20 caractères.',        ]);

        $equippement = EquippementdeCollecte::create(array_merge($request->except('image'), [
            'user_id' => auth()->id(), // Set the user ID
        ]));

        if ($request->hasFile('image')) {
            $equippement->image = $this->uploadImage($request->file('image'));
            $equippement->save();
        }

        return redirect()->route('equipments.index')->with('success', 'Équipement ajouté avec succès.');
    }

    private function uploadImage($image)
    {
        // Stocke l'image et renvoie son chemin
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/Equipments'), $filename);
        return $filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get the equipment only if it belongs to the logged-in user
        $equipment = EquippementdeCollecte::with('center') 
        ->where('id', $id)
        ->where('user_id', auth()->id())
        ->first();
        if (!$equipment) {
            return redirect()->route('equipments.index')->with('error', 'Équipement non trouvé ou vous n\'êtes pas autorisé à le voir.');
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
        // Retrieve the equipment by ID and ensure it belongs to the user
        $equipment = EquippementdeCollecte::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
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
            'nom' => 'required|string|max:100',
            'statut' => 'required|in:active,maintenance,out_of_service',
            'capacite' => 'required|numeric|min:1|max:1000',
            'emplacement' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Retrieve the equipment by ID
        $equippement = EquippementdeCollecte::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

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

        return redirect()->route('equipments.index')->with('success', 'Équipement mis à jour avec succès.');
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
            if (file_exists($path)) {
                unlink($path);
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
        // Find the equipment by ID and ensure it belongs to the user
        $equipment = EquippementdeCollecte::where('id', $id)->where('user_id', auth()->id())->first();

        if ($equipment) {
            $equipment->delete();
            return redirect()->route('equipments.index')->with('success', 'Équipement supprimé avec succès.');
        }

        return redirect()->route('equipments.index')->with('error', 'Équipement non trouvé ou vous n\'êtes pas autorisé à le supprimer.');
    }
}
