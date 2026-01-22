<div>
    <div class="table-responsive mb-1">
        <table class="table table-sm align-middle" id="orderTable">
            <thead class="text-muted table-light">
                <tr class="text-uppercase">
                    <th style="width: 60px;">Linea</th>
                    <th>Rubro</th>
                    <th style="width: 150px;">Valor Mensual</th>
                    <th style="width: 150px;">Valor Diario</th>
                    <th>Nombre</th>
                    <th style="width: 80px;">Acción</th>
                </tr>
            </thead>
            <tbody class="list form-check-all">
            @foreach($ingresos as $key => $recno)
            <tr>
                <td>
                    <input type="text" class="form-control border-0 p-1" id="linea-{{$recno['linea']}}" wire:model="ingresos.{{$key}}.linea" disabled>
                </td>
                <td>
                    <select type="select" class="form-select bg-light border-0 p-1" data-trigger id="rubro-{{$recno['linea']}}" wire:model="ingresos.{{$key}}.rubro_id" required>
                        <option value="">Ingrese tipo de rol</option>
                        @foreach ($rubros as $rubro)
                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control bg-light border-0 p-1" id="valmes-{{$recno['linea']}}" wire:model="ingresos.{{$key}}.valor_mes">
                </td>
                <td>
                    <input type="text" class="form-control bg-light border-0 p-1" id="valdia-{{$recno['linea']}}" wire:model="ingresos.{{$key}}.valor_dia">
                </td>
                <td>
                    <input type="text" class="form-control bg-light border-0 p-1" id="nombre-{{$recno['linea']}}" wire:model="ingresos.{{$key}}.nombre">
                </td>
                <td>
                    <ul class="list-inline hstack gap-2 mb-0">
                        <li class="list-inline-item" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                            <a class="text-danger d-inline-block remove-item-btn"
                                data-bs-toggle="modal" href="" wire:click.prevent="delete({{ $recno['id'] }})">
                                <i class="ri-delete-bin-5-fill fs-16"></i>
                            </a>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mb-3">
            <button type="button" wire:click.prevent="addLine()" class="btn btn-soft-secondary w-sm">Agregar Detalle</button>
        </div>
    </div>
</div>
