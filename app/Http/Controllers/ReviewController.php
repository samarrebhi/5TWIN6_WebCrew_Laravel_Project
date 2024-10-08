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
        $reviews = $evenement->reviews;

        return view('Front.reviews.index', compact('evenement', 'reviews'));
    }

    public function create($evenementId)
    {
        $evenement = EvenementCollecte::findOrFail($evenementId);
        return view('Front.reviews.create', compact('evenement'));
    }
    public function store(Request $request, $evenementId)
{
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

    Review::create([
        'evenement_collecte_id' => $evenementId,
        'comment' => $request->comment,
        'rating' => $request->rating,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('reviews.index', $evenementId)->with('success', 'Review created successfully!');
}

    

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.edit', compact('review'));
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
    public function show($id)
    {
        $evenement = EvenementCollecte::with('reviews.user')->findOrFail($id); // Eager load reviews with user
        return view('events.show', compact('evenement')); // Adjust the view name accordingly
    }
    
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index', $review->evenement_collecte_id)->with('success', 'Review deleted successfully.');
    }
}
