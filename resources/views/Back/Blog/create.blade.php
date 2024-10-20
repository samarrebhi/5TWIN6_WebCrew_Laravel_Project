@extends('Back/dashboard') 
@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                <a href="{{ route('admin.listBlog')}}" class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-list-ul me-1"></i> Jump to list
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <h5 class="card-header m-0 me-2 pb-3">Create Your Blog</h5>

                <!-- Formulaire de création -->
                <form id="createBlogForm" action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="card border-0 shadow-lg"> 
                        <div class="card-body">
                            <!-- Champ Titre -->
                            <div class="mb-3">
                                <label for="titre" class="form-label">Title</label>
                                <input type="text" name="titre" id="titre" placeholder="Type the Title" 
                                       class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre') }}" required>
                                <div class="invalid-feedback" id="titreError"></div>
                                @error('titre')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Champ Texte -->
                            <div class="mb-3">
                                <label for="texte" class="form-label">Text</label>
                                <textarea name="texte" id="texte" placeholder="Type the Text" 
                                          class="form-control @error('texte') is-invalid @enderror" required>{{ old('texte') }}</textarea>
                                <div class="invalid-feedback" id="texteError"></div>
                                @error('texte')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Champ Support -->
                            <div class="mb-3">
                                <label for="support" class="form-label">Support</label>
                                <textarea name="support" id="support" placeholder="Type the Supports" 
                                          class="form-control @error('support') is-invalid @enderror" required>{{ old('support') }}</textarea>
                                <div class="invalid-feedback" id="supportError"></div>
                                @error('support')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Champ Image -->
                            <div class="mb-3">
                                <label for="upload" class="btn btn-secondary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                        type="file"
                                        id="upload"
                                        name="image"
                                        class="account-file-input @error('image') is-invalid @enderror"
                                        hidden
                                        accept="image/png, image/jpeg"
                                    />
                                </label>
                                <div class="invalid-feedback" id="imageError"></div>
                                @error('image')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Bouton d'envoi qui déclenche le modal -->
                    <button type="button" class="btn btn-primary mt-3" id="openModalBtn">Done</button>
                </form>

                <!-- Modal de Confirmation -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Confirmation </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Are you sure you want to create this blog?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="confirmSubmit">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validation JavaScript -->
                <script>
                    function validateForm() {
                        let isValid = true;

                        // Validation du champ Titre
                        const titre = document.getElementById('titre');
                        const titreError = document.getElementById('titreError');
                        if (titre.value.trim() === "") {
                            titre.classList.add('is-invalid');
                            titreError.textContent = "Title is required.";
                            isValid = false;
                        } else {
                            titre.classList.remove('is-invalid');
                            titreError.textContent = "";
                        }

                        // Validation du champ Texte (au moins 3 mots)
                        const texte = document.getElementById('texte');
                        const texteError = document.getElementById('texteError');
                        const wordCount = texte.value.trim().split(/\s+/).length;
                        if (texte.value.trim() === "") {
                            texte.classList.add('is-invalid');
                            texteError.textContent = "Text is required.";
                            isValid = false;
                        } else if (wordCount < 3) {
                            texte.classList.add('is-invalid');
                            texteError.textContent = "The text field must contain at least three words.";
                            isValid = false;
                        } else {
                            texte.classList.remove('is-invalid');
                            texteError.textContent = "";
                        }

                        // Validation du champ Support
                        const support = document.getElementById('support');
                        const supportError = document.getElementById('supportError');
                        if (support.value.trim() === "") {
                            support.classList.add('is-invalid');
                            supportError.textContent = "Support is required.";
                            isValid = false;
                        } else {
                            support.classList.remove('is-invalid');
                            supportError.textContent = "";
                        }

                        // Validation du type de fichier pour l'image
                        const upload = document.getElementById('upload');
                        const imageError = document.getElementById('imageError');
                        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                        if (upload.files.length > 0 && !allowedExtensions.exec(upload.value)) {
                            imageError.textContent = "Seuls les fichiers .jpeg et .png sont acceptés.";
                            upload.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            imageError.textContent = "";
                            upload.classList.remove('is-invalid');
                        }

                        return isValid; // Retourne true si tous les champs sont valides
                    }

                    // Gestionnaire de clic pour ouvrir le modal après validation
                    document.getElementById('openModalBtn').addEventListener('click', function() {
                        if (validateForm()) {
                            new bootstrap.Modal(document.getElementById('confirmModal')).show();
                        }
                    });

                    // Soumission du formulaire lorsque l'utilisateur confirme dans le modal
                    document.getElementById('confirmSubmit').addEventListener('click', function() {
                        document.getElementById('createBlogForm').submit();
                    });
                </script>
            </div>
        </div>
    </div>
</div>

@endsection
