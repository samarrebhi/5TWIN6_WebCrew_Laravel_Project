@extends('Front/layout')
@section('content') 

<div class="container my-5" style="padding-top: 120px;"> 
    <div class="row justify-content-center">
        @foreach($centers as $center)
            <div class="col-md-4 mb-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $center->name }}</h5>
                        <p class="card-text text-muted">
                            Address: {{ $center->address }} <br>
                        </p>
                        <div class="d-flex justify-content-center"> 
                            <a href="{{ route('center.show', $center->id) }}" class="btn btn-outline-success btn-sm">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
