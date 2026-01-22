<div>
    <div class="relative">
        <div class="search-box mb-3">
            <input id="searchproducto" type="text" class="form-control search border border-primary"
                placeholder="Buscar" wire:model.live="filters" autofocus>
            <i class="ri-search-line search-icon"></i>
        </div>

        <div class="mb-3">
            <div class="file-manager-content w-100 p-3 ">
                <div class="table-responsive table-card mb-3">
                    <div style="overflow-x:auto;">
                        <table class="table-sm table-nowrap align-middle mb-1" style="width:100%">
                            <thead class="table-light">
                                <tr style="background-color:#F5F5F5">
                                    <th class="text-left" width="120"><b>Código</b></th>
                                    <th class="text-left"><b>Cuenta</b></th>
                                    <th class="text-left" width="100"><b>Grupo</b></th>
                                </tr>
                            </thead>
                            <tbody id="file-list">
                                @foreach($tblcuentas as $key => $cuenta)
                                <tr>
                                    <td><a class="fw-semibold" href="" id="{{$cuenta->Codigo}}"
                                            wire:click.prevent="addCuenta({{$cuenta->Codigo}})">{{$cuenta->Codigo}}</a>
                                    </td>
                                    <td>{{$cuenta->Nombre}}</td>
                                    <td>{{$cuenta->Grupo}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>