<x-guest-layout>
    <section class="auth-panel p-4 p-sm-5">
        <div class="mb-4">
            <h1 class="auth-title mb-2">Buat akun</h1>
            <p class="auth-description mb-0">Daftar untuk mulai mengelola produk.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger small" role="alert">
                Periksa kembali data yang dimasukkan. Pesan kesalahan tersedia di setiap kolom.
            </div>
        @endif

        <form method="POST" action="{{ route('register', absolute: false) }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama lengkap</label>
                <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" maxlength="255">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" inputmode="email" maxlength="255">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" minlength="8">
                <div class="form-text">Minimal 8 karakter.</div>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Konfirmasi password</label>
                <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="new-password" minlength="8">
                @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Buat akun</button>
        </form>

        <p class="text-center small text-secondary mt-4 mb-0">
            Sudah memiliki akun?
            <a href="{{ route('login', absolute: false) }}" class="fw-semibold text-decoration-none">Login</a>
        </p>
    </section>
</x-guest-layout>
