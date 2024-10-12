<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentMail;
use App\Models\Reservation;


class PaymentController extends Controller
{
    public function processPayment(Request $request, $id)
{
    // Valider les données du formulaire
    $request->validate([
        'email' => 'required|email',
        'cardNumber' => 'required|string',
        'expiration' => 'required|string',
        'cvc' => 'required|string',
        'amount' => 'required|numeric',
    ]);

    // Logique de validation ou d'API de paiement ici
    $paymentSuccess = true; // Simuler un paiement réussi

    if ($paymentSuccess) {
        // Envoyer l'e-mail de confirmation
        $this->sendConfirmationEmail($request->email, 'Votre paiement a été effectué avec succès.');

        // Récupérer la réservation et les catégories associées
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return redirect()->back()->withErrors('Réservation introuvable.');
        }

        // Réduire la quantité des catégories après paiement
        foreach ($reservation->categories as $category) {
            $quantityPaid = $category->pivot->quantity;

            // Réduire la quantité dans la table 'categories'
            $category->quantity -= $quantityPaid;
            $category->save();
        }

        // Mettre à jour la date de paiement
        $reservation->paid_at = now();
        $reservation->save();

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('cart')->with('success', 'Paiement effectué. Quantités mises à jour.');
    }

    // Gérer les erreurs de paiement
    return redirect()->back()->with('error', 'Le paiement a échoué.');
}


    protected function sendConfirmationEmail($email, $messageContent)
    {
        try {
            // Envoyer l'e-mail en utilisant la classe PaymentMail
            Mail::to($email)->send(new PaymentMail($messageContent));
            return true; // Indique que l'e-mail a été envoyé avec succès
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'envoi de l\'e-mail : ' . $e->getMessage());
            return false; // Indique que l'e-mail n'a pas été envoyé
        }
    }
}
