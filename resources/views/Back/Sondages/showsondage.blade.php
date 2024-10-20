@extends('Back/dashboard')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="{{ route('sondage.index') }}" class="btn-outline-primary  ">Go Back</a>
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Poll/</span> Selected Poll Details (ID: {{ $sondage->id }})</h4>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $sondage->title }}</h5>
                <div class="card-subtitle text-muted mb-3">{{ $sondage->category }}</div>
                <hr>
                <p><strong>Description:</strong> {{ $sondage->description }}</p>
                <p><strong>Creation Date:</strong> {{ \Carbon\Carbon::parse($sondage->created_at)->format('d/m/Y H:i') }}</p>
                <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($sondage->start_date)->format('d/m/Y H:i') }}</p>
                <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($sondage->end_date)->format('d/m/Y H:i') }}</p>

                <p><strong>Created by user:</strong>{{ $sondage->user_id }}</p>
                <p><strong>Questions and options:</strong></p>
                <ul>


                    @if($questions)
                        @foreach($questions as $question)
                        <li>
                            <strong>{{ $question['text'] }}</strong>
                            <ul>
                                @foreach($question['options'] as $option)
                                    <li>{{ $option }}</li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    @else
                        <li>No questions available</li>
                    @endif

                </ul>



            </div>
        </div>
    </div>



@endsection

