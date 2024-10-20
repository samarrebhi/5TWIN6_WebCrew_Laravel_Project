@extends('Front/layout')

@section('content')
<div class="container py-5">
    <a href="{{ route('equipments.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i> Back to All Equipments
    </a>

    <div class="card shadow-lg border-0">
        <div class="row g-0">
            <div class="col-md-6">
                @if ($equipment->image)
                    <img src="{{ asset('uploads/Equipments/' . $equipment->image) }}" 
                         alt="Image of {{ $equipment->nom }}" 
                         class="img-fluid rounded-start" 
                         style="height: 100%; object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-equipment.png') }}" 
                         alt="Default Equipment Image" 
                         class="img-fluid rounded-start" 
                         style="height: 100%; object-fit: cover;">
                @endif
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <div class="card-body p-5">
                    <h1 class="card-title mb-3">{{ $equipment->nom }}</h1>

                    <p class="card-text text-muted mb-2">
                        <i class="bi bi-info-circle"></i> 
                        <strong>Status:</strong> 
                        <span class="badge bg-{{ $equipment->statut === 'actif' ? 'success' : ($equipment->statut === 'en maintenance' ? 'warning' : 'danger') }}">
                            {{ ucfirst($equipment->statut) }}
                        </span>
                    </p>

                    <p class="card-text mb-2">
                        <i class="bi bi-archive"></i> 
                        <strong>Capacity:</strong> {{ $equipment->capacite }} units
                    </p>

                    <p class="card-text mb-4">
                        <i class="bi bi-geo-alt"></i> 
                        <strong>Location:</strong> {{ $equipment->emplacement }}
                    </p>

                    <a href="{{ route('front.equipments.index') }}" 
   class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2 text-white" 
   style="font-weight: 500; font-size: 16px; text-decoration: none;">
    <i class="bi bi-arrow-left-circle" style="font-size: 1.2rem;"></i> 
    Back to Equipments List
</a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
