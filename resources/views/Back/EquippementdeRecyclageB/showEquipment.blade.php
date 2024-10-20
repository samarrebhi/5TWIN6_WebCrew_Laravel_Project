@extends('Back.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Détails de l'équipement</h4>

    <div class="card">
        <div class="card-body">
            <h5>Nom : {{ $equipment->nom }}</h5>
            <p>Statut : {{ $equipment->statut }}</p>
            <p>Capacité : {{ $equipment->capacite }}</p>
            <p>Emplacement : {{ $equipment->emplacement }}</p>

            @if ($equipment->image)
                <img src="{{ asset('uploads/Equipments/' . $equipment->image) }}" 
                     alt="Image de {{ $equipment->nom }}" 
                     style="max-width: 100%; height: auto;">
            @else
                <p>Aucune image disponible.</p>
            @endif

            <a href="{{ route('equipments.index') }}" class="btn btn-primary mt-3">Retour</a>
        </div>
    </div>
</div>
@endsection
