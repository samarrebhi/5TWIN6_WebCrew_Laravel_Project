@extends('Front/layout')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="{{ route('sondage.index') }}" class="btn-outline-primary">Go Back</a>
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Poll/</span> Selected Poll Details </h4>

        <!-- Empty Card Start -->
        <div class="card mb-4">
            <div class="card-body text-center">


            </div>
        </div>
        <!-- Empty Card End -->

        <div class="card mb-4 border-green">
            <div class="card-body ">
                <h5 class="card-title">{{ $sondage->title }}</h5>
                <div class="card-subtitle text-muted mb-3">{{ $sondage->category }}</div>
                <hr>
                <p><strong>Description:</strong> {{ $sondage->description }}</p>
                <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($sondage->start_date)->format('d/m/Y H:i') }}</p>
                <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($sondage->end_date)->format('d/m/Y H:i') }}</p>

                <p><strong>Questions:</strong></p>
                <ul>
                    @foreach(explode('|', $sondage->questions) as $question)
                        <li>{{ $question }}</li>
                    @endforeach
                </ul>
                <div class="container-xxl flex-grow-1 container-p-y">






                </div>

            </div>

        </div>
        <div class="d-flex justify-content-end mb-3">
            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary ms-2">
                <i class="fa fa-pencil-alt me-2 text-primary"></i> Take poll
            </a>
            <a href="{{ route('guide.sondages',$guide=>id) }}" class="btn border border-secondary
             rounded-pill px-3 text-primary">
                <i class="fa fa-list me-2 text-primary"></i> Go back to polls list
            </a>

        </div>
    </div>
    <style>
        .border-green {
            border: 2px solid #1b8158; /* Green border */

        }
    </style>
@endsection
