<!-- [file name]: admin/users/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manage Users - Adibiyas Tour')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Users</h1>
    </div>

    <!-- Users Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
            <div class="filter-section">
                <select class="form-select form-select-sm" onchange="window.location.href = this.value">
                    <option value="{{ route('admin.users.index') }}" {{ request('status') ? '' : 'selected' }}>All Users
                    </option>
                    <option value="{{ route('admin.users.index', ['status' => 'active']) }}" {{
                        request('status')=='active' ? 'selected' : '' }}>Active</option>
                    <option value="{{ route('admin.users.index', ['status' => 'inactive']) }}" {{
                        request('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="usersTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Bookings</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px; font-size: 1rem;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->isAdmin())
                                        <span class="badge bg-warning ms-1">Admin</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->role === 'admin' ? 'warning' : 'secondary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $user->bookings_count ?? 0 }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <small>{{ $user->created_at->format('M d, Y') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info"
                                        title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.users.update-status', $user) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="btn btn-sm btn-{{ $user->is_active ? 'warning' : 'success' }}"
                                            title="{{ $user->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-users fa-2x text-muted mb-3"></i>
                                <p class="text-muted">No users found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection