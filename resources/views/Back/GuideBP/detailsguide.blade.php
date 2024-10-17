@extends('Back/dashboard')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="{{ route('guide.index') }}" class="btn-outline-primary">Go Back</a>
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Best Practices guides/</span> Selected Guide Details (ID: {{ $guide->id }})</h4>

        <div class="card mb-4">
            <div class="card-body d-flex">
                <div class="col-md-8"> <!-- Left Column for Text Details -->
                    <h5 class="card-title">{{ $guide->title }}</h5>
                     <div class="card-subtitle text-muted mb-3"><p><strong>Created by user:</strong>{{ $guide->user_id }}</div>
                    <hr>

                    <p><strong>body:</strong> {{ $guide->body }}</p>
                    <p><strong>Creation Date:</strong> {{ \Carbon\Carbon::parse($guide->created_at)->format('d/m/Y H:i') }}</p>
                    <p><strong>Update Date:</strong> {{ \Carbon\Carbon::parse($guide->updated_at)->format('d/m/Y H:i') }}</p>
                    <p><strong>Category:</strong> {{ $guide->category }}</p>

                    <p><strong>Tags:</strong></p>
                    <ul>
                        @foreach(explode(',', $guide->tags) as $tag)
                            <li>{{ $tag }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-4 text-center"> <!-- Right Column for Image -->
                    @if ($guide->image)
                        <img src="{{ asset('storage/' . $guide->image) }}" alt="{{ $guide->title }}" class="img-fluid" style="max-width: 100%; height: auto;">
                    @else
                        <p>No image available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
