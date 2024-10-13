@extends('Back/dashboard')

@section('content')
<div class="container">
    <h1>Reviews</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Event</th>
                <th>Comment</th>
                <th>Rating</th>
                <th>Would Recommend</th>
                <th>Anonymous</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                @if(!$review->user->blocked) <!-- Check if user is not blocked -->
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->user ? $review->user->name : 'N/A' }}</td>
                        <td>{{ $review->evenementCollecte ? $review->evenementCollecte->titre : 'N/A' }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->would_recommend ? 'Yes' : 'No' }}</td>
                        <td>{{ $review->anonymous ? 'Yes' : 'No' }}</td>
                        <td>
                            <form action="{{ route('users.block', $review->user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to block this user?');">Block User</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
