@extends('Front.layout')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">All Equipments</h2>

    <div class="row">
        @forelse($equippements as $equipment)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($equipment->image)
                        <img src="{{ asset('uploads/Equipments/' . $equipment->image) }}" 
                             alt="Image of {{ $equipment->nom }}" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default-equipment.png') }}" 
                             alt="Default Equipment Image" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                    <h5 class="card-title">
                    <h5 class="card-title mb-3">
    <i class="fas fa-recycle"></i> {{ $equipment->nom }}
</h5>
</h5>
<p class="card-text">
    <i class="fas fa-info-circle"></i> <strong>Status:</strong> {{ ucfirst($equipment->statut) }}
</p>
<p class="card-text">
    <i class="fas fa-battery-full"></i> <strong>Capacity:</strong> {{ $equipment->capacite }}
</p>
<p class="card-text">
    <i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $equipment->emplacement }}
</p>
<p class="card-text">
    <i class="fas fa-building"></i> <strong>Located Center:</strong> 
    {{ $equipment->center ? $equipment->center->name : 'Not Assigned' }}
</p>

                        <a href="{{ route('front.equipments.show', $equipment->id) }}" 
                           class="btn btn-primary mt-2 text-white">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No equipment found.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
