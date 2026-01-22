<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Historial de Certificados</h5>
                        <div class="flex-shrink-0">
                            <!--<div class="d-flex flex-wrap gap-2">
                                <a href="/bascula-compra/peso-bruto" class="btn btn-danger add-btn" target="_blank"><i class="ri-add-line align-bottom me-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Crear tickets</font></font></a>
                                <button class="btn btn-soft-danger" id="remove-actions" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Periodo</label>
                                    <select class="form-select" id="cmbnivel" wire:model.live="filters.periodo">
                                         @foreach ($tblperiodo as $record) 
                                        <option value="{{$record->periodo}}">{{$record->periodo}}</option>
                                        @endforeach                                           
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Mes</label>
                                    <select class="form-select" name="mes-default" id="cmbmes" wire:model.live="filters.mes">                              
                                        @foreach($meses as $key => $vmes)
                                        <option value="{{$key}}">{{$vmes}}</option>
                                        @endforeach                   
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="input-documento" class="form-label">Documento</label>
                                    <input type="text" class="form-control" data-plugin="documento" id="documento" placeholder="Documento" wire:model.live="filters.documento"/>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Producto</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbproducto" wire:model="filters.producto">
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
                                    <i class="ri-store-2-fill me-1 align-bottom"></i> Emitidos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 {{$activeTab[2]}} Pickups" data-bs-toggle="tab" id="Pickups"
                                    href="#" onclick="Livewire.dispatch('selectTab', {tab: 2})"  role="tab" aria-selected="false">
                                    <i class="ri-truck-line me-1 align-bottom"></i> Por Emitir <span
                                        class="badge bg-danger align-middle ms-1">{{$cantidad}}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        @if($this->filters['tab']==1)
                                            <th>Usuario</th>
                                        @endif
                                        <th>Documento</th>
                                        <th>Fecha</th>
                                        <th style="width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Cliente</th>
                                        <th>Peso Bruto</th>
                                        <th>Peso Tara</th>
                                        <th>Peso Neto</th>
                                        <th style="width: 300px;">Producto</th>
                                        <th>Acción</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        @if($this->filters['tab']==1)
                                            <td>{{$record->user_calidad}}</td>
                                        @endif
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
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">                                              
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                    title="Imprimir">
                                                    @if($this->filters['tab']==2)
                                                    <a href="/bascula/certificado-calidad/{{$record->TipoEgr}},{{$record->Id_Fila}}" target="_blank"
                                                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle">
                                                        <i class="ri-printer-fill fs-18"></i>
                                                    </a>
                                                    
                                                    @else
                                                    <button onclick="window.open('{{ route('Certificado.pdf', ['tipo' => $record->TipoEgr, 'id' => $record->Id_Fila]) }}')", '_blank')"
                                                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-printer-fill fs-18"></i>
                                                    </button>
                                                    @endif 
                                                </li>
                                                @if($this->filters['tab']==1)
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                        data-bs-toggle="modal" href="" wire:click.prevent="delete({{ $record->Id_Fila}},{{$record->TipoEgr}})">
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                @endif
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
                        {{$tblrecords->links('')}}
                    </div>

                    <div wire.ignore.self class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true" wire:model='selectId'>
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                    </lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4>¿Está a punto de inactivar el registro?</h4>
                                        <p class="text-muted fs-15 mb-4">Inactivar el registro afectará toda su 
                                        información de nuestra base de datos.</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                                Cerrar </button>
                                            <button class="btn btn-danger" id="delete-record"  wire:click="deleteData()"> Si,
                                                Inactivar</button>
                                        </div>
                                    </div>
                                </div>
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

