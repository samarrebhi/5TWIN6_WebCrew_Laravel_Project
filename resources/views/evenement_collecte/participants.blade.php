@extends('Back/dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">List of Participants</h1>

    <!-- Search Bar -->
    <div class="input-group mb-3">
        <input type="text" id="search" class="form-control" placeholder="Search by participant name, email, or event title">
        <span class="input-group-text">
            <i class="bi bi-search"></i> <!-- Bootstrap icon for search -->
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Participant Name</th>
                    <th>Participant Email</th>
                    <th>Event Title</th>
                    <th>Event Created by</th> <!-- New column for event creator -->
                    <th>Date and Time of Participation</th>
                    <th>Event Image</th>
                </tr>
            </thead>
            <tbody id="participant-table-body">
                @foreach($participants as $participant)
                    <tr class="participant-row">
                        <td class="participant-name">{{ $participant['user']->name }}</td>
                        <td class="participant-email">{{ $participant['user']->email }}</td>
                        <td class="event-title">{{ $participant['event']->titre }}</td>
                        <td>{{ $participant['event_creator'] ? $participant['event_creator']->name : 'Unknown' }}</td>
                        <td>{{ $participant['participation_time'] }}</td>
                        <td>
                            <img src="{{ asset('uploads/evenements/' . $participant['event']->image) }}" alt="{{ $participant['event']->titre }}" class="img-thumbnail" style="width: 70px; height: auto;">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript for live search functionality -->
<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let query = this.value.toLowerCase(); // Get the search query
        let rows = document.querySelectorAll('.participant-row'); // Select all participant rows

        rows.forEach(function(row) {
            let name = row.querySelector('.participant-name').textContent.toLowerCase();
            let email = row.querySelector('.participant-email').textContent.toLowerCase();
            let eventTitle = row.querySelector('.event-title').textContent.toLowerCase();

            // Check if the query matches any of the participant's name, email, or event title
            if (name.includes(query) || email.includes(query) || eventTitle.includes(query)) {
                row.style.display = ''; // Show row if it matches
            } else {
                row.style.display = 'none'; // Hide row if it doesn't match
            }
        });
    });
</script>
@endsection
