<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Plan de Cuentas</h5>
                        <div class="flex-shrink-0">
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-sm table-nowrap align-middle scroll-table" style="width:100%">
    <thead class="text-muted table-light">
        <tr class="text-uppercase">
            <th>Cuentas</th>
            <th class="text-end">Saldo</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cuentas as $detalle)
        <tr wire:key="tr-{{ $detalle['codigo'] }}-nivel-0" class="{{ $detalle['auxiliar'] == 0 ? 'fw-semibold' : '' }}">
            <td style="text-indent: 0px;">
                {{-- Mostrar + solo si es expandible (auxiliar == 0) --}}
                @if($detalle['auxiliar'] == 0)
                    @if(in_array($detalle['codigo'], $expanded))
                        <a href="javascript:void(0)" wire:click.prevent="toggleChildren('{{ $detalle['codigo'] }}')" class="me-2">
                            <i class="ri-indeterminate-circle-fill fs-16 text-warning"></i>
                        </a>
                    @else
                        <a href="javascript:void(0)" wire:click.prevent="toggleChildren('{{ $detalle['codigo'] }}')" class="me-2">
                            <i class="ri-add-circle-fill fs-16 text-primary"></i>
                        </a>
                    @endif
                @endif

                {{ $detalle['codigo'] }} {{ $detalle['nombre'] }}
            </td>
            <td class="text-end">{{ number_format($detalle['saldo'] ?? 0, 2) }}</td>
        </tr>

        {{-- Si está expandido, renderizamos el subnivel (le pasamos TODO el dataset) --}}
        @if($detalle['auxiliar'] == 0 && in_array($detalle['codigo'], $expanded))
            <livewire:vc-subnivel-cuentas
                :parentCode="$detalle['codigo']"
                :nivel="1"
                :allAccounts="$allAccounts"
                wire:key="subnivel-{{ $detalle['codigo'] }}" />
        @endif

    @empty
        <tr>
            <td colspan="2" class="text-center text-muted">No se encontraron cuentas principales (1..6)</td>
        </tr>
    @endforelse
    </tbody>
</table>       
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted">We've searched more than 150+ Orders We did
                                    not find any
                                    orders for you search.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->

    

</div>

