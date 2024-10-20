@extends('Back/dashboard')
@section('content') 
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Limit the form width */
            margin: auto; /* Center the form */
        }
        .form-label {
            font-weight: bold;
        }
        .form-control, .form-select {
            padding: 10px;
            font-size: 1rem;
        }
        .btn-primary {
    color: #fff;
}
  
    </style>
</head>

<div class="container my-5" style="padding-top: 100px;"> 
    <h1 class="mb-4 text-center">Add a New Waste Category</h1>
    <div class="form-section">
        <form method="post" action="{{ route('Categories.store') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="form-label">Category Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name..." required />
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity..." required />
            </div>

            <div class="mb-4">
                <label for="state" class="form-label">State:</label>
                <select name="state" id="state" class="form-select" required>
                    <option value="">Select state...</option>
                    <option value="solid">Solid</option>
                    <option value="liquid">Liquid</option>
                    <option value="electronic">Electronic</option>
                    <option value="gas">Gas</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="environmental_impact" class="form-label">Environmental Impact:</label>
                <select name="environmental_impact" id="environmental_impact" class="form-select" required>
                    <option value="">Select impact level...</option>
                    <option value="low">Low</option>
                    <option value="moderate">Moderate</option>
                    <option value="high">High</option>
                    <option value="polluting">Polluting</option>
                    <option value="biodegradable">Biodegradable</option>
                </select>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit"class="btn btn-primary">Add Category</button>
            </div>
        </form>
    </div>
</div>

@endsection
