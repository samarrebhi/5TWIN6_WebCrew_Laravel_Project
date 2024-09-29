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
                                <a href="{{ route('admin.listBlog')}}" class="btn btn-sm btn-outline-primary"><i class="bx bx-list-ul me-1"></i>Aller Vers La Liste</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <h5 class="card-header m-0 me-2 pb-3">Create Your Blog</h5>

                <form id="createBlogForm" action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card border-0 shadow-lg"> 
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" name="titre" id="titre" placeholder="Taper le Titre" 
                                       class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre')}}">
                                @error('titre')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="texte" class="form-label">Text</label>
                                <textarea name="texte" id="texte" placeholder="Tapez le Texte" 
                                          class="form-control @error('texte') is-invalid @enderror">{{ old('texte')}}</textarea>
                                @error('texte')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="support" class="form-label">Support</label>
                                <textarea name="support" id="support" placeholder="Tapez les Supports" 
                                          class="form-control">{{ old('support')}}</textarea>
                            </div>
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
                                @error('image')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#confirmModal">Done</button>
                </form>

                <!-- Modal de Confirmation -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Confirmation de Création</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir créer ce blog ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-primary" id="confirmSubmit">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('confirmSubmit').addEventListener('click', function() {
                        document.getElementById('createBlogForm').submit();
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
