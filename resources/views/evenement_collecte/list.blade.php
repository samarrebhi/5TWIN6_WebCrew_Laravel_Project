@extends('layouts.app')

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
                    <form action="{{ route('evenement_collectes.destroy', $evenement->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $evenements->links() }}
</div>
@endsection
