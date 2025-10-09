<!-- [file name]: admin/flights/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Add New Flight - Adibiyas Tour')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Flight</h1>
        <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Flights
        </a>
    </div>

    <!-- Flight Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Flight Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.flights.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="flight_number" class="form-label">Flight Number *</label>
                            <input type="text" class="form-control @error('flight_number') is-invalid @enderror"
                                id="flight_number" name="flight_number" value="{{ old('flight_number') }}" required>
                            @error('flight_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="airline" class="form-label">Airline *</label>
                            <input type="text" class="form-control @error('airline') is-invalid @enderror" id="airline"
                                name="airline" value="{{ old('airline') }}" required>
                            @error('airline')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="departure_airport" class="form-label">Departure Airport *</label>
                            <input type="text" class="form-control @error('departure_airport') is-invalid @enderror"
                                id="departure_airport" name="departure_airport" value="{{ old('departure_airport') }}"
                                required>
                            @error('departure_airport')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="arrival_airport" class="form-label">Arrival Airport *</label>
                            <input type="text" class="form-control @error('arrival_airport') is-invalid @enderror"
                                id="arrival_airport" name="arrival_airport" value="{{ old('arrival_airport') }}"
                                required>
                            @error('arrival_airport')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="departure_city" class="form-label">Departure City *</label>
                            <input type="text" class="form-control @error('departure_city') is-invalid @enderror"
                                id="departure_city" name="departure_city" value="{{ old('departure_city') }}" required>
                            @error('departure_city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="arrival_city" class="form-label">Arrival City *</label>
                            <input type="text" class="form-control @error('arrival_city') is-invalid @enderror"
                                id="arrival_city" name="arrival_city" value="{{ old('arrival_city') }}" required>
                            @error('arrival_city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="departure_time" class="form-label">Departure Time *</label>
                            <input type="datetime-local"
                                class="form-control @error('departure_time') is-invalid @enderror" id="departure_time"
                                name="departure_time" value="{{ old('departure_time') }}" required>
                            @error('departure_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="arrival_time" class="form-label">Arrival Time *</label>
                            <input type="datetime-local"
                                class="form-control @error('arrival_time') is-invalid @enderror" id="arrival_time"
                                name="arrival_time" value="{{ old('arrival_time') }}" required>
                            @error('arrival_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="duration" class="form-label">Duration (minutes) *</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror"
                                id="duration" name="duration" value="{{ old('duration') }}" required>
                            @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Price ($) *</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                id="price" name="price" value="{{ old('price') }}" required>
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="seats_available" class="form-label">Seats Available *</label>
                            <input type="number" class="form-control @error('seats_available') is-invalid @enderror"
                                id="seats_available" name="seats_available" value="{{ old('seats_available') }}"
                                required>
                            @error('seats_available')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="class" class="form-label">Class *</label>
                            <select class="form-control @error('class') is-invalid @enderror" id="class" name="class"
                                required>
                                <option value="">Select Class</option>
                                <option value="economy" {{ old('class')=='economy' ? 'selected' : '' }}>Economy</option>
                                <option value="premium_economy" {{ old('class')=='premium_economy' ? 'selected' : '' }}>
                                    Premium Economy</option>
                                <option value="business" {{ old('class')=='business' ? 'selected' : '' }}>Business
                                </option>
                                <option value="first" {{ old('class')=='first' ? 'selected' : '' }}>First Class</option>
                            </select>
                            @error('class')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                                required>
                                <option value="scheduled" {{ old('status')=='scheduled' ? 'selected' : '' }}>Scheduled
                                </option>
                                <option value="delayed" {{ old('status')=='delayed' ? 'selected' : '' }}>Delayed
                                </option>
                                <option value="cancelled" {{ old('status')=='cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Flight</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection