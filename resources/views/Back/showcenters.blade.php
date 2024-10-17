@extends('Back/dashboard')

@section('content') 

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Recycling Centers</h2>
        <a href="{{ route('center.create') }}" class="btn text-white" style="background-color: #006400;">+ Add Center</a>
    </div>
    
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead class="text-white" style="background-color: #006400;"> 
                    <tr>
                        <th class="text-white">Name</th>
                        <th class="text-white">Address</th>
                        <th class="text-white">Description</th>
                        <th class="text-white">Phone</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($centers as $center)
                        <tr>
                            <td>{{ $center->name }}</td>
                            <td>{{ $center->address }}</td>
                            <td>{{ $center->description }}</td>
                            <td>{{ $center->phone }}</td>
                            <td>{{ $center->email }}</td>
                            <td>
                                <div class="d-flex gap-2"> 
                                    <a href="{{ route('center.show.details', $center->id) }}" class="btn btn-outline-secondary btn-sm">Details</a>
                                    <a href="{{ route('center.edit', $center->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                    <button class="btn btn-outline-danger btn-sm delete-center" data-id="{{ $center->id }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.delete-center', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure you want to delete this center?',
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
                    url: '/center/' + id,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'The center has been deleted successfully.',
                            'success'
                        );
                        row.fadeOut(); // Remove the row from the table
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error',
                            'Error deleting the center: ' + xhr.responseJSON.message,
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>

@endsection
