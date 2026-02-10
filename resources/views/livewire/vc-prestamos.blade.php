<div>
    <form autocomplete="off" wire:submit.prevent="{{ 'createData' }}" id="encashment_form">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-money-dollar-circle-fill align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-13 text-muted mb-1">
                                            Total Prestamos</p>
                                        <h4 class=" mb-0">${{$prestamo->total}}</h4>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-arrow-up-circle-fill align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-13 text-muted mb-1">
                                            Cancelado</p>
                                        <h4 class=" mb-0">${{$prestamo->cancelado}}</h4>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-arrow-down-circle-fill align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-13 text-muted mb-1">Por Cobrar</p>
                                        <h4 class=" mb-0">${{$prestamo->porcancelar}}</h4>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
                <div class="card">

                    <div class="table-responsive mb-1">
                        <div class="card-header border-0">
                            <div class="row">
                                <div class="col-lg-2">
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="periodo">
                                        <option value="" selected>-- Periodo --</option>
                                        @foreach ($anios as $ejercicio)
                                        <option value="{{$ejercicio['periodo']}}">{{$ejercicio['periodo']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-8">
                                    <div class="search-box">
                                        <input type="text" class="form-control search"
                                            placeholder="Burcar por descripción..." wire:model="filters.descripcion">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-nowrap align-middle" id="orderTable">
                            <thead class="text-muted table-light">
                                <tr class="text-uppercase">
                                    <th>Empleado</th>
                                    <th>Fecha</th>
                                    <th> Documento</th>
                                    <th class="text-end">Monto</th>
                                    <th class="text-end">Cuotas</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($tblprestamos as $prestamo)
                                <tr>
                                    <td>{{$prestamo->apellidos}} {{$prestamo->nombres}}</td>
                                    <td>{{date('d/m/Y', strtotime($prestamo->fecha))}}</td>
                                    <td>{{$prestamo->id}}</td>
                                    <td class="text-end">${{number_format($prestamo->monto,2)}}</td>
                                    <td class="text-end">{{ ($prestamo->pagos ?? 0) > 0 ? $prestamo->pagos : 0 }}/{{$prestamo->cuota}}</td>
                                    <td class="text-center">
                                        @if($prestamo->estado)
                                        <span class="badge badge-soft-success text-uppercase">Activo</span>
                                        @else
                                        <span class="badge badge-soft-warning text-uppercase">Cancelado</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <ul class="list-inline hstack gap-2 mb-0">
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" data-bs-placement="top" title="Ver detalle">
                                                <a href="" wire:click.prevent="view({{ $prestamo }})">
                                                    <i class="las la-eye fs-22 text-info"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" data-bs-placement="top" title="Editar">
                                                <a href="" wire:click.prevent="edit({{ $prestamo }})">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" data-bs-placement="top" title="Eliminar">
                                                <a class="text-danger d-inline-block remove-item-btn"
                                                    data-bs-toggle="modal" href=""
                                                    wire:click.prevent="delete({{ $prestamo->id }})">
                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$tblprestamos->links('')}}
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="tab-content text-muted">
                                    <div class="tab-pane active">
                                        <div class="p-3 bg-soft-warning">
                                            <div class="float-end ms-2">
                                                <a href="javascript:void(0);" class="btn btn-soft-danger btn-sm"
                                                    wire:click.prevent="add()">Nuevo Registro</a>
                                            </div>
                                            <h6 class="mb-0 text-danger">Préstamo</h6>
                                        </div>
                                        <div class="card card-height-100">
                                            <div class="card-header">
                                                <ul class="nav nav-tabs-custom rounded card-header-tabs nav-justified border-bottom-0 mx-n3"
                                                    role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link active" data-bs-toggle="tab"
                                                            href="#cryptoBuy" role="tab" aria-selected="false"
                                                            tabindex="-1">
                                                            Préstamo
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#cryptoSell"
                                                            role="tab" aria-selected="true">
                                                            Detalle Cuotas
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content text-muted">
                                                <div class="tab-pane active show" id="cryptoBuy" role="tabpanel">
                                                    <fieldset {{$fieldset}}>
                                                    <div class="p-3">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="mb-3">
                                                                    <label>Emision :</label>
                                                                    <input id="dfechaini" name="dateIni" type="date"
                                                                        class="form-control" data-provider="flatpickr"
                                                                        data-date-format="d-m-Y" data-time="true"
                                                                        wire:model.defer="record.fecha" required>
                                                                </div>
                                                            </div><!-- end col -->
                                                            <div class="col-8">
                                                                <div class="mb-3">
                                                                    <label>Empleado :</label>
                                                                    <select type="select" class="form-control" data-trigger id="cmbtiporol" wire:model="record.persona_id" wire:change="loadperiodo()" required>
                                                                        <option value="">Seleccione Empleado</option>
                                                                        @foreach ($tblpersonas as $personas)
                                                                            @if ($record['persona_id'] == $personas->id)
                                                                                <option value="{{$personas->id}}" Selected>{{$personas->apellidos}} {{$personas->nombres}}</option>
                                                                            @else
                                                                                <option value="{{$personas->id}}">{{$personas->apellidos}} {{$personas->nombres}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div><!-- end col -->
                                                        </div><!-- end row -->

                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="mb-3">
                                                                    <select type="select" class="form-select"
                                                                        id="cmbtipo" placeholder="Ingrese el concepto"
                                                                        wire:model.defer="record.tipoprestamo_id"
                                                                        required>
                                                                        <option value="">-- Concepto --</option>
                                                                        @foreach ($tbltipo as $tipo)
                                                                        <option value="{{$tipo->id}}">
                                                                            {{$tipo->descripcion}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-7">
                                                                <div class="mb-3">
                                                                    <select type="select" class="form-select"
                                                                        data-trigger id="cmbrubros"
                                                                        wire:model.defer="record.rubrosrol_id" required>
                                                                        <option value="">-- Rubro --</option>
                                                                        @foreach ($tblrubros as $rubros)
                                                                        <option value="{{$rubros->id}}">
                                                                            {{$rubros->descripcion}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <select type="select" class="form-select" data-trigger
                                                                    id="cmbperiodo"
                                                                    wire:model.defer="record.periodosrol_id" required>
                                                                    <option value="">-- Periodo --</option>
                                                                    @foreach ($tblperiodos as $periodo)
                                                                    <option value="{{$periodo->id}}">
                                                                        {{$periodo->fechafin}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="input-group mb-3">
                                                                    <label class="input-group-text">Monto</label>
                                                                    <input type="number"
                                                                        class="form-control  product-price"
                                                                        id="txtvalor" step="0.01" placeholder="2.045585"
                                                                        wire:model.defer="record.monto" required>
                                                                    <label class="input-group-text">$</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="input-group mb-0">
                                                                    <label class="input-group-text">Cuotas</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="2700.16"
                                                                        wire:model.defer="record.cuota" required>
                                                                    <div class="form-check form-check-success mb-3">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            wire:model.defer="mesgracia">
                                                                        <label class="form-check-label"
                                                                            for="record.imprimerol1">Mes Gracia</label>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="col-5">
                                                                <div class="input-group mb-3">
                                                                    <label class="input-group-text">Valor Cuota</label>
                                                                    <input type="number"
                                                                        class="form-control product-price"
                                                                        id="txtvalor" step="0.01" 
                                                                        wire:model.defer="record.valorcuota" required>
                                                                    <label class="input-group-text">$</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                
                                                                <div class="float-end">
                                                                    <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                                        data-bs-trigger="hover" data-bs-placement="top" title="Calcular Cuotas">
                                                                        <a href="" wire:click.prevent="calculaPagos()" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-thumb-up-line align-bottom fs-22"></i></a>
                                                                    </li>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label for="txtplazo"
                                                                    class="form-label mb-0">Comentario</label>
                                                                <textarea type="text" class="form-control"
                                                                    id="txtcomentario"
                                                                    placeholder="Ingrese su comentario"
                                                                    wire:model.defer="record.comentario" required>
                                                                </textarea>
                                                            </div>
                                                        </div>

                                                        <div class="mt-3 pt-2">
                                                            <div class="d-flex mb-2">
                                                                <div class="flex-grow-1">
                                                                    <p class="fs-13 mb-0">Transacción<span
                                                                            class="text-muted ms-1 fs-11"></span></p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <h6 class="mb-0">{{$record['monto']}}</h6>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex mb-2">
                                                                <div class="flex-grow-1">
                                                                    <p class="fs-13 mb-0">Número de Cuotas<span
                                                                            class="text-muted ms-1 fs-11"></span></p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <h6 class="mb-0">{{$record['ncuota']}}</h6>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1">
                                                                    <p class="fs-13 mb-0">Ultima Cuota</p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <h6 class="mb-0">{{date('d/m/Y', strtotime($record['ultimopago']))}}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3 pt-2">
                                                            <button type="submit" class="btn btn-success w-100">Grabar</button>
                                                        </div>
                                                    </div>
                                                    </fieldset>
                                                </div>
                                                <div class="tab-pane" id="cryptoSell" role="tabpanel">
                                                    <div class="p-3">
                                                        <fieldset {{$fieldset}}>
                                                        <div class="table-responsive  mb-3">
                                                            <div style="overflow-x:auto;">
                                                                <table class="table table-sm table-nowrap align-middle"
                                                                    style="width:100%">
                                                                    <thead class="text-muted table-light">
                                                                        <tr class="text-uppercase">
                                                                            <th scope="col"># Cuota</th>
                                                                            <th scope="col">Fecha</th>
                                                                            <th scope="col">Valor</th>
                                                                            <th scope="col">Estado</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="list form-check-all">
                                                                        @foreach ($cuotas as $key => $cuota)
                                                                        <tr>
                                                                            <td>{{$cuota['cuota']}}</td>
                                                                            <td>{{date('d/m/Y', strtotime($cuota['fecha']))}}</td>
                                                                            <td>
                                                                                <input type="number"
                                                                                class="form-control form-control-sm product-price"
                                                                                id="txtvalor" step="0.01" wire:model.defer="cuotas.{{$key}}.valor" required>
                                                                            </td>
                                                                            <td>
                                                                                @if($cuota['estado']=='P')
                                                                                <span
                                                                                    class="badge badge-soft-success text-uppercase">Pendiente</span>
                                                                                @else
                                                                                <span
                                                                                    class="badge badge-soft-info text-uppercase">Cancelado</span>
                                                                                @endif
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="noresult" style="display: none">
                                                                <div class="text-center">
                                                                    <lord-icon
                                                                        src="https://cdn.lordicon.com/msoeawqm.json"
                                                                        trigger="loop"
                                                                        colors="primary:#121331,secondary:#08a88a"
                                                                        style="width:75px;height:75px">
                                                                    </lord-icon>
                                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                                    <p class="text-muted mb-0">We've searched more than
                                                                        150+ contacts We
                                                                        did not find any
                                                                        contacts for you search.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </fieldset>
                                                    </div>
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


                <!--end col-->
                <!--<div class="row g-3">
            <div class="col-md-auto ms-auto">
                <div class="justify-content-center">
                    <button type="submit" class="btn btn-success w-sm" ><i class="ri-save-3-fill align-bottom me-1"></i>Grabar</button>
                </div>
            </div>
        </div>-->
            </div>
        </div>
    </form>


    <!--end row-->
</div>