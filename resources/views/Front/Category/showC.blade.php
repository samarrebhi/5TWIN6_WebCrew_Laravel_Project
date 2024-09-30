
@extends('Back/dashboard')
@section('content')
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container my-5">
    <div class="card shadow-lg border-success">
        <div class="card-header bg-success text-white text-center">
            <h2 class="mb-0">Details of the Waste Category</h2>
        </div>
        <div class="card-body">
            <h4 class="card-title text-success">{{ $Category->name }}</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Quantity:</strong> {{ $Category->quantity }}
                </li>
                <li class="list-group-item">
                    <strong>State:</strong> {{ ucfirst($Category->state) }}
                </li>
                <li class="list-group-item">
                    <strong>Environmental Impact:</strong> {{ ucfirst($Category->environmental_impact) }}
                </li>
            </ul>
        </div>
     
    </div>
</div>
@endsection
