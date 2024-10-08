@extends('Front/layout') 

@section('content') 
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <h1 class="text-center">Write a Review for {{ $evenement->titre }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reviews.store', $evenement->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="rating">Rating</label>
                <select id="rating" name="rating" class="form-control" required>
                    <option value="">Select Rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
</div>
@endsection 
