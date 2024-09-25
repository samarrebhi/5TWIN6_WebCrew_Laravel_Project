

@if('success')
    <div>{{session('success')}}</div>
@endif
<ul>

@foreach($centers as $center)
<table>
    <td>
{{$center->name}}
</td>
</table>
<a href="{{route('center.show',$center->id)}}">Details</a>
<a href="{{route('center.edit',$center->id)}}">Edit</a>
<hr>
<form method="post" action="{{route('center.destroy',$center->id)}}">
    @csrf 
    @method('DELETE')
<button type="submit">Delete</button>
</form>
@endforeach