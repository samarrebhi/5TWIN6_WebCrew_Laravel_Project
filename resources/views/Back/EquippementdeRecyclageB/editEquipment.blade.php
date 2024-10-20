@extends('Back/dashboard')

@section('content') 
<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="text-center mt-1 mb-3" style="color: green;">Modifier l'équipement</h1>

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
                    <form id="modifyEquipmentForm" action="{{ route('equipments.update', $equipment->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Nom Field -->
                        <div class="mb-1">
                            <label class="form-label" for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $equipment->nom) }}" 
                                   required minlength="3" maxlength="50" placeholder="Entrez le nom (min 3 caractères)">
                            <div class="invalid-feedback">Le nom doit comporter entre 3 et 50 caractères.</div>
                        </div>

                        <!-- Statut Field -->
                        <div class="mb-1">
                            <label class="form-label" for="statut">Statut</label>
                            <input type="text" class="form-control" id="statut" name="statut" value="{{ old('statut', $equipment->statut) }}" 
                                   required placeholder="Entrez le statut">
                            <div class="invalid-feedback">Le statut est requis.</div>
                        </div>

                        <!-- Capacité Field -->
                        <div class="mb-1">
                            <label class="form-label" for="capacite">Capacité</label>
                            <input type="number" class="form-control" id="capacite" name="capacite" value="{{ old('capacite', $equipment->capacite) }}" 
                                   required placeholder="Entrez la capacité">
                            <div class="invalid-feedback">La capacité est requise et doit être numérique.</div>
                        </div>

                        <!-- Emplacement Field -->
                        <div class="mb-1">
                            <label class="form-label" for="emplacement">Emplacement</label>
                            <input type="text" class="form-control" id="emplacement" name="emplacement" value="{{ old('emplacement', $equipment->emplacement) }}" 
                                   required placeholder="Entrez l'emplacement">
                            <div class="invalid-feedback">L'emplacement est requis.</div>
                        </div>

                        <!-- Affichage de l'image actuelle -->
                        @if($equipment->image)
                            <div class="mb-3">
                                <label for="current_image" class="form-label">Image actuelle</label>
                                <img src="{{ asset('uploads/Equipments/' . $equipment->image) }}" alt="Image actuelle" style="max-width: 100%; height: auto;">
                            </div>
                        @endif

                        <!-- Champ pour télécharger une nouvelle image (optionnel) -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Changer l'image (facultatif)</label>
                            <input type="file" name="image" class="form-control" id="image" accept="image/*" onchange="previewImage(event)">
                        </div>

                        <!-- Prévisualisation de l'image -->
                        <div class="mb-3" style="display: none;">
                            <img id="preview" src="#" alt="Image prévisualisée" style="max-width: 100%; height: auto;">
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-primary mt-3 d-block mx-auto" style="background-color: #287233; border-color: #287233; color: white;">
                                Modifier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

    // Validation Script
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('modifyEquipmentForm');

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
</script>
@endsection
