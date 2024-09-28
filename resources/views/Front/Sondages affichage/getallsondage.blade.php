@extends('Front/layout')

@section('content')
    <!-- Polls Page Start -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h4 class="text-primary">Our Polls</h4>
            <h1 class="display-5 text-dark" style="font-weight: bold; margin-top: 10px;">Our Polls</h1>
        </div>

        <!-- Search Bar and Pagination Start -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pagination d-flex justify-content-end mt-3">
                    <a href="#" class="rounded pagination-button">&laquo;</a>
                    <a href="#" class="active rounded">1</a>
                    <a href="#" class="rounded pagination-button">2</a>
                    <a href="#" class="rounded">3</a>
                    <a href="#" class="rounded">4</a>
                    <a href="#" class="rounded">5</a>
                    <a href="#" class="rounded">6</a>
                    <a href="#" class="rounded">&raquo;</a>
                </div>
            </div>
        </div>
        <!-- Search Bar and Pagination End -->


        <div class="row">
            @if($sondages->isEmpty())
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No polls available at the moment.
                    </div>
                </div>
            @else
                @foreach($sondages as $sondage)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card poll-card shadow-sm h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $sondage->title }}</h5>
                                <p class="card-text mb-4">{{ Str::limit($sondage->description, 200) }}</p>
                                <p class="card-text mb-4"><strong>Poll's Category: </strong> {{ $sondage->category }}</p>
                                <div class="mt-auto">
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-eye me-2 text-primary"></i> View details</a>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-poll me-2 text-primary"></i> Take poll</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <style>
        /* Card Customization */
        .poll-card {
            border: 2px solid #FFB524; /* Orange border for the cards */
            border-radius: 10px; /* Rounded corners */
            transition: all 0.3s ease;
        }

        .poll-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-weight: 600;
            color: #343a40;
        }

        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .btn {
            border-radius: 20px;
        }

        /* Search Input Customization */
        .input-group {
            width: 50%; /* Adjust width as needed */
            margin-bottom: 20px; /* Space below the search input */
        }

        .input-group .form-control {
            border: 2px solid darkgray; /* Orange border for search input */
        }
        .pagination-button {

            color: green; /* Text color for pagination buttons */

        }
    </style>

@endsection
