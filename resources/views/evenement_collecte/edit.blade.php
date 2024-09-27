@extends('Back/dashboard')

@section('content') 
<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="text-center mt-1 mb-3" style="color: green;">Modify Event</h1>

    @if (session('success'))
        <script>
            swal("Succès!", "{{ session('success') }}", "success");
        </script>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4" style="padding: 20px;">
                <div class="card-body" style="padding: 0;">
                    <form action="{{ route('evenement_collecte.update', $evenement->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-1">
                            <label class="form-label" for="titre">Title</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $evenement->titre) }}">
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $evenement->description) }}</textarea>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="lieu">Location</label>
                            <input type="text" class="form-control" id="lieu" name="lieu" value="{{ old('lieu', $evenement->lieu) }}">
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($evenement->date)->format('Y-m-d')) }}">
                            </div>

                        <div class="mb-1">
                            <label class="form-label" for="heure">Time</label>
                            <input type="time" class="form-control" id="heure" name="heure" value="{{ old('heure', $evenement->heure) }}">
                        </div>

                        <div class="form-group">
                            <label for="image">Image (optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary mt-3 d-block mx-auto" style="background-color: #287233; border-color: #287233; color: white;">Modify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
