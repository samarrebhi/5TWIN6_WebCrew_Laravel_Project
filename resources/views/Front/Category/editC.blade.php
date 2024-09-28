<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container my-5" style="padding-top: 20px;"> <!-- Reduce top padding -->
    <h2 class="text-center">Edit Category</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('Categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="{{ $category->quantity }}" min="1" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="state">State</label>
                            <input type="text" name="state" class="form-control" value="{{ $category->state }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="environmental_impact">Environmental Impact</label>
                            <input type="text" name="environmental_impact" class="form-control" value="{{ $category->environmental_impact }}" required>
                        </div>

                        <div class="form-group mb-3 text-center">
                            <button type="submit" class="btn btn-success">Update Category</button>
                            <a href="{{ route('Categories.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


