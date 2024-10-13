<?php

namespace App\Http\Controllers;
use App\Rules\NoBadWords;

use App\Models\Review;
use App\Models\EvenementCollecte;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
     // Method to display all reviews with associated events and users
     public function adminIndex()
     {

         // Retrieve all reviews with associated events and users
         $reviews = Review::with(['evenementCollecte', 'user'])->get();
 
         return view('back.reviews.index', compact('reviews'));
     }
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
            'comment' => ['required', 'string','min:3','max:40' ,new NoBadWords],  // Apply the custom rule here

            'rating' => 'required|integer|between:1,5',
            'would_recommend' => 'required|boolean',
        ]);
        
        // If validation passes, create the review
        Review::create([
            'evenement_collecte_id' => $evenementId,
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
            'comment' => ['required', 'string','min:3','max:40' ,new NoBadWords],  // Apply the custom rule here

            'rating' => 'required|integer|between:1,5',
            'would_recommend' => 'required|boolean',
        ]);
    
        $review = Review::findOrFail($id);
    
        // Update the review with the new data
        $review->update($request->only('comment', 'rating', 'would_recommend'));
    
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

    public function search(Request $request)
    {
        $query = $request->input('query');
        // Search reviews by user name or event title
        $reviews = Review::whereHas('user', function($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->orWhereHas('evenementCollecte', function($q) use ($query) {
            $q->where('titre', 'like', '%' . $query . '%');
        })->get();
    
        // Return the partial view with the filtered reviews
        return view('reviews.partials.review_table', compact('reviews'));
    }
    
    

}
