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


        <div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h4 class="text-primary">Our Blogs</h4>
            <h1 class="display-5 mb-5 text-dark">Latest Blog Posts</h1>
        </div>
        
        <!-- Carousel pour les blogs -->
        <div class="owl-carousel testimonial-carousel">
            @if($blogs->isNotEmpty())
                @foreach ($blogs as $blog)
                <div class="testimonial-item img-border-radius bg-light rounded p-4" style="height: 350px;"> <!-- Hauteur fixe définie ici -->
                    <div class="position-relative" style="height: 100%;">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <!-- Titre du blog -->
                            <h4 class="text-dark" style="height: 30px; overflow: hidden; text-overflow: ellipsis;">{{ $blog->titre }}</h4> <!-- Titre limité en hauteur -->
                            <!-- Texte du blog -->
                            <p class="mb-0" style="height: 30px; overflow: hidden; text-overflow: ellipsis;">{{ Str::limit($blog->support, 100) }}</p> <!-- Texte limité en hauteur -->
                        </div>
                        
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded" style="flex-shrink: 0;">
                                <!-- Vérification et affichage de l'image du blog -->
                                @if($blog->image != '' && file_exists(public_path().'/uploads/blogs/'.$blog->image))
                                <img src="{{ url('uploads/blogs/'.$blog->image) }}" class="img-fluid rounded" style="width: 200px; height: 200px; object-fit: cover;" alt="">
                                @else
                                <img src="{{ url('back/assets/img/no-image.jpg') }}" class="img-fluid rounded" style="width: 200px; height: 200px; object-fit: cover;" alt="">
                                @endif
                            </div>
                            
                            <div class="ms-4 d-block" style="flex-grow: 1;">
                                <p class="m-0 pb-3" style="height: 150px; overflow: hidden; text-overflow: ellipsis;">{{ $blog->texte }}</p> <!-- Texte limité en hauteur -->

                                <!-- Bouton Like avec Compteur -->
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary like-button" data-liked="false" data-id="{{ $blog->id }}">
                                    <i class="fa fa-thumbs-up me-2"></i> (<span class="like-count">{{ $blog->likes_count }}</span>)
                                </a>
                            </div>
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

<script>
    // Ajoute un gestionnaire d'événements pour les boutons de like
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le lien de naviguer

            const isLiked = this.getAttribute('data-liked') === 'true';
            const blogId = this.getAttribute('data-id');
            const likeCountElement = this.querySelector('.like-count');

            // Effectuer une requête AJAX pour ajouter ou retirer le like
            fetch(`/blog/${blogId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Assurez-vous d'inclure le token CSRF
                },
                body: JSON.stringify({ liked: !isLiked }), // Indiquez si le like est ajouté ou retiré
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour le compteur de likes
                    likeCountElement.textContent = data.likes_count;

                    // Changer la couleur du bouton en fonction de l'état
                    if (isLiked) {
                        this.classList.remove('bg-primary', 'text-white'); // Retire les classes pour le like
                        this.classList.add('text-primary'); // Rétablit l'état normal
                        this.setAttribute('data-liked', 'false'); // Met à jour l'état
                    } else {
                        this.classList.add('bg-primary', 'text-white'); // Ajoute les classes pour le like
                        this.setAttribute('data-liked', 'true'); // Met à jour l'état
                    }
                } else {
                    console.error('Échec de l\'ajout du "J\'aime"');
                }
            })
            .catch(error => console.error('Erreur:', error));
        });
    });

    // Initialiser le carousel Owl
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });
</script>







                    </div>
                </div>      
            </div>
        </div>

@endsection