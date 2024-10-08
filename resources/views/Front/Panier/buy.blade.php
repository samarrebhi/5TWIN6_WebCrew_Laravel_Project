@extends('Front/layout')
@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop Detail</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active text-white">Shop Detail</li>
    </ol>
</div>

<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="#">
                                <img src="{{asset('img/RecyclagePanier.jpg')}}" class="img-fluid rounded" alt="Image">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <h4 class="fw-bold mb-3">{{ $category->name }}</h4>

                        <p class="mb-4">If you want to add this product to your cart, you can select a quantity and negotiate a price, then click on the button below.</p>
                        <p class="mb-4">Your product will be added to the cart, and once the administration confirms your order, you can proceed to payment.</p>
                        <p class="mb-4">Thank you.</p>

                        <!-- Formulaire pour ajouter une réservation -->
                        <form action="{{ route('reservations.store') }}" method="post" id="reservationForm">
    @csrf
    <input type="hidden" name="category_id" value="{{ $category->id }}">

    <!-- Sélection de la quantité -->
    <div class="input-group quantity mb-5" style="width: 100px;">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-minus rounded-circle bg-light border" type="button">
                <i class="fa fa-minus"></i>
            </button>
        </div>
        <input type="number" name="quantity" class="form-control form-control-sm text-center border-0" value="1" min="1" max="{{ $category->quantity }}">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-plus rounded-circle bg-light border" type="button">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>

    <!-- Sélection du prix -->
    <div class="col-lg-12">
        <div class="mb-3">
            <h4 class="mb-2">Price</h4>
            <input type="range" class="form-range w-100" id="rangeInput" name="prix" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
            <output id="amount" name="amount" min-value="0" max-value="500" for="rangeInput">0</output>
        </div>
    </div>

    <!-- Bouton pour ajouter au panier -->
    <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
    </button>
</form>


                        <!-- Fin du formulaire -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
