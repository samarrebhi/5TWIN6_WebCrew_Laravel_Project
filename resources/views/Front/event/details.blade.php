<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Event Details - WebCrew</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1>{{ $event->titre }}</h1>
        <img src="{{ asset('uploads/evenements/' . $event->image) }}" alt="{{ $event->titre }}" class="img-fluid">
        <p><strong>Description:</strong> {{ $event->description }}</p>
        <p><strong>Location:</strong> {{ $event->lieu }}</p>
        <p><strong>Date:</strong> {{ $event->date }}</p>
        <p><strong>Time:</strong> {{ $event->heure }}</p>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a> <!-- Back button -->
    </div>

</body>

</html>
