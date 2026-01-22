<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Registro Pesos</h5>
                        <div class="flex-shrink-0">
                            <!--<button type="button" wire:click.prevent="add()" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Agregar
                            </button>-->
                            <div class="hstack text-nowrap gap-2">
                                <a href="" wire:click.prevent="exportExcel()" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-file-excel-2-line align-bottom fs-22"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-sm-2">
                                <div class="search-box mb-3">
                                    <input type="text" class="form-control search"
                                        placeholder="Burcar por Ticket" wire:model.live="filters.buscar">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.live="filters.fechaini">       
                            </div>
                            <div class="col-sm-2">
                                <input id="dfechafin" name="dateFin" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.live="filters.fechafin">       
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th class="sort" data-sort="id"> ID</th>
                                        <th class="sort" data-sort="superior">Fecha Ingreso</th>
                                        <th class="sort" data-sort="codigo"> Fecha Salida</th>
                                        <th class="sort" data-sort="descripcion">Peso Tara</th>
                                        <th class="sort" data-sort="estado">Peso Bruto</th>
                                        <th class="sort" data-sort="accion">Peso Neto</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>{{$record->id_fila}}</td>
                                        <td>{{ date('d/m/Y', strtotime($record->fecha_ingreso))}}</td> 
                                        <td>{{ date('d/m/Y', strtotime($record->fecha_salida))}}</td>
                                        <td>{{number_format($record->peso_tara/1000,2)}}</td>
                                        <td>{{number_format($record->peso_bruto/1000,2)}}</td>
                                        <td>{{number_format($record->peso_neto/1000,2)}}</td>
                                    </tr>
                                @endforeach
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
                        {{$tblrecords->links('')}}
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div>
