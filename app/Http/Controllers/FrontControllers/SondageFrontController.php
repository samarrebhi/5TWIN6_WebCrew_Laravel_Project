<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\GuideBP;
use App\Models\Sondage; // Correctly importing your model
use Illuminate\Http\Request;

class SondageFrontController extends Controller
{


    public function index()
    {
       // $sondages=sondage::all();
        // Fetch polls with pagination
        $sondages = Sondage::paginate(6);

        return view('Front.Sondages affichage.getallsondage',compact('sondages'));
    }

    public function show($id)
    {
        // Find the event by ID
        $sondage=sondage::find($id);

        // Return the view with event data
        return view('Front.Sondages affichage.detailssondage', compact('sondage'));
    }
    public function getSondagesByGuide($guideId)
    {

        $guide = GuideBP::findOrFail($guideId);
        $sondages = Sondage::where('guide_bp_id', $guideId)->get();


        return view('Front.Sondages affichage.sondagesByGuide', compact('guide', 'sondages'));
    }
}
