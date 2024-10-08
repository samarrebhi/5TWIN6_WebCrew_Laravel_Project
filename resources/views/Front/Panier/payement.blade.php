<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>WebCrew_Laravel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        .input-group-text {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <!-- Formulaire de paiement -->
            <div class="col-md-12 col-lg-7">
                <div class="card p-4 shadow-sm">
                    <div class="text-center mb-3">
                        <img src="{{ asset('img/payment.png') }}" class="img-fluid" alt="Payment Details">
                    </div>      

                    <!-- Affichage des messages d'erreur -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('payment.process', ['id' => $reservation->id]) }}" method="POST">
    @csrf  <!-- Ajoutez cette ligne pour le token CSRF -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="text-muted">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="cardNumber" class="text-muted">Card Number</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                <input type="text" name="cardNumber" class="form-control" id="cardNumber" placeholder="Enter card number" required>
            </div>
            @error('cardNumber')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="expiration" class="text-muted">Expiration Date</label>
            <div class="input-group">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                <input type="text" name="expiration" class="form-control" id="expiration" placeholder="MM/YY" required>
            </div>
            @error('expiration')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="cvc" class="text-muted">CVC</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="text" name="cvc" class="form-control" id="cvc" placeholder="Card Verification Code" required>
            </div>
            @error('cvc')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="amount" class="text-muted">Amount to Pay</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
            <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter amount" required>
        </div>
        @error('amount')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success w-100 py-2" style="border-radius: 5px;">
            <i class="fas fa-check-circle"></i> Confirm Payment
        </button>
    </div>
</form>


                </div>
            </div>
            <!-- Carousel -->
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active rounded">
                            <img src="{{asset('img/3.jpg')}}" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">Recycle</a>
                        </div>
                        <div class="carousel-item rounded">
                            <img src="{{asset('img/2.jpg')}}" class="img-fluid w-100 h-100 rounded" alt="Second slide">
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

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
