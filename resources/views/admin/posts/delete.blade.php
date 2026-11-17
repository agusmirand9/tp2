<x-layouts.main>
    <x-slot:title>Eliminar novedad</x-slot:title>

    <h1>Eliminar novedad</h1>
    <p>
        ¿Seguro que querés eliminar “{{ $post->title }}”?
        Esta acción no se puede deshacer.
    </p>

    <form action="{{ route('admin.posts.destroy', ['post' => $post]) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash me-1" aria-hidden="true"></i>Sí, eliminar
        </button>
        <a href="{{ route('admin.posts.index') }}">
            <i class="bi bi-arrow-left me-1" aria-hidden="true"></i>No, volver atras
        </a>
    </form>
</x-layouts.main>
