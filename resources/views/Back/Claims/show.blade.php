@extends('Back/dashboard')

@section('content') 
<div class="container">
    <h2>Claim Details</h2>
    <p><strong>Title:</strong> {{ $claim->title }}</p>
    <p><strong>Description:</strong> {{ $claim->description }}</p>
    <p><strong>Status:</strong> {{ $claim->status }}</p>
    <p><strong>Admin Note:</strong> {{ $claim->admin_note }}</p>

    <form action="{{ route('admin.claims.updateStatus', $claim->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="status">Update Status</label>
            <select name="status" class="form-select">
                <option value="in_progress" {{ $claim->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="seen" {{ $claim->status == 'seen' ? 'selected' : '' }}>Seen</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="admin_note">Admin Note</label>
            <textarea name="admin_note" class="form-control" rows="4">{{ old('admin_note', $claim->admin_note) }}</textarea>
        </div>

        <button type="submit" class="btn " style="background-color: #006400; color: white;">Add a note</button>
    </form>
</div>
@endsection