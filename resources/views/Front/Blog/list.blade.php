@extends('Front/layout')
@section('content') 

<div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">100% Eco-Friendly Products</h4>
                        <h3 class="mb-5 display-3 text-primary">Eco-Friendly Living & Recycling </h3>
                        <div class="position-relative mx-auto">
                            <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number" placeholder="Search">
                            <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active rounded">
                                    <img src="{{ asset('img/3.jpg') }}" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Recycle</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="{{ asset('img/2.jpg') }}" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Dechet</a>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Our Blogs</h1>
                        </div>
                       
                    </div>





                    @if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif

<div class="tab-content">
    <div id="tab-5" class="tab-pane fade show p-0 active">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    @if($blogs->isNotEmpty())
                        @foreach ($blogs as $blog)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item h-100">
                                <div class="fruite-img" style="height: 200px; overflow: hidden;">
                                    <!-- Vérification et affichage de l'image du blog -->
                                    @if($blog->image != '' && file_exists(public_path().'/uploads/blogs/'.$blog->image))
                                    <img src="{{ url('uploads/blogs/'.$blog->image) }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="">
                                    @else
                                    <img src="{{ url('back/assets/img/no-image.jpg') }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="">
                                    @endif
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                    {{ $blog->titre }}
                                </div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column justify-content-between">
                                    <h4 style="height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $blog->titre }}</h4>
                                    <p style="height: 70px; overflow: hidden;">{{ Str::limit($blog->texte, 100) }}</p>

                                    <!-- Bouton Like -->
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary like-button" data-liked="false">
                                        <i class="fa fa-thumbs-up me-2"></i> J'aime
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="col-3">
                            <p class="text-center">Aucun blog trouvé</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-3">
    {{ $blogs->links() }}
</div>

<script>
    // Ajoute un gestionnaire d'événements pour les boutons de like
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le lien de naviguer

            const isLiked = this.getAttribute('data-liked') === 'true';
            // Change la couleur du bouton en fonction de l'état
            if (isLiked) {
                this.classList.remove('bg-primary', 'text-white'); // Retire les classes pour le like
                this.classList.add('text-primary'); // Rétablit l'état normal
                this.setAttribute('data-liked', 'false'); // Met à jour l'état
            } else {
                this.classList.add('bg-primary', 'text-white'); // Ajoute les classes pour le like
                this.setAttribute('data-liked', 'true'); // Met à jour l'état
            }
        });
    });
</script>






                    </div>
                </div>      
            </div>
        </div>

@endsection