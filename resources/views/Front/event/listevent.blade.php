@extends('Front/layout')
@section('content') 


<div class="table-responsive text-nowrap">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Lieu</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($evenements as $evenement)
                <tr>
                    <td>{{ $evenement->id }}</td>
                    <td>{{ $evenement->titre }}</td>
                    <td>{{ $evenement->description }}</td>
                    <td>{{ $evenement->lieu }}</td>
                    <td>{{ $evenement->date }}</td>
                    <td>{{ $evenement->heure }}</td>
                    <td>
                        @if($evenement->image)
                            <img src="{{ asset('uploads/evenements/' . $evenement->image) }}" alt="Image" width="100">
                        @else
                            Pas d'image
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
{{ $evenements->links() }}
@endsection 
