<x-guest-layout>
    <section class="auth-panel p-4 p-sm-5">
        <div class="mb-4">
            <h1 class="auth-title mb-2">Selamat datang kembali</h1>
            <p class="auth-description mb-0">Masuk untuk mengelola produk Anda.</p>
        </div>

        <x-auth-session-status class="alert alert-success small mb-3" :status="session('status')" />

        @if ($errors->any())
            <div class="alert alert-danger small" role="alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login', absolute: false) }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" inputmode="email">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
                    <button id="toggle-password" class="btn btn-outline-secondary" type="button" aria-label="Tampilkan password" aria-pressed="false" aria-controls="password">
                        <svg id="password-eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.5-7 9.75-7 9.75 7 9.75 7-3.5 7-9.75 7-9.75-7-9.75-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg id="password-eye-off" class="d-none" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8M9.9 5.2A10 10 0 0 1 12 5c6.25 0 9.75 7 9.75 7a16 16 0 0 1-3.1 3.9M6.2 6.2C3.6 8 2.25 12 2.25 12s3.5 7 9.75 7c1 0 1.9-.2 2.8-.5" />
                        </svg>
                    </button>
                </div>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-check mb-4">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-secondary">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center small text-secondary mt-4 mb-0">
            Belum memiliki akun?
            <a href="{{ route('register', absolute: false) }}" class="fw-semibold text-decoration-none">Daftar</a>
        </p>
    </section>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('toggle-password');
        const passwordEye = document.getElementById('password-eye');
        const passwordEyeOff = document.getElementById('password-eye-off');

        togglePasswordButton.addEventListener('click', () => {
            const isVisible = passwordInput.type === 'text';

            passwordInput.type = isVisible ? 'password' : 'text';
            togglePasswordButton.setAttribute('aria-pressed', String(!isVisible));
            togglePasswordButton.setAttribute('aria-label', isVisible ? 'Tampilkan password' : 'Sembunyikan password');
            passwordEye.classList.toggle('d-none', !isVisible);
            passwordEyeOff.classList.toggle('d-none', isVisible);
        });
    </script>
</x-guest-layout>
