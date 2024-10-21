@extends('Back.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Equipment /</span> Create a New Equipment</h4>

    <a href="{{ route('equipments.index') }}" class="btn btn-outline-primary">Go Back</a>

    <div class="col-xl-8 mx-auto">
        <div class="card mb-4">
            <div class="card-body">
                <form method="post" action="{{ route('equipments.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Center Selection --}}
                    <div class="mb-3">
                        <label class="form-label" for="center_id">Select Center</label>
                        <select id="center_id" name="center_id" 
                                class="form-control @error('center_id') is-invalid @enderror" required>
                            <option value="">Choose a center</option>
                            @foreach($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                        @error('center_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Equipment Name --}}
                    <div class="mb-3">
                        <label class="form-label" for="equipment-name">Name</label>
                        <input 
                            type="text" 
                            id="equipment-name" 
                            name="nom" 
                            class="form-control @error('nom') is-invalid @enderror" 
                            placeholder="Enter equipment name" 
                            required 
                        />
                        @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label" for="equipment-status">Status</label>
                        <select id="equipment-status" name="statut" 
                                class="form-control @error('statut') is-invalid @enderror" required>
                            <option value="active">Active</option>
                            <option value="maintenance">In Maintenance</option>
                            <option value="out_of_service">Out of Service</option>
                        </select>
                        @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Capacity --}}
                    <div class="mb-3">
                        <label class="form-label" for="equipment-capacity">Capacity</label>
                        <input 
                            type="number" 
                            id="equipment-capacity" 
                            name="capacite" 
                            class="form-control @error('capacite') is-invalid @enderror" 
                            placeholder="Enter capacity (e.g., in liters or kg)" 
                            required 
                        />
                        @error('capacite')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Location --}}
                    <div class="mb-3">
                        <label class="form-label" for="equipment-location">Location</label>
                        <input 
                            type="text" 
                            id="equipment-location" 
                            name="emplacement" 
                            class="form-control @error('emplacement') is-invalid @enderror" 
                            placeholder="Enter current location" 
                            required 
                        />
                        @error('emplacement')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div class="mb-3">
                        <label class="form-label" for="equipment-image">Image</label>
                        <input 
                            type="file" 
                            id="equipment-image" 
                            name="image" 
                            class="form-control @error('image') is-invalid @enderror" 
                            accept="image/*" 
                            required 
                        />
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Add Equipment</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
