
        <div class="container-fluid py-5">
    <div class="container py-5">
    
        
        
        <div class="table-responsive">
            <table class="table">
                <thead >
                    <tr>
                    <th>Image</th>

                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evenements as $evenement)
                    <tr>
                        <!-- Titre -->
                        <td>
                            @if($evenement->image)
                                <img src="{{ asset('uploads/evenements/' . $evenement->image) }}" alt="Image" 
                                     class="img-fluid rounded-circle" style="width: 80px; height: 80px;">
                            @else
                                <p class="mb-0 mt-4">Pas d'image</p>
                            @endif
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{ $evenement->titre }}</p>
                        </td>
                        
                        <!-- Description -->
                        <td>
                            <p class="mb-0 mt-4">{{ $evenement->description }}</p>
                        </td>
                        
                        <!-- Lieu -->
                        <td>
                            <p class="mb-0 mt-4">{{ $evenement->lieu }}</p>
                        </td>
                        
                        <!-- Date -->
                        <td>
                            <p class="mb-0 mt-4">{{ $evenement->date }}</p>
                        </td>
                        
                        <!-- Heure -->
                        <td>
                            <p class="mb-0 mt-4">{{ $evenement->heure }}</p>
                        </td>
                        
                        <!-- Image with Rounded Style -->
                     
                        
                        <!-- Actions -->
                        <td>
                        <td>
 <!-- Actions -->


</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $evenements->links() }}
        </div>
    </div>
</div>
////////////