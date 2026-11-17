<x-layouts.main>
    <x-slot:title>Crear una cuenta</x-slot:title>

    <h1>Crear una cuenta</h1>

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
            Hay campos del formulario que tienen valores inválidos. Revisalos y probá de nuevo.
        </div>
    @endif

    <form action="{{ route('auth.register.process') }}" method="post" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input
                type="text"
                id="name"
                name="name"
                autocomplete="name"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('name'),
                ])
                @error('name')
                aria-invalid="true"
                aria-errormessage="error-name"
                @enderror
                value="{{ old('name') }}"
            >
            @error('name')
                <div class="text-danger" id="error-name">{{ $message }}</div>
            @enderror
        </div>

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
                autocomplete="new-password"
                aria-describedby="help-password"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('password'),
                ])
                @error('password')
                aria-invalid="true"
                aria-errormessage="error-password"
                @enderror
            >
            <div class="form-text" id="help-password">Mínimo 8 caracteres.</div>
            @error('password')
                <div class="text-danger" id="error-password">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Repetir contraseña</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                autocomplete="new-password"
                class="form-control"
            >
        </div>

        <button type="submit" class="btn btn-primary">Crear cuenta</button>
    </form>

    <p class="mt-3">¿Ya tenés cuenta? <a href="{{ route('auth.login.form') }}">Ingresá</a>.</p>


</x-layouts.main>
