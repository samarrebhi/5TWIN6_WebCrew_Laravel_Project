
<form method="post" action="{{route('sondage.store')}}">
    @csrf
    <label>Title</label>
    <input type="text" name="title"/><br>

    <label>Location</label>
    <input type="text" name="location"/><br>

    <label>Description</label>
    <textarea name="description"></textarea><br>

    <label>Category</label>
    <input type="text" name="category"/><br>

    <label>Start Date</label>
    <input type="date" name="start_date"/><br>

    <label>End Date</label>
    <input type="date" name="end_date"/><br>

    <label>Poll questions</label>
    <textarea name="questions" placeholder="Enter your poll questions, separated by commas or new lines..." ></textarea><br>



    <button>Add Poll </button>
</form>
