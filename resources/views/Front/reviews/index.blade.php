@extends('Front/layout')

@section('content')

<div class="container d-flex align-items-center justify-content-center flex-column" style="min-height: 100vh;">
    <h1 class="text-center mb-4">Reviews for <span class="text-success">{{ $evenement->titre }}</span></h1>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

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
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm rounded">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th> <!-- Added name column -->
                        <th>would_recommend</th> <!-- Added email column -->
                        <th>anonymous</th> <!-- Added email column -->

                        <th>Comment</th>
                        <th>Rating</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td> <!-- Assuming the review is associated with a user -->
                        <td>{{ $review->would_recommend }}</td>
                        <td>{{ $review->anonymous }}</td>
                 
                        <td>{{ $review->comment }}</td>
                        <td>
                            <span class="badge badge-warning">{{ $review->rating }}</span>
                        </td>
                        <td>{{ $review->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <!-- Edit Icon -->
                            <a href="{{ route('reviews.edit', ['evenementId' => $evenement->id, 'id' => $review->id]) }}" class="text-warning me-2" title="Edit">
                                <i class="bx bx-edit" style="font-size: 1.5em;"></i>
                            </a>
                            <!-- Delete Icon -->
                            <form action="{{ route('reviews.destroy', ['evenementId' => $evenement->id, 'reviewId' => $review->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link text-danger p-0 delete-event" data-id="{{ $review->id }}" title="Delete">
                                    <i class="bx bx-trash" style="font-size: 1.5em;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('reviews.create', $evenement->id) }}" class="btn custom-btn">
            <i class="bx bx-plus me-1"></i>Add a Review
        </a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).on('click', '.delete-event', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var evenementId = {{ $evenement->id }};
        var row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure you want to delete this review?',
            text: "This action is irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/reviews/' + evenementId + '/' + id,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        Swal.fire('Deleted!', 'The review has been deleted successfully', 'success');
                        row.fadeOut();
                    },
                    error: function (xhr) {
                        Swal.fire('Error', 'Error deleting the review: ' + xhr.responseJSON.message, 'error');
                    }
                });
            }
        });
    });
</script>

<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #fff;
    }
    .table-responsive {
        overflow-x: auto;
        margin-top: 20px;
    }
    .custom-btn {
        background-color: #28a745;
        color: #fff;
        padding: 12px 24px;
        border-radius: 25px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .custom-btn:hover {
        background-color: #218838;
        transform: scale(1.05);
    }
    .custom-btn:focus {
        outline: none;
    }
    .custom-btn i {
        font-size: 1.2em;
        vertical-align: middle;
    }
</style>
@endsection
