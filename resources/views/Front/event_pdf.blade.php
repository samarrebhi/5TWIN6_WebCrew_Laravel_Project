<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $event->titre }} - Event Details</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        p { margin: 10px 0; }
    </style>
</head>
<body>
    <h1>{{ $event->titre }}</h1>
    <p><strong>Description:</strong> {{ $event->description }}</p>
    <p><strong>Location:</strong> {{ $event->lieu }}</p>
    <p><strong>Date:</strong> {{ $event->date }}</p>
    <p><strong>Time:</strong> {{ $event->heure }}</p>
    <img src="{{ public_path('uploads/evenements/' . $event->image) }}" alt="{{ $event->titre }}" style="width:100%; height:auto;">
</body>
</html>
