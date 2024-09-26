<?php

namespace App\Http\Controllers;

use App\Models\EvenementCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EvenementCollecteController extends Controller
{
    /**
     * Lister les événements avec pagination
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $evenements = EvenementCollecte::orderBy('id', 'DESC')->paginate(50);
        return view('evenement_collecte.list', ['evenements' => $evenements]);
    }

    public function create()
    {
        return view('evenement_collecte.create');
    }
    
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validator = Validator::make($request->all(), [
            'titre' => 'required|max:255',
            'description' => 'required',
            'lieu' => 'required|max:255',
            'date' => 'required|date',
            'heure' => 'required',
            'image' => 'sometimes|mimes:gif,png,jpeg,jpg'
        ]);
    
        if ($validator->passes()) {
            // Création de l'événement
            $evenement = EvenementCollecte::create($request->post());
    
            // Gestion du téléchargement d'image
            if ($request->hasFile('image')) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->image->move(public_path() . '/uploads/evenements/', $newFileName);
    
                $evenement->image = $newFileName;
                $evenement->save();
            }
    
            return redirect()->route('evenement_collectes.index')->with('success', 'Événement ajouté avec succès.');
        } else {
            // Retourner avec des erreurs
            return redirect()->route('evenement_collectes.create')->withErrors($validator)->withInput();
        }
    }
    
    /**
     * Afficher le formulaire de modification
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $evenement = EvenementCollecte::findOrFail($id); // Ensure you get the correct instance
        return view('evenement_collecte.edit', compact('evenement'));
    }

    /**
     * Mettre à jour un événement existant
     *
     * @param EvenementCollecte $evenement
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EvenementCollecte $evenement, Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'titre' => 'required|max:255',
            'description' => 'required',
            'lieu' => 'required|max:255',
            'date' => 'required|date',
            'heure' => 'required',
            'image' => 'sometimes|mimes:gif,png,jpeg,jpg'
        ]);

        if ($validator->passes()) {
            // Mise à jour des données
            $evenement->fill($request->post())->save();

            // Gestion du téléchargement d'une nouvelle image
            if ($request->hasFile('image')) {
                $oldImage = $evenement->image;

                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->image->move(public_path() . '/uploads/evenements/', $newFileName);

                $evenement->image = $newFileName;
                $evenement->save();

                // Suppression de l'ancienne image
                if ($oldImage && File::exists(public_path() . '/uploads/evenements/' . $oldImage)) {
                    File::delete(public_path() . '/uploads/evenements/' . $oldImage);
                }
            }

            return redirect()->route('evenement_collectes.index')->with('success', 'Événement mis à jour avec succès.');
        } else {
            // Retourner avec des erreurs
            return redirect()->route('evenement_collectes.edit', $evenement->id)->withErrors($validator)->withInput();
        }
    }

    /**
     * Afficher un événement
     *
     * @param EvenementCollecte $evenement_collecte
     * @return \Illuminate\View\View
     */
    public function show(EvenementCollecte $evenement_collecte)
    {
        return view('evenement_collecte.show', compact('evenement_collecte'));
    }

    /**
     * Supprimer un événement
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $evenement = EvenementCollecte::find($id);
    
        if ($evenement) {
            $evenement->delete();
            return response()->json(['message' => 'Événement supprimé avec succès.'], 200);
        } else {
            return response()->json(['message' => 'Événement non trouvé.'], 404);
        }
    }
}
