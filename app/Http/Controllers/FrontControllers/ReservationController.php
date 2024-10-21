<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

   
public function shop($id)
{
    $category = Category::findOrFail($id);
    return view('Front.Panier.buy', compact('category'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'quantity' => 'required|integer|min:1|max:100', 
        'prix' => 'required|numeric|min:0|max:1000', 
    ], [
        'category_id.required' => 'La catégorie est obligatoire.',
        'category_id.exists' => 'La catégorie sélectionnée est invalide.',
        'quantity.required' => 'La quantité est obligatoire.',
        'quantity.integer' => 'La quantité doit être un entier.',
        'quantity.min' => 'La quantité doit être au moins de 1.',
        'quantity.max' => 'La quantité ne peut pas dépasser 100.', 
        'prix.required' => 'Le prix est obligatoire.',
        'prix.numeric' => 'Le prix doit être un nombre.',
        'prix.min' => 'Le prix doit être au moins de 0.',
        'prix.max' => 'Le prix ne peut pas dépasser 1000.', 
    ]);

    $reservation = new Reservation();
    $reservation->quantity = $validatedData['quantity'];
    $reservation->prix = $validatedData['prix'];
    $reservation->user_id = Auth::id();
    $reservation->save();

    $reservation->categories()->attach($validatedData['category_id'], [
        'quantity' => $validatedData['quantity'],
    ]);

    if ($validatedData['prix'] > 50) {
        $extraAmount = $validatedData['prix'] - 50;
        $points = floor($extraAmount / 10);

        $user = User::find(Auth::id());
        $user->fidelity_points += $points;
        $user->save();
    }

    return redirect()->route('cart')->with('success', 'Produit ajouté au panier !');
}

public function showCart()
{
    $reservations = Reservation::with('categories')->where('user_id', Auth::id())->get();

    return view('Front.Panier.cart', compact('reservations'));
}

public function edit($id) {

    $reservation = Reservation::findOrFail($id);
    $category = $reservation->categories()->first();
    return view('Front.Panier.editReserv', compact('reservation', 'category'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'quantity' => 'sometimes|integer|min:1|max:100',  
        'prix' => 'sometimes|numeric|min:0|max:1000', 
    ]);

    $reservation = Reservation::findOrFail($id);

    if ($request->has('quantity')) {
        $reservation->quantity = $validatedData['quantity'];
        $reservation->categories()->updateExistingPivot($request->input('category_id'), [
            'quantity' => $validatedData['quantity'],
        ]);
    }

    if ($request->has('prix')) {
        $reservation->prix = $validatedData['prix'];
    }

    $reservation->save();

    \Log::info('Reservation updated:', [
        'id' => $reservation->id,
        'quantity' => $reservation->quantity,
        'prix' => $reservation->prix,
    ]);

    return redirect()->route('cart')->with('success', 'La réservation a été mise à jour avec succès !');
}


public function remove($id)
{
    $reservation = Reservation::findOrFail($id);
    
    $reservation->delete();

    return redirect()->route('cart')->with('success', 'Item removed from cart');
}


public function pay($id)
{
    $reservation = Reservation::findOrFail($id);

    return view('Front.Panier.payement', compact('reservation'));
}


}
