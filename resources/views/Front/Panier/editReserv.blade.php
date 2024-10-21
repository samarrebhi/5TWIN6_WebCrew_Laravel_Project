@extends('Front/layout')
@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Edit Reservation</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{route('homepage')}}">Home</a></li>
        <li class="breadcrumb-item active text-white">Edit Reservation</li>
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

                        <p class="mb-4">If you want to edit this reservation, you can update the quantity or price below, then click the update button.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

                        <form action="{{ route('reservation.update', $reservation->id) }}" method="post" id="reservationForm">
    @csrf
    @method('PUT') 
    <input type="hidden" name="category_id" value="{{ $category->id }}">

    <div class="input-group quantity mb-5" style="width: 100px;">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-minus rounded-circle bg-light border" type="button">
                <i class="fa fa-minus"></i>
            </button>
        </div>
        <input type="text" name="quantity" class="form-control form-control-sm text-center border-0" value="{{ $reservation->quantity }}" min="1" max="{{ $category->quantity }}">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-plus rounded-circle bg-light border" type="button">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="mb-3">
            <h4 class="mb-2">Price</h4>
            <input type="range" class="form-range w-100" id="rangeInput" name="prix" min="0" max="500" value="{{ $reservation->prix }}" oninput="amount.value=rangeInput.value">
            <output id="amount" name="amount" min-value="0" max-value="500" for="rangeInput">{{ $reservation->prix }}</output>
        </div>
    </div>

    <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
        <i class="fa fa-shopping-bag me-2 text-primary"></i> Update Reservation
    </button>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
