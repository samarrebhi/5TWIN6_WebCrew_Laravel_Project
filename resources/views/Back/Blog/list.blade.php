@extends('Back/dashboard')
@section('content') 

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Félicitations ! 🌿</h5>
                                <p class="mb-4">
                                Vous avez contribué à réduire <span class="fw-bold">72 % </span> de déchets supplémentaires aujourd'hui. 
                                Découvrez votre nouveau badge de recyclage dans votre profil."
                                </p>
                                <a href="{{ route('admin.createBlog')}}" class="btn btn-sm btn-outline-primary">Ajouter </a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="../back/assets/img/illustrations/man-with-laptop-light.png"
                                    height="140"
                                    alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <h5 class="card-header m-0 me-2 pb-3">Blogs</h5>
                <table class="table table-striped table-hover mx-auto col-lg-12" style="width: 80%;">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Texte</th>
                        <th>Support</th>
                        <th>Likes</th>
                        <th>Users</th>
                        <th>Actions</th>
                    </tr>

                    @if($blogs->isNotEmpty())
                        @foreach ($blogs as $blog)
                        <tr valign="middle">
                            <td>{{ $blog->id }}</td>
                            <td>
                                @if($blog->image != '' && file_exists(public_path().'/uploads/blogs/'.$blog->image))
                                <img src="{{ url('uploads/blogs/'.$blog->image) }}" alt="" height="40" width="40" class="rounded-circle">
                                @else
                                <img src="{{ url('back/assets/img/no-image.jpg') }}" alt="" height="40" width="40" class="rounded-circle">
                                @endif
                            </td>
                            <td>{{ Str::words($blog->titre, 2, '...') }}</td>
                            <td>{{ Str::words($blog->texte, 2, '...') }}</td>
                            <td>{{ Str::words($blog->support, 2, '...') }}</td>
                            <td>{{ $blog->like_count }}</td>
                            <td>
    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
        @foreach ($blog->likes as $user)
        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{ $user->email }}">
            <img src="{{asset('img/useravater.jpeg')}}" alt="Avatar" class="rounded-circle" />
        </li>
        @endforeach
    </ul>
</td>

                            <td>
                                <a href="{{ route('admin.blog.show', $blog->id) }}" class="btn btn-info btn-sm" title="Détails">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-primary btn-sm" title="Modifier">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <!-- Bouton pour déclencher la modale de confirmation -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-blogid="{{ $blog->id }}">
                                    <i class="fa fa-trash-alt"></i>
                                </button>

                                <!-- Formulaire de suppression masqué -->
                                <form id="blog-delete-action-{{ $blog->id }}" action="{{ route('admin.blog.destroy', $blog->id) }}" method="post" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-center">Aucun blog trouvé</td>
                    </tr>
                    @endif
                </table>

                <div class="mt-3">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmation pour la Suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de Suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce blog ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Stocker l'ID du blog à supprimer
    let blogIdToDelete;

    // Lorsqu'on ouvre la modale, récupérer l'ID du blog
    document.getElementById('confirmDeleteModal').addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget; // Bouton qui a déclenché la modale
        blogIdToDelete = button.getAttribute('data-blogid'); // Récupérer l'ID du blog
    });

    // Lorsqu'on confirme la suppression
    document.getElementById('confirmDelete').addEventListener('click', function () {
        document.getElementById('blog-delete-action-' + blogIdToDelete).submit();
    });
</script>

@endsection
