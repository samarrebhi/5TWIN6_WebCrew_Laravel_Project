@extends('Front/layout')
@section('content') 

<div class="container my-5" style="padding-top: 120px;"> 
    <div class="row justify-content-center">
        @foreach($Categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $category->name }}</h5>
                        <p class="card-text text-muted">
                            Quantity: {{ $category->quantity }} <br>
                            State: {{ ucfirst($category->state) }} <br>
                            Environmental Impact: {{ ucfirst($category->environmental_impact) }}
                        </p>
                        <div class="d-flex justify-content-center"> 
                            <a href="{{ route('Categories.show', $category->id) }}" class="btn btn-outline-success btn-sm">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
