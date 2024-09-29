@extends('Front/layout')
@section('content') 

<div class="container my-5" style="padding-top: 120px;"> 
    <div class="row justify-content-center">
        @foreach($Categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $category->name }}</h5>
                        <p class="card-text text-muted">
                            Quantity: {{ $category->quantity }} <br>
                            State: {{ ucfirst($category->state) }} <br>
                            Environmental Impact: {{ ucfirst($category->environmental_impact) }}
                        </p>
                        <div class="d-flex justify-content-center"> 
                            <a href="{{ route('Categories.show', $category->id) }}" class="btn btn-outline-success btn-sm">Details</a>
                            <a href="{{ route('Categories.edit', $category->id) }}" class="btn btn-primary btn-sm ms-2">Edit</a>

                            <!-- Delete Button -->
                            <form action="{{ route('Categories.destroy', $category->id) }}" method="POST" class="ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Go back to the form Button -->
<div class="mb-4">
    <a href="{{ route('Categories.create') }}" class="btn btn-primary text-white" style="left;">Go back to the form</a>
</div>
@endsection
