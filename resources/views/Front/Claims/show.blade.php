@extends('Front/layout')
@section('content')

<div class="container my-5" style="padding-top: 120px;">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4>Claim Details</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-4">
                    <strong>Title:</strong>
                </div>
                <div class="col-sm-8">
                    <p>{{ $claim->title }}</p>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-sm-4">
                    <strong>Description:</strong>
                </div>
                <div class="col-sm-8">
                    <p>{{ $claim->description }}</p>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-sm-4">
                    <strong>Center:</strong>
                </div>
                <div class="col-sm-8">
                    <p>{{ $claim->center->name }}</p> 
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-sm-4">
                    <strong>Status:</strong>
                </div>
                <div class="col-sm-8">
                    @if($claim->status == 'in_progress')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($claim->status == 'seen')
                        <span class="badge bg-success">Resolved</span>
                    @else
                        <span class="badge bg-secondary">Unknown</span>
                    @endif
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-sm-4">
                    <strong>Category:</strong>
                </div>
                <div class="col-sm-8">
                    <p>{{ ucfirst($claim->category) }}</p> <!-- Capitalize first letter of category -->
                </div>
            </div>

            @if($claim->attachment)
            <div class="row mb-3">
                <div class="col-sm-4">
                    <strong>Attachment:</strong>
                </div>
                <div class="col-sm-8">
                    <a href="{{ asset('storage/' . $claim->attachment) }}" target="_blank" class="btn btn-info btn-sm">
                        View Attachment
                    </a>
                </div>
            </div>
            @endif

            <div class="text-center">
                <a href="{{ route('claim.index') }}" class="btn btn-secondary">Back to Claims</a>
            </div>
        </div>
    </div>
</div>

@endsection
