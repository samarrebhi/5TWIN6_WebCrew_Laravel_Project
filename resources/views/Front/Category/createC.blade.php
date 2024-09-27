
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container my-5" style="padding-top: 120px;"> 
    <h1 class="mb-4">Add a New Waste Category</h1>
    <form method="post" action="{{ route('Categories.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input type="text" name="name" id="name" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="state" class="form-label">State:</label>
            <select name="state" id="state" class="form-select" required>
                <option value="solid">Solid</option>
                <option value="liquid">Liquid</option>
                <option value="electronic">Electronic</option>
                <option value="gas">Gas</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="environmental_impact" class="form-label">Environmental Impact:</label>
            <select name="environmental_impact" id="environmental_impact" class="form-select" required>
                <option value="low">Low</option>
                <option value="moderate">Moderate</option>
                <option value="high">High</option>
                <option value="polluting">Polluting</option>
                <option value="biodegradable">Biodegradable</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
</div>


