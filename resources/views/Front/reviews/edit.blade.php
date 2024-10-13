@extends('Front/layout')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 130vh;">
    <div class="col-md-6 bg-light p-5 shadow rounded" style="border-radius: 15px; backdrop-filter: blur(10px); animation: slideIn 1.5s ease-out;">
        <h1 class="text-center text-dark mb-4" style="font-family: 'Poppins', sans-serif; font-weight: bold;">Edit Review for <span class="text-center mt-1 mb-3" style="color: green;">{{ $evenement->titre }}</span></h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Would Recommend -->
            <div class="form-group mb-4">
                <label for="would_recommend" class="form-label">Would you recommend this event?</label>
                <select id="would_recommend" name="would_recommend" class="form-control @error('would_recommend') is-invalid @enderror">
                    <option value="1" {{ old('would_recommend', $review->would_recommend) == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('would_recommend', $review->would_recommend) == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('would_recommend')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

         

            <!-- Comment Field -->
            <div class="form-group mb-4">
                <label for="comment" class="form-label">Your Comment</label>
                <div class="input-group">
                    <textarea id="comment" name="comment" class="form-control border border-secondary rounded @error('comment') is-invalid @enderror" rows="5" placeholder="Update your thoughts about this event..." >{{ old('comment', $review->comment) }}</textarea>
                </div>
                <small id="charCount" class="text-muted mt-1">{{ strlen(old('comment', $review->comment)) }} / 250 characters</small>
                @error('comment')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rating Field -->
            <div class="form-group mb-4">
                <label for="rating" class="form-label">Your Rating</label>
                <div class="input-group">
                    <select id="rating" name="rating" class="form-control border border-secondary rounded @error('rating') is-invalid @enderror" >
                        <option value="" disabled selected>Choose a rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ $i == old('rating', $review->rating) ? 'selected' : '' }}>
                                {{ $i }} - {{ $i == 1 ? 'Poor' : ($i == 5 ? 'Excellent' : 'Good') }}
                            </option>
                        @endfor
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3 d-block mx-auto" style="background-color: #287233; border-color: #287233; color: white;">
                Update Review
            </button>
        </form>
    </div>
</div>

{{-- CSS for the animations --}}
<style>
    @keyframes slideIn {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    textarea:focus, select:focus {
        transform: scale(1.03);
        box-shadow: 0 0 10px rgba(255, 204, 102, 0.7);
        outline: none;
    }

    button:hover {
        background-color: #f57c00;
        transform: translateY(-2px);
        box-shadow: 0px 5px 15px rgba(255, 204, 102, 0.6);
    }

    .input-group textarea, .input-group select {
        border-left: none;
    }
</style>

<script>
    const commentField = document.getElementById('comment');
    const charCount = document.getElementById('charCount');

    commentField.addEventListener('input', function() {
        const text = commentField.value;
        charCount.textContent = `${text.length} / 250 characters`;
    });
</script>

{{-- Link FontAwesome for icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection
