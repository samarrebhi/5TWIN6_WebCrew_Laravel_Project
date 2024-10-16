<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\Sondage; // Correctly importing your model
use Illuminate\Http\Request;

class SondageFrontController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'role:client');
        $this->middleware( 'role:admin');
    }
    public function index()
    {
        $sondages=sondage::all();
        return view('Front.Sondages affichage.getallsondage',compact('sondages'));
    }

    public function show($id)
    {
        // Find the event by ID
        $sondage=sondage::find($id);

        // Return the view with event data
        return view('Front.Sondages affichage.detailssondage', compact('sondage')); // Ensure the view is also correct
    }
}
