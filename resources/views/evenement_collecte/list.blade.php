@extends('Front/layout')

@section('content')
<div class="container">
    <h1>Liste des événements</h1>
    <a href="{{ route('evenement_collectes.create') }}" class="btn btn-primary">Créer un nouvel événement</a>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Lieu</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Participants</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evenements as $evenement)
            <tr>
                <td>{{ $evenement->id }}</td>
                <td>{{ $evenement->titre }}</td>
                <td>{{ $evenement->description }}</td>
                <td>{{ $evenement->lieu }}</td>
                <td>{{ $evenement->date }}</td>
                <td>{{ $evenement->heure }}</td>
                <td>{{ $evenement->participants }}</td>
                <td>
                    @if($evenement->image)
                    <img src="{{ asset('uploads/evenements/' . $evenement->image) }}" alt="Image" width="100">
                    @else
                    Pas d'image
                    @endif
                </td>
                <td>
                    <a href="{{ route('evenement_collectes.edit', $evenement->id) }}" class="btn btn-warning">Modifier</a>
                    <button class="btn btn-danger delete-event" data-id="{{ $evenement->id }}">Supprimer</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $evenements->links() }}
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.delete-event', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr'); // Get the closest row to remove

        if (confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
            $.ajax({
                url: '/evenement_collectes/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}" // Add CSRF token for security
                },
                success: function(response) {
                    alert(response.message); // Display success message
                    row.fadeOut(); // Remove the row from the table with fade out effect
                },
                error: function(xhr) {
                    alert('Erreur lors de la suppression de l\'événement.');
                }
            });
        }
    });
</script>
@endsection
