<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Événement</title>
</head>
<body>
    <h1>Créer un Événement</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evenement_collectes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="titre">Titre:</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="lieu">Lieu:</label>
            <input type="text" name="lieu" id="lieu" value="{{ old('lieu') }}" required>
        </div>

        <div>
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}" required>
        </div>

        <div>
            <label for="heure">Heure:</label>
            <input type="time" name="heure" id="heure" value="{{ old('heure') }}" required>
        </div>

        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        <div>
            <button type="submit">Créer Événement</button>
        </div>
    </form>
</body>
</html>
