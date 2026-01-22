<div class="relative w-full">
    
        <div class="search-box">
        <input type="text" class="form-control" name="identidad"
                id="billinginfo-firstName" placeholder="Seleccione Palmicultor" 
                wire:model.live.debounce.300ms="query"
                wire:keydown.escape="borrar" wire:keydown.tab="borrar" wire:keydown.arrow-up="decrementHighlight"
                wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter.prevent="selectStudent" required>
            <i class="ri-search-line search-icon"></i>
        </div>
        <!--<a id="btnstudents" class="input-group-text btn btn-soft-secondary"
            wire:click="search(1)"><i class="ri-search-line"></i></a>
        <a id="btnstudents" class="input-group-text btn btn-soft-primary"
            wire:click="search(1)"><i class="las la-plus"></i></a>-->
    
    @if(!empty($query))
    {{-- Fondo para cerrar el dropdown al click --}}
    <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="borrar"></div>

    {{-- Dropdown mostrado hacia ARRIBA --}}

    @if(!empty($results) && $selectId==0)
    <div class="dropdown-menu dropdown-menu-end show" style="width: 96%;" data-popper-placement="bottom-end">
        @foreach ($results as $i => $result)
        <a href="#" wire:click.prevent="selectStudentByIndex({{ $i }})" wire:key="result-{{ $i }}"
            class="dropdown-item block px-3 py-2 cursor-pointer hover:bg-gray-100 {{ $highlightIndex === $i ? 'bg-soft-primary' : '' }}">
            <div class="row">
            <div class="col-1"><strong>{{ $result['Codigo'] ?? ($result->Codigo ?? '') }}</strong></div>
            <div class="col-5 text-wrap">{{ $result['Nombre'] ?? ($result->Nombre ?? '') }}</div>
            <div class="col-5 text-wrap">{{ $result['Nombre_Comercial'] ?? ($result->Nombre_Comercial ?? '') }}</div>
            </div>
        </a>
        @endforeach
    </div>
    @endif

    @endif
</div>
