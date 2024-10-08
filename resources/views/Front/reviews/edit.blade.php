@extends('Front/layout')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <h1 class="text-center">Edit Review</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
    @csrf
    @method('PUT')
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" class="form-control" rows="5" required>{{ old('comment', $review->comment) }}</textarea>
            </div>
            <div class="form-group">
                <label for="rating">Rating</label>
                <select id="rating" name="rating" class="form-control" required>
                    <option value="">Select Rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == old('rating', $review->rating) ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Review</button>
        </form>
    </div>
</div>
@endsection
