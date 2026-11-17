<x-layouts.main>
    <x-slot:title>Panel de administración</x-slot:title>

    <h1>Panel de administración</h1>
    <p>Gestioná las publicaciones del blog y revisá los usuarios del sitio desde acá.</p>

    <nav aria-label="Secciones del panel de administración">
        <ul class="card-grid list-unstyled">
            <li class="card-item card-link">
                <i class="bi bi-journal-text card-icon" aria-hidden="true"></i>
                <h2>
                    <a class="stretched-link" href="{{ route('admin.posts.index') }}">Novedades <span aria-hidden="true">&rarr;</span></a>
                </h2>
                <p>Creá, editá y eliminá las entradas del blog.</p>
            </li>
            <li class="card-item card-link">
                <i class="bi bi-people card-icon" aria-hidden="true"></i>
                <h2>
                    <a class="stretched-link" href="{{ route('admin.users.index') }}">Usuarios <span aria-hidden="true">&rarr;</span></a>
                </h2>
                <p>Consultá los usuarios registrados y las cabalgatas que contrataron.</p>
            </li>
        </ul>
    </nav>
</x-layouts.main>
