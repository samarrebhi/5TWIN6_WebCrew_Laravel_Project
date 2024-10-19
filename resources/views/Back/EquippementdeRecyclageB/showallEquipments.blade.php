@extends('Back.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Equipment /</span> All Equipment
    </h4>

    <a href="{{ route('equipments.create') }}" class="btn btn-primary mb-3">Add New Equipment</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th> <!-- Nouvelle colonne pour l'image -->
                        <th>Name</th>
                        <th>Status</th>
                        <th>Capacity</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($equippements as $equipment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <!-- Affichage de l'image -->
                            <td>
                                @if ($equipment->image)
                                    <img src="{{ asset('uploads/Equipments/' . $equipment->image) }}" 
                                         alt="Image of {{ $equipment->nom }}" 
                                         width="80" 
                                         height="80" 
                                         style="object-fit: cover; border-radius: 8px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>{{ $equipment->nom }}</td>
                            <td>{{ ucfirst($equipment->statut) }}</td>
                            <td>{{ $equipment->capacite }}</td>
                            <td>{{ $equipment->emplacement }}</td>
                            <td>
                            <a href="{{ route('equipments.show', $equipment->id) }}" class="btn btn-info btn-sm">
    <i class="bx bx-show"></i> View
</a>

                                <a href="{{ route('equipments.edit', $equipment->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bx bx-edit"></i> Update
                                </a>
                                <form action="{{ route('equipments.destroy', $equipment->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="bx bx-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No equipment found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
