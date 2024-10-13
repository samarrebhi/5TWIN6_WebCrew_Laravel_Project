@extends('Back/dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Blocked Users</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search Input -->
    <div class="mb-3">
        <input type="text" id="search" class="form-control" placeholder="Search blocked users by name or email">
    </div>

    <!-- No Blocked Users Warning -->
    @if ($blockedUsers->isEmpty())
        <div class="alert alert-warning text-center">
            No blocked users found.
        </div>
    @else
        <!-- Blocked Users Table -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>created_at </th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody id="blocked-users-table-body">
                    @foreach($blockedUsers as $user)
                        <tr class="user-row">
                            <td class="user-name">{{ $user->name }}</td>
                            <td class="user-email">{{ $user->email }}</td>
                            <td class="user-email">{{ $user->created_at }}</td>

                            <td>
                                <!-- Unblock Button with Modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#unblockModal-{{ $user->id }}">
                                    <i class="bi bi-unlock"></i> Unblock
                                </button>

                                <!-- Modal for Unblock Confirmation -->
                                <div class="modal fade" id="unblockModal-{{ $user->id }}" tabindex="-1" aria-labelledby="unblockModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="unblockModalLabel">Confirm Unblock</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to unblock this user?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('users.unblock', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Yes, Unblock</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
// Search functionality to filter blocked users by name or email
document.getElementById('search').addEventListener('keyup', function() {
    let query = this.value.toLowerCase(); // Convert input to lowercase for case-insensitive search
    let rows = document.querySelectorAll('.user-row'); // Select all rows with class .user-row

    rows.forEach(function(row) {
        let userName = row.querySelector('.user-name').textContent.toLowerCase(); // Get user name
        let userEmail = row.querySelector('.user-email').textContent.toLowerCase(); // Get user email

        // Check if the search query matches either the user name or email
        if (userName.includes(query) || userEmail.includes(query)) {
            row.style.display = ''; // Show the row if it matches
        } else {
            row.style.display = 'none'; // Hide the row if it doesn't match
        }
    });
});
</script>
@endsection
