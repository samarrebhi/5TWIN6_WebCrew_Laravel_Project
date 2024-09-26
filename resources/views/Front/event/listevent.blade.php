@extends('Back/dashboard')

@section('content') 
<div class="container">
    <h1 class="text-center mt-3 mb-3" style="color: green;">Event List</h1>
    <a href="{{ route('evenement_collectes.create') }}" class="btn btn-primary" style="background-color: #287233; border-color: #287233; color: white;">Create Event</a>
    
    <div class="card mt-4">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead style="background-color: #89AC76; color: black;">
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Lieu</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($evenements as $evenement)
                    <tr>
                        <td>{{ $evenement->id }}</td>
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
                                    <a class="dropdown-item" href="{{ route('evenement_collectes.edit', $evenement->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Modifier
                                    </a>
                                    <button class="dropdown-item delete-event" data-id="{{ $evenement->id }}">
                                        <i class="bx bx-trash me-1"></i> Supprimer
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

    {{ $evenements->links() }}
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.delete-event', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        if (confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
            $.ajax({
                url: '/evenement_collectes/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response.message);
                    row.fadeOut();
                },
                error: function(xhr) {
                    alert('Erreur lors de la suppression de l\'événement: ' + xhr.responseJSON.message);
                }
            });
        }
    });
</script>
@endsection
