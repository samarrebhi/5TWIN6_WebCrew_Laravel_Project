@extends('Back/dashboard')
@section('content') 

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Recycling Centers</h2>
        <a href="{{ route('center.create') }}" class="btn text-white" style="background-color: #006400;">+ Add Center</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead class="text-white" style="background-color: #006400;"> 
                    <tr >
                        <th class="text-white">Name</th>
                        <th class="text-white">Address</th>
                        <th class="text-white">Description</th>
                        <th class="text-white">Phone</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($centers as $center)
                        <tr>
                            <td>{{ $center->name }}</td>
                            <td>{{ $center->address }}</td>
                            <td>{{ $center->description }}</td>
                            <td>{{ $center->phone }}</td>
                            <td>{{ $center->email }}</td>
                            <td>
                                <a href="{{ route('center.edit', $center->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                <form action="{{ route('center.destroy', $center->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this center?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
