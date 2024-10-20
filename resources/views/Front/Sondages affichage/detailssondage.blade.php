@extends('Front/layout')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="{{ route('sondage.index') }}" class="btn-outline-primary">Go Back</a>
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Poll/</span> Selected Poll Details </h4>

        <!-- Empty Card Start -->
        <div class="card mb-4">
            <div class="card-body text-center">


            </div>
        </div>
        <!-- Empty Card End -->

        <div class="card mb-4 border-green">
            <div class="card-body ">
                <h5 class="card-title">{{ $sondage->title }}</h5>
                <div class="card-subtitle text-muted mb-3">{{ $sondage->category }}</div>
                <hr>
                <p><strong>Description:</strong> {{ $sondage->description }}</p>
                <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($sondage->start_date)->format('d/m/Y H:i') }}</p>
                <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($sondage->end_date)->format('d/m/Y H:i') }}</p>
                <form id="pollForm">
                <p><strong>Questions:</strong></p>
                <div class="text-align: center;">
                    @foreach(json_decode($sondage->questions, true) as $index => $question)
                        <div>
                            <strong>{{ $index + 1 }}. {{ $question['text'] }}</strong> <!-- Add numbering here -->

                            <div>
                                @foreach($question['options'] as $optionIndex => $option)
                                    <div>
                                        <input type="radio" name="answers[{{ $index }}]" value="{{ $option }}" id="option{{ $index }}{{ $optionIndex }}">
                                        <label for="option{{ $index }}{{ $optionIndex }}">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                    <div class="d-flex justify-content-center  mb-3">
                        <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary ms-2" id="submitPollButton" disabled>
                            <i class="fa fa-pen me-2 text-primary"></i> Submit Poll
                        </button>
                    </div>

                </form>

            </div>
        </div>
        <div class="d-flex justify-content-end mb-3">


            <a href="{{ route('sondage.listing') }}" class="btn border border-secondary
             rounded-pill px-3 text-primary">
                <i class="fa fa-list me-2 text-primary"></i> Go back to polls list
            </a>

        </div>
        <!-- Card that appears on button click -->
        <div id="thankYouCard" class="collapse mt-3 ">
            <div class="card border-green">
                <div class="card-body">
                    <h5 class="card-title">Thank you for participating in this poll !</h5>
                    <p class="card-text">
                        To test your knowledge further and explore more, visit the guide related to this poll.
                    </p>

                    <a href="{{ route('guide.bypoll', ['id' => $sondage->guide_bp_id]) }}" class="btn border border-secondary rounded-pill px-3 text-primary ms-2">
                        <i class="fa fa-book me-2 text-primary"></i> Go to Guide
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const pollForm = document.getElementById('pollForm');
            const submitButton = document.getElementById('submitPollButton');
            const thankYouCard = document.getElementById('thankYouCard');

            // Function to check if all questions have been answered
            function checkAllAnswered() {
                const questions = pollForm.querySelectorAll('input[type="radio"]');
                const questionCount = [...new Set([...questions].map(q => q.name))].length; // Unique question names
                const answeredCount = [...questions].filter(q => q.checked).length;

                // Enable button if all questions are answered
                submitButton.disabled = answeredCount < questionCount;
            }

            // Add event listeners to radio buttons
            pollForm.addEventListener('change', checkAllAnswered);

            // Show thank-you card when the button is clicked and all questions are answered
            submitButton.addEventListener('click', function() {
                if (!submitButton.disabled) {
                    thankYouCard.classList.toggle('collapse'); // Toggle the visibility of the thank-you card
                }
            });
        });
    </script>

    <style>
        .border-green {
            border: 2px solid #1b8158; /* Green border */

        }
    </style>

@endsection
