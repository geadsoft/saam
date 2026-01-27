<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Gestion de Permisos</h5>
                        <div class="flex-shrink-0">
                            <button type="button" wire:click.prevent="add()" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Agregar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-4 col-sm-4">
                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Burcar por descripción..." wire:model.live="filters.descripcion">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <select class="form-select" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbnivel" wire:model.live="filters.departamento">
                                    <option value="" selected>-- Departamento --</option>
                                    @foreach ($departs as $departamento)
                                    <option value="{{$departamento->id}}">{{$departamento->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <select class="form-select" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbnivel" wire:model.live="filters.periodo">
                                    <option value="" selected>-- Periodo --</option>
                                    @foreach ($tblperiodos as $periodo)
                                    <option value="{{$periodo->periodo}}">{{$periodo->periodo}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbestado" wire:model="filters.estado">
                                        <option value="">-- Estado --</option>
                                        <option value="S">Solicitado</option>
                                        <option value="A">Aprobado</option>
                                        <option value="C">Cerrado</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="button" class="btn btn-primary w-100" wire:click="resetFilter();"> <i
                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Todos
                                    </button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th>Estado</th>
                                        <th>Nombre</th>
                                        <th>Permiso</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Cantidad</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>                                    
                                        <td>
                                            <span class="badge {{$estado['S']['color']}} text-uppercase fs-11">{{$estado['S']['estado']}}</span>
                                        </td>
                                        <td>{{$record->persona->apellidos}} {{$record->persona->nombres}}</td> 
                                        <td>{{$record->referencia}}</td>
                                        <td>{{$record->fecha}}</td>
                                        <td class="text-success">{{$record->fecha_empieza}}</td>
                                        <td class="text-info">{{$record->fecha_termina}}</td>
                                        <td>{{$record->tiempo}}</td>                                        
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a href="" wire:click.prevent="edit({{ $record }})">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
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
                       
                        {{$tblrecords->links('')}}                        

                    </div>

                    <!-- Modal -->
                    <div wire.ignore.self class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true" wire:model='selectId'>
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                    </lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4>¿Está a punto de inactivar el registro? {{ $selectValue }}</h4>
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

                    <!--end modal -->
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <div wire:ignore.self class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3" style="background-color: #024750;">
                    <h5 class="modal-title text-white" id="exampleModalLabel" > {{ $showEditModal ? 'Actualizar Permiso' : 'Registrar Permiso' }}</h5>
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
                                <div>
                                    <label for="client_nameName-field" class="form-label">Referencia</label>
                                    <input type="text" id="client_nameName-field" class="form-control"
                                        placeholder="Ingrese referencia.." wire:model.defer="record.referencia" required />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="client_nameName-field" class="form-label">Remuneración</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="S" wire:model.defer="record.remuneracion" required>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Con goce
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="N" wire:model.defer="record.remuneracion" required>
                                        <label class="form-check-label" for="flexRadioDefault2"> 
                                            Sin goce
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="date-field" class="form-label">Fecha Empieza</label>
                                <div class="d-flex gap-2">
                                    <input id="dfechaini" name="dateIni" type="date" class="form-control"
                                    data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                    wire:model.defer="record.fechadesde" required>
                                    <input type="time" class="form-control" id="timeini" wire:model.defer="record.horadesde" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="duedate-field" class="form-label">Fecha Finaliza</label>
                                <div class="d-flex gap-2">
                                    <input id="dfechafin" name="dateIni" type="date" class="form-control"
                                    data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                    wire:model.defer="record.fechahasta" required>
                                    <input type="time" class="form-control" id="timefin" wire:model.defer="record.horahasta" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="assignedtoName-field" class="form-label">Comentario</label>
                                    <textarea class="form-control" id="txtcoment" rows="3" wire:model.defer="record.comentario"></textarea>
                                </div>
                            </div>
                            <!--<div class="col-lg-6">
                                <label for="ticket-status" class="form-label">Estado</label>
                                <select class="form-control" data-plugin="choices" name="ticket-status"
                                    id="ticket-status">
                                    <option value="S">Solicitado</option>
                                    <option value="A">Aprobado</option>
                                    <option value="C">Cerrada</option>
                                </select>
                            </div>-->
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
