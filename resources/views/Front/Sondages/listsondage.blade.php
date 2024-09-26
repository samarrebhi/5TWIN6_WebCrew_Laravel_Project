@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-4">

    <h2>Polls List</h2>
    <div class="mb-10">
        <button type="button" onclick="window.location.href='{{ route('sondage.create.form') }}'"
                class="btn btn-primary">Add a new Poll</button>
    </div>

    <ul class="list-group">
        @foreach($sondages as $sondage)
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>{{ $sondage->title }}</h5>
                        <p>{{ $sondage->description }}</p>
                    </div>
                    <div>
                        <a href="{{ route('sondage.show', $sondage->id) }}" class="btn btn-info btn-sm">Details</a>
                        <a href="{{ route('sondage.edit', $sondage->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form method="post" action="{{ route('sondage.destroy', $sondage->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
