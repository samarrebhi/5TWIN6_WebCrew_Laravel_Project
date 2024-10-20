@extends('Back/dashboard')
@section('content')
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="container d-flex justify-content-center align-items-center mt-5" style="min-height: 80vh;">
    <div class="card shadow-lg border-success" style="width: 50%; background-color: #f8f9fa;">
        <div class="card-header text-white text-center">
            <h3 class="mb-0">Edit Recycling Center</h3>
        </div>
        <div class="card-body">
            <form id="editCenterForm" method="post" action="{{ route('center.update', $center->id) }}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $center->name }}" id="name"  />
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $center->address }}" id="address"  />
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name="description" >{{ $center->description }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $center->phone }}" id="phone"  />
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $center->email }}" id="email" />
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="flex justify-center mb-4">
                    @if($center->image)
                        <img src="{{ asset('storage/' . $center->image) }}" class="img-fluid mx-auto d-block" alt="{{ $center->name }}" style="max-width: 200px; height: auto;" />
                    @endif
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile01" name="image" />
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success">Edit Center</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
