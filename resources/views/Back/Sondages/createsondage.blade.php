@extends('Back/dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Poll/</span> Create a new poll</h4>
        <a href="{{ route('sondage.index') }}" class="btn--primary">Go Back</a>

        <div class="col-xl-8 mx-auto">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route('sondage.store') }}">
                        @csrf

                        <div class="mb-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <label class="form-label" for="poll-title">Title</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-title"></i></span>
                                <input
                                    type="text"
                                    id="poll-title"
                                    name="title"
                                    class="form-control"
                                    placeholder="Enter poll title"
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="poll-description">Description</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                <textarea
                                    id="poll-description"
                                    name="description"
                                    class="form-control"
                                    placeholder="Enter a brief description"
                                ></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="guide-category">Category</label>
                            <select id="guide-category" name="category" class="form-select">
                                <option value="" disabled selected>Select a category</option>
                                <option value="Recycling">Recycling</option>
                                <option value="Waste Management">Waste Management</option>
                                <option value="Environmental Awareness">Environmental Awareness</option>
                                <option value="Composting">Composting</option>
                                <option value="Upcycling">Upcycling</option>
                                <option value="E-Waste Management">E-Waste Management</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="guide-bp">Guide of Best Practices</label>
                            <select id="guide-bp" name="guide_bp_id" class="form-select">
                                <option value="">Select a guide</option>
                                @foreach($guides as $guide)
                                    <option value="{{ $guide->id }}">{{ $guide->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="poll-start-date">Start Date</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input
                                    type="date"
                                    id="poll-start-date"
                                    name="start_date"
                                    class="form-control"
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="poll-end-date">End Date</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input
                                    type="date"
                                    id="poll-end-date"
                                    name="end_date"
                                    class="form-control"
                                />
                            </div>
                        </div>

                        <div class="mb-3" id="questions-container">
                            <label class="form-label" for="poll-questions">Poll Questions</label>
                            <div id="question1" class="question mb-4">
                                <label>Question:</label>
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="bx bx-question-mark"></i></span>
                                    <input type="text" name="questions[0][text]" class="form-control" placeholder="Enter your poll question" />
                                    <button type="button" class="btn btn-danger btn-sm me-2 remove-question">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="options-container">
                                    <label>Options:</label>
                                    <div class="option-group mb-2">
                                        <input type="text" name="questions[0][options][]" class="form-control" placeholder="Enter an option" />
                                    </div>
                                    <div class="d-flex align-items-center mb-3">

                                        <button type="button" class="btn btn-info btn-sm me-2 add-option">Add Option</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Container for the buttons -->
                            <div class="d-flex align-items-center mb-3">
                                <button type="button" class="btn btn-warning btn-sm me-2 add-question">Add Question</button>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-success mt-4">Add Poll</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <<script>
        document.addEventListener("DOMContentLoaded", function () {
            let questionCount = 1; // Counter for questions

            // Function to add a new question
            document.querySelector('.add-question').addEventListener('click', function () {
                const questionContainer = document.createElement('div');
                questionContainer.setAttribute('id', `question${questionCount}`);
                questionContainer.classList.add('question', 'mb-4');
                questionContainer.innerHTML = `
<label>Question:</label>
                <div class="input-group input-group-merge mb-2">

                    <span class="input-group-text"><i class="bx bx-question-mark"></i></span>
                    <input type="text" name="questions[${questionCount}][text]" class="form-control" placeholder="Enter your poll question" />
                  <button type="button" class="btn btn-danger btn-sm me-2 remove-question">
  <i class="fas fa-trash"></i>
</button>

                </div>
                <div class="options-container">
                    <label>Options:</label>
                    <div class="option-group mb-2">
                        <input type="text" name="questions[${questionCount}][options][]" class="form-control" placeholder="Enter an option" />

                    </div>
                    <div class="d-flex align-items-center mb-3">

                        <button type="button" class="btn btn-info btn-sm me-2 add-option">Add Option</button>
                    </div>

                </div>
            `;
                document.getElementById('questions-container').appendChild(questionContainer);
                questionCount++;
                attachEventListeners(); // Reattach event listeners for the newly added buttons
            });

            // Function to attach event listeners to dynamic buttons
            function attachEventListeners() {
                document.querySelectorAll('.add-option').forEach(button => {
                    button.removeEventListener('click', addOption);
                    button.addEventListener('click', addOption);
                });

                document.querySelectorAll('.remove-option').forEach(button => {
                    button.removeEventListener('click', removeOption);
                    button.addEventListener('click', removeOption);
                });

                document.querySelectorAll('.remove-question').forEach(button => {
                    button.removeEventListener('click', removeQuestion);
                    button.addEventListener('click', removeQuestion);
                });
            }

            // Function to add a new option within a question
            function addOption() {
                const optionsContainer = this.closest('.options-container');
                const optionGroup = document.createElement('div');
                optionGroup.classList.add('option-group', 'mb-2');
                optionGroup.innerHTML = `
 <div class="option-group mb-2">
<div class="input-group input-group-merge mb-2">

                        <input type="text" name="questions[${questionCount-1}][options][]" class="form-control" placeholder="Enter an option" />

<button type="button" class="btn btn-danger btn-sm me-2 remove-option">
  <i class="fas fa-trash"></i>
</button>

                    </div>



            `;
                optionsContainer.appendChild(optionGroup);
                attachEventListeners(); // Reattach the listeners to the newly created option
            }

            // Function to remove an option
            function removeOption() {
                this.closest('.option-group').remove();
            }

            // Function to remove a question
            function removeQuestion() {
                this.closest('.question').remove();
            }

            // Initialize event listeners on the first load
            attachEventListeners();
        });
    </script>
@endsection
