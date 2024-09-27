@extends('Back/dashboard')

@section('content') 

<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="text-center mt-1 mb-3" style="color: green;">Add Event</h1>

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
                    <form id="eventForm" action="{{ route('evenement_collecte.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <!-- Title Field -->
                        <div class="mb-1">
                            <label class="form-label" for="titre">Title</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre') }}" 
                                   required minlength="3" maxlength="25" placeholder="Enter title (min 3 chars)">
                            <div class="text-danger input-required" style="display:none;">Input required</div> <!-- Required Message -->
                            <div class="invalid-feedback">Title must be between 3 and 25 characters.</div>
                        </div>

                        <!-- Description Field -->
                        <div class="mb-1">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required minlength="10"
                                      placeholder="Enter a description (min 10 chars)">{{ old('description') }}</textarea>
                            <div class="text-danger input-required" style="display:none;">Input required</div> <!-- Required Message -->
                            <div class="invalid-feedback">Description must be at least 10 characters long.</div>
                        </div>

                        <!-- Location Field -->
                        <div class="mb-1">
                            <label class="form-label" for="lieu">Location</label>
                            <input type="text" class="form-control" id="lieu" name="lieu" value="{{ old('lieu') }}" 
                                   required minlength="2" maxlength="25" placeholder="Enter location">
                            <div class="text-danger input-required" style="display:none;">Input required</div> <!-- Required Message -->
                            <div class="invalid-feedback">Location must be between 2 and 25 characters.</div>
                        </div>

                        <!-- Date Field -->
                        <div class="mb-1">
                            <label class="form-label" for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                            <div class="text-danger input-required" style="display:none;">Input required</div> <!-- Required Message -->
                            <div class="invalid-feedback">Please select a valid date.</div>
                        </div>

                        <!-- Time Field -->
                        <div class="mb-1">
                            <label class="form-label" for="heure">Time</label>
                            <input type="time" class="form-control" id="heure" name="heure" value="{{ old('heure') }}" required>
                            <div class="text-danger input-required" style="display:none;">Input required</div> <!-- Required Message -->
                            <div class="invalid-feedback">Please enter a valid time.</div>
                        </div>

                        <!-- Image Field -->
                        <div class="mb-1">
                            <label class="form-label" for="image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required style="display: none;">
                                <label class="custom-file-label btn" style="background-color: #287233; color: white; cursor: pointer;" for="image">
                                    Choose file
                                </label>
                                <div class="text-danger input-required" style="display:none;">Input required</div> <!-- Required Message -->
                                <div class="invalid-feedback">Please select an image file (jpg, jpeg, png, gif).</div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="">
                            <button type="submit" class="btn btn-primary mt-3 d-block mx-auto" style="background-color: #287233; border-color: #287233; color: white;">
                                Create
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
        const form = document.getElementById('eventForm');
        const inputRequiredMessages = document.querySelectorAll('.input-required');

        // Add the 'input' event listener to all form inputs to hide 'input required' when typing
        form.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', function() {
                if (input.value.trim() !== '') {
                    input.nextElementSibling.style.display = 'none'; // Hide 'Input required' message
                }
            });
        });

        form.addEventListener('submit', function(event) {
            let isValid = true;

            // Show 'Input required' messages for empty fields
            form.querySelectorAll('input, textarea').forEach(input => {
                if (!input.value.trim()) {
                    input.nextElementSibling.style.display = 'block'; // Show 'Input required' message
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
