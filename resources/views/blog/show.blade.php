<x-layouts.main>
    <x-slot:title>{{ $post->title }}</x-slot:title>

    <article class="post">
        <header class="post-header">
            <h1>{{ $post->title }}</h1>
            <p class="post-meta">
                <i class="bi bi-person me-1" aria-hidden="true"></i>Por {{ $post->author->name }} el
                <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('d/m/Y') }}</time>
            </p>
            <p class="lead">{{ $post->excerpt }}</p>
        </header>

        @if($post->cover)
            <figure class="post-cover">
                <img
                    src="{{ asset('storage/' . $post->cover) }}"
                    alt="{{ $post->cover_description }}"
                >
            </figure>
        @endif

        <div class="post-content">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    <p class="mt-4">
        <a href="{{ route('blog.index') }}">
            <i class="bi bi-arrow-left me-1" aria-hidden="true"></i>Volver al blog
        </a>
    </p>

</x-layouts.main>
