<div>
    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Total de Tickets</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="547">0</span>k
                            </h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                    <i class="ri-arrow-up-line align-middle"></i> 17.32 %
                                </span> vs. Meses anteriores</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-ticket-2-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Tickets Pendientes</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                    data-target="124">0</span>k</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                    <i class="ri-arrow-down-line align-middle"></i> 0.96 %
                                </span> vs. Meses anteriores</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="mdi mdi-timer-sand"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Tickets Cerrados</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                    data-target="107">0</span>K</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                    <i class="ri-arrow-down-line align-middle"></i> 3.87 %
                                </span> vs. Meses anteriores</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-shopping-bag-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Tickets Eliminados</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                    data-target="15.95">0</span>%</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                    <i class="ri-arrow-up-line align-middle"></i> 1.09 %
                                </span> vs. Meses Anteriores</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-delete-bin-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Tickets</h5>
                        <div class="flex-shrink-0">
                            <button class="btn btn-danger add-btn" wire:click = "addData()"><i
                                    class="ri-add-line align-bottom me-1"></i> Crear Tickets</button>
                            <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                    class="ri-delete-bin-2-line"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-12">
                                <div class="search-box">
                                    <input type="text" class="form-control search bg-light border-light"
                                        placeholder="Search for ticket details or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-3 col-sm-4">
                                <input type="text" class="form-control bg-light border-light" data-provider="flatpickr"
                                    data-date-format="d M, Y" data-range-date="true" id="demo-datepicker"
                                    placeholder="Select date range">
                            </div>
                            <!--end col-->

                            <div class="col-xxl-3 col-sm-4">
                                <div class="input-light">
                                    <select class="form-control" data-choices data-choices-search-false
                                        name="choices-single-default" id="idStatus">
                                        <option value="">Estado</option>
                                        <option value="all" selected>Todos</option>
                                        <option value="A">Abiertos</option>
                                        <option value="P">En progreso</option>
                                        <option value="F">Finalizados</option>
                                        <option value="N">Nuevos</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                        class="ri-equalizer-fill me-1 align-bottom"></i>
                                    Filtrar
                                </button>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <!--end card-body-->
                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 40px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th class="sort" data-sort="tipo">Tipo</th>
                                    <th class="sort" data-sort="tasks_name">Titulo</th>
                                    <th class="sort" data-sort="client_name">Usuario</th>
                                    <th class="sort" data-sort="assignedto">Asignado</th>
                                    <th class="sort" data-sort="create_date">Fecha de Creación</th>
                                    <th class="sort" data-sort="due_date">Fecha de Finalización</th>
                                    <th class="sort" data-sort="status">Estado</th>
                                    <th class="sort" data-sort="priority">Prioridad</th>
                                    <th class="sort" data-sort="action">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="ticket-list-data">
                                @foreach($temp as $recno)
                                <?php
                                    $estado = $recno->estado;
                                    $tipo = $recno->tipo;
                                ?>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checkAll"
                                                value="option1">
                                        </div>
                                    </th>
                                    <!--<td class="id"><a href="javascript:void(0);" onclick="ViewTickets(this)"
                                            data-id="001" class="fw-medium link-primary">#VLZ001</a></td>-->
                                    <td class="priority"><span class="badge bg-danger text-uppercase">@lang("status.{$tipo}")</span>
                                    <td class="tasks_name">{{$recno->titulo}}</td>
                                    <td class="client_name">{{$recno->usuario}}</td>
                                    <td class="assignedto">{{$recno->asignado}}</td>
                                    <td class="create_date">{{$recno->fecha}}</td>
                                    <td class="due_date">{{$recno->fechafin}}</td>
                                    <td class="status"><span class="badge badge-soft-warning text-uppercase"> @lang("status.{$estado}") </span></td>
                                    <td class="priority"><span class="badge bg-danger text-uppercase">{{$recno->prioridad}}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><button class="dropdown-item"
                                                        onclick="location.href = 'apps-tickets-details';"><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                        Listar</button></li>
                                                <li><a class="dropdown-item asignar-item-btn" href=""
                                                        data-bs-toggle="modal" wire:click="asignar({{$recno->id}})"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Asignar a</a></li>
                                                <li>
                                                    <a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                        href="#deleteOrder">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Eliminar
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @foreach($tempenv as $recno2)
                                <?php
                                    $estado = $recno2->estado;
                                    $tipo = $recno2->tipo;
                                ?>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checkAll"
                                                value="option1">
                                        </div>
                                    </th>
                                    <!--<td class="id"><a href="javascript:void(0);" onclick="ViewTickets(this)"
                                            data-id="001" class="fw-medium link-primary">#VLZ001</a></td>-->
                                    <td class="priority"><span class="badge bg-danger text-uppercase">@lang("status.{$tipo}")</span>
                                    <td class="tasks_name">{{$recno2->titulo}}</td>
                                    <td class="client_name">{{$recno2->userenv}}</td>
                                    <td class="assignedto">{{$recno2->enviado}}</td>
                                    <td class="create_date">{{$recno2->fecha}}</td>
                                    <td class="due_date">{{$recno2->fechafin}}</td>
                                    <td class="status">
                                    <button id = "estadoBtn" class="btn badge bg-secondary-subtle text-secondary-emphasis status-button" onclick="cambiarEstado()">
                                        @lang("status.{$estado}")
                                    </button>
                                    </td>
                                    <td class="priority"><span class="badge bg-danger text-uppercase">{{$recno2->prioridad}}</span>
                                    </td>
                                    <td>
                                        
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <!--<li><button class="dropdown-item"
                                                        onclick="location.href = 'apps-tickets-details';"><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                        Listar</button></li>-->
                                                <li><a class="dropdown-item asignar-item-btn" href=""
                                                        data-bs-toggle="modal" wire:click="asignar({{$recno2->id}})"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Modificar</a></li>
                                                <!--<li>
                                                    <a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                        href="#deleteOrder">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Eliminar
                                                    </a>
                                                </li>-->
                                            </ul>
                                        
                                    </td>
                                </tr>
                                <script>
                                    const boton = document.getElementById('estadoBtn');

                                    // Definimos los estados y sus clases de estilo
                                    const estados = [
                                    { texto: "Nuevo", clase: "bg-secondary-subtle text-secondary-emphasis" },
                                    { texto: "En Proceso", clase: "bg-primary-subtle text-primary-emphasis" },
                                    { texto: "Completado", clase: "bg-success-subtle text-success-emphasis" }
                                    ];

                                    let indiceEstado = 0;

                                    boton.addEventListener('click', () => {
                                    // Eliminar todas las clases actuales de estilo
                                    boton.className = 'btn badge status-button';
                                    
                                    // Incrementar índice y volver a 0 si llegamos al final
                                    indiceEstado = (indiceEstado + 1) % estados.length;

                                    const nuevoEstado = estados[indiceEstado];

                                    // Agregar nuevas clases y actualizar texto
                                    boton.textContent = nuevoEstado.texto;
                                    boton.classList.add(...nuevoEstado.clase.split(' '));
                                    });
                                </script>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">Lo sentimos! Resultado no encontrado</h5>
                                <p class="text-muted mb-0">Hemos buscado más de 150 tickets.
                                    No encontramos ninguna para tu búsqueda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="#">
                                Anterior
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="#">
                                Siguiente
                            </a>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                    </lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4>Estás a punto de eliminar un ticket ?</h4>
                                        <p class="text-muted fs-14 mb-4">Al eliminar su ticket, se eliminará toda 
                                            su información de nuestra base de datos..</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                                Close</button>
                                            <button class="btn btn-danger" id="delete-record">Si, Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end modal -->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <div wire.ignore.self class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                    <div class="modal-body">
                        <div class="row g-3">
                            <!--<div class="col-lg-12">
                                <div id="modal-id">
                                    <label for="orderId" class="form-label">ID</label>
                                    <input type="text" id="orderId" class="form-control" placeholder="ID" value="#VLZ462"
                                        readonly />
                                </div>
                            </div>-->
                            <div class="col-lg-6">
                                <label for="ticket-tipo" class="form-label">Tipo de Ticket</label>
                                <select class="form-control" data-plugin="choices" name="ticket-tipo"
                                    id="ticket-tipo" wire:model.defer="record.tipo">
                                    <option value="">Tipo</option>
                                    <option value="M">Mantenimiento</option>
                                    <option value="S">Soporte</option>
                                    <option value="C">Corrección</option>
                                    <option value="R">Reporte</option>
                                    <option value="E">Errores Sistema</option>
                                    <option value="W">Cambios Sistema</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="tasksTitle-field" class="form-label">Titulo</label>
                                    <input type="text" id="tasksTitle-field" class="form-control" placeholder="Titulo"
                                        wire:model.defer="record.titulo" required />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="client_nameName-field" class="form-label">Usuario</label>
                                    <input type="text" id="client_nameName-field" class="form-control"
                                        placeholder="Nombre de usuario" wire:model.defer="record.usuario" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="assignedtoName-field" class="form-label">Asignado a</label>
                                    <input type="text" id="assignedtoName-field" class="form-control"
                                        placeholder="Asignado a" wire:model.defer="record.asignado" required />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="date-field" class="form-label">Fecha de creación</label>
                                <input type="date" id="date-field" class="form-control" data-provider="flatpickr"
                                    data-date-format="d M, Y" placeholder="Create Date" wire:model.defer="record.fecha" required />
                            </div>
                            <!--<div class="col-lg-6">
                                <label for="duedate-field" class="form-label">Due Date</label>
                                <input type="text" id="duedate-field" class="form-control" data-provider="flatpickr"
                                    data-date-format="d M, Y" placeholder="Due Date" required />
                            </div>-->
                            <div class="col-lg-6">
                                <label for="ticket-status" class="form-label">Estado</label>
                                <select class="form-control" data-plugin="choices" name="ticket-status"
                                    id="ticket-status" wire:model.defer="record.estado">
                                    <option value="">Estado</option>
                                    <option value="N">Nuevo</option>
                                    <option value="P">En Progreso</option>
                                    <option value="F">Finalizado</option>
                                    <option value="A">Abierto</option>
                                </select>
                            </div>
                            <div>
                                <label for="exampleFormControlTextarea5" class="form-label">Descripción</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" wire:model.defer="record.descripcion"></textarea>
                            </div>
                            @if($asignara == true)
                            <div class="col-lg-6">
                                <label for="date-ini" class="form-label">Fecha inicio</label>
                                <input type="date" id="date-ini" class="form-control" data-provider="flatpickr"
                                    data-date-format="d M, Y" placeholder="Create Date" wire:model.defer="record.fechaini"/>
                            </div>
                            <div class="col-lg-6">
                                <label for="date-fin" class="form-label">Fecha fin</label>
                                <input type="date" id="date-fin" class="form-control" data-provider="flatpickr"
                                    data-date-format="d M, Y" placeholder="Create Date" wire:model.defer="record.fechafin"/>
                            </div>
                            @endif
                            <div class="col-lg-6">
                                <label for="priority-field" class="form-label">Prioridad</label>
                                <select class="form-control" data-plugin="choices" name="priority-field"
                                    id="priority-field" wire:model.defer="record.prioridad">
                                    <option value="">Prioridad</option>
                                    <option value="A">Alta</option>
                                    <option value="M">Media</option>
                                    <option value="B">Baja</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Agregar Ticket</button>
                            <button type="button" class="btn btn-success" id="edit-btn">Modificar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
