<!-- [file name]: admin/bookings/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manage Bookings - Adibiyas Tour')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Bookings</h1>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Bookings Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Bookings</h6>
            <div class="filter-section">
                <select class="form-select form-select-sm" onchange="window.location.href = this.value">
                    <option value="{{ route('admin.bookings.index') }}" {{ request('status') ? '' : 'selected' }}>All
                        Status</option>
                    <option value="{{ route('admin.bookings.index', ['status' => 'pending']) }}" {{
                        request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}" {{
                        request('status')=='confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="{{ route('admin.bookings.index', ['status' => 'cancelled']) }}" {{
                        request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="bookingsTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>Booking Ref</th>
                            <th>Customer</th>
                            <th>Flight</th>
                            <th>Passengers</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>
                                <strong>{{ $booking->booking_reference }}</strong>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <strong>{{ $booking->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $booking->user->email }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="flight-info">
                                    <strong>{{ $booking->flight->flight_number }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        {{ $booking->flight->departure_city }} → {{ $booking->flight->arrival_city }}
                                    </small>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $booking->passenger_count }}</span>
                            </td>
                            <td>
                                <strong>${{ number_format($booking->total_amount, 2) }}</strong>
                            </td>
                            <td>
                                <span
                                    class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <span
                                    class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : ($booking->payment_status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <small>{{ $booking->created_at->format('M d, Y') }}</small>
                                <br>
                                <small class="text-muted">{{ $booking->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-info"
                                        title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this booking?')"
                                            title="Delete Booking">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-ticket-alt fa-2x text-muted mb-3"></i>
                                <p class="text-muted">No bookings found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $bookings->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection