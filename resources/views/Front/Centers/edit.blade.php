
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container d-flex justify-content-center align-items-center mt-5" style="min-height: 80vh;">
    <div class="card shadow-lg border-success" style="width: 50%; background-color: #f8f9fa;">
        <div class="card-header text-white text-center">
            <h3 class="mb-0">Edit Recycling Center</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('center.update', $center->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $center->name }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $center->address }}" />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $center->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="number" class="form-control" name="phone" value="{{ $center->phone }}" />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $center->email }}" />
                </div>
                <div class="text-center">
                    <button class="btn btn-success">Edit Center</button>
                </div>
            </form>
        </div>
    </div>
</div>
