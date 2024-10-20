@extends('Front/layout')
@section('content')

<div class="container my-5" style="padding-top: 120px;">
    <h2>Edit Claim</h2>
    <form action="{{ route('claim.update', $claim->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Center selection -->
        <div class="mb-3">
            <label for="center_id" class="form-label">Select Center</label>
            <select name="center_id" class="form-select @error('center_id') is-invalid @enderror">
                <option value="">Choose a center</option>
                @foreach($centers as $center)
                    <option value="{{ $center->id }}" {{ $claim->center_id == $center->id ? 'selected' : '' }}>
                        {{ $center->name }}
                    </option>
                @endforeach
            </select>
            @error('center_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category selection -->
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" class="form-select @error('category') is-invalid @enderror">
                <option value="service" {{ $claim->category == 'service' ? 'selected' : '' }}>Service</option>
                <option value="quality" {{ $claim->category == 'quality' ? 'selected' : '' }}>Quality</option>
                <option value="time" {{ $claim->category == 'time' ? 'selected' : '' }}>Time</option>
                <option value="other" {{ $claim->category == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $claim->title }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ $claim->description }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Attachment -->
        <div class="mb-3">
            <label for="attachment" class="form-label">Attachment (optional)</label>
            <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror">
            @error('attachment')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Claim</button>
    </form>
</div>

@endsection
