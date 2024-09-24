@extends('layouts.app')

@section('content')
    <h1>Ajouter un Événement de Collecte</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evenement_collectes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom de l'événement</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="datetime-local" name="date" class="form-control" value="{{ old('date') }}">
        </div>
        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" name="lieu" class="form-control" value="{{ old('lieu') }}">
        </div>
        <div class="form-group">
            <label for="organisateur_id">Organisateur</label>
            <input type="number" name="organisateur_id" class="form-control" value="{{ old('organisateur_id') }}">
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
@endsection
