<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EquippementdeCollecte;

class EquippementControllerF extends Controller
{


    public function index()
    {
        $equippements=EquippementdeCollecte::all();
        return view('Front.EquippementdeRecyclageF.showallEquipmentsF',compact('equippements'));
    }


    public function show($id)
    {
        $equipment = EquippementdeCollecte::find($id);
    
        if (!$equipment) {
            return redirect()->route('equipments.index')->with('error', 'Équipement non trouvé.');
        }
    
        return view('Front.EquippementdeRecyclageF.showEquipmentF', compact('equipment'));
    }












}