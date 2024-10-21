@extends('Back/dashboard')

@section('content')
<div class="container mt-5">
    <h2>Claims List</h2>

    <!-- Formulaire de filtre dynamique -->
    <form method="GET" action="{{ route('admin.claims.index') }}">
        <div class="row">
            <!-- Filtre par statut -->
            <div class="col-md-4">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="seen" {{ request('status') == 'seen' ? 'selected' : '' }}>Seen</option>
                </select>
            </div>

            <!-- Filtre par centre -->
            <div class="col-md-4">
                <label for="center_id">Center</label>
                <select name="center_id" id="center_id" class="form-select" onchange="this.form.submit()">
                    <option value="">All Centers</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}" {{ request('center_id') == $center->id ? 'selected' : '' }}>
                            {{ $center->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtre par catégorie -->
            <div class="col-md-4">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <option value="quality" {{ request('category') == 'quality' ? 'selected' : '' }}>Quality</option>
                    <option value="time" {{ request('category') == 'time' ? 'selected' : '' }}>Time</option>
                    <option value="service" {{ request('category') == 'service' ? 'selected' : '' }}>Service</option>
                </select>
            </div>
        </div>
    </form>

    <!-- Tableau des réclamations -->
    <table class="table mt-4" id="claimsTable">
        <thead>
            <tr>
                <th>Title</th>
                <th>Center</th>
                <th>Category</th>
                <th>Date</th>
                <th>Status</th>
                <th>View Details</th>
            </tr>
        </thead>
        <tbody>
            @if($claims->count())
                @foreach($claims as $claim)
                    <tr>
                        <td>{{ $claim->title }}</td>
                        <td>{{ $claim->center->name }}</td>
                        <td>{{ $claim->category }}</td>
                        <td>{{ $claim->created_at->format('Y-m-d') }}</td>
                        <td>{{ $claim->status }}</td>
                        <td><a href="{{ route('admin.claims.show', $claim->id) }}">View Details</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center items-center flex">No Claims found .</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
