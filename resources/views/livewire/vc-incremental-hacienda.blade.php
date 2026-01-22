<div class="relative w-full">
    <div class="search-box">
        <input type="text" class="form-control" placeholder="Buscar hacienda..." wire:model.live.debounce.300ms="query"
            wire:keydown.escape="borrar" wire:keydown.tab="borrar" wire:keydown.arrow-up="decrementHighlight"
            wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter.prevent="selectStudent" />
        <i class="ri-search-line search-icon"></i>
    </div>

    @if(!empty($query))
    {{-- Fondo para cerrar el dropdown al click --}}
    <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="borrar"></div>

    {{-- Dropdown mostrado hacia ARRIBA --}}

    @if(!empty($results) && $selectId==0)
    <div class="dropdown-menu dropdown-menu-end show" style="width: 96%;" data-popper-placement="bottom-end">
        @foreach ($results as $i => $result)
        <a href="#" wire:click.prevent="selectStudentByIndex({{ $i }})" wire:key="result-{{ $i }}"
            class="dropdown-item block px-3 py-2 cursor-pointer hover:bg-gray-100 {{ $highlightIndex === $i ? 'bg-soft-primary' : '' }}">
            {{ $result['Id_Fila'] ?? ($result->Id_Fila ?? '') }}
            {{ $result['Nombre'] ?? ($result->Nombre ?? '') }}
        </a>
        @endforeach
    </div>
    @endif

    @endif
</div>