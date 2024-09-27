@extends('Front/layout')
@section('content') 

<div class="container my-5" style="padding-top: 120px;"> 
    <div class="row justify-content-center">
        @foreach($centers as $center)
            <div class="col-md-4 mb-4">
                <div class="card border-success shadow-sm" style="height: 100%;"> 
                    <div class="card-body d-flex flex-column justify-content-between" style="padding: 20px;">
                        <h5 class="card-title text-center text-success">{{ $center->name }}</h5>
                        @if($center->image)
                            <div style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                                <img src="{{ asset('storage/' . $center->image) }}" class="img-fluid" alt="{{ $center->name }}" style="max-width: 100%; height: auto;" />
                            </div>
                        @endif
                        <p class="card-text text-muted mb-3"> 
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
