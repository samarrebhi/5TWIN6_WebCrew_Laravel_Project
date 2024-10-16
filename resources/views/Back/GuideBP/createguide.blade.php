@extends('Back/dashboard')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Guides /</span> Create a new Guide</h4>
        <a href="{{ route('guide.index') }}" class="btn-outline-primary">Go Back</a>

        <div class="col-xl-8 mx-auto">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route('guide.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="guide-title">Title</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-title"></i></span>
                                <input
                                    type="text"
                                    id="guide-title"
                                    name="title"
                                    class="form-control"
                                    placeholder="Enter guide title"
                                    required
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="guide-content">Content</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                <textarea
                                    id="guide-content"
                                    name="content"
                                    class="form-control"
                                    placeholder="Enter the content"
                                    required
                                ></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="guide-category">Category</label>
                            <select id="guide-category" name="category" class="form-select" required>
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
                            <label class="form-label" for="guide-image">Image</label>
                            <input type="file" id="guide-image" name="image" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="guide-external-links">External Links</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-link"></i></span>
                                <input
                                    type="text"
                                    id="guide-external-links"
                                    name="external_links"
                                    class="form-control"
                                    placeholder="Enter external links (optional)"
                                />
                            </div>
                        </div>

                        <div class="mb-3" id="tags-container">
                            <label class="form-label">Tags</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-tag"></i></span>
                                <input type="text" name="tags[]" class="form-control" placeholder="Enter a related tag" />
                                <button type="button" class="btn btn-outline-primary" id="add-tag">+</button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Add Guide</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-tag').addEventListener('click', function() {
            const tagsContainer = document.getElementById('tags-container');
            const newTagInput = document.createElement('div');
            newTagInput.classList.add('input-group', 'input-group-merge', 'mb-2');
            newTagInput.innerHTML = `
                <input type="text" name="tags[]" class="form-control" placeholder="Enter a tag" />
                <button type="button" class="btn btn-outline-danger remove-tag">-</button>
            `;
            tagsContainer.appendChild(newTagInput);

            // Remove tag functionality
            newTagInput.querySelector('.remove-tag').addEventListener('click', function() {
                tagsContainer.removeChild(newTagInput);
            });
        });
    </script>
@endsection
