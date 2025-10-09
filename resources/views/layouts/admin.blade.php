<!-- [file name]: admin.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Adibiyas Tour')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                    <i class="fas fa-plane"></i>
                    <span>Adibiyas Admin</span>
                </a>
            </div>
            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}"
                    class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.flights.index') }}"
                    class="menu-item {{ request()->routeIs('admin.flights.*') ? 'active' : '' }}">
                    <i class="fas fa-plane"></i>
                    <span>Flights</span>
                </a>
                <a href="{{ route('admin.bookings.index') }}"
                    class="menu-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Bookings</span>
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="menu-item logout-btn w-100 text-start border-0 bg-transparent">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Top Bar -->
            <div class="admin-topbar">
                <button class="sidebar-toggle" onclick="toggleAdminSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="admin-user">
                    <span>Welcome, {{ Auth::guard('admin')->user()->name }}</span>
                    <div class="dropdown">
                        <button class="user-dropdown" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleAdminSidebar() {
            document.getElementById('adminSidebar').classList.toggle('active');
        }
    </script>
    @stack('scripts')
</body>

</html>