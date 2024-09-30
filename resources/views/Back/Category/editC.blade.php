@extends('Back/dashboard')
@section('content')
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container my-5" style="padding-top: 20px;">
    <h2 class="text-center">Edit Category</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('Categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Category Name -->
                        <div class="form-group mb-3">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                        </div>

                        <!-- Quantity -->
                        <div class="form-group mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="{{ $category->quantity }}" min="1" required>
                        </div>

                        <!-- State Select -->
                        <div class="form-group mb-3">
                            <label for="state">State</label>
                            <select name="state" id="state" class="form-select" required>
                                <option value="solid" {{ $category->state == 'solid' ? 'selected' : '' }}>Solid</option>
                                <option value="liquid" {{ $category->state == 'liquid' ? 'selected' : '' }}>Liquid</option>
                                <option value="electronic" {{ $category->state == 'electronic' ? 'selected' : '' }}>Electronic</option>
                                <option value="gas" {{ $category->state == 'gas' ? 'selected' : '' }}>Gas</option>
                                <option value="other" {{ $category->state == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Environmental Impact Select -->
                        <div class="form-group mb-3">
                            <label for="environmental_impact">Environmental Impact</label>
                            <select name="environmental_impact" id="environmental_impact" class="form-select" required>
                                <option value="low" {{ $category->environmental_impact == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="moderate" {{ $category->environmental_impact == 'moderate' ? 'selected' : '' }}>Moderate</option>
                                <option value="high" {{ $category->environmental_impact == 'high' ? 'selected' : '' }}>High</option>
                                <option value="polluting" {{ $category->environmental_impact == 'polluting' ? 'selected' : '' }}>Polluting</option>
                                <option value="biodegradable" {{ $category->environmental_impact == 'biodegradable' ? 'selected' : '' }}>Biodegradable</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-group mb-3 text-center">
                            <button type="submit" class="btn btn-success">Update Category</button>
                            <a href="{{ route('Categories.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
