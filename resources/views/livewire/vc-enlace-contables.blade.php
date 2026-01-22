<div>
    <form id="addrubro-form" autocomplete="off" wire:submit.prevent="{{ $edit ? 'updateData' : 'createData' }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-1 ">
                                <input type="text" class="form-control border-0 fw-semibold" placeholder="ID"
                                    value="TIPO ROL:" />
                            </div>
                            <div class="col-xxl-4 col-sm-4">
                                <select class="form-select" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbnivel" wire:model.defer="tiporolId"
                                    wire:change='render()'>
                                    @foreach ($tbltiposrols as $tipo)
                                    <option value="{{$tipo->id}}" selected>{{$tipo->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-select" js-example-basic-single name="choices-single-default"
                                    id="cmbnivel" wire:model.defer="tipoPago" wire:change='render()'>
                                    <option value="Q" selected>Quincenal</option>
                                    <option value="M" selected>Mensual</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-xxl-12">
                <div class="card" id="contactList">
                    <div class="card-header">
                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">
                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="{{$classnavD}}" id="debito-tab" data-bs-toggle="pill"
                                        data-bs-target="#pill-debito" type="button" role="tab"
                                        aria-controls="pills-bill-info" aria-selected="true" data-position="0"
                                        wire:click.prevent="tipoCta('D')">
                                        <i
                                            class="ri-file-add-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        DÉBITO
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="{{$classnavC}}" id="credito-tab" data-bs-toggle="pill"
                                        data-bs-target="#pill-credito" type="button" role="tab"
                                        aria-controls="pills-bill-address" aria-selected="false" data-position="1"
                                        tabindex="-1" wire:click.prevent="tipoCta('C')">
                                        <i
                                            class="ri-file-reduce-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        CRÉDITO </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="{{$classtabD}}" id="pill-debito" role="tabpanel" aria-labelledby="debito-tab">
                                <div class="row">
                                    <div class="col-lg-1">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="dnomina"
                                                wire:model.defer="comprobante" value="N" required>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Nomina
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dnomina"
                                                wire:model.defer="comprobante" value="P" required>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Provisión
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="filename-input" class="form-label">Rubro</label>
                                        <select type="select" class="form-select" data-trigger name="rubro-select"
                                            wire:model.defer="rubroId" required>
                                            <option value="">Seleccione Rubro</option>
                                            @foreach ($tblrubros as $rubro)
                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}</option>
                                            @endforeach
                                            <option value="TI">TOTAL INGRESOS</option>
                                            <option value="TE">TOTAL EGRESOS</option>
                                            <option value="TP">TOTAL A PAGAR</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row">
                                            <label for="filename-input" class="form-label">Cuenta Contable</label>
                                            <div class="input-group">
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="dcodcta"
                                                        placeholder="Código" wire:model.defer="codCuenta" required>
                                                </div>
                                                <input type="text" class="form-control" name="ncodcta"
                                                    wire:model.defer="nomCuenta" disabled>
                                                <a id="btnbuscar" class="input-group-text btn btn-soft-secondary"
                                                    wire:click.prevent="consulta('sgi_con_catalogo')"><i
                                                        class="ri-search-line search-icon"></i></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-auto ms-auto">
                                                <div class="hstack text-nowrap gap-2">
                                                    <div class="form-check form-check-success" style="display: inline;">
                                                        <input class="form-check-input" type="checkbox" id="dcheck"
                                                            wire:model.defer="gDeducible">
                                                        <label class="form-check-label fs-12"
                                                            style="margin-top:0px;margin-right:10px;" for="formCheck8">
                                                            Gasto Deducible
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="filename-input" class="form-label">Centro de Costo</label>
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="dcodccosto"
                                                    placeholder="Código" wire:model.defer="codCCosto" required>
                                            </div>
                                            <input type="text" class="form-control" name="dnomccosto"
                                                wire:model.defer="nomCCosto" disabled>
                                            <a id="btnstudents" class="input-group-text btn btn-soft-secondary"
                                                wire:click.prevent="consulta('sgi_cc_divisiones')"><i
                                                    class="ri-search-line search-icon"></i></a>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-auto ms-auto">
                                        @if ($edit==false)
                                        <div class="hstack text-nowrap gap-2">
                                            <button type="sumit" class="btn btn-soft-success material-shadow-none"><i
                                                    class="ri-add-circle-line align-middle me-1"></i> Grabar </button>
                                        </div>
                                        @else
                                        <div class="hstack text-nowrap gap-2">
                                            <button type="sumit" class="btn btn-soft-success material-shadow-none"><i
                                                    class="ri-add-circle-line align-middle me-1"></i> Actualizar
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="{{$classtabC}}" id="pill-credito" role="tabpanel" aria-labelledby="credito-tab">
                                <div class="row">
                                    <div class="col-lg-1">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="cnomina"
                                                wire:model.defer="comprobante" value="N" required>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Nomina
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cnomina"
                                                wire:model.defer="comprobante" value="P" required>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Provisión
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="filename-input" class="form-label">Rubro</label>
                                        <select type="select" class="form-select" data-trigger name="rubro-select"
                                            wire:model.defer="rubroId" required>
                                            <option value="">Seleccione Rubro</option>
                                            @foreach ($tblrubros as $rubro)
                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}</option>
                                            @endforeach
                                            <option value="TI">TOTAL INGRESOS</option>
                                            <option value="TE">TOTAL EGRESOS</option>
                                            <option value="TP">TOTAL A PAGAR</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row">
                                            <label for="filename-input" class="form-label">Cuenta Contable</label>
                                            <div class="input-group">
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="identidad" id="nom13"
                                                        placeholder="Código" wire:model.defer="codCuenta" required>
                                                </div>
                                                <input type="text" class="form-control" name="identidad" id="b13"
                                                    wire:model.defer="nomCuenta" disabled>
                                                <a id="btnbuscar" class="input-group-text btn btn-soft-secondary"
                                                    wire:click.prevent="consulta('sgi_con_catalogo')"><i
                                                        class="ri-search-line search-icon"></i></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-auto ms-auto">
                                                <div class="hstack text-nowrap gap-2">
                                                    <div class="form-check form-check-success" style="display: inline;">
                                                        <input class="form-check-input" type="checkbox" id="formCheck8"
                                                            wire:model.defer="gDeducible">
                                                        <label class="form-check-label fs-12"
                                                            style="margin-top:0px;margin-right:10px;" for="formCheck8">
                                                            Gasto Deducible
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="filename-input" class="form-label">Centro de Costo</label>
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="identidad" id="nomvac"
                                                    placeholder="Código" wire:model.defer="codCCosto" required>
                                            </div>
                                            <input type="text" class="form-control" name="identidad" id="b14"
                                                wire:model.defer="nomCCosto" disabled>
                                            <a id="btnstudents" class="input-group-text btn btn-soft-secondary"
                                                wire:click.prevent="consulta('sgi_cc_divisiones')"><i
                                                    class="ri-search-line search-icon"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-auto ms-auto">
                                        @if ($edit==false)
                                        <div class="hstack text-nowrap gap-2">
                                            <button type="sumit" class="btn btn-soft-success material-shadow-none"><i
                                                    class="ri-add-circle-line align-middle me-1"></i> Agregar </button>
                                        </div>
                                        @else
                                        <div class="hstack text-nowrap gap-2">
                                            <button type="sumit" class="btn btn-soft-success material-shadow-none"><i
                                                    class="ri-add-circle-line align-middle me-1"></i> Actualizar
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="file-manager-content w-100 p-3 ">
                            <div class="table-responsive table-card mb-3">
                                <div style="overflow-x:auto;">
                                    <table class="table table-nowrap align-middle" id="orderTable">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">
                                                <th scope="col">Rubro</th>
                                                <th scope="col">Cuenta</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Naturaleza</th>
                                                <th scope="col">Comprobante</th>
                                                <th scope="col">Centro de Costo</th>
                                                <th scope="col">Gasto Deducible</th>
                                                <th scope="col" class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="file-list">
                                            @foreach ($tblrecords as $record)
                                            <tr>
                                                @if ($record->rubro_id==null)
                                                <td>{{$arrRubro[$record->rubro_pago]}}</td>
                                                @else
                                                <td>{{$record->rubro->descripcion}}</td>
                                                @endif
                                                <td>{{$record->cuenta}}</td>
                                                <td>{{$record->descripcion}}</td>
                                                <td>{{$arrayNaturaleza[$record->tipo]}}</td>
                                                <td>{{$arrayComprobante[$record->comprobante]}}</td>
                                                <td>{{$record->ccosto}}</td>
                                                <td>{{$record->gastodeducible}}</td>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top"
                                                            title="Edit">
                                                            <a href="" wire:click.prevent="edit({{ $record }})">
                                                                <i class="ri-pencil-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top"
                                                            title="Remove">
                                                            <a class="text-danger d-inline-block remove-item-btn"
                                                                data-bs-toggle="modal" href=""
                                                                wire:click.prevent="delete({{ $record->id }})">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{$tblrecords->links('')}}
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <!--end col-->
        </div>
        <!--end row-->
    </form>


    <div class="modal fade" id="showCuentas" tabindex="-1" aria-labelledby="modalCcosto"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-content border-0">

                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="modalCcosto">
                        <span> Consultar Centro de Costo &nbsp;</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form autocomplete="off">
                    <div class="modal-body">
                        @livewire('vc-busqueda',[
                            'tabla'=>''
                        ])
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    {{--<div class="modal fade" id="showCCosto" tabindex="-1" aria-labelledby="modalCcosto" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-content border-0">
                
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="modalCcosto">
                        <span> Consultar Centro de Costo &nbsp;</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form autocomplete="off">
                    
                    <div class="modal-body">                                       
                        @livewire('vc-buscar-c-costo',['emitTo'=>'vc-enlace-contables'])                                 
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>--}}

    <div wire:ignore.self class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true"
        wire:model='selectId'>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                    </lord-icon>
                    <div class="mt-4 text-center">
                        <h4>¿Está a punto de eliminar el registro? {{ $selectValue }}</h4>
                        <p class="text-muted fs-15 mb-4">Eliminar el registro afectará toda su
                            información de nuestra base de datos.</p>
                        <div class="hstack gap-2 justify-content-center remove">
                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                Cerrar </button>
                            <button class="btn btn-danger" id="delete-record" wire:click="deleteData()"> Si,
                                Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>