@extends('Back/dashboard') 

@section('content') 
<div class="container">
    <h1 class="text-center mt-4 mb-3 " style="color: green;">Event List</h1>
    <a href="{{ route('evenement_collecte.create') }}" class="btn btn-primary" style="background-color: #287233; border-color: #287233; color: white;">Create Event</a>

    <div class="mt-3 text-end">
    <input type="text" id="search" class="form-control d-inline-block" placeholder="Search events..." style="width: 250px;" />
</div>

    <div class="card mt-4">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead style="background-color: #89AC76; color: black;">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="event-table">
                    @foreach($evenements as $evenement)
                    <tr>
                        <td>{{ $evenement->titre }}</td>
                        <td>{{ $evenement->description }}</td>
                        <td>{{ $evenement->lieu }}</td>
                        <td>{{ $evenement->date }}</td>
                        <td>{{ $evenement->heure }}</td>
                        <td>
                            @if($evenement->image)
                                <img src="{{ asset('uploads/evenements/' . $evenement->image) }}" alt="Image" width="100">
                            @else
                                Pas d'image
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('evenement_collecte.edit', $evenement->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Modify
                                    </a>
                                    <a class="dropdown-item" href="{{ route('evenement_collecte.evenement_collecte.showDet', $evenement->id) }}">
                                        <i class="fas fa-info-circle me-1"></i> Details
                                    </a>
                                    <button class="dropdown-item delete-event" data-id="{{ $evenement->id }}">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $evenements->links() }} <!-- Pagination -->
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Delete Event Script
    $(document).on('click', '.delete-event', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure you want to delete this event?',
            text: "This action is irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete !',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/evenement_collectes/' + id,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'The event has been deleted successfully',
                            'success'
                        );
                        row.fadeOut(); // Remove the row from the table
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error',
                            'Error deleting the event: ' + xhr.responseJSON.message,
                            'error'
                        );
                    }
                });
            }
        });
    });

    // Dynamic Search Functionality
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#event-table tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

@endsection 
