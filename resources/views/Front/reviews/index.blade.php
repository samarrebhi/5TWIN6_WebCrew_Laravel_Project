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
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
    @foreach ($reviews as $review)
        <tr>
            <td>{{ $review->comment }}</td>
            <td>{{ $review->rating }}</td>
            <td>{{ $review->created_at->format('Y-m-d H:i') }}</td>
            <td>
            <a href="{{ route('reviews.edit', ['evenementId' => $evenement->id, 'id' => $review->id]) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?');">Delete</button>
                </form>
            </td>
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
