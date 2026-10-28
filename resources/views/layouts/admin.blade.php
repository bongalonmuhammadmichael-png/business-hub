
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin | Business Hub')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">

    <div class="admin-shell">

        {{-- Sidebar --}}
        <aside class="admin-sidebar">

            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <span class="admin-brand-mark">B</span>

                <span>
                    <strong>Business Hub</strong>
                    <small>Management Platform</small>
                </span>
            </a>

            <div class="admin-nav-label">WORKSPACE</div>

            <nav class="admin-nav">

                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="admin-nav-icon">⌂</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span class="admin-nav-icon">♙</span>
                    <span>Users</span>
                </a>

                <a href="{{ route('admin.projects.index') }}"
                   class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <span class="admin-nav-icon">▤</span>
                    <span>Projects</span>
                </a>

                <a href="{{ route('admin.activity-logs.index') }}"
                   class="{{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                    <span class="admin-nav-icon">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M3 12a9 9 0 1 0 2.64-6.36" />
                            <path d="M3 3v5h5" />
                            <path d="M12 7v5l4 2" />
                        </svg>
                    </span>
                    <span>Activity Log</span>
                </a>

            </nav>

            <div class="admin-nav-label admin-nav-label-lower">
                SYSTEM
            </div>

            <nav class="admin-nav">

                <a href="{{ route('admin.reports.index') }}"
                   class="{{ request()->routeIs('admin.reports.*') ? 'Reports' : '' }}">
                    <span class="admin-nav-icon">▧</span>
                    <span>Reports</span>
                </a>

                <a href="{{ route('admin.settings.index') }}"
                   class="{{ request()->routeIs('admin.settings.*') ? 'Settings' : '' }}">
                    <span class="admin-nav-icon">⚙</span>
                    <span>Settings</span>
                </a>

            </nav>

            <div class="admin-sidebar-bottom">
                <div class="admin-sidebar-user">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="admin-sidebar-user-info">
                        <strong>{{ auth()->user()->name }}</strong>
                        <span>{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="admin-logout">
                        ↪ <span>Log out</span>
                    </button>
                </form>
            </div>

        </aside>


        {{-- Main application area --}}
        <div class="admin-workspace">

            <header class="admin-topbar">

                <div>
                    <span class="admin-topbar-eyebrow">BUSINESS HUB</span>
                    <strong>@yield('page-heading', 'Workspace')</strong>
                </div>

                <div class="admin-topbar-right">
                    <span class="admin-online-dot"></span>
                    <span>Administrator workspace</span>
                </div>

            </header>

            <main class="admin-main">
                @yield('content')
            </main>

            <footer class="admin-footer">
                <span>© {{ date('Y') }} Business Hub</span>
                <span>Business management, organized.</span>
            </footer>

        </div>

    </div>

</body>
</html>
