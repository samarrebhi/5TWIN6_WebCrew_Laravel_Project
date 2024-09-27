@extends('Front/layout')
@section('content') 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Event Details - WebCrew</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Event Details</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Details Available</li>
            </ol>
        </div>
<div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5" style="padding-top: px;"> <!-- Increased padding-top -->
    <div class="col-lg-8 col-xl-9">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class=" rounded">
                    <a href="#">
                        <img src="{{ asset('uploads/evenements/' . $event->image) }}" alt="{{ $event->titre }}" class="img-fluid rounded"> <!-- Event Image -->
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <h4 class="fw-bold mb-3">{{ $event->titre }}</h4> <!-- Event Title -->
                <p class="mb-3" style="margin-top: 20px;"><strong>Description:</strong> {{ $event->description }}</p> <!-- Description -->
                <p class="mb-3" style="margin-top: 20px;"><strong>Location:</strong> {{ $event->lieu }}</p> <!-- Location -->
                <p class="mb-3" style="margin-top: 20px;"><strong>Date:</strong> {{ $event->date }}</p> <!-- Date -->
                <p class="mb-3" style="margin-top: 20px;"><strong>Time:</strong> {{ $event->heure }}</p> <!-- Time -->
                <div class="d-flex mb-4">
                    <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Participate
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <nav>
                <div class="nav nav-tabs mb-3">
                    <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                        id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description"
                        aria-controls="nav-description" aria-selected="true">Description</button>
                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                        id="nav-reviews-tab" data-bs-toggle="tab" data-bs-target="#nav-reviews"
                        aria-controls="nav-reviews" aria-selected="false">Reviews</button>
                </div>
            </nav>
            <div class="tab-content mb-5">
                <div class="tab-pane active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                    <p style="margin-top: 20px;">{{ $event->description }}</p> <!-- Event Description -->
                </div>
                <div class="tab-pane" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviews-tab">
                    <!-- Reviews will be populated here -->
                    <p style="margin-top: 20px;">No reviews yet.</p>
                </div>
            </div>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a> <!-- Back button -->
    </div>
</div>

</body>

</html>
@endsection 
