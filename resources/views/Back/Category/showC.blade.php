@extends('Back.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Détails de la Catégorie de Déchet</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3 text-primary">Nom : {{ $Category->name }}</h5>
            
            <p><strong>Quantité :</strong> {{ $Category->quantity }}</p>
            <p><strong>État :</strong> {{ ucfirst($Category->state) }}</p>
            <p><strong>Impact Environnemental :</strong> {{ ucfirst($Category->environmental_impact) }}</p>

            <div class="text-center mt-4">
                <a href="{{ route('Categories.index') }}" class="btn btn-primary">Retour aux Catégories</a>
            </div>
        </div>
    </div>
</div>
@endsection
