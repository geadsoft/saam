<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Listado de Préstamos</h5>
                        <div class="flex-shrink-0">
                            <button type="button" wire:click="printData" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle dropdown">
                            <i class="ri-printer-fill fs-22"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle dropdown">
                            <i class="ri-file-excel-2-line fs-22"></i>
                            </button>                            
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-2">
                                <div>
                                    <input id="dfechaini" name="dateIni" type="date" class="form-control"
                                        data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                        wire:model.live="filters.startDate" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div>
                                    <input id="dfechaini" name="dateIni" type="date" class="form-control"
                                        data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                        wire:model.live="filters.endDate" required>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.area">
                                        <option value="" selected> -- Area -- </option>
                                        @foreach ($areas as $area)
                                        <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbestado" wire:model.live="filters.estado">
                                        <option value=""> -- Estado-- </option>
                                        <option value="C">PENDIENTES</option>
                                        <option value="P">CANCELADOS</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                        </ul>

                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th> Empleado</th>
                                        <th> Documento</th>
                                        <th>Tipo</th>
                                        <th>Fecha</th>
                                        <th class="text-center">Cuotas</th>
                                        <th class="text-end">Monto</th>
                                        <th class="text-end">Cancelado</th>
                                        <th class="text-end">Saldo</th>
                                        <th class="text-end">Última Cuota</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>{{$record->apellidos}} {{$record->nombres}}</td>
                                        <td>{{$record->id}}</td>
                                        <td>{{$record->etiqueta}}</td>
                                        <td>{{date('d/m/Y', strtotime($record->fecha))}}</td>
                                        <td class="text-center">{{$record->cuota}}/{{ ($record->pagos ?? 0) > 0 ? $record->pagos : 0 }}</td>
                                        <td class="text-end">{{number_format($record->monto,2)}}</td>
                                        <td class="text-end">{{number_format($record->cancelado,2)}}</td>
                                        <td class="text-end">{{number_format($record->monto-$record->cancelado,2)}}</td>  
                                        <td class="text-end">{{date('d/m/Y', strtotime($record->ultfecha))}}</td>                                      
                                        <td class="text-center">
                                            @if($record->estado=='P')
                                               <span class="badge badge-soft-success text-uppercase">PENDIENTE</span>
                                            @else
                                                <span class="badge badge-soft-info text-uppercase">CANCELADA</span>
                                            @endif
                                        </td>
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
                       
                        <!--<div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>-->
                        {{$tblrecords->links('')}}

                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <div wire.ignore.self class="modal fade flip" id="generaDiario" tabindex="-1" aria-hidden="true" wire:model='selectId'>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5 text-center">
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                    </lord-icon>
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                    </lord-icon>
                    <div class="mt-4 text-center">
                        <h4>¿Seguro de generar comprobante diario</h4>
                        <p class="text-muted fs-15 mb-4">Esta opción procesara el registro cambiando a su estado CERRADO. 
                        Esta acción es irreversible</p>
                        <div class="hstack gap-2 justify-content-center remove">
                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                Cancelar</button>
                            <button class="btn btn-danger" id="delete-record"  wire:click="comprobante()"> Si,
                                Continuar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

