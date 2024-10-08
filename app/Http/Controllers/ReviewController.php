<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\EvenementCollecte;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index($evenementId)
{
    $evenement = EvenementCollecte::findOrFail($evenementId);
    // Retrieve only reviews created by the logged-in user
    $reviews = $evenement->reviews()->where('user_id', auth()->id())->get();

    return view('Front.reviews.index', compact('evenement', 'reviews'));
}


    public function create($evenementId)
    {
        $evenement = EvenementCollecte::findOrFail($evenementId);
        return view('Front.reviews.create', compact('evenement'));
    }

    public function store(Request $request, $evenementId)
    {
        // Validate input
        $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ], [
            'comment.required' => 'Le commentaire est obligatoire.',
            'comment.string' => 'Le commentaire doit être une chaîne de caractères.',
            'comment.max' => 'Le commentaire ne doit pas dépasser 1000 caractères.',
            'rating.required' => 'La note est obligatoire.',
            'rating.integer' => 'La note doit être un nombre entier.',
            'rating.between' => 'La note doit être comprise entre 1 et 5.',
        ]);

        // Create the review
        Review::create([
            'evenement_collecte_id' => $evenementId,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'user_id' => auth()->id(),  // Attach the logged-in user's ID
        ]);
     

        return redirect()->route('reviews.index', $evenementId)->with('success', 'Review created successfully!');
    }
    
    
  public function edit($evenementId, $id)
{
    $review = Review::findOrFail($id);
    $evenement = EvenementCollecte::findOrFail($evenementId); // Fetch the associated event by ID
    return view('Front.reviews.edit', compact('review', 'evenement'));
}

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        $review = Review::findOrFail($id);
        $review->update($request->only('comment', 'rating'));

        return redirect()->route('reviews.index', $review->evenement_collecte_id)->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index', $review->evenement_collecte_id)->with('success', 'Review deleted successfully.');
    }
}
