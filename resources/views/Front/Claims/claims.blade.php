@extends('Front/layout')
@section('content')

<div class="container my-5" style="padding-top: 120px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center mb-0">My Claims</h2>
        
        <!-- Add Claim Button positioned on the right with light green color -->
        <a href="{{ route('claim.create') }}" class="btn" style="background-color: #2E8B57; color: white;">
            <i class="fas fa-plus me-1"></i> Add a Claim
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($claims as $claim)
                <tr>
                    <td>{{ $claim->title }}</td>
                    <td>
                        @if($claim->status == 'in_progress')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($claim->status == 'seen')
                            <span class="badge bg-success">Seen</span>
                        @else
                            <span class="badge bg-secondary">Unknown</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <!-- Details Button with Eye Icon -->
                        <a href="{{ route('claim.show', $claim->id) }}" class="btn btn-outline-success btn-sm me-1">
                            <i class="fas fa-eye"></i>
                        </a>

                        <!-- Edit Button with Pencil Icon -->
                        <a href="{{ route('claim.edit', $claim->id) }}" class="btn btn-outline-primary btn-sm me-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <!-- Delete Button with Trash Icon -->
                        <form action="{{ route('claim.destroy', $claim->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" >
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
