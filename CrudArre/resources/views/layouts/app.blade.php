<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f8fafc">
    <title>@yield('title', 'Produk') | {{ config('app.name', 'Product Management') }}</title>
    <script>
        const navigationEntry = performance.getEntriesByType('navigation')[0];

        if (navigationEntry?.type === 'reload') {
            document.documentElement.style.visibility = 'hidden';

            document.addEventListener('DOMContentLoaded', () => {
                const logoutForm = document.createElement('form');
                const csrfToken = document.createElement('input');

                logoutForm.method = 'POST';
                logoutForm.action = @json(route('logout', absolute: false));
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;

                logoutForm.append(csrfToken);
                document.body.append(logoutForm);
                logoutForm.submit();
            }, { once: true });
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            --page-bg: #f8fafc;
            --primary: #2563eb;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        body {
            min-width: 320px;
            background: var(--page-bg);
            color: var(--text-main);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .app-navbar {
            min-height: 64px;
            border-bottom: 1px solid var(--border);
            background: #fff;
        }

        .navbar-brand {
            color: var(--text-main);
            font-size: .95rem;
            font-weight: 650;
        }

        .navbar-brand:hover {
            color: var(--text-main);
        }

        .app-navbar .nav-link {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            color: var(--text-muted);
            font-size: .9rem;
        }

        .app-navbar .nav-link:hover,
        .app-navbar .nav-link.active {
            color: var(--primary);
        }

        .app-content {
            max-width: 1120px;
            padding-top: 36px;
            padding-bottom: 52px;
        }

        .btn {
            min-height: 40px;
            border-radius: 7px;
            font-size: .875rem;
            font-weight: 550;
        }

        .btn-primary {
            --bs-btn-bg: var(--primary);
            --bs-btn-border-color: var(--primary);
            --bs-btn-hover-bg: #1d4ed8;
            --bs-btn-hover-border-color: #1d4ed8;
        }

        .form-control {
            min-height: 44px;
            border-color: #cbd5e1;
            border-radius: 7px;
        }

        .form-control:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 .2rem rgb(37 99 235 / 12%);
        }

        .text-secondary {
            color: var(--text-muted) !important;
        }

        @media (max-width: 991.98px) {
            .app-navbar .navbar-collapse {
                padding: .5rem 0 .75rem;
            }

            .app-navbar .nav-link {
                padding-inline: .25rem;
            }
        }

        @media (max-width: 575.98px) {
            .app-content {
                padding-top: 26px;
                padding-bottom: 36px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg app-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('products.index', absolute: false) }}">Product Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Buka navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="navbar-nav ms-lg-auto gap-lg-2">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard', absolute: false) }}">Dashboard</a>
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index', absolute: false) }}">Produk</a>
                    <a class="nav-link" href="{{ route('products.create', absolute: false) }}">Tambah Produk</a>
                    <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit', absolute: false) }}">Profil</a>
                    <span class="nav-link d-none d-lg-inline-flex">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout', absolute: false) }}" method="POST" class="d-flex align-items-center py-2 py-lg-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary w-100">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="container app-content">
        @isset($header)
            <header class="mb-4">{{ $header }}</header>
        @endisset
        @if (session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="status">{{ session('success') }}</div>
        @endif

        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
