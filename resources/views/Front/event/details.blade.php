<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Event Details - WebCrew_Laravel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-light bg-white navbar-expand-xl">
        <a href="index.html" class="navbar-brand"><h1 class="text-primary">WebCrew</h1></a>
        <!-- Add other navbar items here -->
    </nav>
    <!-- Navbar End -->

    <div class="container py-5">
    <h2 class="text-center">{{ $event->titre }}</h2> <!-- Change $evenement to $event -->
    <div class="text-center mb-4">
            @if($evenement->image)
                <img src="{{ asset('uploads/evenements/' . $evenement->image) }}" alt="Image" class="img-fluid" style="width: 300px; height: auto;">
            @endif
        </div>
        <div class="mb-3">
            <h5>Description:</h5>
            <p>{{ $evenement->description }}</p>
        </div>
        <div class="mb-3">
            <h5>Location:</h5>
            <p>{{ $evenement->lieu }}</p>
        </div>
        <div class="mb-3">
            <h5>Date:</h5>
            <p>{{ $evenement->date }}</p>
        </div>
        <div class="mb-3">
            <h5>Time:</h5>
            <p>{{ $evenement->heure }}</p>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back to Events</a>
    </div>

    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 WebCrew. All Rights Reserved.</p>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
