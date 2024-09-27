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
                    <input type="text" name="name" class="form-control" value="{{ $center->name }}" id="name" required />
                    <small class="text-danger" id="nameError" style="display:none;">This field is required.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $center->address }}" id="address" required />
                    <small class="text-danger" id="addressError" style="display:none;">This field is required.</small>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required>{{ $center->description }}</textarea>
                    <small class="text-danger" id="descriptionError" style="display:none;">This field is required.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone" value="{{ $center->phone }}" id="phone" required />
                    <small class="text-danger" id="phoneError" style="display:none;">Phone number must be exactly 8 digits.</small>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $center->email }}" id="email" required />
                    <small class="text-danger" id="emailError" style="display:none;">Please enter a valid email address.</small>
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
                        <input type="file" class="form-control" id="inputGroupFile01" name="image" required />
                        <small class="text-danger" id="imageError" style="display:none;">This field is required.</small>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success">Edit Center</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputFields = {
            'phone': {
                errorId: 'phoneError',
                validation: value => value.length === 8
            },
            'email': {
                errorId: 'emailError',
                validation: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
            },
            'name': { errorId: 'nameError', validation: value => value.trim() !== '' },
            'address': { errorId: 'addressError', validation: value => value.trim() !== '' },
            'description': { errorId: 'descriptionError', validation: value => value.trim() !== '' },
            'inputGroupFile01': { errorId: 'imageError', validation: value => value.trim() !== '' }
        };

        Object.keys(inputFields).forEach(fieldId => {
            const field = document.getElementById(fieldId);

            field.addEventListener('blur', function () {
                const { errorId, validation } = inputFields[fieldId];
                if (!validation(field.value)) {
                    document.getElementById(errorId).style.display = 'block';
                } else {
                    document.getElementById(errorId).style.display = 'none';
                }
            });
        });
    });
</script>

@endsection
