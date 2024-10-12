<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\EvenementCollecte;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Afficher les reviews de l'utilisateur connecté pour un événement spécifique
    public function index($evenementId)
    {
        $evenement = EvenementCollecte::findOrFail($evenementId);
        $reviews = $evenement->reviews()->where('user_id', auth()->id())->get();

        return view('Front.reviews.index', compact('evenement', 'reviews'));
    }

    // Formulaire pour créer une nouvelle review
    public function create($evenementId)
    {
        $evenement = EvenementCollecte::findOrFail($evenementId);
        return view('Front.reviews.create', compact('evenement'));
    }

    // Approuver une review
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'approved']);

        return redirect()->route('reviews.index', $review->event_id)->with('success', 'Review approved successfully.');
    }

    // Rejeter une review
    public function reject($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'rejected']);

        return redirect()->route('reviews.index', $review->event_id)->with('success', 'Review rejected successfully.');
    }

    // Sauvegarder une nouvelle review
    public function store(Request $request, $evenementId)
    {
        // Validate the request input
        $request->validate([
            'comment' => 'required|string|max:250',
            'rating' => 'required|integer|between:1,5',
            'would_recommend' => 'required|boolean',
            'anonymous' => 'nullable|boolean',
        ]);
    
        // Create the review and ensure 'evenement_collecte_id' is provided
        Review::create([
            'evenement_collecte_id' => $evenementId, // Ensure this line is present and correct
            'comment' => $request->comment,
            'rating' => $request->rating,
            'would_recommend' => $request->would_recommend,
            'anonymous' => $request->anonymous,
            'user_id' => auth()->id(),
        ]);
    
        // Redirect after successful creation
        return redirect()->route('reviews.index', $evenementId)->with('success', 'Review created successfully!');
    }
    

    // Formulaire pour éditer une review existante
    public function edit($evenementId, $id)
    {
        $review = Review::findOrFail($id);
        $evenement = EvenementCollecte::findOrFail($evenementId);

        return view('Front.reviews.edit', compact('review', 'evenement'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:250',
            'rating' => 'required|integer|between:1,5',
            'would_recommend' => 'required|boolean',
            'anonymous' => 'nullable|boolean',
        ]);
    
        $review = Review::findOrFail($id);
    
        // Update the review with the new data
        $review->update($request->only('comment', 'rating', 'would_recommend', 'anonymous'));
    
        // Redirect back to the reviews.index route, passing the correct evenement_collecte_id
        return redirect()->route('reviews.index', ['evenementId' => $review->evenement_collecte_id])
                         ->with('success', 'Review updated successfully.');
    }
    
    // Supprimer une review
    public function destroy($evenementId, $reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }
}
