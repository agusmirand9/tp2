<x-layouts.main>
    <x-slot:title>Cabalgatas</x-slot:title>

    <h1>Cabalgatas</h1>
    <p>Elegí el recorrido que mejor se adapte a vos, desde un paseo corto hasta una jornada completa por el campo.</p>

    @if($rides->isEmpty())
        <p>Todavía no hay cabalgatas disponibles.</p>
    @else
        <ul class="card-grid list-unstyled">
            @foreach($rides as $ride)
                <li>
                    <article class="card-item price-card">
                        @if($ride->cover != null && \Storage::exists($ride->cover))
                            <img
                                src="{{ \Storage::url($ride->cover) }}"
                                alt="{{ $ride->cover_description }}"
                                class="img-fluid mb-3"
                            >
                        @endif

                        <p class="price">
                            ${{ number_format($ride->price, 0, ',', '.') }}<small> por persona</small>
                        </p>

                        <h2>
                            <a href="{{ route('rides.show', ['ride' => $ride]) }}">{{ $ride->name }}</a>
                        </h2>

                        <ul class="price-card-features">
                            <li><i class="bi bi-check-lg" aria-hidden="true"></i>Duración: {{ $ride->duration_label }}</li>
                            <li><i class="bi bi-check-lg" aria-hidden="true"></i>Dificultad: {{ $ride->difficulty }}</li>
                            <li><i class="bi bi-check-lg" aria-hidden="true"></i>Guía durante todo el recorrido</li>
                        </ul>

                        <a href="{{ route('rides.show', ['ride' => $ride]) }}" class="link-more">
                            Ver detalle<span class="visually-hidden"> de {{ $ride->name }}</span><i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                        </a>
                    </article>
                </li>
            @endforeach
        </ul>
    @endif

</x-layouts.main>
