@extends('Back/dashboard')

@section('content') 
<div class="container">
    <h1 class="text-center mt-4 mb-3" style="color: green;">Event Details</h1>
    <div class="d-flex justify-content-center mt-4">
        <div class="card mb-4" style="width: 50%; padding: 20px;">
            <div class="card-body">
                <h5 class="card-title">{{ $evenement->titre }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $evenement->description }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $evenement->lieu }}</p>
                <p class="card-text"><strong>Date:</strong> {{ $evenement->date }}</p>
                <p class="card-text"><strong>Time:</strong> {{ $evenement->heure }}</p>
                <div class="mb-3">
                    @if($evenement->image)
                        <img src="{{ asset('uploads/evenements/' . $evenement->image) }}" alt="Event Image" class="img-fluid">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
