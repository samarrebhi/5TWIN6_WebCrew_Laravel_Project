@extends('Front/layout')
@section('content') 

<div class="container my-5" style="padding-top: 120px;"> 
    <div class="row justify-content-center">
        @foreach($centers as $center)
            <div class="col-md-4 mb-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $center->name }}</h5>
                        <p class="card-text text-muted">
                            Address: {{ $center->address }} <br>
                        </p>
                        <a href="{{ route('center.show', $center->id) }}" class="btn btn-outline-success btn-sm">Details</a>
                        <a href="{{ route('center.edit', $center->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                        <form method="POST" action="{{ route('center.destroy', $center->id) }}" style="display: inline-block;">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this center?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
