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
                    <article class="card-item">
                        @if($ride->cover)
                            <img
                                src="{{ asset('storage/' . $ride->cover) }}"
                                alt="{{ $ride->cover_description }}"
                                class="img-fluid mb-2"
                            >
                        @endif

                        <h2>
                            <a href="{{ route('rides.show', ['ride' => $ride]) }}">{{ $ride->name }}</a>
                        </h2>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-clock me-1" aria-hidden="true"></i>Duración: {{ $ride->duration_label }}</li>
                            <li><i class="bi bi-speedometer2 me-1" aria-hidden="true"></i>Dificultad: {{ $ride->difficulty }}</li>
                            <li><i class="bi bi-cash-coin me-1" aria-hidden="true"></i>Precio por persona: ${{ number_format($ride->price, 0, ',', '.') }}</li>
                        </ul>
                        <a href="{{ route('rides.show', ['ride' => $ride]) }}">
                            Ver detalle<span class="visually-hidden"> de {{ $ride->name }}</span><i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                        </a>
                    </article>
                </li>
            @endforeach
        </ul>
    @endif

</x-layouts.main>
