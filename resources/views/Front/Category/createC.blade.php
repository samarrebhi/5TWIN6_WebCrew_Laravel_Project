<!----> <form method="post" action="{{ route('Categories.store') }}">
    @csrf
    <h1>Add a New Waste Category</h1>
    <div>
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" required />
    </div>

    <div>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required />
    </div>

    <div>
        <label for="state">State:</label>
        <select name="state" id="state" required>
            <option value="solid">Solid</option>
            <option value="liquid">Liquid</option>
            <option value="electronic">Electronic</option>
            <option value="gas">Gas</option>
            <option value="other">Other</option>
        </select>
    </div>

    <div>
        <label for="environmental_impact">Environmental Impact:</label>
        <select name="environmental_impact" id="environmental_impact" required>
            <option value="low">Low</option>
            <option value="moderate">Moderate</option>
            <option value="high">High</option>
            <option value="polluting">Polluting</option>
            <option value="biodegradable">Biodegradable</option>
        </select>
    </div>

    <button type="submit">Add Category</button>
</form>
