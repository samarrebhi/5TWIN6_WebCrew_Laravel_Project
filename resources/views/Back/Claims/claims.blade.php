@extends('Back/dashboard')

@section('content') 
<div class="container">
    <h2>Claims List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($claims as $claim)
                <tr>
                    <td>{{ $claim->title }}</td>
                    <td>{{ $claim->description }}</td>
                    <td>{{ $claim->status }}</td>
                    <td>
                        <a href="{{ route('admin.claims.show', $claim->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
