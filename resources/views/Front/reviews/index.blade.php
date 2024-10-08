@extends('Front/layout') 

@section('content') 
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <h1 class="text-center">Reviews for {{ $evenement->titre }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($reviews->isEmpty())
        <div class="alert alert-warning">
            No reviews yet.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Comment</th>
                    <th>Rating</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="text-center">
        <a href="{{ route('reviews.create', $evenement->id) }}" class="btn btn-primary">Add a Review</a>
    </div>
</div>
@endsection 
