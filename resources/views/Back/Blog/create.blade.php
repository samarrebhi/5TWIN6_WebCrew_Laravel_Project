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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

                <!-- Formulaire de création -->
                <form id="createBlogForm" action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="card border-0 shadow-lg"> 
                        <div class="card-body">
                            <!-- Champ Titre -->
                            <div class="mb-3">
                                <label for="titre" class="form-label">Title</label>
                                <input type="text" name="titre" id="titre" placeholder="Type the Title" 
                                       class="form-control " value="{{ old('titre') }}" required>
                               
                            </div>

                            <!-- Champ Texte -->
                            <div class="mb-3">
                                <label for="texte" class="form-label">Text</label>
                                <textarea name="texte" id="texte" placeholder="Type the Text" 
                                          class="form-control " required>{{ old('texte') }}</textarea>
                             
                            </div>

                            <!-- Champ Support -->
                            <div class="mb-3">
                                <label for="support" class="form-label">Support</label>
                                <textarea name="support" id="support" placeholder="Type the Supports" 
                                          class="form-control " required>{{ old('support') }}</textarea>
                            
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
                                        class="account-file-input "
                                        hidden
                                        accept="image/png, image/jpeg"
                                    />
                                </label>
                              
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3" id="openModalBtn">Done</button>

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

             
            </div>
        </div>
    </div>
</div>

@endsection
