<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\GuideBP;
use App\Models\Sondage; // Correctly importing your model
use Illuminate\Http\Request;

class SondageFrontController extends Controller
{
/*
    public function __construct()
    {
        $this->middleware( 'role:client');
    }*/
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Search by title or category if the search keyword is present
        $sondages = Sondage::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
        })->paginate(6); // Adjust the number of items per page

        return view('Front.Sondages affichage.getallsondage',compact('sondages'));
    }

    public function show($id)
    {
        // Find the event by ID
        $sondage=sondage::find($id);

        // Return the view with event data
        return view('Front.Sondages affichage.detailssondage', compact('sondage'));
    }
    public function getSondagesByGuide($guideId,Request $request)
    {

        $guide = GuideBP::findOrFail($guideId);

        $search = $request->input('search');

// Retrieve and filter sondages by guide_bp_id and search criteria, then paginate
        $sondages = Sondage::where('guide_bp_id', $guideId)
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            })
            ->paginate(6); // Adjust the number of items per page



        return view('Front.Sondages affichage.sondagesByGuide', compact('guide', 'sondages'));
    }
}
