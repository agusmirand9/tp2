<x-layouts.main>
    <x-slot:title>Blog</x-slot:title>

    <h1>Blog</h1>
    <p>Novedades, consejos y noticias del campo.</p>

    @if($posts->isEmpty())
        <p>Todavía no hay novedades publicadas.</p>
    @else
        <ul class="card-grid list-unstyled">
            @foreach($posts as $post)
                <li @class(['post-featured' => $loop->first && $posts->onFirstPage()])>
                    <article class="card-item post-card">
                        @if($post->cover)
                            <img
                                src="{{ asset('storage/' . $post->cover) }}"
                                alt="{{ $post->cover_description }}"
                            >
                        @else
                            <div class="post-card-placeholder" aria-hidden="true">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif

                        <div class="post-card-body">
                            <h2>
                                <a href="{{ route('blog.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h2>
                            <p>
                                <i class="bi bi-person me-1" aria-hidden="true"></i>Por {{ $post->author->name }} el
                                <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('d/m/Y') }}</time>
                            </p>
                            <p>{{ $post->excerpt }}</p>
                            <a href="{{ route('blog.show', ['slug' => $post->slug]) }}">
                                Leer más<span class="visually-hidden"> sobre {{ $post->title }}</span><i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                            </a>
                        </div>
                    </article>
                </li>
            @endforeach
        </ul>

        {{ $posts->links() }}
    @endif

</x-layouts.main>
