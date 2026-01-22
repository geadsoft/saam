<div>
   <!-- resources/views/livewire/mostrar-lecturas.blade.php -->
    <div wire:poll.5000ms> {{-- Actualiza cada 5 segundos --}}
        <h2 class="text-lg font-bold">Últimos datos recibidos:</h2>
        <ul class="mt-2">
            @foreach($lecturas as $lectura)
                <li>{{ $lectura->created_at->format('H:i:s') }} — {{ $lectura->valor }}</li>
            @endforeach
        </ul>
    </div>
</div>
