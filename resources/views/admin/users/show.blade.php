<x-layouts.main>
    <x-slot:title>{{ $user->name }}</x-slot:title>

    <h1>{{ $user->name }}</h1>

    <h2>Datos del usuario</h2>
    <dl>
        <dt><i class="bi bi-envelope me-1" aria-hidden="true"></i>Email</dt>
        <dd>{{ $user->email }}</dd>

        <dt><i class="bi bi-person-badge me-1" aria-hidden="true"></i>Rol</dt>
        <dd>{{ $user->role->label }}</dd>

        <dt><i class="bi bi-calendar-event me-1" aria-hidden="true"></i>Registrado el</dt>
        <dd>
            <time datetime="{{ $user->created_at->toDateString() }}">{{ $user->created_at->format('d/m/Y') }}</time>
        </dd>
    </dl>

    <h2>Cabalgatas contratadas</h2>

    @if($bookings->isEmpty())
        <p>Este usuario todavía no contrató ninguna cabalgata.</p>
    @else
        <div class="table-responsive">
            <table class="table">
                <caption>Contrataciones realizadas por {{ $user->name }}</caption>
                <thead>
                    <tr>
                        <th scope="col">Cabalgata</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Personas</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <th scope="row">{{ $booking->ride->name }}</th>
                            <td>
                                <time datetime="{{ $booking->ride_date->toDateString() }}">{{ $booking->ride_date->format('d/m/Y') }}</time>
                            </td>
                            <td>{{ $booking->participants }}</td>
                            <td>${{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <p class="mt-4">
        <a href="{{ route('admin.users.index') }}" class="link-back">
            <i class="bi bi-arrow-left" aria-hidden="true"></i>Volver al listado de usuarios
        </a>
    </p>
</x-layouts.main>
