@extends('Front/layout')
@section('content')

<div class="container my-5" style="padding-top: 120px;">
    <form method="POST" action="{{ route('claim.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Step 1: Select Center and Category -->
        <div id="step1" class="step">
            <h4>Select Center and Category</h4>
            <div class="mb-3">
                <label for="center_id" class="form-label">Select Center</label>
                <select name="center_id" class="form-select @error('center_id') is-invalid @enderror">
                    <option value="">Choose a center</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}" {{ old('center_id') == $center->id ? 'selected' : '' }}>
                            {{ $center->name }}
                        </option>
                    @endforeach
                </select>
                @error('center_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Select Category</label>
                <select name="category" class="form-select @error('category') is-invalid @enderror">
                    <option value="service" {{ old('category') == 'service' ? 'selected' : '' }}>Service</option>
                    <option value="quality" {{ old('category') == 'quality' ? 'selected' : '' }}>Quality</option>
                    <option value="time" {{ old('category') == 'time' ? 'selected' : '' }}>Time</option>
                    <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="button" class="btn btn-success" onclick="nextStep()">Next</button>
        </div>

        <!-- Step 2: Enter Title, Description, and Attachment -->
        <div id="step2" class="step" style="display: none;">
            <h4>Enter Details</h4>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

    <div class="mb-3">
        <label for="attachment" class="form-label">Attachment (optional)</label>
        <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror">
        @error('attachment')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

            <button type="button" class="btn btn-secondary" onclick="previousStep()">Previous</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>

<script>
    function nextStep() {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
    }

    function previousStep() {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
    }
</script>

@endsection
