@extends('Back/dashboard')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Details Blog /</span> {{ $blog->titre }}</h4>

    <div class="row">
        <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.listBlog') }}"><i class="bx bx-list-ul me-1"></i> All</a> <!-- Icône de liste -->
                </li>
            </ul>
            <div class="card mb-4">
                <!-- Blog Details -->
                <div class="card-body">
                    <div class="mb-3">
                        <img
                            src="{{ url('uploads/blogs/' . $blog->image) }}"
                            alt="blog-image"
                            class="img-fluid rounded"
                            style="width: 100%; height: auto;"  
                        />
                    </div>
                    <hr class="my-3" />
                    <div>
                        <strong>Titre:</strong> {{ $blog->titre }}<br>
                        <strong>Texte:</strong> {{ $blog->texte }}<br>
                        <strong>Support:</strong> {{ $blog->support }}<br>
                        <strong>Likes:</strong> {{ $blog->likes_count }}<br>
                        <strong>Crée à:</strong> {{ $blog->created_at }}<br>
                        <strong>Modifié à:</strong> {{ $blog->updated_at }}
                    </div>
                </div>
                <!-- /Blog Details -->
            </div>
        </div>
    </div>
</div>

@endsection
