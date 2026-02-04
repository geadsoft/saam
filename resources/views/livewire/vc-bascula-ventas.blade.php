<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Pesos Realizados</h5>
                        <div class="flex-shrink-0">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="" class="btn btn-danger add-btn" target="_blank"><i class="ri-add-line align-bottom me-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Crear tickets</font></font></a>
                                <!--<button class="btn btn-soft-danger" id="remove-actions" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>-->
                            </div>
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
                                        @foreach ($tblrecords as $record) 
                                        <option value="{{$record->periodo}}" selected>{{$record->periodo}}</option>
                                        @endforeach                                
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Mes</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.mes">
                                        
                                        @for($mes=1;$mes<=12;$mes++)                                
                                            <option value="{{$mes}}">{{$meses[$mes]}}</option> 
                                        @endfor                                 
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Producto</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.producto">
                                        <option value="" selected>All</option>
                                        @foreach ($tblproductos as $producto)
                                        <option value="{{$producto->codigo}}">{{$producto->nombre}}</option>
                                        @endforeach                               
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Estado</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbestado" wire:model="filters.estado">
                                        <option value="">Select Estatus</option>
                                        <option value="C">CREADA</option>
                                        <option value="P">PROCESADA</option>
                                        <option value="A">ANULADA</option>
                                    </select>
                                </div>
                            </div>
                            <!--<div class="col-xxl-1 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">-</label>
                                    <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Filters
                                    </button>
                                </div>
                            </div>-->
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{$activeTab[1]}} All py-3" data-bs-toggle="tab" id="All"
                                    href="#" onclick="Livewire.dispatch('selectTab', {tab: 1})" role="tab" aria-selected="true">
                                    <i class="ri-store-2-fill me-1 align-bottom"></i> Todos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 {{$activeTab[2]}} Delivered" data-bs-toggle="tab" id="Delivered"
                                    href="#" onclick="Livewire.dispatch('selectTab', {tab: 2})"  role="tab" aria-selected="false">
                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Manuales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 {{$activeTab[3]}} Pickups" data-bs-toggle="tab" id="Pickups"
                                    href="#" onclick="Livewire.dispatch('selectTab', {tab: 3})"  role="tab" aria-selected="false">
                                    <i class="ri-truck-line me-1 align-bottom"></i> En Patio <span
                                        class="badge bg-danger align-middle ms-1">{{$cantidad}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 {{$activeTab[4]}} Returns" data-bs-toggle="tab" id="Returns"
                                    href="#" onclick="Livewire.dispatch('selectTab', {tab: 4})" role="tab" aria-selected="false">
                                    <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Anulados
                                </a>
                            </li>
                        </ul>

                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap table-sm" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th>Documento</th>
                                        <th>Fecha</th>
                                        <th style="width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Cliente</th>
                                        <th>Peso Bruto</th>
                                        <th>Peso Tara</th>
                                        <th>Peso Neto</th>
                                        <th style="width: 300px;">Producto</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
                                        <th class="text-center">Acción</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>
                                            {{$tipoDoc[$record->TipoEgr]}}
                                            <div> 
                                            <a href=""><strong>{{$record->Documento}}</strong></a>
                                            </div>
                                        </td>
                                        <td>{{date('d/m/Y', strtotime($record->FechaSalida))}}</td>
                                        <td class="text-uppercase" style="width: 50px;">{{$record->NombreComercial}}
                                            <div>
                                                @if(strlen($record->factura)==15)
                                                <a class="text-muted"> Factura. </a> <a href="">{{$record->factura}}</a>
                                                @endif
                                            </div>
                                            <div>
                                                <a class="text-muted"> Guia. </a> <a href=""> {{$record->guia}}  </a>
                                            </div>
                                            <div>
                                                <a class="text-muted"> Chofer. </a> <a href=""> {{$record->Chofer}}  </a>
                                            </div>
                                            <div>
                                                <a class="text-muted"> Placa. </a> <a href=""> {{$record->Placa}} </a>
                                            </div>
                                        </td>
                                        <td>{{number_format($record->PesoBruto,2)}}</td>
                                        <td>{{number_format($record->PesoTara,2)}}</td>
                                        <td>{{number_format($record->PesoNeto,2)}}</td>
                                        <td>{{$record->producto}}
                                            <div>
                                                <a class="text-muted"> AC. </a> <a href=""> {{$record->Acidez}} </a>
                                                <a class="text-muted"> HU. </a> <a href=""> {{$record->Humedad}}  </a>
                                                <a class="text-muted"> IM. </a> <a href=""> {{$record->Impureza}}  </a>
                                            </div>
                                        </td>
                                        <td>{{number_format($record->Precio,2)}}</td>
                                        <td>{{number_format($record->Subtotal,2)}}</td>
                                        <td class="action-cell text-center align-middle">
                                            <ul class="list-inline mb-0 action-list">
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                    title="View">
                                                    <a href="apps-ecommerce-order-details"
                                                        class="text-primary d-inline-block">
                                                        <i class="ri-eye-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                @if ($record->certificado==1) 
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                    title="Certificado">
                                                    <a href="{{ route('Certificado.pdf', [$record->TipoEgr, $record->Id_Fila]) }}" target="_blank"
                                                        class="text-secondary d-inline-block">
                                                        <i class="ri-price-tag-line fs-16"></i>
                                                    </a>
                                                </li>
                                                @endif                                                
                                                @if ($record->PesoNeto==0)
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                    title="Editar">
                                                    <a href="/bascula-compra/peso-tara/{{$record->Id_Fila}}"
                                                        class="text-primary d-inline-block" target="_blank">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                @endif                                                
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                        data-bs-toggle="modal" href="" wire:click.prevent="">
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Imprimir">

                                                    <div class="dropdown">
                                                        <a href="#" 
                                                        class="text-black d-inline-block" 
                                                        data-bs-toggle="dropdown" 
                                                        role="button">
                                                            <i class="ri-printer-fill fs-16"></i>
                                                        </a>

                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item view-item-btn" href="javascript:void(0);">
                                                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Ticket
                                                            </a></li>

                                                            <li><a class="dropdown-item edit-item-btn" href="#showModal" data-bs-toggle="modal">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>Guia
                                                            </a></li>

                                                            <li><a class="dropdown-item remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Factura
                                                            </a></li>
                                                        </ul>
                                                    </div>
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
                        </div>
                        -->
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

