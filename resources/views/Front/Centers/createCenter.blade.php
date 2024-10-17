@extends('Back/dashboard')
@section('content')
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container d-flex justify-content-center align-items-center mt-5" style="min-height: 80vh;">
    <div class="card shadow-lg border-success" style="width: 50%; background-color: #f8f9fa;">
        <div class="card-header text-white text-center">
            <h3 class="mb-0">Add Recycling Center</h3>
        </div>
        <div class="card-body">
            <form id="centerForm" method="post" action="{{ route('center.store') }}" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  />
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" />
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea  rows="3" name="description" id="description" class="form-control @error('description') is-invalid @enderror" ></textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" />
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" placeholder="name@example.com" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  />
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" />
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success">Add Center</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection