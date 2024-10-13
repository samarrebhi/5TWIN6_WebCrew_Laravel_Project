@extends('Back/dashboard')

@section('content')
<div class="container">
    <h1 class="mt-4">Reviews</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search Input -->
    <div class="mb-3">
        <input type="text" id="search" class="form-control" placeholder="Search reviews by user or event title">
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>User</th>
                    <th>Event</th>
                    <th>Event Created by</th>

                    <th>Comment</th>
                    <th>Rating</th>
                    <th>Would Recommend</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="review-table-body">
                @foreach($reviews as $review)
                    @if(!$review->user->blocked) <!-- Check if user is not blocked -->
                        <tr class="review-row">
                            <td class="user-name">{{ $review->user ? $review->user->name : 'N/A' }}</td>
                            
                            <td class="event-title">{{ $review->evenementCollecte ? $review->evenementCollecte->titre : 'N/A' }}</td>

                            <td class="event-created-by">{{ $review->evenementCollecte ? $review->evenementCollecte->user->email : 'N/A' }}</td> <!-- New column -->

                            <td>{{ $review->comment }}</td>
                            <td>{{ $review->rating }}</td>
                            <td>{{ $review->would_recommend ? 'Yes' : 'No' }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#blockModal-{{ $review->user->id }}">
                                    Block User
                                </button>

                                <!-- Modal for confirmation -->
                                <div class="modal fade" id="blockModal-{{ $review->user->id }}" tabindex="-1" aria-labelledby="blockModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="blockModalLabel">Confirm Block</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to block this user?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('users.block', $review->user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Block User</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
// Function to filter table rows based on user input
document.getElementById('search').addEventListener('keyup', function() {
    let query = this.value.toLowerCase(); // Convert input to lowercase for case-insensitive search
    let rows = document.querySelectorAll('.review-row'); // Select all rows with class .review-row

    rows.forEach(function(row) {
        let userName = row.querySelector('.user-name').textContent.toLowerCase(); // Get user name and event title
        let eventTitle = row.querySelector('.event-title').textContent.toLowerCase();

        // Check if the search query matches either the user name or event title
        if (userName.includes(query) || eventTitle.includes(query)) {
            row.style.display = ''; // Show the row if it matches
        } else {
            row.style.display = 'none'; // Hide the row if it doesn't match
        }
    });
});
</script>
@endsection
