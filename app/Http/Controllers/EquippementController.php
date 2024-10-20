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

     public function __construct()
     {
      $this->middleware( 'role:admin');
     }


    public function index()
{
    // Filtrer les équipements créés par l'utilisateur connecté
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
        return view('Back.EquippementdeRecyclageB.createEquipment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */public function store(Request $request)
{
    // Validation avec messages personnalisés
    $request->validate([
        'nom' => 'required|string|max:100', // Maximum length of 100 characters
        'statut' => 'required|in:active,maintenance,out_of_service', // Ensure valid status options
        'capacite' => 'required|numeric|min:1|max:1000', // Capacity must be a number between 1 and 10,000
        'emplacement' => 'required|string|max:255', // Maximum length of 255 characters
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image rules
    ], [
        'nom.required' => 'Le nom de l\'équipement est obligatoire.',
        'nom.string' => 'Le nom doit être une chaîne de caractères.',
        'nom.max' => 'Le nom ne doit pas dépasser 100 caractères.',
        'statut.required' => 'Le statut est obligatoire.',
        'statut.in' => 'Le statut doit être actif, en maintenance ou hors service.',
        'capacite.required' => 'La capacité est obligatoire.',
        'capacite.numeric' => 'La capacité doit être un nombre.',
        'capacite.min' => 'La capacité doit être d\'au moins 1.',
        'capacite.max' => 'La capacité ne doit pas dépasser 1000.',
        'emplacement.required' => 'L\'emplacement est obligatoire.',
        'emplacement.string' => 'L\'emplacement doit être une chaîne de caractères.',
        'emplacement.max' => 'L\'emplacement ne doit pas dépasser 255 caractères.',
        'image.image' => 'Le fichier doit être une image.',
        'image.mimes' => 'L\'image doit être au format jpg, jpeg ou png.',
        'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
    ]);

   // $equippement = EquippementdeCollecte::create($request->except('image'));

    // Ajouter l'utilisateur connecté comme créateur
    $equippement = EquippementdeCollecte::create([
        'nom' => $request->nom,
        'statut' => $request->statut,
        'capacite' => $request->capacite,
        'emplacement' => $request->emplacement,
        'user_id' => auth()->id(), // Ajout de l'ID de l'utilisateur connecté
    ]);



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
         $request->validate([
             'nom' => 'required|string|max:100',
             'statut' => 'required|in:active,maintenance,out_of_service',
             'capacite' => 'required|numeric|min:1|max:1000',
             'emplacement' => 'required|string|max:255',
             'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
         ]);
     
         $equippement = EquippementdeCollecte::findOrFail($id);
     
         // Mettre à jour les champs
         $equippement->update([
             'nom' => $request->nom,
             'statut' => $request->statut,
             'capacite' => $request->capacite,
             'emplacement' => $request->emplacement,
             'updated_by' => auth()->id(), // Stocke l'utilisateur qui a fait la mise à jour
         ]);
     
         // Gérer l'image
         if ($request->hasFile('image')) {
             if ($equippement->image) {
                 $this->deleteOldImage($equippement->image);
             }
             $equippement->image = $this->uploadImage($request->file('image'));
         }
     
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
         $equipment = EquippementdeCollecte::findOrFail($id);
     
         // Vérifier si l'utilisateur connecté est autorisé à supprimer l'équipement
         if ($equipment->user_id !== auth()->id()) {
             return redirect()->route('equipments.index')
                              ->with('error', 'Vous n\'êtes pas autorisé à supprimer cet équipement.');
         }
     
         if ($equipment->image) {
             $this->deleteOldImage($equipment->image);
         }
     
         $equipment->delete();
     
         return redirect()->route('equipments.index')
                          ->with('success', 'Équipement supprimé avec succès.');
     }
     
    
}