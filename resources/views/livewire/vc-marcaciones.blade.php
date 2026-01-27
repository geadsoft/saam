<div>
    <form id="addrubro-form" autocomplete="off" class="needs-validation" wire:submit.prevent="createData()">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label for="cmbtiporol" class="form-label">Fecha Inicial</label>
                                <div>
                                    <input id="dfechaini" name="dateIni" type="date" class="form-control"
                                        data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                        wire:model.defer="filters.startDate" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="cmbtiporol" class="form-label">Fecha Final</label>
                                <div>
                                    <input id="dfechaini" name="dateIni" type="date" class="form-control"
                                        data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                        wire:model.defer="filters.endDate" required>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <label for="cmbtiporol" class="form-label">Departamento</label>
                                <select class="form-select" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbnivel" wire:model.live="filters.departamento">
                                    <option value="" selected>Seleccione Departamento</option>
                                    @foreach ($departs as $departamento)
                                    <option value="{{$departamento->id}}">{{$departamento->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-auto ms-auto">
                                <div class="hstack text-nowrap gap-2">
                                    <button type="button" wire:click.prevent="marcaciones()"
                                        class="btn btn-info add-btn" data-bs-toggle="modal" id="create-btn"
                                        data-bs-target=""><i class="ri-file-copy-fill align-bottom me-1"></i>
                                        Marcaciones
                                    </button>
                                    <button type="button" wire:click.prevent="calcularHoras" class="btn btn-danger add-btn"
                                        data-bs-toggle="modal" id="create-btn" data-bs-target=""><i
                                            class="ri-file-copy-fill align-bottom me-1"></i> Calcular Horas
                                    </button>
                                    <button type="sumit" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target=""><i
                                            class="ri-save-3-fill align-bottom me-1"></i> Grabar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-xxl-12">
                <div class="card" id="contactList">
                    <ul class="nav nav-tabs nav-border-top nav-border-top-primary" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $this->filters['tab'] == 'timbres' ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-marcaciones" role="tab">
                                Marcaciones
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $this->filters['tab'] == 'extras' ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-horasextras" role="tab">
                                Horas Extras
                            </a>
                        </li>
                        <li class="nav-item ms-auto mt-2 me-2">
                            <a href="javascript:void(0);"
                            class="btn btn-soft-primary btn-sm" wire:click.prevent="add()">
                                Agregar Timbre
                            </a>
                        </li>
                    </ul>
                    
                    
                    <div class="tab-content mb-3">
                        <div class="tab-pane fade {{ $this->filters['tab'] == 'timbres' ? 'show active' : '' }}" id="tab-marcaciones" role="tabpanel">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div style="overflow-x:auto;">
                                        <table class="table table-sm table-nowrap align-middle" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col" style="width: 50px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="checkAll" value="option">
                                                        </div>
                                                    </th>
                                                    <!--<th class="sort" data-sort="id" scope="col">ID</th>-->
                                                    <th scope="col" style="display:none">Id</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Departamento</th>
                                                    <th scope="col">Cargo</th>
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col">Turno</th>
                                                    <th scope="col">Entrada</th>
                                                    <th scope="col">Timbre</th>
                                                    <th scope="col">Sal Alim</th>
                                                    <th scope="col">Timbre</th>
                                                    <th scope="col">Ent Alim</th>
                                                    <th scope="col">Timbre</th>
                                                    <th scope="col">Salida</th>
                                                    <th scope="col">Timbre</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($tblrecords as $fil => $data)

                                                <tr id="{{$fil}}" class="detalle">
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="chk_child" value="option1">
                                                        </div>
                                                    </th>
                                                    <td>{{$data['nombre']}}</td>
                                                    <td>{{$data['depart']}}</td>
                                                    <td>{{$data['cargo']}}</td>
                                                    <td>{{$data['fecha']}}</td>
                                                    <td>{{$data['turno']}}</td>
                                                    <td>{{$data['entrada']}}</td>
                                                    @if($data['emanual'] == 'S')
                                                    <td>{{ $data['timbre1'] ? \Carbon\Carbon::parse($data['timbre1'])->format('H:i:s') : '' }}<i class="ri-asterisk text-danger ms-1"title="Timbre manual"></td>
                                                    @else
                                                    <td>{{ $data['timbre1'] ? \Carbon\Carbon::parse($data['timbre1'])->format('H:i:s') : '' }}</td>
                                                    @endif
                                                    <td>{{$data['salalim']}}</td>
                                                    <td>{{$data['timbre2']}}</td>
                                                    <td>{{$data['entalim']}}</td>
                                                    <td>{{$data['timbre3']}}</td>
                                                    <td>{{$data['salida']}}</td>
                                                    @if($data['smanual'] == 'S')
                                                    <td>{{ $data['timbre4'] ? \Carbon\Carbon::parse($data['timbre4'])->format('H:i:s') : '' }}<i class="ri-asterisk text-danger ms-1"title="Timbre manual"></i></td>
                                                    @else
                                                    <td>{{ $data['timbre4'] ? \Carbon\Carbon::parse($data['timbre4'])->format('H:i:s') : '' }}</td>
                                                    @endif
                                                    
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $this->filters['tab'] == 'extras' ? 'show active' : '' }}" id="tab-horasextras" role="tabpanel">
                            <div class="table-responsive">
                                <div class="card-body">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <label for="cmbtiporol" class="col-md-2 col-form-label fw-semibold">
                                                Rol de Pago 
                                            </label>
                                            <div class="col-md-6 mb-3">
                                                <select
                                                    id="cmbtiporol"
                                                    class="form-select"
                                                    wire:model.defer="filters.periodoRolId"
                                                    required>
                                                    <option value="">--Seleccione Periodo--</option>
                                                    @foreach ($periodoRol as $periodo)
                                                        <option value="{{ $periodo->id }}">
                                                            {{ $periodo->tiporol->descripcion }}
                                                            {{ date('d/m/Y', strtotime($periodo->fechaini)) }}
                                                            -
                                                            {{ date('d/m/Y', strtotime($periodo->fechafin)) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="overflow-x:auto;">
                                        <table class="table table-sm table-nowrap align-middle" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col" style="width: 50px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="checkAll" value="option">
                                                        </div>
                                                    </th>
                                                    <!--<th class="sort" data-sort="id" scope="col">ID</th>-->
                                                    <th scope="col" style="display:none">Id</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Departamento</th>
                                                    <th scope="col">Cargo</th>
                                                    <th scope="col">Sueldo</th>
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col">Horas Trabajadas</th>
                                                    <th scope="col">HE 25</th>
                                                    <th scope="col">Monto</th>
                                                    <th scope="col">HE 50</th>
                                                    <th scope="col">Monto</th>
                                                    <th scope="col">HE 100</th>
                                                    <th scope="col">Monto</th>
                                                    <th scope="col">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($tblextras as $fil => $extra)
                                                @if($extra['total']>0)
                                                <tr id="{{$fil}}" class="detalle">
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="chk_child" value="option1">
                                                        </div>
                                                    </th>
                                                    <td>{{$extra['nombre']}}</td>
                                                    <td>{{$extra['depart']}}</td>
                                                    <td>{{$extra['cargo']}}</td>
                                                    <td>${{$extra['sueldo']}}</td>
                                                    <td>{{$extra['fecha']}}</td>
                                                    <td>{{ number_format($extra['normales'], 2) }}</td>
                                                    <td>{{ number_format($extra['he25'], 2) }}</td>
                                                    <td>${{number_format($extra['monto25'],2)}}</td>
                                                    <td>{{ number_format($extra['he50'], 2) }}</td>
                                                    <td>${{number_format($extra['monto50'],2)}}</td>
                                                    <td>{{ number_format($extra['he100'], 2) }}</td>
                                                    <td>${{number_format($extra['monto100'],2)}}</td>
                                                    <td>${{number_format($extra['total'],2)}}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <div wire.ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span>Agregar Timbre</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <form autocomplete="off">
                    
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="empleado" class="form-label">Empleado</label>
                            <select class="form-select" data-choices data-choices-search-false
                                name="choices-single-default" id="cmbnivel" wire:model.defer="record.codigo">
                                <option value="" selected>--Seleccione Empleado--</option>
                                @foreach ($empleados as $empleado)
                                <option value="{{$empleado->nui}}">{{$empleado->apellidos}} {{$empleado->nombres}}</option>
                                @endforeach
                            </select>
                        </div>    
                        <div class="row mb-3">
                            <div class="col-sm-8">
                            <label for="cmbtiporol" class="form-label">Fecha Timbre</label>
                            <input id="dfechaini" name="dateIni" type="date" class="form-control"
                                data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                wire:model.defer="record.fecha" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="hentrada" class="form-label">Hora Timbre</label>
                                <input type="time" wire:model.defer="record.hora" class="form-control" name="hentrada" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="cmbtiporol" class="form-label">Acción</label>
                            <select type="select" class="form-select" data-trigger name="funcion" wire:model.defer="record.funcion">
                            <option value="">--Seleccione Acción--</option>
                            <option value="0">Entrada</option>
                            <option value="2">Salida Almuerzo</option>
                            <option value="3">Entrada Almuerzo</option>
                            <option value="1">Salida</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" id="add-btn" wire:click="grabaTimbre">Grabar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>