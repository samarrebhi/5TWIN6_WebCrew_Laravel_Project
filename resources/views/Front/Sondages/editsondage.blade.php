<form method="post"  action="{{route('sondage.update',$sondage->id)}}">
    @csrf
    @method('PUT')


    <label>Title</label>
    <input type="text" name="titre"/><br>

    <label>Location</label>
    <input type="text" name="Location" value="{{$sondage->titre}}"/><br>

    <label>Description</label>
    <textarea name="description" value="{{$sondage->description}}"></textarea><br>

    <label>Category</label>
    <input type="text" name="Category" value="{{$sondage->category}}"/><br>

    <label>Start Date</label>
    <input type="date" name="start_date" value="{{$sondage->start_date}}"/><br>

    <label>End Date</label>
    <input type="date" name="end_date" value="{{$sondage->end_date}}"/><br>

    <label>Poll questions</label>
    <textarea name="questions" value="{{$sondage->questions}}" placeholder="Enter your poll questions, separated by commas or new lines..." ></textarea><br>

    <button>Edit Poll </button>
</form>
