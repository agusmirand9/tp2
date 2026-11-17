<x-layouts.main>
    <x-slot:title>Novedades</x-slot:title>

    <h1>Novedades</h1>
    <p>
        <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">
            <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Crear novedad
        </a>
    </p>

    @if($posts->isEmpty())
        <p>Todavía no hay novedades cargadas.</p>
    @else
        <div class="table-responsive">
            <table class="table">
                <caption>Novedades del blog</caption>
                <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Publicación</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->title }}</th>
                            <td>{{ $post->author->name }}</td>
                            <td>
                                <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('d/m/Y') }}</time>
                            </td>
                            <td>
                                @if($post->published_at->isFuture())
                                    <i class="bi bi-clock-history me-1" aria-hidden="true"></i>Programada
                                @else
                                    <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Publicada
                                @endif
                            </td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="{{ route('admin.posts.edit', ['post' => $post]) }}">
                                            <i class="bi bi-pencil-square me-1" aria-hidden="true"></i>Editar<span class="visually-hidden"> {{ $post->title }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.posts.delete', ['post' => $post]) }}">
                                            <i class="bi bi-trash me-1" aria-hidden="true"></i>Eliminar<span class="visually-hidden"> {{ $post->title }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $posts->links() }}
    @endif

    <p class="mt-4">
        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-arrow-left me-1" aria-hidden="true"></i>Volver al panel
        </a>
    </p>
</x-layouts.main>
