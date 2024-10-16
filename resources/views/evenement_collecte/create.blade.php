@extends('Back/dashboard')

@section('content') <head>
<!-- Add this in your <head> section -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script></head>

<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="text-center mt-1 mb-3" style="color: green;">Add Event</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4" style="padding: 20px;">
                <div class="card-body" style="padding: 0;">
                <form action="{{ route('evenement_collecte.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Titre -->
    <div class="mb-1">
        <label for="titre" class="form-label">Titre</label>
        
        <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre') }}" >
        @error('titre')
            <div class="invalid-feedback" >{{ $message }}</div>
        @enderror
    </div>

    <!-- Description -->
    <div class="mb-1">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" >{{ old('description') }}</textarea>
        @error('description')
            <div class="invalid-feedback" >{{ $message }}</div>
        @enderror
    </div>

    <!-- Lieu -->
    <div class="mb-1">
        <label for="lieu" class="form-label">Lieu</label>
        <input type="text" name="lieu" id="lieu" class="form-control @error('lieu') is-invalid @enderror" value="{{ old('lieu') }}" >
        @error('lieu')
            <div class="invalid-feedback" >{{ $message }}</div>
        @enderror
    </div>

    <!-- Date -->
    <div class="mb-1">
        <label for="date" class="form-label">Date</label>
        <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" >
        @error('date')
            <div class="invalid-feedback" >{{ $message }}</div>
        @enderror
    </div>

    <!-- Heure -->
    <div class="mb-1">
        <label for="heure" class="form-label">Heure</label>
        <input type="time" name="heure" id="heure" class="form-control @error('heure') is-invalid @enderror" value="{{ old('heure') }}" >
        @error('heure')
            <div class="invalid-feedback" >{{ $message }}</div>
        @enderror
    </div>

    <!-- Image -->
    <div class="mb-1">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <div class="invalid-feedback" >{{ $message }}</div>
        @enderror
    </div>

    <!-- Bouton de soumission -->
    <button type="submit" class="btn btn-primary">Create</button>
</form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Validation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
     

        form.addEventListener('submit', function(event) {
            let isValid = true;

            form.querySelectorAll('input, textarea').forEach(input => {
                if (!input.value.trim()) {
                    input.nextElementSibling.style.display = 'block'; 
                    isValid = false;
                }
            });

            // Prevent form submission if validation fails
            if (!isValid || !form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            // Add Bootstrap's validation classes
            form.classList.add('was-validated');
        });

        // Handle file input display
        const customFileInput = document.querySelector('.custom-file-input');
        const customFileLabel = customFileInput.nextElementSibling;

        customFileInput.addEventListener('change', function(event) {
            const fileName = event.target.files[0] ? event.target.files[0].name : 'Choose file';
            customFileLabel.textContent = fileName;
        });
    });
</script>
@endsection
