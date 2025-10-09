<?php
// [file name]: AdminUserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::withCount('bookings')
            ->where('role', 'user')
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['bookings' => function ($query) {
            $query->with('flight')->latest()->take(5);
        }]);

        return view('admin.users.show', compact('user'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $user->update([
            'is_active' => !$user->is_active
        ]);

        return back()->with('success', 'User status updated successfully.');
    }
}
