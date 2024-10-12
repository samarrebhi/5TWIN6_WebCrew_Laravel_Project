@extends('Back/dashboard')

@section('content')
<div class="container">
    <h1>List of participants</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Participant Name </th>
                <th>Participant Email</th>
                <th>Event Title</th>
                <th>Event Created by</th> <!-- New column for event creator -->
                <th>Date and Time of Participation</th>
                <th>Event Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participants as $participant)
                <tr>
                    <td>{{ $participant['user']->name }}</td>
                    <td>{{ $participant['user']->email }}</td> <!-- Assurez-vous que vous avez un champ 'email' -->
                    <td>{{ $participant['event']->titre }}</td>
                    <td>{{ $participant['event_creator'] ? $participant['event_creator']->name : 'Inconnu' }}</td> <!-- Event creator's name -->
                    <td>{{ $participant['participation_time'] }}</td>
                    <td>
                        <img src="{{ asset('uploads/evenements/' . $participant['event']->image) }}" alt="{{ $participant['event']->titre }}" style="width: 50px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
