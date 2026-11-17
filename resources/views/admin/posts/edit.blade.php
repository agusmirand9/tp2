<x-layouts.main>
    <x-slot:title>Editar novedad</x-slot:title>

    <h1>Editar novedad</h1>

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
            Hay campos del formulario que tienen valores inválidos. Revisalos y probá de nuevo.
        </div>
    @endif

    <form action="{{ route('admin.posts.update', ['post' => $post]) }}" method="post" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Título (obligatorio)</label>
            <input
                type="text"
                id="title"
                name="title"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('title'),
                ])
                @error('title')
                aria-invalid="true"
                aria-errormessage="error-title"
                @enderror
                value="{{ old('title', $post->title) }}"
            >
            @error('title')
                <div class="text-danger" id="error-title">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="excerpt" class="form-label">Resumen (obligatorio)</label>
            <textarea
                id="excerpt"
                name="excerpt"
                rows="3"
                aria-describedby="help-excerpt"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('excerpt'),
                ])
                @error('excerpt')
                aria-invalid="true"
                aria-errormessage="error-excerpt"
                @enderror
            >{{ old('excerpt', $post->excerpt) }}</textarea>
            <div class="form-text" id="help-excerpt">Es el texto corto que se ve en el listado del blog.</div>
            @error('excerpt')
                <div class="text-danger" id="error-excerpt">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenido (obligatorio)</label>
            <textarea
                id="content"
                name="content"
                rows="10"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('content'),
                ])
                @error('content')
                aria-invalid="true"
                aria-errormessage="error-content"
                @enderror
            >{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="text-danger" id="error-content">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="published_at" class="form-label">Fecha de publicación (obligatorio)</label>
            <input
                type="date"
                id="published_at"
                name="published_at"
                aria-describedby="help-published-at"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('published_at'),
                ])
                @error('published_at')
                aria-invalid="true"
                aria-errormessage="error-published-at"
                @enderror
                value="{{ old('published_at', $post->published_at->toDateString()) }}"
            >
            <div class="form-text" id="help-published-at">Si elegís una fecha futura la novedad se va a mostrar recién ese día.</div>
            @error('published_at')
                <div class="text-danger" id="error-published-at">{{ $message }}</div>
            @enderror
        </div>

        @if($post->cover)
            <figure class="mb-3">
                <img
                    src="{{ asset('storage/' . $post->cover) }}"
                    alt="{{ $post->cover_description }}"
                    class="img-fluid"
                >
                <figcaption>Imagen actual</figcaption>
            </figure>
        @endif

        <div class="mb-3">
            <label for="cover" class="form-label">
                {{ $post->cover ? 'Reemplazar imagen de portada (opcional)' : 'Imagen de portada (opcional)' }}
            </label>
            <input
                type="file"
                id="cover"
                name="cover"
                aria-describedby="help-cover"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('cover'),
                ])
                @error('cover')
                aria-invalid="true"
                aria-errormessage="error-cover"
                @enderror
            >
            <div class="form-text" id="help-cover">
                JPG, PNG o WEBP, de hasta 2 MB.
                @if($post->cover)
                    Si no elegís ninguna, se mantiene la imagen actual.
                @endif
            </div>
            @error('cover')
                <div class="text-danger" id="error-cover">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_description" class="form-label">Descripción de la imagen (obligatorio si hay una imagen)</label>
            <input
                type="text"
                id="cover_description"
                name="cover_description"
                aria-describedby="help-cover-description"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('cover_description'),
                ])
                @error('cover_description')
                aria-invalid="true"
                aria-errormessage="error-cover-description"
                @enderror
                value="{{ old('cover_description', $post->cover_description) }}"
            >
            <div class="form-text" id="help-cover-description">Describí qué se ve en la imagen.</div>
            @error('cover_description')
                <div class="text-danger" id="error-cover-description">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>

    <p class="mt-3">
        <a href="{{ route('admin.posts.index') }}">Cancelar y volver al listado</a>
    </p>


</x-layouts.main>
