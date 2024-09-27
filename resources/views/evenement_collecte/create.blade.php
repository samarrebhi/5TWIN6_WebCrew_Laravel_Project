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
                    <form id="eventForm" action="{{ route('evenement_collecte.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-1">
                            <label class="form-label" for="titre">Title</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre') }}" 
                                   required minlength="3" maxlength="255" placeholder="Enter title (min 3 chars)">
                            <span class="invalid-feedback">Title must be between 3 and 255 characters.</span>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required minlength="10"
                                      placeholder="Enter a description (min 10 chars)">{{ old('description') }}</textarea>
                            <span class="invalid-feedback">Description must be at least 10 characters long.</span>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="lieu">Location</label>
                            <input type="text" class="form-control" id="lieu" name="lieu" value="{{ old('lieu') }}" 
                                   required minlength="2" maxlength="255" placeholder="Enter location">
                            <span class="invalid-feedback">Location must be between 2 and 255 characters.</span>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                            <span class="invalid-feedback">Please select a valid date.</span>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="heure">Time</label>
                            <input type="time" class="form-control" id="heure" name="heure" value="{{ old('heure') }}" required>
                            <span class="invalid-feedback">Please enter a valid time.</span>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required 
                                       style="display: none;">
                                <label class="custom-file-label btn" style="background-color: #287233; color: white; cursor: pointer;" for="image">
                                    Choose file
                                </label>
                                <span class="invalid-feedback">Please select an image file (jpg, jpeg, png, gif).</span>
                            </div>
                        </div>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const customFileInput = document.querySelector('.custom-file-input');
        const customFileLabel = customFileInput.nextElementSibling;

        // Display selected file name
        customFileInput.addEventListener('change', function(event) {
            const fileName = event.target.files[0] ? event.target.files[0].name : 'Choose file';
            customFileLabel.textContent = fileName;
        });

        // Form validation
        const form = document.getElementById('eventForm');
        form.addEventListener('submit', function(e) {
            const isValid = form.checkValidity();
            if (!isValid) {
                e.preventDefault(); // Prevent form submission if not valid
                form.classList.add('was-validated'); // Show validation messages
            }
        });
    });
</script>
@endsection
@endsection
