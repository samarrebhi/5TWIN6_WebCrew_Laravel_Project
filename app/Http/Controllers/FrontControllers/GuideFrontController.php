<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\GuideBP;
use App\Models\Sondage;
use Illuminate\Http\Request;

class GuideFrontController extends Controller
{

    public function index()
    {
        $guides=GuideBP::all();
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
