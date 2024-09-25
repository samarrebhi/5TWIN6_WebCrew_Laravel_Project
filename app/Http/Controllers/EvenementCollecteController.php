<?php

namespace App\Http\Controllers;
use App\Models\EvenementCollecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
class EvenementCollecteController extends Controller
{
 
    /**
     * Lister les événements avec pagination
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $evenements = EvenementCollecte::all(); // Récupère tous les événements

        $evenements = EvenementCollecte::orderBy('id', 'DESC')->paginate(50);
        return view('evenement_collecte.list', ['evenements' => $evenements]);
    }

    /**
     * Afficher le formulaire de création d'événement
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('evenement_collecte.create');
    }

    /**
     * Enregistrer un nouvel événement
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validator = Validator::make($request->all(), [
            'titre' => 'required|max:255',
            'description' => 'required',
            'lieu' => 'required|max:255',
            'date' => 'required|date',
            'heure' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg'
        ]);

        if ($validator->passes()) {
            // Création de l'événement
            $evenement = EvenementCollecte::create($request->post());

            // Gestion du téléchargement d'image
            if ($request->image) {
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
     * @param EvenementCollecte $evenement
     * @return \Illuminate\View\View
     */
    public function edit(EvenementCollecte $evenement)
    {
        return view('evenement_collecte.edit', ['evenement' => $evenement]);
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
            'image' => 'sometimes|image:gif,png,jpeg,jpg'
        ]);

        if ($validator->passes()) {
            // Mise à jour des données
            $evenement->fill($request->post())->save();

            // Gestion du téléchargement d'une nouvelle image
            if ($request->image) {
                $oldImage = $evenement->image;

                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->image->move(public_path() . '/uploads/evenements/', $newFileName);

                $evenement->image = $newFileName;
                $evenement->save();

                // Suppression de l'ancienne image
                File::delete(public_path() . '/uploads/evenements/' . $oldImage);
            }

            return redirect()->route('evenement_collectes.index')->with('success', 'Événement mis à jour avec succès.');
        } else {
            // Retourner avec des erreurs
            return redirect()->route('evenement_collectes.edit', $evenement->id)->withErrors($validator)->withInput();
        }
    }
    public function show($id)
    {
        $evenementCollecte = EvenementCollecte::findOrFail($id); // Assuming you have a model named EvenementCollecte
        return view('evenement_collectes.show', compact('evenementCollecte'));
    }
    
    /**
     * Supprimer un événement
     *
     * @param EvenementCollecte $evenement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(EvenementCollecte $evenement)
    {
        // Suppression de l'image associée
        File::delete(public_path() . '/uploads/evenements/' . $evenement->image);

        // Suppression de l'événement
        $evenement->delete();

        return redirect()->route('evenement_collectes.index')->with('success', 'Événement supprimé avec succès.');
    }
}