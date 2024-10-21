@extends('Back/dashboard')
@section('content')

    <title>Table - List of Polls</title>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Polls /</span> List </h4>

        <div class="card">

            <!-- Add Poll Button and Filter Form -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Created Polls</h5>
                <div class="d-flex align-items-left">
                    <!-- Add Poll Button -->
                    <a href="{{ route('sondage.create.form') }}" class="btn btn-success ms-2">+ Add Poll</a>

                    <!-- Category Filter Form -->
                    <form action="{{ route('sondage.index') }}" method="GET" class="d-flex align-items-center ms-3">
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

            <!-- Poll Table -->
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($sondages as $sondage)
                        <tr>
                            <td><strong>{{ Str::limit($sondage->title, 20) }}</strong></td>
                            <td>{{ Str::limit($sondage->description, 30) }}</td>
                            <td>{{ $sondage->category }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('sondage.show', $sondage->id) }}" class="btn btn-info btn-sm me-2">Details</a>
                                    <a href="{{ route('sondage.edit', $sondage->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form method="post" action="{{ route('sondage.destroy', $sondage->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this poll?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links (optional) -->
            {{ $sondages->links() }}

        </div>
    </div>

@endsection
