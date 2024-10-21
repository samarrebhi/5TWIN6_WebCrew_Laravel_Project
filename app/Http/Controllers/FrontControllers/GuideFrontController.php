<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\GuideBP;
use App\Models\Sondage;
use Illuminate\Http\Request;

class GuideFrontController extends Controller
{
    /*public function __construct()
    {
        $this->middleware( 'role:client');
    }*/
    public function index(Request $request)
    {

        $search = $request->input('search');

        // Search by title or category if the search keyword is present
        $guides = GuideBP::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
        })->paginate(6); // Adjust the number of items per page

        return view('Front.Guides affichage.getallguide',compact('guides'));
    }

    public function show($id)
    {

        $guide=GuideBP::find($id);

        // Return the view with event data
        return view('Front.Guides affichage.displayguide', compact('guide'));
    }
    public function showbypoll($id)
    {
        // Find the guide by ID and load related sondages using the relationship
        $guide = GuideBP::with('sondages')->findOrFail($id);

        // Pass the guide and its sondages to the view
        return view('Front.Guides affichage.displayguide', compact('guide'));
    }
}
