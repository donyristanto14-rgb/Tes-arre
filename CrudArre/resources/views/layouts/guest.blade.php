<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f8fafc">
    <title>@yield('title', 'Authentication') | {{ config('app.name', 'Product Management') }}</title>
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
            min-height: 100vh;
            background: var(--page-bg);
            color: var(--text-main);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .auth-shell {
            width: min(100% - 2rem, 420px);
        }

        .auth-panel {
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #fff;
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 650;
            letter-spacing: -.04em;
        }

        .auth-description,
        .form-text {
            color: var(--text-muted);
        }

        .form-label {
            color: #334155;
            font-size: .875rem;
            font-weight: 550;
        }

        .form-control {
            min-height: 46px;
            border-color: #cbd5e1;
            border-radius: 7px;
        }

        .form-control:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 .2rem rgb(37 99 235 / 12%);
        }

        .btn-primary {
            min-height: 46px;
            border-color: var(--primary);
            border-radius: 7px;
            background: var(--primary);
            font-weight: 600;
        }

        .btn-primary:hover {
            border-color: #1d4ed8;
            background: #1d4ed8;
        }

        a {
            color: var(--primary);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-4">
    <main class="auth-shell">
        <a href="{{ route('login', absolute: false) }}" class="d-flex align-items-center justify-content-center gap-2 text-decoration-none text-dark mb-4">
            <span class="d-inline-grid rounded-3 bg-primary-subtle text-primary fw-bold text-center" style="width: 34px; height: 34px; place-items: center;" aria-hidden="true">P</span>
            <span class="fw-semibold">Product Management</span>
        </a>
        {{ $slot }}
        <p class="text-center small text-secondary mt-4 mb-0">Product Management System</p>
    </main>
</body>
</html>
