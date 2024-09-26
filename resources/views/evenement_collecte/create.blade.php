@extends('Front/layout')

@section('content')
<div class="container">
    <h1>Créer un Nouvel Événement</h1>

    @if (session('success'))
        <script>
            swal("Succès!", "{{ session('success') }}", "success");
        </script>
    @endif

    @if ($errors->any())
        <script>
            swal("Erreur!", "{{ implode(', ', $errors->all()) }}", "error");
        </script>
    @endif

    <form action="{{ route('evenement_collectes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" name="titre" value="{{ old('titre') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" class="form-control" name="lieu" value="{{ old('lieu') }}" required>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" value="{{ old('date') }}" required>
        </div>

        <div class="form-group">
            <label for="heure">Heure</label>
            <input type="time" class="form-control" name="heure" value="{{ old('heure') }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image (optionnel)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Créer Événement</button>
    </form>
</div>
@endsection
