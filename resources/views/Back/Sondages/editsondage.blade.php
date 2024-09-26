<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<form method="post"  action="{{route('sondage.update',$sondage->id)}}">
    @csrf
    @method('PUT')


    <label>Title</label>
    <input type="text" name="title" value="{{$sondage->title}}"/><br>

    <label>Location</label>
    <input type="text" name="location" value="{{$sondage->location}}"/><br>

    <label>Description</label>
    <textarea name="description">{{$sondage->description}}></textarea><br>

    <label>Category</label>
    <input type="text" name="category" value="{{$sondage->category}}"/><br>

    <label>Start Date</label>
    <input type="date" name="start_date" value="{{ $sondage->start_date }}"><br>


    <label>End Date</label>
    <input type="date" name="end_date" value="{{$sondage->end_date}}"><br>

    <label>Poll questions</label>

    <textarea name="questions">{{$sondage->questions}}></textarea><br>

    <button>Edit Poll </button>
</form>
