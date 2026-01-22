<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Roles de Pagos</h5>
                    
                        <div class="flex-shrink-0">
                            <a class="btn btn-soft-secondary add-btn" href="/payroll/rolpago"><i
                            class="ri-add-circle-line me-1 align-middle fs-16"></i> General Rol</a>
                            
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Periodo</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.periodo">
                                        <option value="" selected>All</option>                                
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Mes</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.mes">
                                        <option value="" selected>All</option>
                                        @for($mes=1;$mes<=12;$mes++)                                
                                            <option value="{{$mes}}">{{$meses[$mes]}}</option> 
                                        @endfor                                 
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Departamento</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.tiporol">
                                        <option value="" selected>All</option>                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Rol</label>
                                    <select class="form-select"
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.proceso">
                                        <option value="" selected>All</option>
                                        <option value="Q">QUINCENAL</option>
                                        <option value="M">MENSUAL</option>                                   
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Estado</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbestado" wire:model.live="filters.estado">
                                        <option value="">Select Estatus</option>
                                        <option value="C">CREADA</option>
                                        <option value="P">PROCESADA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">-</label>
                                    <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Filters
                                    </button>
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
                                        <th class="sort" data-sort="id"> Periodo</th>
                                        <th class="sort" data-sort="id"> Pago</th>
                                        <th class="sort" data-sort="superior">Departamento</th>
                                        <th class="sort" data-sort="codigo"> Ingresos</th>
                                        <th class="sort" data-sort="descripcion">Egresos</th>
                                        <th class="sort" data-sort="descripcion">Total</th>
                                        <th class="sort" data-sort="estado">Estado</th>
                                        <th class="sort" data-sort="accion">Acción</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td> <a href="/payroll/registrar-pagos/{{$record->id}}"><strong>{{$meses[$record->mes]}} {{$record->periodo}}</strong></a></td>
                                        @if ($record->remuneracion=='Q')
                                            <td> QUINCENAL</td>
                                        @else
                                            <td> MENSUAL</td>
                                        @endif
                                        <td class="text-uppercase">{{$record->tiposrol->descripcion}}
                                            @if (!empty($record->nomina))
                                            <div>
                                                <a><strong>COMPROBANTE:</strong></a>
                                                <a class="text-muted"> Provisión. </a> <a href="/payroll/comprobante/{{$record->id}},P"> {{$record->provision}} </a>
                                                <a class="text-muted"> Nomina. </a> <a href="/payroll/comprobante/{{$record->id}},N"> {{$record->nomina}}  </a>
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{number_format($record->ingresos,2)}}</td>
                                        <td>{{number_format($record->egresos,2)}}</td>
                                        <td>{{number_format($record->total,2)}}</td>
                                        <td>
                                            @if($record->estado=='C')
                                               <span class="badge badge-soft-success text-uppercase">CREADA</span>
                                            @else
                                                <span class="badge badge-soft-info text-uppercase">PROCESADA</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Editar">
                                                    <a href="" wire:click.prevent="edit({{ $record->id }})">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                @if($record->estado=='P')
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Generar Diario">
                                                    <a href="" class="text-success d-inline-block" wire:click.prevent="generaDiario({{ $record->id }})">
                                                        <i class=" ri-thumb-up-fill  align-bottom me-1 fs-16"></i>
                                                    </a>
                                                </li>
                                                @endif
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Imprimir">
                                                    <a type = "button" href="" class="d-inline-block" data-bs-toggle="dropdown">
                                                        <i class="ri-printer-fill align-bottom me-1 fs-16"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="printData('NOM',{{$record->id}})"><i class="ri-article-line align-bottom me-2 text-muted"></i> Nomina General </a></li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            href="" wire:click.prevent="printData('PAGO',{{$record->id}})">
                                                                <i class="ri-stack-line align-bottom me-2 text-muted"></i>
                                                                Lista de Pagos
                                                            </a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="printData('ROL',{{$record->id}})"><i class="ri-stack-line align-bottom me-2 text-muted"></i> Comprobante de Pago </a></li>
                                                        <li><a class="dropdown-item" href=""><i class="ri-stack-line align-bottom me-2 text-muted"></i> Diario de Provision </a></li>
                                                        <li><a class="dropdown-item" href=""><i class="ri-stack-line align-bottom me-2 text-muted"></i> Diario de Nomina </a></li>
                                                    </ul>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                        data-bs-toggle="modal" href="" wire:click.prevent="delete({{ $record->id }})">
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </a>
                                                </li>
                                            </ul>
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

