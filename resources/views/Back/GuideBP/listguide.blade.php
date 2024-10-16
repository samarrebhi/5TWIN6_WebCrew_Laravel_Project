


@extends('Back/dashboard')
@section('content')

    <title>Table -List of Best Practices Guides</title>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Guides /</span> List </h4>

        <div class="card">

            <div class="table-responsive text-nowrap">

                <div class="card-header f-flex justify-body-between align-items-center">
                    <h5>Created Polls</h5>
                    <a href="{{ route('guide.create.form') }}" class="btn btn-success ">+ Add Guide</a>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>body</th>

                        <th>Image</th>


                        <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($guides as $guide)
                        <tr>
                            <td><strong>{{Str::limit($guide->title , 30)}}</strong></td>

                            <td>{{ $guide->category}}</td>
                            <td>{{ Str::limit($guide->body, 30) }}</td>
                            <td>

                                <img src="{{ asset('storage/' . $guide->image)  }}" alt="{{ $guide->title }}" class="img-thumbnail" style="width: 100px; height: auto;">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('guide.show', $guide->id) }}" class="btn btn-info btn-sm me-2">Details</a>
                                    <a href="{{ route('guide.edit', $guide->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form method="post" action="{{ route('guide.destroy', $guide->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this guide?')">Delete</button>
                                    </form>
                                </div>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

@endsection
