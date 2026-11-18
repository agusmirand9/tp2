<x-layouts.main>
    <x-slot:title>Usuarios</x-slot:title>

    <h1>Usuarios</h1>

    @if($users->isEmpty())
        <p>Todavía no hay usuarios registrados.</p>
    @else
        <div class="table-responsive">
            <table class="table table-stack">
                <caption>Usuarios registrados</caption>
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Contrataciones</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->name }}</th>
                            <td data-label="Email">{{ $user->email }}</td>
                            <td data-label="Rol">{{ $user->role->label }}</td>
                            <td data-label="Contrataciones">{{ $user->bookings_count }}</td>
                            <td data-label="Acciones">
                               <a href="{{ route('admin.users.show', ['user' => $user]) }}" class="btn btn-sm btn-outline-secondary btn-action">
                                    <i class="bi bi-eye me-1" aria-hidden="true"></i>Ver detalle<span class="visually-hidden"> de {{ $user->name }}</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $users->links() }}
    @endif

    <p class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="link-back">
            <i class="bi bi-arrow-left" aria-hidden="true"></i>Volver al panel
        </a>
    </p>
</x-layouts.main>
