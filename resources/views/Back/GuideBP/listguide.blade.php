@extends('Back/dashboard')
@section('content')

    <title>Table - List of Best Practices Guides</title>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Guides /</span> List </h4>

        <div class="card">

            <!-- Add Category Filter Form -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- Left Side: Title -->
                <h5 class="mb-0">Created Best Practices Guides</h5>

                <!-- Right Side: Add Guide Button and Filter Form -->
                <div class="d-flex align-items-left">
                    <!-- Add Guide Button -->
                    <a href="{{ route('guide.create.form') }}" class="btn btn-success ms-2">+ Add Guide</a>

                    <!-- Category Filter Form -->
                    <form action="{{ route('guide.index') }}" method="GET" class="d-flex align-items-center ms-3">
                        <select name="category" class="form-select me-2">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-info">Filter</button>
                    </form>
                </div>
            </div>


            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Body</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($guides as $guide)
                        <tr>
                            <td><strong>{{Str::limit($guide->title , 20)}}</strong></td>
                            <td>{{ $guide->category }}</td>
                            <td>{{ Str::limit($guide->body, 20) }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $guide->image) }}" alt="{{ $guide->title }}" class="img-fluid rounded" style="width: 120px; height: 80px;">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('guide.show', $guide->id) }}" class="btn btn-info btn-sm me-2">Details</a>
                                    <a href="{{ route('guide.edit', $guide->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form method="post" action="{{ route('guide.destroy', $guide->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this guide?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links (optional) -->
            {{ $guides->links() }}

        </div>
    </div>
@endsection
