@extends('Front/layout')

@section('content')
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center rounded-top">
            <h2 class="mb-0">
                <i class="fas fa-recycle me-2"></i>Waste Category Details
            </h2>
        </div>

        <div class="card-body py-4">
            <h4 class="text-success fw-bold">
                <i class="fas fa-tag me-2"></i>{{ $Category->name }}
            </h4>

            <ul class="list-group list-group-flush mt-4">
                <li class="list-group-item d-flex align-items-center">
                    <i class="fas fa-cubes text-primary me-3"></i>
                    <strong class="me-2">Quantity:</strong> {{ $Category->quantity }}
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="fas fa-info-circle text-warning me-3"></i>
                    <strong class="me-2">State:</strong> {{ ucfirst($Category->state) }}
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="fas fa-leaf text-success me-3"></i>
                    <strong class="me-2">Environmental Impact:</strong> {{ ucfirst($Category->environmental_impact) }}
                </li>
            </ul>

            <div class="text-center mt-4">
    <a href="{{ route('allCateg.index') }}" 
       class="btn btn-white border border-success text-success rounded-pill px-4 py-2 shadow-sm">
        <i class="fas fa-arrow-left me-2"></i>Back to Categories
    </a>
</div>

        </div>
    </div>
</div>
@endsection
