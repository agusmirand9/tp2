<x-layouts.main>
    <x-slot:title>Ingresar a mi cuenta</x-slot:title>

    <h1>Ingresar a mi cuenta</h1>

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
            No pudimos iniciar tu sesión. Revisá los datos ingresados y probá de nuevo.
        </div>
    @endif

    <form action="{{ route('auth.login.process') }}" method="post" novalidate>
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                autocomplete="email"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('email'),
                ])
                @error('email')
                aria-invalid="true"
                aria-errormessage="error-email"
                @enderror
                value="{{ old('email') }}"
            >
            @error('email')
                <div class="text-danger" id="error-email">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('password'),
                ])
                @error('password')
                aria-invalid="true"
                aria-errormessage="error-password"
                @enderror
            >
            @error('password')
                <div class="text-danger" id="error-password">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>

    <p class="mt-3">¿Todavía no tenés cuenta? <a href="{{ route('auth.register.form') }}">Registrate</a>.</p>


</x-layouts.main>
