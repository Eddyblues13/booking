<!-- [file name]: admin/flights/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Flight - Adibiyas Tour')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Flight</h1>
        <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Flights
        </a>
    </div>

    <!-- Flight Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Flight Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.flights.update', $flight) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="flight_number" class="form-label">Flight Number *</label>
                            <input type="text" class="form-control @error('flight_number') is-invalid @enderror"
                                id="flight_number" name="flight_number"
                                value="{{ old('flight_number', $flight->flight_number) }}" required>
                            @error('flight_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="airline" class="form-label">Airline *</label>
                            <input type="text" class="form-control @error('airline') is-invalid @enderror" id="airline"
                                name="airline" value="{{ old('airline', $flight->airline) }}" required>
                            @error('airline')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- ... rest of the form fields similar to create.blade.php but with old values ... -->

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Flight</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection