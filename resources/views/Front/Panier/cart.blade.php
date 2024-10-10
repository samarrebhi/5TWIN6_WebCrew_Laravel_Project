@extends('Front/layout')
@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle">Categories</th>
                        <th scope="col" class="align-middle">Name</th>
                        <th scope="col" class="align-middle">Price</th>
                        <th scope="col" class="align-middle">Quantity</th>
                        <th scope="col" class="align-middle">Handle</th>
                        <th scope="col" class="align-middle">Payer</th> <!-- Colonne pour le bouton Payer ou le texte Déjà payé -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        @foreach($reservation->categories as $category)
                        <tr>
                            <th scope="row" class="align-middle">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('img/RecyclagePanier.jpg') }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td class="align-middle">{{ $category->name }}</td>
                            <td class="align-middle">{{ $reservation->prix }} Dt</td>
                            <td class="align-middle">{{ $category->pivot->quantity }}</td> <!-- Quantité du pivot -->
                            <td class="align-middle">
                                <!-- Icône pour supprimer l'article -->
                                <form action="{{ route('reservations.remove', $reservation->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE') <!-- Spécifie que c'est une requête DELETE -->
                                    <button type="submit" class="btn btn-link text-danger p-0">
                                        <i class="fas fa-times"></i> <!-- Icône de croix -->
                                    </button>
                                </form>
                            </td>
                            <td class="align-middle">
                                <!-- Vérification des états de confirmation et de refus -->
                                @if($reservation->refused_at)
                                    <!-- Si la commande est refusée -->
                                    <span class="text-danger">Commande refusée</span>
                                @elseif($reservation->paid_at)
                                    <!-- Si la commande est déjà payée, afficher "Déjà payé" -->
                                    <span class="text-success">Déjà payé</span>
                                @elseif($reservation->confirmed_at)
                                    <!-- Si la commande est confirmée mais pas encore payée, afficher le bouton payer -->
                                    <a href="{{ route('reservations.pay', $reservation->id) }}" class="btn btn-success">Payer</a>
                                @else
                                    <!-- Si la commande est en attente de confirmation -->
                                    <button class="btn btn-secondary" disabled>En attente de confirmation</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
