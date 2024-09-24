@extends('layouts.app')

@section('content')
    <h1>Liste des Événements de Collecte</h1>
    <a href="{{ route('evenement_collectes.create') }}" class="btn btn-primary">Ajouter un événement</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evenements as $evenement)
                <tr>
                    <td>{{ $evenement->nom }}</td>
                    <td>{{ $evenement->date }}</td>
                    <td>{{ $evenement->lieu }}</td>
                    <td>
                        <a href="{{ route('evenement_collectes.show', $evenement) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('evenement_collectes.edit', $evenement) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('evenement_collectes.destroy', $evenement) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
