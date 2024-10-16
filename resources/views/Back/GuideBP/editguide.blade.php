@extends('Back/dashboard')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Guides /</span> Update Guide (ID: {{ $guide->id }})</h4>
        <a href="{{ route('guide.index') }}" class="btn-outline-primary">Go Back</a>

        <div class="col-xl-8 mx-auto">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route('guide.update', $guide->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                    value="{{ $guide->title }}"
                                required
                                />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="guide-content">Content</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                <input type="text"
                                    id="guide-content"
                                    name="content"
                                    placeholder="Enter your guide content"
                                    class="form-control"
value="{{ $guide->content}}"
                                />
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="guide-category">Category</label>
                            <select id="guide-category" name="category" class="form-select" required>
                                <option value="" disabled>Select a category</option>
                                <option value="Recycling" {{ $guide->category == 'Recycling' ? 'selected' : '' }}>Recycling</option>
                                <option value="Waste Management" {{ $guide->category == 'Waste Management' ? 'selected' : '' }}>Waste Management</option>
                                <option value="Environmental Awareness" {{ $guide->category == 'Environmental Awareness' ? 'selected' : '' }}>Environmental Awareness</option>
                                <option value="Composting" {{ $guide->category == 'Composting' ? 'selected' : '' }}>Composting</option>
                                <option value="Upcycling" {{ $guide->category == 'Upcycling' ? 'selected' : '' }}>Upcycling</option>
                                <option value="E-Waste Management" {{ $guide->category == 'E-Waste Management' ? 'selected' : '' }}>E-Waste Management</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="guide-image">Image</label>
                            <input type="file" id="guide-image" name="image" class="form-control" />
                            <small class="form-text text-muted text-danger">Leave empty to keep the current image.</small>
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
                                    value="{{ 'external_links', $guide->external_links}}"
                                />
                            </div>
                        </div>

                        <div class="mb-3" id="tags-container">
                            <label class="form-label">Tags</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-tag"></i></span>
                                @foreach(explode(',', $guide->tags) as $tag)
                                    <div class="input-group mb-2">
                                        <input type="text" name="tags[]" class="form-control" placeholder="Enter a related tag" value="{{ $tag }}" />
                                        <button type="button" class="btn btn-outline-danger remove-tag">-</button>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-outline-primary" id="add-tag">+</button>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-success">Update Guide</button> <!-- Change button text -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to add new tag input
        document.getElementById('add-tag').addEventListener('click', function() {
            const tagsContainer = document.getElementById('tags-container');
            const newTagInput = document.createElement('div');
            newTagInput.classList.add('input-group', 'mb-2');
            newTagInput.innerHTML = `
            <input type="text" name="tags[]" class="form-control" placeholder="Enter a tag" />
            <button type="button" class="btn btn-outline-danger remove-tag">-</button>
        `;
            tagsContainer.appendChild(newTagInput);
        });

        // Event delegation for removing existing and new tags
        document.getElementById('tags-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-tag')) {
                const tagInput = e.target.closest('.input-group');
                if (tagInput) {
                    tagInput.remove();
                }
            }
        });
    </script>

@endsection
