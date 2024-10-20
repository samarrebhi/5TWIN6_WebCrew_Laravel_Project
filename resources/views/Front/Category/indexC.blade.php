@extends('Front/layout')

@section('content')

<div class="container my-5" style="padding-top: 120px;">
    <div class="row justify-content-center">
        @foreach($Categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-lg rounded-3">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">
                            <i class="fas fa-box-open me-2"></i>{{ $category->name }}
                        </h5>
                        <p class="card-text text-muted mb-4">
                            <i class="fas fa-cubes me-2"></i>Quantity: {{ $category->quantity }} <br>
                            <i class="fas fa-info-circle me-2"></i>State: {{ ucfirst($category->state) }} <br>
                            <i class="fas fa-leaf me-2"></i>Environmental Impact: {{ ucfirst($category->environmental_impact) }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('allCateg.show', $category->id) }}" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-info-circle me-1"></i>Details
                            </a>
                            <a href="{{ route('buy', $category->id) }}" 
                               class="btn btn-success btn-sm">
                                <i class="fas fa-shopping-cart me-1"></i>Buy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection
