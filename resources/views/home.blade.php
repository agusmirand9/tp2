<x-layouts.main>
    <x-slot:title>Inicio</x-slot:title>

    <section class="hero">
        <h1>{{ config('app.name') }}</h1>
        <p class="lead">
            Cabalgatas por el campo correntino. Descubrí la verdadera vida de estancia,
            a tu ritmo y con un guía que te acompaña durante todo el recorrido.
        </p>
        <a class="btn btn-primary" href="{{ route('rides.index') }}">
            Ver cabalgatas<i class="bi bi-arrow-right ms-2" aria-hidden="true"></i>
        </a>
    </section>

    <section>
        <h2>Nuestras cabalgatas</h2>

        @if($rides->isEmpty())
            <p>Todavía no hay cabalgatas disponibles.</p>
        @else
            <ul class="card-grid list-unstyled">
                @foreach($rides as $ride)
                    <li>
                        <article class="card-item">
                            @if($ride->cover != null && \Storage::exists($ride->cover))
                                <img
                                    src="{{ \Storage::url($ride->cover) }}"
                                    alt="{{ $ride->cover_description }}"
                                >
                            @endif

                            <h3>
                                <a href="{{ route('rides.show', ['ride' => $ride]) }}">{{ $ride->name }}</a>
                            </h3>
                            <ul class="list-unstyled mb-0">
                                <li><i class="bi bi-clock me-1" aria-hidden="true"></i>{{ $ride->duration_label }}</li>
                                <li><i class="bi bi-speedometer2 me-1" aria-hidden="true"></i>Dificultad {{ $ride->difficulty }}</li>
                                <li><i class="bi bi-cash-coin me-1" aria-hidden="true"></i>${{ number_format($ride->price, 0, ',', '.') }} por persona</li>
                            </ul>
                        </article>
                    </li>
                @endforeach
            </ul>

            <p>
                <a href="{{ route('rides.index') }}" class="link-more">
                    Ver todas las cabalgatas<i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
            </p>
        @endif
    </section>

    <section>
        <h2>Por qué elegirnos</h2>

        <ul class="card-grid list-unstyled">
            <li class="card-item">
                <i class="bi bi-shield-check card-icon" aria-hidden="true"></i>
                <h3>Caballos mansos</h3>
                <p>Están acostumbrados a los principiantes, y el guía elige el indicado según tu experiencia y tu altura.</p>
            </li>
            <li class="card-item">
                <i class="bi bi-compass card-icon" aria-hidden="true"></i>
                <h3>Un guía en todo el recorrido</h3>
                <p>Antes de salir te explicamos cómo subir, sostener las riendas y pedirle al caballo que avance o frene.</p>
            </li>
            <li class="card-item">
                <i class="bi bi-people card-icon" aria-hidden="true"></i>
                <h3>Salidas para todos los niveles</h3>
                <p>Desde un paseo de una hora hasta una jornada de medio día por el campo.</p>
            </li>
        </ul>
    </section>

    <section>
        <h2>Novedades</h2>

        @if($posts->isEmpty())
            <p>Todavía no hay novedades publicadas.</p>
        @else
            <ul class="card-grid list-unstyled">
                @foreach($posts as $post)
                    <li>
                        <article class="card-item">
                            <h3>
                                <a href="{{ route('blog.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h3>
                            <p>
                                <i class="bi bi-calendar-event me-1" aria-hidden="true"></i><time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('d/m/Y') }}</time>
                            </p>
                            <p>{{ $post->excerpt }}</p>
                        </article>
                    </li>
                @endforeach
            </ul>

            <p>
                <a href="{{ route('blog.index') }}" class="link-more">
                    Ver todas las novedades<i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
            </p>
        @endif
    </section>
</x-layouts.main>
