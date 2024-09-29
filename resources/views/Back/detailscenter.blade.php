@extends('Back.dashboard')
@section('content')
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-white ">
        <h4 class="mb-0 text-center">Center Details</h4>
        </div>
        <div class="card-body mt-4">
            <p><strong>Name:</strong> {{ $center->name }}</p>
            <p><strong>Address:</strong> {{ $center->address }}</p>
            <p><strong>Description:</strong> {{ $center->description }}</p>
            <p><strong>Phone:</strong> {{ $center->phone }}</p>
            <p><strong>Email:</strong> {{ $center->email }}</p>
            @if($center->image)
                <div class="text-center"> 
                    <img src="{{ asset('storage/' . $center->image) }}" class="img-fluid" alt="{{ $center->name }}" style="max-width: 200px; height: auto;" />
                </div>
            @endif
            <a href="{{ route('centers.index') }}" class="btn btn-success mt-3">Back to Centers</a>
        </div>
    </div>
</div>
@endsection
