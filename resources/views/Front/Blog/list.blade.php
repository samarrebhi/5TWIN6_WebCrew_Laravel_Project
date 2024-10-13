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
                                <img src="{{ url('uploads/blogs/'.$blog->image) }}" class="img-fluid rounded" style="width: 200px; height: 200px; object-fit: cover;" alt="Image du blog">
                                @else
                                <img src="{{ url('back/assets/img/no-image.jpg') }}" class="img-fluid rounded" style="width: 200px; height: 200px; object-fit: cover;" alt="No image available">
                                @endif
                            </div>  

                            <!-- Bouton J'aime -->
                            <div class="ms-4 d-block" style="flex-grow: 1;">
                                <p class="m-0 pb-3" style="height: 150px; overflow: hidden; text-overflow: ellipsis;">{{ $blog->texte }}</p> <!-- Texte limité en hauteur -->

                                <button class="btn like-btn" data-id="{{ $blog->id }}" style="background: transparent; border: none;">
                                    <i class="fa fa-thumbs-up" style="font-size: 24px; color: green;"></i>
                                </button>
                                <span id="like-count-{{ $blog->id }}" style="margin-left: 10px;">{{ $blog->like_count }}</span>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    // Lire l'état du localStorage et mettre à jour l'interface utilisateur
    $('.like-btn').each(function() {
        var blogId = $(this).data('id');
        var liked = localStorage.getItem('likedBlogs') ? JSON.parse(localStorage.getItem('likedBlogs')) : {};

        if (liked[blogId]) {
            $(this).find('.fa-thumbs-up').css('font-size', '30px'); // Taille augmentée pour l'état "aimé"
            $(this).data('liked', true);
        } else {
            $(this).find('.fa-thumbs-up').css('font-size', '24px'); // Taille normale pour l'état "non aimé"
            $(this).data('liked', false);
        }
    });

    // Gérer le clic sur le bouton "J'aime"
    $('.like-btn').click(function() {
        var blogId = $(this).data('id');
        var likeButton = $(this);
        var liked = likeButton.data('liked');

        $.ajax({
            url: '/like-blog/' + blogId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Met à jour le compteur de likes
                $('#like-count-' + blogId).text(response.like_count);

                // Basculer l'état du bouton "J'aime"
                if (!liked) {
                    // L'utilisateur aime le blog
                    likeButton.find('.fa-thumbs-up').css('font-size', '30px'); // Augmente la taille de l'icône pour indiquer qu'il aime
                    likeButton.data('liked', true);

                    // Enregistrer l'état dans le localStorage
                    var likedBlogs = localStorage.getItem('likedBlogs') ? JSON.parse(localStorage.getItem('likedBlogs')) : {};
                    likedBlogs[blogId] = true;
                    localStorage.setItem('likedBlogs', JSON.stringify(likedBlogs));
                } else {
                    // L'utilisateur n'aime plus le blog (dislike)
                    likeButton.find('.fa-thumbs-up').css('font-size', '24px'); // Réduit la taille de l'icône
                    likeButton.data('liked', false);

                    // Supprimer l'état du localStorage
                    var likedBlogs = JSON.parse(localStorage.getItem('likedBlogs'));
                    delete likedBlogs[blogId];
                    localStorage.setItem('likedBlogs', JSON.stringify(likedBlogs));
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});

</script>

@endsection
