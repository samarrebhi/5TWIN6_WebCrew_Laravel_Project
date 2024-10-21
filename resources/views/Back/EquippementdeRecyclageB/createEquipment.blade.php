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

                    <div class="mb-3">
                        <label class="form-label" for="equipment-name">Name</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-cube"></i></span>
                            <input 
                                type="text" 
                                id="equipment-name" 
                                name="nom" 
                                class="form-control @error('nom') is-invalid @enderror" 
                                placeholder="Enter equipment name" 
                                required 
                            />
                        </div>
                        @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="equipment-status">Status</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-toggle-left"></i></span>
                            <select id="equipment-status" name="statut" class="form-control @error('statut') is-invalid @enderror" required>
                                <option value="active">Active</option>
                                <option value="maintenance">In Maintenance</option>
                                <option value="out_of_service">Out of Service</option>
                            </select>
                        </div>
                        @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="equipment-capacity">Capacity</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-bar-chart"></i></span>
                            <input 
                                type="number" 
                                id="equipment-capacity" 
                                name="capacite" 
                                class="form-control @error('capacite') is-invalid @enderror" 
                                placeholder="Enter capacity (e.g., in liters or kg)" 
                                required 
                            />
                        </div>
                        @error('capacite')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="equipment-location">Location</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-map"></i></span>
                            <input 
                                type="text" 
                                id="equipment-location" 
                                name="emplacement" 
                                class="form-control @error('emplacement') is-invalid @enderror" 
                                placeholder="Enter current location" 
                                required 
                            />
                        </div>
                        @error('emplacement')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="equipment-image">Image</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-image-add"></i></span>
                            <input 
                                type="file" 
                                id="equipment-image" 
                                name="image" 
                                class="form-control @error('image') is-invalid @enderror" 
                                accept="image/*" 
                                required 
                            />
                        </div>
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
