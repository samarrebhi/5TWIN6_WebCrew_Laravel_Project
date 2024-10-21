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

    <!-- Barre de recherche avec filtres -->
    <div class="mb-4 w-100">
        <div class="row">
            <div class="col-md-4">
                <input type="text" id="name-search" class="form-control" placeholder="Search by Name" />
            </div>
            <div class="col-md-4">
                <input type="text" id="event-search" class="form-control" placeholder="Search by Event" />
            </div>
            <div class="col-md-4">
                <input type="text" id="comment-search" class="form-control" placeholder="Search by Comment" />
            </div>
        </div>
    </div>

    @if ($reviews->isEmpty())
        <div class="alert alert-warning">
            No reviews yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm rounded">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Event name</th>
                        <th>Comment</th>
                        <th>Rating</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="reviews-table-body">
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->evenementCollecte ? $review->evenementCollecte->titre : 'N/A' }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>
                            <span class="badge badge-warning">{{ $review->rating }}</span>
                        </td>
                        <td>{{ $review->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('reviews.edit', ['evenementId' => $evenement->id, 'id' => $review->id]) }}" class="text-warning me-2" title="Edit">
                                <i class="bx bx-edit" style="font-size: 1.5em;"></i>
                            </a>
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

    // Fonction de recherche multicritères
    $(document).ready(function() {
        $('input').on('keyup', function() {
            var nameValue = $('#name-search').val().toLowerCase();
            var eventValue = $('#event-search').val().toLowerCase();
            var commentValue = $('#comment-search').val().toLowerCase();

            $('#reviews-table-body tr').filter(function() {
                $(this).toggle(
                    ($(this).find('td:nth-child(1)').text().toLowerCase().indexOf(nameValue) > -1 || nameValue === '') &&
                    ($(this).find('td:nth-child(2)').text().toLowerCase().indexOf(eventValue) > -1 || eventValue === '') &&
                    ($(this).find('td:nth-child(3)').text().toLowerCase().indexOf(commentValue) > -1 || commentValue === '')
                );
            });
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
    /* Styles supplémentaires pour les champs de recherche */
    #name-search, #event-search, #comment-search {
        border: 1px solid #ced4da;
        border-radius: 5px;
    }
    #name-search:focus, #event-search:focus, #comment-search:focus {
        border-color: #80bdff;
        outline: none;
        box-shadow: 0 0 0.2rem rgba(0, 123, 255, .25);
    }
</style>
@endsection
