<?php

namespace App\Http\Controllers;
use App\Rules\NoBadWords;

use App\Models\Review;
use App\Models\EvenementCollecte;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
     public function adminIndex()
     {

         $reviews = Review::with(['evenementCollecte', 'user'])->get();
 
         return view('back.reviews.index', compact('reviews'));
     }
    public function index($evenementId)
    {
        $evenement = EvenementCollecte::findOrFail($evenementId);
        $reviews = $evenement->reviews()->where('user_id', auth()->id())->get();

        return view('Front.reviews.index', compact('evenement', 'reviews'));
    }

    public function create($evenementId)
    {
        $evenement = EvenementCollecte::findOrFail($evenementId);
        return view('Front.reviews.create', compact('evenement'));
    }

    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'approved']);

        return redirect()->route('reviews.index', $review->event_id)->with('success', 'Review approved successfully.');
    }

    public function reject($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'rejected']);

        return redirect()->route('reviews.index', $review->event_id)->with('success', 'Review rejected successfully.');
    }

    public function store(Request $request, $evenementId)
    {
        $request->validate([
            'comment' => ['required', 'string','min:3','max:40' ,new NoBadWords], 

            'rating' => 'required|integer|between:1,5',
            'would_recommend' => 'required|boolean',
        ]);
        
        Review::create([
            'evenement_collecte_id' => $evenementId,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'would_recommend' => $request->would_recommend,
            'anonymous' => $request->anonymous,
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('reviews.index', $evenementId)->with('success', 'Review created successfully!');
    }
    
    

    public function edit($evenementId, $id)
    {
        $review = Review::findOrFail($id);
        $evenement = EvenementCollecte::findOrFail($evenementId);

        return view('Front.reviews.edit', compact('review', 'evenement'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => ['required', 'string','min:3','max:40' ,new NoBadWords],  

            'rating' => 'required|integer|between:1,5',
            'would_recommend' => 'required|boolean',
        ]);
    
        $review = Review::findOrFail($id);
    
        $review->update($request->only('comment', 'rating', 'would_recommend'));
    
        return redirect()->route('reviews.index', ['evenementId' => $review->evenement_collecte_id])
                         ->with('success', 'Review updated successfully.');
    }
    
    public function destroy($evenementId, $reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $reviews = Review::whereHas('user', function($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->orWhereHas('evenementCollecte', function($q) use ($query) {
            $q->where('titre', 'like', '%' . $query . '%');
        })->get();
    
        return view('reviews.partials.review_table', compact('reviews'));
    }
    
    

}
