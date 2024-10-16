<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentMail;
use App\Models\Reservation;
use App\Models\User;

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
            'fidelity_points' => 'required|integer|min:0|max:' . auth()->user()->fidelity_points,
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

            // Appliquer la réduction basée sur les points de fidélité utilisés
            $fidelityPointsUsed = $request->fidelity_points;
            $user = auth()->user();
            $user->fidelity_points -= $fidelityPointsUsed; // Déduire les points utilisés du total de l'utilisateur
            $user->save();

            // Réduire le montant total à payer si les points de fidélité sont utilisés
            $discount = $fidelityPointsUsed * 0.02; // Par exemple, chaque point réduit de 2% le prix
            $totalAmount = $reservation->prix - ($reservation->prix * $discount);

            // Assurez-vous que le montant final ne soit pas négatif
            $totalAmount = max($totalAmount, 0);

            // Mise à jour du prix de la réservation après la réduction
            $reservation->prix = $totalAmount;
            $reservation->paid_at = now();
            $reservation->fidelity_points_used = $fidelityPointsUsed;
            $reservation->save();

            // Réduire la quantité des catégories après paiement
            foreach ($reservation->categories as $category) {
                $quantityPaid = $category->pivot->quantity;

                // Réduire la quantité dans la table 'categories'
                $category->quantity -= $quantityPaid;
                $category->save();
            }

            // Rediriger l'utilisateur avec un message de succès
            return redirect()->route('cart')->with('success', 'Paiement effectué avec succès. Quantités mises à jour et points de fidélité appliqués.');
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
