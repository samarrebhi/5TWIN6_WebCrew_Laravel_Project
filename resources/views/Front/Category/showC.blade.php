<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container my-5">
    <div class="card shadow-lg border-info">
        <div class="card-header bg-info text-white text-center">
            <h2 class="mb-0">Details of the Waste Category</h2>
        </div>
        <div class="card-body">
            <h4 class="card-title text-info">{{ $Category->name }}</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Quantity:</strong> {{ $Category->quantity }}
                </li>
                <li class="list-group-item">
                    <strong>State:</strong> {{ ucfirst($Category->state) }}
                </li>
                <li class="list-group-item">
                    <strong>Environmental Impact:</strong> {{ ucfirst($Category->environmental_impact) }}
                </li>
            </ul>
        </div>
        <div class="card-footer text-center bg-white">
            <a href="{{ route('Categories.index') }}" class="btn btn-info">Back to Categories</a>
        </div>
    </div>
</div>
