@extends('Back/dashboard')
@section('content')

<div class="container mt-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Waste Categories Management</h2>
        <a href="{{ route('Categories.create') }}" class="btn text-white" style="background-color: #006400;">+ Add Category</a>
    </div>

    <!-- Categories Table -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead class="text-white" style="background-color: #006400;">
                    <tr>
                        <th class="text-white">Name</th>
                        <th class="text-white">Quantity</th>
                        <th class="text-white">State</th>
                        <th class="text-white">Environmental Impact</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->quantity }}</td>
                            <td>{{ ucfirst($category->state) }}</td>
                            <td>{{ ucfirst($category->environmental_impact) }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Details Button -->
                                    <a href="{{ route('Categories.show', $category->id) }}" class="btn btn-outline-secondary btn-sm">Details</a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('Categories.edit', $category->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>

                                    <!-- Delete Form -->
                                    <form action="{{ route('Categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
