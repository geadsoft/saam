<div>
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-75 text-truncate mb-0">
                                            Dias disfrutados/aprobados </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-white fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            <!--+16.24 %-->
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                class="counter-value" data-target="0">21/31</span>
                                        </h4>
                                        <a href="" class="text-decoration-underline text-white-50">Visualizar</a>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-75 text-truncate mb-0">
                                            Dias aprobados/disponibles</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-white fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            <!---3.57 %-->
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                class="counter-value" data-target="0">31/299</span>
                                        </h4>
                                        <a href="" class="text-decoration-underline text-white-50">Visualizar</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-light rounded fs-3">
                                            <i class="bx bx-shopping-bag text-white"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-75 text-truncate mb-0">
                                            Peticiones sin gestionar</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-white fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            <!--+29.08 %-->
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                class="counter-value" data-target="0">6/14</span>
                                        </h4>
                                        <a href="" class="text-decoration-underline text-white-50">Visualizar</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-light rounded fs-3">
                                            <i class="bx bx-user-circle text-white"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                            Peticiones denegadas/gestionadas</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-white fs-14 mb-0">
                                            +0.00 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4">$<span
                                                class="counter-value" data-target="0">3/8</span>
                                        </h4>
                                        <a href="/payroll/nominas"
                                            class="text-decoration-underline text-white-50">Visualizar Nominas</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-light rounded fs-3">
                                            <i class="bx bx-wallet text-white"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row g-3">
                                <div class="col-xxl-5 col-sm-6">
                                    <label for="cmbtiporol" class="form-label">Buscar</label>
                                    <div class="search-box">
                                        <input type="text" class="form-control search"
                                            placeholder="Burcar por descripción..." wire:model.live="filters.buscar">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <label for="cmbtiporol" class="form-label">Estado</label>
                                        <select class="form-select" data-choices data-choices-search-false
                                            name="choices-single-default" id="cmbestado"
                                            wire:model.live="filters.estado">
                                            <option value="">-- Estado --</option>
                                            <option value="S">Solicitado</option>
                                            <option value="A">Aprobado</option>
                                            <option value="D">Denegada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-sm-4">
                                    <label for="cmbtiporol" class="form-label">Departamento</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel"
                                        wire:model.live="filters.departamento">
                                        <option value="" selected>Seleccione Departamento</option>
                                        @foreach ($departs as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12">
                    <div class="card" id="contactList">
                        <ul class="nav nav-tabs nav-border-top nav-border-top-primary" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ $this->filters['tab'] == 'vacaciones' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#tab-vacaciones" role="tab">
                                    Vacaciones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $this->filters['tab'] == 'calendario' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#tab-calendario" role="tab">
                                    Calendario
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $this->filters['tab'] == 'empleados' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#tab-empleados" role="tab">
                                    Empleados
                                </a>
                            </li>
                            <li class="nav-item ms-auto mt-2 me-2">
                                <a href="javascript:void(0);" class="btn btn-soft-primary btn-sm"
                                    wire:click.prevent="add()">
                                    Agregar Vacaciones
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mb-3">
                            <div class="tab-pane fade {{ $this->filters['tab'] == 'vacaciones' ? 'show active' : '' }}"
                                id="tab-vacaciones" role="tabpanel">
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table class="table table-sm table-nowrap align-middle" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Cargo</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Solicitador Por</th>
                                                    <th scope="col">Fecha Solicitud</th>
                                                    <th scope="col">Fecha Inicio</th>
                                                    <th scope="col">Fecha Fin</th>
                                                    <th class="text-center">Total Dias</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach($tblrecords as $fil => $record)
                                                <tr id="{{$fil}}" class="detalle">
                                                    <td>{{$record->id}}</td>
                                                    <td>{{$record->apellidos}} {{$record->nombres}}</td>
                                                    <td>{{$record->cargo}}</td>
                                                    <td>
                                                        <span class="badge {{$estado[$record->estado]['color']}} text-uppercase">{{$estado[$record->estado]['estado']}}</span>
                                                    </td>
                                                    <td>{{$record->usuario}}</td>
                                                    <td>{{ date('d/m/Y', strtotime($record->fecha)) }}</td>
                                                    <td class="text-success">{{$record->fecha_empieza}}</td>
                                                    <td class="text-info">{{$record->fecha_termina}}</td>
                                                    <td class="text-center">{{$record->dias}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-soft-secondary btn-sm dropdown"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                                                <li><button class="dropdown-item"
                                                                        href="javascript:void(0);"
                                                                        data-id="btnap-{{$fil}}"
                                                                        wire:click="aprobar({{$record->id}})"><i
                                                                            class="las la-thumbs-up align-bottom me-2 text-muted"></i>
                                                                        Aprobar</button></li>
                                                                <li><button class="dropdown-item"
                                                                        href="javascript:void(0);"
                                                                        data-id="btnde--{{$fil}}"><i
                                                                            class="las la-thumbs-down align-bottom me-2 text-muted"></i>
                                                                        Denegar</button></li>
                                                                @if($record->estado=='S')
                                                                <li><button class="dropdown-item"
                                                                        href="javascript:void(0);"
                                                                        data-id="btnap-{{$fil}}"
                                                                        wire:click="edit({{$record}})"><i
                                                                            class="las la-pen align-bottom me-2 text-muted"></i>
                                                                        Editar</button></li>
                                                                @endif
                                                                <li class="dropdown-divider"></li>
                                                                <li>
                                                                    <a class="dropdown-item remove-item-btn" href="#"
                                                                        x-data @click.prevent="
                                                                                    Swal.fire({
                                                                                        title: '¿Anular solicitud?',
                                                                                        text: 'Se eliminarán los movimientos y se restaurarán los días disponibles.',
                                                                                        icon: 'warning',
                                                                                        showCancelButton: true,
                                                                                        confirmButtonColor: '#d33',
                                                                                        confirmButtonText: 'Sí, anular',
                                                                                        cancelButtonText: 'Cancelar'
                                                                                    }).then(result => {
                                                                                        if (result.isConfirmed) {
                                                                                            $wire.anularSolicitud({{ $record->id }})
                                                                                        }
                                                                                    })">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Eliminar
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$tblrecords->links('')}}

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ $this->filters['tab'] == 'calendario' ? 'show active' : '' }}"
                                id="tab-calendario" role="tabpanel">

                                <div class="col-xl-12">
                                    <div class="card card-h-100">
                                        <div class="card-body" wire:ignore>
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>

                                <div style="clear:both"></div>
                            </div>
                            <div class="tab-pane fade {{ $this->filters['tab'] == 'empleados' ? 'show active' : '' }}"
                                id="tab-empleados" role="tabpanel">
                                <div class="table-responsive">
                                    <div class="card-body">
                                        <div style="overflow-x:auto;">
                                            <table class="table table-nowrap align-middle" style="width:100%">
                                                <thead class="txt-muted">
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Area</th>
                                                        <th>Departamento</th>
                                                        <th>
                                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Dias Disponibles">
                                                                <i class="mdi mdi-beach fs-18"></i>
                                                            </li>
                                                        </th>
                                                        <th>
                                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Dias Aprobados">
                                                                <i class="mdi mdi-calendar-check fs-18"></i>
                                                            </li>
                                                        </th>
                                                        <th>
                                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Dias por Validar">
                                                                <i class="mdi mdi-calendar-clock fs-18"></i>
                                                            </li>
                                                        </th>
                                                        <th>
                                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Dias Pendientes">
                                                                <i class="mdi mdi-calendar-blank fs-18"></i>
                                                            </li>
                                                        </th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach($vacaciones as $fil => $data)
                                                    <tr id="{{$fil}}" class="detalle">
                                                        <td>
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <img src="@if ($data->foto != '') {{ URL::asset('storage/fotos/'.$data->foto) }}@else{{ URL::asset('assets/images/users/avatar-7.jpg') }} @endif"
                                                                        alt="" class="avatar-xs rounded-circle">
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    {{$data->apellidos}} {{$data->nombres}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$data->area}}</td>
                                                        <td>{{$data->departamento}}</td>
                                                        <td>{{$data->disponibles}}</td>
                                                        <td>{{$data->aprobadas}}</td>
                                                        <td>{{$data->solicitadas}}</td>
                                                        <td>{{$data->disponibles}}</td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item edit"
                                                                    data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Ver detalle">
                                                                    <a href="/rrhh/vacaciones-historial/{{$data['id']}}"
                                                                        target="_blank">
                                                                        <i class="las la-eye fs-22 text-info"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{$vacaciones->links('')}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>

    <div wire:ignore.self class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3" style="background-color: #024750;">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        {{ $showEditModal ? 'Actualizar Vacaciones' : 'Registrar Vacaciones' }}</h5>
                    <button type="button" class="btn border-0" data-bs-dismiss="modal">
                        <i class="mdi mdi-close-thick text-danger fs-4"></i>
                    </button>
                </div>
                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-9">
                                <div>
                                    <label for="cmbpersona" class="form-label">Empleado</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbpersona"
                                        wire:model.defer="record.personaId" required @disabled($showEditModal)>
                                        <option value="" selected>Seleccione Empleado</option>
                                        @foreach ($personas as $persona)
                                        <option value="{{$persona->id}}">{{$persona->apellidos}} {{$persona->nombres}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="orderId" class="form-label">Fecha Solicitud</label>
                                <input id="dfecha" name="date" type="date" class="form-control"
                                    data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                    wire:model.defer="record.fecha" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label for="date-field" class="form-label">Fecha Empieza</label>
                                <div class="d-flex gap-2">
                                    <input id="dfechaini" name="dateIni" type="date" class="form-control"
                                        data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                        wire:model.defer="record.fechadesde" required>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="duedate-field" class="form-label">Fecha Finaliza</label>
                                <div class="d-flex gap-2">
                                    <input id="dfechafin" name="dateIni" type="date" class="form-control"
                                        data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                        wire:model.defer="record.fechahasta" required>

                                </div>
                            </div>
                            @error('fecha_fin')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="col-lg-12">
                                <div>
                                    <label for="assignedtoName-field" class="form-label">Comentario</label>
                                    <textarea class="form-control" id="txtcoment" rows="3"
                                        wire:model.defer="record.comentario"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Grabar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire.ignore.self class="modal fade flip" id="frmAprobar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5 text-center">
                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                        colors="primary:#024750,secondary:#f06548" style="width:150px;height:150px">
                    </lord-icon>

                    <div class="mt-4 text-center">
                        <h4>¿Desea aprobar las vacaciones de {{ $selectValue }}?</h4>
                        <p class="text-muted fs-15 mb-4">
                            Al aprobar, se descontarán los días correspondientes del período disponible.
                        </p>
                        <div class="hstack gap-2 justify-content-center remove">
                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                Cerrar </button>
                            <button class="btn btn-danger" id="delete-record" wire:click="aprobarVacaciones()"> Si,
                                Aprobar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>