@extends('Front/layout')

@section('content')

<div class="container d-flex align-items-center justify-content-center" style="min-height: 120vh;">
    <div class="col-md-6 bg-light p-5 shadow rounded" style="border-radius: 15px;">
        <h1 class="text-center text-dark mb-4">Review for <span style="color: green;">{{ $evenement->titre }}</span></h1>

        <form action="{{ route('reviews.store', $evenement->id) }}" method="POST">
            @csrf

            <!-- Would Recommend -->
            <div class="form-group mb-4">
                <label for="would_recommend">Would you recommend this event?</label>
                <select id="would_recommend" name="would_recommend" class="form-control @error('would_recommend') is-invalid @enderror">
                    <option value="1" {{ old('would_recommend') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('would_recommend') == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('would_recommend')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Anonymous Review -->
            <div class="form-group mb-4">
                <label for="anonymous">Submit as anonymous</label>
                <input type="checkbox" id="anonymous" name="anonymous" value="1" class="@error('anonymous') is-invalid @enderror" {{ old('anonymous') ? 'checked' : '' }}>
                @error('anonymous')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Comment -->
            <div class="form-group mb-4">
                <label for="comment">Your Comment</label>
                <textarea id="comment" name="comment" class="form-control @error('comment') is-invalid @enderror" rows="5"  >{{ old('comment') }}</textarea>
                @error('comment')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">{{ strlen(old('comment')) }} / 250 characters</small>
            </div>

            <!-- Rating -->
            <div class="form-group mb-4">
                <label for="rating">Your Rating</label>
                <select id="rating" name="rating" class="form-control @error('rating') is-invalid @enderror" >
                    <option value="" disabled selected>Choose a rating</option>
                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 - Poor</option>
                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 - Fair</option>
                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 - Good</option>
                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 - Very Good</option>
                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 - Excellent</option>
                </select>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
        </form>
    </div>
</div>

@endsection
