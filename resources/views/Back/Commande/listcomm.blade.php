@extends('Back/dashboard')
@section('content') 

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <h5 class="mb-4">Confirm Orders</h5>

            <!-- Formulaire de recherche -->
            <form method="GET" action="{{ route('commandeList') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="category_name" class="form-control" placeholder="Category Name" value="{{ request('category_name') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="refused" {{ request('status') == 'refused' ? 'selected' : '' }}>Refused</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table card-table">
                    <thead>
                        <tr>
                            <th>Categories</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th> <!-- Nouvelle colonne pour l'état de la commande -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($reservations as $reservation)
                            @foreach($reservation->categories as $category)
                                <tr>
                                    <!-- Image de la catégorie -->
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('img/RecyclagePanier.jpg') }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <!-- Nom de la catégorie -->
                                    <td>{{ $category->name }}</td>
                                    <!-- Prix de la réservation -->
                                    <td>{{ $reservation->prix }} Dt</td>
                                    <!-- Quantité de la réservation -->
                                    <td>{{ $category->pivot->quantity }}</td>

                                    <!-- Nouvelle colonne pour l'état de la commande -->
                                    <td>
                                        @if(!is_null($reservation->refused_at))
                                            <span class="text-danger">-</span>
                                        @elseif(!is_null($reservation->confirmed_at) && is_null($reservation->paid_at))
                                            <span class="text-warning">Unpaid</span>
                                        @elseif(!is_null($reservation->confirmed_at) && !is_null($reservation->paid_at))
                                            <span class="text-success">Paid</span>
                                        @else
                                            <span class="text-secondary">Waiting</span>
                                        @endif
                                    </td>

                                    <!-- Actions pour confirmer ou refuser -->
                                    <td>
                                        @if(is_null($reservation->confirmed_at) && is_null($reservation->refused_at))
                                            <form action="{{ route('admin.reservations.confirm', $reservation->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success">Confirm</button>
                                            </form>
                                            <form action="{{ route('admin.reservations.refuse', $reservation->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-danger">Refused</button>
                                            </form>
                                        @elseif(!is_null($reservation->confirmed_at))
                                            <span class="text-success">Confirm</span>
                                        @elseif(!is_null($reservation->refused_at))
                                            <span class="text-danger">Refused</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
