@extends('Back/dashboard')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Poll/</span> Create a new poll</h4>
        <a href="{{ route('sondage.index') }}" class="btn-outline-primary  ">Go Back</a>
        <!-- Basic Layout & Basic with Icons -->
        <div class="col-xl-8 mx-auto"> <!-- Set a max width with a responsive column -->

            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route('sondage.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="poll-title">Title</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-title"></i></span>
                                <input
                                    type="text"
                                    id="poll-title"
                                    name="title"
                                    class="form-control"
                                    placeholder="Enter poll title"
                                    required
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
                                    required
                                ></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="poll-category">Category</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-category"></i></span>
                                <input
                                    type="text"
                                    id="poll-category"
                                    name="category"
                                    class="form-control"
                                    placeholder="Enter category"
                                />
                            </div>
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
                                    required
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
                                    required
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="poll-questions">Poll Questions</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-question-mark"></i></span>
                                <textarea
                                    id="poll-questions"
                                    name="questions"
                                    class="form-control"
                                    placeholder="Enter your poll questions, separated by commas or new lines..."
                                    required
                                ></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Poll</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
