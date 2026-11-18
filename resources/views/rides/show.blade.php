<x-layouts.main>
    <x-slot:title>{{ $ride->name }}</x-slot:title>

    <article>
        <header>
            <h1>{{ $ride->name }}</h1>
        </header>

        @if($ride->cover != null && \Storage::exists($ride->cover))
            <img
                src="{{ \Storage::url($ride->cover) }}"
                alt="{{ $ride->cover_description }}"
                class="img-cover mb-3"
            >
        @endif

        <div>
            {!! nl2br(e($ride->description)) !!}
        </div>
        <div class="band">
            <h2>Datos de la salida</h2>
            <dl class="band-grid">
                <div>
                    <dt><i class="bi bi-clock" aria-hidden="true"></i> Duración</dt>
                    <dd>{{ $ride->duration_label }}</dd>
                </div>  
                <div>  
                    <dt><i class="bi bi-speedometer2" aria-hidden="true"></i> Dificultad</dt>
                    <dd>{{ $ride->difficulty }}</dd>
                </div>
                <div>
                    <dt><i class="bi bi-cash-coin " aria-hidden="true"></i> Precio por persona</dt>
                    <dd>${{ number_format($ride->price, 0, ',', '.') }}</dd>
                </div>
            </dl>
        </div>
    </article>

    <p class="mt-4">
        <a href="{{ route('rides.index') }}" class="link-back">
            <i class="bi bi-arrow-left" aria-hidden="true"></i>Volver a las cabalgatas
        </a>
    </p>

</x-layouts.main>
