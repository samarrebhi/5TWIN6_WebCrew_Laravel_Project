

@if('success')
    <div>{{session('success')}}</div>
@endif
<ul>

    @foreach($sondages as $sondage)
        <table>
            <td>
                {{$sondage->name}}
            </td>
        </table>
        <a href="{{route('sondage.show',$sondage->id)}}">Details</a>
        <a href="{{route('sondage.edit',$sondage->id)}}">Edit</a>
        <hr>
        <form method="post" action="{{route('sondage.destroy',$sondage->id)}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
@endforeach
