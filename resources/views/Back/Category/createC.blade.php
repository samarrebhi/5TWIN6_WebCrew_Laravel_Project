@extends('Back.dashboard')

@section('content')
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="container my-5" style="padding-top: 120px;">
    <h1 class="mb-4">Add a New Waste Category</h1>

    <form method="post" action="{{ route('Categories.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name') }}" 
                required 
            />
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity:</label>
            <input 
                type="number" 
                name="quantity" 
                id="quantity" 
                class="form-control @error('quantity') is-invalid @enderror" 
                value="{{ old('quantity') }}" 
                required 
            />
            @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="state" class="form-label">State:</label>
            <select 
                name="state" 
                id="state" 
                class="form-select @error('state') is-invalid @enderror" 
                required
            >
                <option value="">Select a state</option>
                <option value="solid" {{ old('state') == 'solid' ? 'selected' : '' }}>Solid</option>
                <option value="liquid" {{ old('state') == 'liquid' ? 'selected' : '' }}>Liquid</option>
                <option value="electronic" {{ old('state') == 'electronic' ? 'selected' : '' }}>Electronic</option>
                <option value="gas" {{ old('state') == 'gas' ? 'selected' : '' }}>Gas</option>
                <option value="other" {{ old('state') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('state')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="environmental_impact" class="form-label">Environmental Impact:</label>
            <select 
                name="environmental_impact" 
                id="environmental_impact" 
                class="form-select @error('environmental_impact') is-invalid @enderror" 
                required
            >
                <option value="">Select impact level</option>
                <option value="low" {{ old('environmental_impact') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="moderate" {{ old('environmental_impact') == 'moderate' ? 'selected' : '' }}>Moderate</option>
                <option value="high" {{ old('environmental_impact') == 'high' ? 'selected' : '' }}>High</option>
                <option value="polluting" {{ old('environmental_impact') == 'polluting' ? 'selected' : '' }}>Polluting</option>
                <option value="biodegradable" {{ old('environmental_impact') == 'biodegradable' ? 'selected' : '' }}>Biodegradable</option>
            </select>
            @error('environmental_impact')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
</div>
@endsection
