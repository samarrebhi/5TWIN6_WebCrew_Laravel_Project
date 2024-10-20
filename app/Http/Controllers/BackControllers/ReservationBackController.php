<?php

namespace App\Http\Controllers\BackControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;


class ReservationBackController extends Controller
{
    
    public function listCommande(Request $request) {
        $query = Reservation::with('categories');
    
        if ($request->has('category_name') && $request->input('category_name') != '') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('category_name') . '%');
            });
        }
    
        if ($request->has('status') && $request->input('status') != '') {
            $status = $request->input('status');
    
            if ($status === 'paid') {
                $query->whereNotNull('confirmed_at')->whereNotNull('paid_at');
            } elseif ($status === 'unpaid') {
                $query->whereNotNull('confirmed_at')->whereNull('paid_at');
            } elseif ($status === 'refused') {
                $query->whereNotNull('refused_at');
            }
        }
    
        $reservations = $query->get();
    
        return view('Back.Commande.listcomm', compact('reservations'));
    }
    

    
    public function confirm($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->confirmed_at = now(); 
    $reservation->refused_at = null; 
    $reservation->save();

    return redirect()->route('commandeList')->with('success', 'Réservation confirmée avec succès.');
}

public function refuse($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->refused_at = now(); 
    $reservation->confirmed_at = null; 
    $reservation->save();

    return redirect()->route('commandeList')->with('success', 'Réservation refusée avec succès.');
}

    
}
