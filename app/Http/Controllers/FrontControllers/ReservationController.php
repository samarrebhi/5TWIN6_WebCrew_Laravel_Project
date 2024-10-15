<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

   
public function shop($id)
{
    // Récupérer la catégorie en fonction de l'ID
    $category = Category::findOrFail($id);

    // Retourner la vue avec les détails de la catégorie
    return view('Front.Panier.buy', compact('category'));
}

public function store(Request $request)
{
    // Valider les données du formulaire
    $validatedData = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'quantity' => 'required|integer|min:1',
        'prix' => 'required|numeric|min:0',  // Le prix est associé à la réservation
    ]);

    // Créer une nouvelle réservation et enregistrer le prix
    $reservation = new Reservation();
    $reservation->quantity = $validatedData['quantity'];
    $reservation->prix = $validatedData['prix'];
    $reservation->user_id = Auth::id(); 
    $reservation->save();

    // Associer la catégorie à la réservation via la table pivot en insérant la quantité
    $reservation->categories()->attach($validatedData['category_id'], [
        'quantity' => $validatedData['quantity'],
    ]);

    // Rediriger vers une page de confirmation ou le panier
    return redirect()->route('cart')->with('success', 'Product added to cart!');
}



public function showCart()
{
    // Récupérer les réservations avec les catégories associées
    $reservations = Reservation::with('categories')->where('user_id', Auth::id())->get();

    // Passer les données à la vue
    return view('Front.Panier.cart', compact('reservations'));
}


public function remove($id)
{
    // Trouver la réservation et la supprimer
    $reservation = Reservation::findOrFail($id);
    
    // Supprimer la réservation ou une catégorie spécifique de la réservation
    $reservation->delete();

    // Rediriger vers la page du panier avec un message de succès
    return redirect()->route('cart')->with('success', 'Item removed from cart');
}


public function pay($id)
{
    // Récupérer la réservation en fonction de l'ID
    $reservation = Reservation::findOrFail($id);

    // Retourner la vue avec les détails de la réservation
    return view('Front.Panier.payement', compact('reservation'));
}


}
