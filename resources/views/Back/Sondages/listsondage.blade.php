


@extends('Back/dashboard')
@section('content')

    <title>Table -List of Polls</title>
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Polls /</span> List </h4>

                    <div class="card">

                        <div class="table-responsive text-nowrap">

                            <div class="card-header f-flex justify-content-between align-items-center">
                                <h5>Created Polls</h5>
                                <a href="{{ route('sondage.create.form') }}" class="btn btn-success ">+ Add Poll</a>
                            </div>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach($sondages as $sondage)
                                    <tr>
                                        <td><strong>{{ $sondage->title }}</strong></td>
                                        <td>{{ Str::limit($sondage->description, 60) }}</td>
                                        <td>{{ $sondage->category}}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('sondage.show', $sondage->id) }}" class="btn btn-info btn-sm me-2">Details</a>
                                                <a href="{{ route('sondage.edit', $sondage->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                                <form method="post" action="{{ route('sondage.destroy', $sondage->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

@endsection
