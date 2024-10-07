@extends('Back/dashboard')

@section('content') 
<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="text-center mt-1 mb-3" style="color: green;">Modify Event</h1>

    @if (session('success'))
        <script>
            swal("Succès!", "{{ session('success') }}", "success");
        </script>
    @endif

    @if ($errors->any())
        <script>
            swal("Erreur!", "{{ implode(', ', $errors->all()) }}", "error");
        </script>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4" style="padding: 20px;">
                <div class="card-body" style="padding: 0;">
                    <form id="modifyEventForm" action="{{ route('evenement_collecte.update', $evenement->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Title Field -->
                        <div class="mb-1">
                            <label class="form-label" for="titre">Title</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $evenement->titre) }}" 
                                   required minlength="3" maxlength="25" placeholder="Enter title (min 3 chars)">
                            <div class="invalid-feedback">Title must be between 3 and 25 characters.</div>
                            <div class="text-danger" id="titreRequired" style="display:none;">Title must be between 3 and 25 characters.</div>
                        </div>

                        <!-- Description Field -->
                        <div class="mb-1">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required minlength="10" placeholder="Enter a description (min 10 chars)">{{ old('description', $evenement->description) }}</textarea>
                            <div class="invalid-feedback">Description must be at least 10 characters long.</div>
                            <div class="text-danger" id="descriptionRequired" style="display:none;">Description must be at least 10 characters long.</div>
                        </div>

                        <!-- Location Field -->
                        <div class="mb-1">
                            <label class="form-label" for="lieu">Location</label>
                            <input type="text" class="form-control" id="lieu" name="lieu" value="{{ old('lieu', $evenement->lieu) }}" 
                                   required minlength="2" maxlength="25" placeholder="Enter location">
                            <div class="invalid-feedback">Location must be between 2 and 25 characters.</div>
                            <div class="text-danger" id="lieuRequired" style="display:none;">Location must be between 2 and 25 characters.</div>
                        </div>

                        <!-- Date Field -->
                        <div class="mb-1">
                            <label class="form-label" for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($evenement->date)->format('Y-m-d')) }}" required>
                            <div class="invalid-feedback">Please select a valid date.</div>
                            <div class="text-danger" id="dateRequired" style="display:none;">Please select a valid date.</div>
                        </div>

                        <!-- Time Field -->
                        <div class="mb-1">
                            <label class="form-label" for="heure">Time</label>
                            <input type="time" class="form-control" id="heure" name="heure" value="{{ old('heure', $evenement->heure) }}" required>
                            <div class="invalid-feedback">Please enter a valid time.</div>
                            <div class="text-danger" id="heureRequired" style="display:none;">Please enter a valid time.</div>
                        </div>
<!-- Affichage de l'image actuelle -->
<!-- Image actuelle -->
<!-- Image actuelle -->
@if($evenement->image)
        <div class="mb-3">
            <label for="current_image" class="form-label">Image actuelle</label>
            <img src="{{ asset('uploads/evenements/' . $evenement->image) }}" alt="Image actuelle" style="max-width: 100%; height: auto;">
        </div>
    @endif

    <!-- Champ pour télécharger une nouvelle image (optionnel) -->
    <div class="mb-3">
        <label for="image" class="form-label">Changer l'image (facultatif)</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>
<!-- Script pour prévisualisation de l'image -->
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const preview = document.getElementById('preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-primary mt-3 d-block mx-auto" style="background-color: #287233; border-color: #287233; color: white;">
                                Modify
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Validation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('modifyEventForm');

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });

        // Hide custom 'required' messages once user types
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                const errorMsg = input.nextElementSibling.nextElementSibling;
                if (input.checkValidity()) {
                    errorMsg.style.display = 'none';
                } else {
                    errorMsg.style.display = 'block';
                }
            });
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
