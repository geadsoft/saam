<div>
    <form id="addrubro-form" autocomplete="off"
        wire:submit.prevent="{{ 'createData' }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-xxl-2 col-sm-4">
                                <select class="form-select" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbnivel" wire:model.live="filters.area" wire:change="consulta">
                                    <option value="" selected>Seleccione Área</option>
                                    @foreach ($areas as $area)
                                        <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                    @endforeach                                
                                </select>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <select class="form-select" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbnivel" wire:model.live="filters.departamento" wire:change="consulta">
                                    <option value="" selected>Seleccione Departamento</option>
                                    @foreach ($departs as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->descripcion}}</option>
                                    @endforeach                                
                                </select>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <select class="form-select" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbnivel" wire:model.live="filters.cargo" wire:change="consulta">
                                    <option value="" selected>Seleccione Cargo</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{$cargo->id}}">{{$cargo->descripcion}}</option>
                                    @endforeach                                
                                </select>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <select class="form-select" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbnivel" wire:model.live="filters.empleado" wire:change="consulta">
                                    <option value="" selected>Seleccione Tipo Empleado</option>
                                    @foreach ($templeados as $empleado)
                                        <option value="{{$empleado->id}}">{{$empleado->descripcion}}</option>
                                    @endforeach                                
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div>
                                    <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="filters.fechaini" wire:change="consulta">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div>
                                    <input id="dfechaFin" name="dateFin" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="filters.fechafin" wire:change="consulta">
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $this->filters['turno'] == 'TF' ? 'active' : '' }}"
                        data-bs-toggle="tab"
                        href="#tab-turnos-fijos"
                        role="tab">
                            Turnos Fijos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $this->filters['turno'] == 'TV' ? 'active' : '' }}"
                        data-bs-toggle="tab"
                        href="#tab-turnos-variables"
                        role="tab">
                            Turnos Variables
                        </a>
                    </li>
                </ul>
                <div class="tab-content">

                    <!-- TURNOS FIJOS -->
                    <div class="tab-pane fade {{ $this->filters['turno'] == 'TF' ? 'show active' : '' }}" id="tab-turnos-fijos" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive mb-1" style="max-height: 750px; overflow-y: auto;">
                                            <table class="table table-nowrap table-sm align-middle" id="orderTable">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                                    wire:click="allEmpleados">
                                                            </div>
                                                        </th>
                                                        <th class="sort">Cédula</th>
                                                        <th class="sort">Empleado</th>
                                                        <th class="sort">Área</th>
                                                        <th class="sort">Turno Actual</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                @foreach ($tblrecords as $key => $record)    
                                                    <tr>
                                                        <td>
                                                        <input class="form-check-input" id="chk-{{$key}}" type="checkbox" wire:model="tblrecords.{{ $key }}.seleccion"> 
                                                        </td>
                                                        <td>{{$record['nui']}}</td>
                                                        <td>{{$record['apellidos']}} {{$record['nombres']}}</td>
                                                        <td>{{$record['area']}}</td>
                                                        <td>{{$record['turno']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 tab-pane active" id="nav-turnovariables" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-calendar-start align-middle me-1 text-muted"></i>Asignar Turnos</h5>
                                            <div class="flex-shrink-0">
                                                <a href="javascript:void(0);" class="btn btn-soft-info btn-sm mt-2 mt-sm-0" wire:click="add">Nuevo</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <fieldset {{$control}}>
                                        <div class="row">
                                            <div class="row mb-2">
                                                <label for="turno" class="col-sm-3 col-form-label">Turno</label>
                                                <div class="col-sm-9">
                                                <select class="form-select" wire:model="record.turno_id" wire:change="selectTurno" required>
                                                    <option value="" selected>Seleccione Turno</option>
                                                    @foreach ($turnos as $turno)
                                                        <option value="{{$turno->id}}">{{$turno->descripcion}}</option>
                                                    @endforeach                                
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="turno" class="col-sm-3 col-form-label">Horario</label>
                                                <div class="col-sm-9">
                                                    <label for="turno" class="col-form-label">{{$turnoHorario['hora_entrada']}} - {{$turnoHorario['hora_salida']}}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="turno" class="col-sm-3 col-form-label">Días</label>
                                                <div class="col-sm-9">
                                                    <label for="turno" class="col-form-label">
                                                        @foreach($diasSemana as $key => $dia)
                                                        @if($dia['aplica']=="N")
                                                        <span class="badge badge-soft-danger text-uppercase fs-11">{{$dia['dia']}}</span>
                                                        @else
                                                        <span class="badge badge-soft-success text-uppercase fs-11">{{$dia['dia']}}</span>
                                                        @endif 
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="turno" class="col-sm-3 col-form-label">Tipo de Turno</label>
                                                <div class="col-sm-9">
                                                    <label for="turno" class="col-form-label">{{$turnoHorario['tipo']}}</label>
                                                </div>
                                            </div>
                                            <div class="card-header mb-3">
                                                <h6 class="flex-grow-1 mb-0 text-primary"><i
                                                    class="mdi mdi-account-tie align-middle me-1 text-success"></i>
                                                    Vigencia de Turno</h6>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="dfechaini" class="col-sm-2 col-form-label">
                                                    Desde
                                                </label>
                                                <div class="col-sm-9">
                                                    <input id="dfechaini" name="dateIni" type="date" class="form-control" wire:model.defer="record.fechaini" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="dfechafin" class="col-sm-2 col-form-label">
                                                    Hasta
                                                </label>
                                                <div class="col-sm-9">
                                                    <input id="dfechafin" name="dateFin" type="date" class="form-control" wire:model.defer="record.fechafin" required>
                                                </div>
                                            </div>
                                            <div class="card-header mb-3">
                                                <h6 class="flex-grow-1 mb-0 text-primary"></h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-check form-check-success mb-3">
                                                    <input class="form-check-input" type="checkbox" wire:model.defer="record.reemplaza">
                                                    <label class="form-check-label" for="record.reemplaza">
                                                        Reemplaza turno anterior
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-success mb-3">
                                                    <input class="form-check-input" type="checkbox" wire:model.defer="record.horasextras">
                                                    <label class="form-check-label" for="record.horasextras">
                                                        Genera Horas Extras
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        </fieldset>
                                    </div>
                                    
                                </div>
                                
                                <div class="card">
                                    <div class="card-body">
                                        <div class="justify-content-end">
                                            <button type="submit" class="btn btn-success w-sm">Grabar</button>
                                            <a class="btn btn-secondary w-sm" href="/form/rubros"><i
                                                    class="me-1 align-bottom"></i>Cancelar</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- TURNOS VARIABLES -->
                    <div class="tab-pane fade {{ $this->filters['turno'] == 'TV' ? 'show active' : '' }}" id="tab-turnos-variables" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <div class="row mb-4">
                                                <label for="dfechaini" class="col-sm-2 col-form-label">
                                                    Desde
                                                </label>
                                                <div class="col-sm-8">
                                                    <input id="dfechaini" name="dateIni" type="date" class="form-control" wire:model.defer="record.fechaini" required>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="dfechafin" class="col-sm-2 col-form-label">
                                                    Hasta
                                                </label>
                                                <div class="col-sm-8">
                                                    <input id="dfechafin" name="dateFin" type="date" class="form-control" wire:model.defer="record.fechafin" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-check form-check-success mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="record.reemplaza">
                                                <label class="form-check-label" for="record.reemplaza">
                                                    Reemplaza turno anterior
                                                </label>
                                            </div>
                                            <div class="form-check form-check-success mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="record.alimentacion">
                                                <label class="form-check-label" for="record.horasextras">
                                                    Aplica Alimentación
                                                </label>
                                            </div>
                                            <div class="form-check form-check-success mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="record.horasextras">
                                                <label class="form-check-label" for="record.horasextras">
                                                    Genera Horas Extras
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto ms-auto">
                                            <div class="hstack text-nowrap gap-2">
                                                <button type="button" wire:click.prevent="generarDias()" class="btn btn-danger add-btn" data-bs-toggle="modal" id="create-btn"
                                                    data-bs-target=""><i class="ri-file-copy-fill align-bottom me-1"></i> Generar Dias
                                                </button>
                                                <button type="sumit" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                                    data-bs-target=""><i class="ri-save-3-fill align-bottom me-1"></i> Grabar
                                                </button>
                                            </div>
                                        </div>
                                        <div class="table-responsive mb-1" style="max-height: 750px; overflow-y: auto;">
                                            <table class="table table-nowrap table-sm align-middle" id="orderTable">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                                    wire:click="allEmpleados">
                                                            </div>
                                                        </th>
                                                        <th class="sort">Cédula</th>
                                                        <th class="sort">Empleado</th>
                                                        <th class="sort">Área</th>
                                                        @if($filters['turno']=='TV')
                                                            @foreach($fechas as $col)
                                                                <th class="text-center">{{$col}}</th>
                                                            @endforeach
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($tblvariable as $key => $recno)    
                                                        <tr>
                                                            <td>
                                                            <input class="form-check-input" id="chk-{{$key}}" type="checkbox"> 
                                                            </td>
                                                            <td>{{$recno['nui']}}</td>
                                                            <td>{{$recno['nombres']}}</td>
                                                            <td>{{$recno['area']}}</td>
                                                            @if($filters['turno']=='TV')
                                                                @foreach($fechas as $col)
                                                                    <td>
                                                                        <select class="form-select" wire:model="tblvariable.{{$key}}.{{$col}}">
                                                                            <option value="" selected>Seleccione Turno</option>
                                                                            @foreach ($turnos as $turno)
                                                                                <option value="{{$turno->id}}">{{$turno->descripcion}}</option>
                                                                            @endforeach                                
                                                                        </select>
                                                                    </td>
                                                                @endforeach
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <!-- end row -->
    </form>
    <div wire.ignore.self class="modal fade flip" id="deleteRecord" tabindex="-1" aria-hidden="true"
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