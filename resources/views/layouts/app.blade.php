<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Business Hub' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <header class="site-header">
        <div class="container nav-container">

            <a href="{{ url('/') }}" class="brand">
                <span class="brand-mark">B</span>
                <span class="brand-name">Business Hub</span>
            </a>

            <nav class="main-nav">
                <a href="{{ url('/') }}"
                   class="{{ request()->is('/') ? 'active' : '' }}">
                    Home
                </a>

                <a href="{{ url('/about') }}"
                   class="{{ request()->is('about') ? 'active' : '' }}">
                    About
                </a>

                <a href="{{ url('/contact') }}"
                   class="{{ request()->is('contact') ? 'active' : '' }}">
                    Contact
                </a>
            </nav>

            <div class="nav-actions">

                @guest
                    <a href="{{ route('login') }}" class="login-link">
                        Log in
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-primary nav-button">
                        Get Started
                    </a>
                @endguest

                @auth
                    <span class="login-link">
                        {{ auth()->user()->name }}
                    </span>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ url('/admin') }}" class="btn btn-primary nav-button">
                            Admin Dashboard
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf

                        <button type="submit" class="login-link" style="border: none; background: none; cursor: pointer;">
                            Log out
                        </button>
                    </form>
                @endauth

            </div>

        </div>
    </header>


    <main>
        @yield('content')
    </main>


    <footer class="site-footer">
        <div class="container footer-container">

            <div>
                <div class="footer-brand">
                    <span class="brand-mark">B</span>
                    <span class="brand-name">Business Hub</span>
                </div>

                <p class="footer-description">
                    A smarter way to organize your business,
                    people and projects.
                </p>
            </div>

            <div class="footer-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="{{ url('/contact') }}">Contact</a>
            </div>

        </div>

        <div class="container copyright">
            © {{ date('Y') }} Business Hub. All rights reserved.
        </div>
    </footer>

</body>
</html>