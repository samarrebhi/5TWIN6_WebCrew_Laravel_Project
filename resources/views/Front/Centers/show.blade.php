

<head>
<link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container my-5">
    <div class="card shadow-lg border-success ">
        <div class="card-header bg-green text-white text-center">
            <h2 class="mb-0 text-green ">Details of the Recycling Center</h2>
        </div>
        <div class="card-body">
            <h4 class="card-title text-success">{{ $center->name }}</h4>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">
            <strong>Description:</strong> {{ $center->description }}
                </li>
                <li class="list-group-item">
                    <strong>Address:</strong> {{ $center->address }}
                </li>
                <li class="list-group-item">
                    <strong>Phone:</strong> {{ $center->phone }}
                </li>
                <li class="list-group-item">
                    <strong>Email:</strong> {{ $center->email }}
                </li>
            </ul>
        </div>
        <div class="card-footer text-center bg-white">
            <a href="{{ route('center.index') }}" class="btn btn-success">Back to Centers</a>
        </div>
    </div>
</div>
