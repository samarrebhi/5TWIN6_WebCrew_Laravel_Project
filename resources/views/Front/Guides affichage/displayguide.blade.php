@extends('Front/layout')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="{{ route('guide.index') }}" class="btn-outline-primary">Go Back</a>
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Best Practices Guide/</span> Displaying the content of the guide you choose </h4>

        <!-- Empty Card Start -->
        <div class="card mb-4">
            <div class="card-body text-center">


            </div>
        </div>


        <div class="card mb-4 border-green">
            <div class="card-body">
                <!-- Guide title and category -->
                <h5 class="card-title">{{ $guide->title }}</h5>
                <div class="card-subtitle text-muted mb-3">{{ $guide->category }}</div>
                <hr>


                @if($guide->image)
                    <img src="{{ asset('storage/' . $guide->image) }}" alt="{{ $guide->title }}" class="img-fluid rounded"
                         style="width: 300px; height: 300px; float: right; margin-left: 15px; object-fit: cover;">
                @else
                    <p>No image available</p>
                @endif

                <p><strong>Related tags:</strong></p>
                <ul>
                    @foreach(explode(',', $guide->tags) as $tag)
                        <li>{{ $tag }}</li>
                    @endforeach
                </ul>


                <p><strong>Available external link:</strong>
                    @if($guide->external_links)
                        <a href="{{ $guide->external_links }}" >{{ $guide->external_links }}</a>
                    @else
                        No link available
                    @endif
                </p>
                <p><strong>Content:</strong> {{ $guide->body }}</p>


            </div>
        </div>



        <div class="container-xxl flex-grow-1 container-p-y">


                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('guide.listing') }}" class="btn border border-secondary
             rounded-pill px-3 text-primary">
                            <i class="fa fa-list me-2 text-primary"></i> Go back to guides list
                        </a>
                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary ms-2">
                            <i class="fa fa-pencil-alt me-2 text-primary"></i>  Take related poll
                        </a>
                    </div>



                </div>

            </div>

        </div>
    </div>
    <style>
        .border-green {
            border: 2px solid #1b8158; /* Green border */

        }
    </style>
@endsection
