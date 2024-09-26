@extends('Front/layout')

@section('content')
<div class="container">
    <h1>Modifier l'événement</h1>
    <form action="{{ route('evenement_collectes.update', $evenement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ old('titre', $evenement->titre) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description', $evenement->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" name="lieu" class="form-control" value="{{ old('lieu', $evenement->lieu) }}" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $evenement->date) }}" required>
        </div>
        <div class="form-group">
            <label for="heure">Heure</label>
            <input type="time" name="heure" class="form-control" value="{{ old('heure', $evenement->heure) }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image (facultatif)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
