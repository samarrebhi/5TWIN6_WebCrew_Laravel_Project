@extends('Front/layout')
@section('content')

<div class="container my-5" style="padding-top: 120px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center mb-0">My Claims</h2>
       
        <a href="{{ route('claim.create') }}" class="btn" style="background-color: #2F4F4F; color: white;">
            <i class="fas fa-plus me-1"></i> Add a Claim
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-success">
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
                    <td>{{ Str::limit($claim->description, 50) }}</td> <!--  a shortened version of the description -->
                    <td>
                        @if($claim->status == 'in_progress')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($claim->status == 'seen')
                            <span class="badge bg-success">Resolved</span>
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
                       
                        @if($claim->user_id === auth()->id())
                        <form action="{{ route('claim.destroy', $claim->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($claims->isEmpty())
    <div class="text-center mt-4">
        <p class="text-muted">No claims found.</p>
    </div>
    @endif

</div>

@endsection
