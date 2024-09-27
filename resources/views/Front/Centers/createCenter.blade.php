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
                    <input type="text" class="form-control" name="name" id="name" required />
                    <small class="text-danger" id="nameError" style="display:none;">This field is required.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" required />
                    <small class="text-danger" id="addressError" style="display:none;">This field is required.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3" name="description" id="description" required></textarea>
                    <small class="text-danger" id="descriptionError" style="display:none;">This field is required.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" required />
                    <small class="text-danger" id="phoneError" style="display:none;">Phone number must be exactly 8 digits.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="name@example.com" name="email" id="email" required />
                    <small class="text-danger" id="emailError" style="display:none;">Please enter a valid email address.</small>
                    <small class="text-danger" id="emailRequiredError" style="display:none;">Email is required.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image" required />
                    <small class="text-danger" id="imageError" style="display:none;">This field is required.</small>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success">Add Center</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('centerForm');

        form.addEventListener('submit', function (event) {
            let valid = true;
            resetErrors();

            const fields = ['name', 'address', 'description', 'phone', 'email', 'image'];
            fields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value) {
                    if (field === 'email') {
                        showError('emailRequiredError');
                    } else {
                        showError(field + 'Error');
                    }
                    valid = false;
                }
            });

            const phone = document.getElementById('phone').value;
            if (phone.length !== 8) {
                showError('phoneError');
                valid = false;
            }

            const email = document.getElementById('email').value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email && !emailPattern.test(email)) {
                showError('emailError');
                valid = false;
            }

            if (!valid) {
                event.preventDefault();
            }
        });

        function showError(errorId) {
            document.getElementById(errorId).style.display = 'block';
        }

        function resetErrors() {
            const errorElements = ['nameError', 'addressError', 'descriptionError', 'phoneError', 'emailError', 'emailRequiredError', 'imageError'];
            errorElements.forEach(id => {
                document.getElementById(id).style.display = 'none';
            });
        }

        const inputFields = ['name', 'address', 'description', 'phone', 'email', 'image'];
        inputFields.forEach(field => {
            const input = document.getElementById(field);
            input.addEventListener('blur', function () {
                resetErrors();
                
                if (!input.value) {
                    if (field === 'email') {
                        showError('emailRequiredError');
                    } else {
                        showError(field + 'Error');
                    }
                } else {
                    if (field === 'phone' && input.value.length !== 8) {
                        showError('phoneError');
                    }

                    if (field === 'email') {
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(input.value)) {
                            showError('emailError');
                        }
                    }
                }
            });
        });
    });
</script>
@endsection
