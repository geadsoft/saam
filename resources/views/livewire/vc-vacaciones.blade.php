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
                                    <div class="search-box">
                                        <input type="text" class="form-control search"
                                            placeholder="Burcar por descripción..." wire:model="filters.descripcion">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <label for="cmbtiporol" class="form-label">Estado</label>
                                        <select class="form-select" data-choices data-choices-search-false
                                            name="choices-single-default" id="cmbestado" wire:model="filters.estado">
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
                                <div class="col-xxl-2 col-sm-4">
                                    <label for="cmbtiporol" class="form-label">Periodo</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.periodo">
                                        <option value="" selected>-- Periodo --</option>
                                        @foreach ($tblperiodos as $periodo)
                                        <option value="{{$periodo->periodo}}">{{$periodo->periodo}}</option>
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
                            <div class="tab-pane fade {{ $this->filters['tab'] == 'timbres' ? 'show active' : '' }}"
                                id="tab-vacaciones" role="tabpanel">
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
                                                        <th scope="col">Cargo</th>
                                                        <th scope="col">Estado</th>
                                                        <th scope="col">Solicitador Por</th>
                                                        <th scope="col">Fecha Solicitud</th>
                                                        <th scope="col">Fecha Inicio</th>
                                                        <th scope="col">Fecha Fin</th>
                                                        <th scope="col">Total Dias</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ $this->filters['tab'] == 'extras' ? 'show active' : '' }}"
                                id="tab-calendario"
                                role="tabpanel">

                                <div class="col-xl-12">
                                    <div class="card card-h-100">
                                        <div class="card-body" wire:ignore>
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>

                                <div style="clear:both"></div>
                            </div>
                            <div class="tab-pane fade {{ $this->filters['tab'] == 'extras' ? 'show active' : '' }}"
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
                                                        <th><i class="mdi mdi-beach fs-18"></i></th>
                                                        <th><i class="mdi mdi-calendar-check fs-18"></i></th>
                                                        <th><i class="mdi mdi-calendar-clock fs-18"></i></th>
                                                        <th><i class="mdi mdi-calendar-blank fs-18"></i></th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach($vacaciones as $fil => $data)
                                                    <tr id="{{$fil}}" class="detalle">
                                                        <td>
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <img src="{{ URL::asset('assets/images/users/avatar-3.jpg')}}"
                                                                        alt="" class="avatar-xs rounded-circle">
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    {{$data['empleado']}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$data['area']}}</td>
                                                        <td>{{$data['departamento']}}</td>
                                                        <td>{{$data['disponibles']}}</td>
                                                        <td>{{$data['aprobadas']}}</td>
                                                        <td>{{$data['validacion']}}</td>
                                                        <td>{{$data['pendientes']}}</td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item edit"
                                                                    data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top" title="Ver detalle">
                                                                    <a href="/rrhh/vacaciones/{{$data['id']}}">
                                                                        <i class="las la-eye fs-22 text-info"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
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
                    <!--end card-->
                </div>
            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>

    <div wire:ignore.self class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3" style="background-color: #024750;">
                    <h5 class="modal-title text-white" id="exampleModalLabel" > {{ $showEditModal ? 'Actualizar Vacaciones' : 'Registrar Vacaciones' }}</h5>
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
                                        name="choices-single-default" id="cmbpersona" wire:model.defer="record.personaId" required  @disabled($showEditModal)>
                                        <option value="" selected>Seleccione Empleado</option>
                                        @foreach ($personas as $persona) 
                                            <option value="{{$persona->id}}">{{$persona->apellidos}} {{$persona->nombres}}</option>
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
                            <div class="col-lg-12">
                                <div>
                                    <label for="assignedtoName-field" class="form-label">Comentario</label>
                                    <textarea class="form-control" id="txtcoment" rows="3" wire:model.defer="record.comentario"></textarea>
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

</div>