@extends('Front/layout')
@section('content')
<div class="container py-5">
    <a href="{{ route('equipments.index') }}" class="btn btn-secondary mb-4">Back to All Equipments</a>

    <div class="card">
        <div class="row g-0">
            <div class="col-md-6">
                @if ($equipment->image)
                    <img src="{{ asset('uploads/Equipments/' . $equipment->image) }}" 
                         alt="Image of {{ $equipment->nom }}" 
                         class="img-fluid" 
                         style="height: 100%; object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-equipment.png') }}" 
                         alt="Default Equipment Image" 
                         class="img-fluid" 
                         style="height: 100%; object-fit: cover;">
                @endif
            </div>

            <div class="col-md-6">
                <div class="card-body">
                    <h3 class="card-title">{{ $equipment->nom }}</h3>
                    <p class="card-text"><strong>Status:</strong> {{ ucfirst($equipment->statut) }}</p>
                    <p class="card-text"><strong>Capacity:</strong> {{ $equipment->capacite }}</p>
                    <p class="card-text"><strong>Location:</strong> {{ $equipment->emplacement }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
