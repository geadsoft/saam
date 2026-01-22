<div>
    <div class="row">
        <!--<div class="col-xxl-3 col-sm-6">
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
                </div> 
            </div>  
        </div> -->
        <!--end col-->
        <!--<div class="col-xxl-3 col-sm-6">
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
                </div>
            </div>
        </div>-->
        <!--end col-->
        <!--<div class="col-xxl-3 col-sm-6">
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
                </div>
            </div>
        </div>-->
        <!--end col-->
        <!--<div class="col-xxl-3 col-sm-6">
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
                </div>
            </div>
        </div>-->
    </div>
    <!--end row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Inventario</h5>
                        <div class="flex-shrink-0">
                            <button class="btn btn-danger add-btn" wire:click = "addData()"><i
                                    class="ri-add-line align-bottom me-1"></i> Ingresar Inventario</button>
                            <!--<button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                    class="ri-delete-bin-2-line"></i></button>-->
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <!--
                            <div class="col-xxl-5 col-sm-12">
                                <div class="search-box">
                                    <input type="text" class="form-control search bg-light border-light"
                                        placeholder="Search for ticket details or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            
                            <div class="col-xxl-3 col-sm-4">
                                <input type="text" class="form-control bg-light border-light" data-provider="flatpickr"
                                    data-date-format="d M, Y" data-range-date="true" id="demo-datepicker"
                                    placeholder="Select date range">
                            </div>

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
                            <div class="col-xxl-1 col-sm-4">
                                <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                        class="ri-equalizer-fill me-1 align-bottom"></i>
                                    Filtrar
                                </button>
                            </div>l-->
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
                                    <!--<th scope="col" style="width: 40px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th> -->
                                    <th class="sort" data-sort="tipo">Fecha</th>
                                    <th class="sort" data-sort="tasks_name">Tanque</th>
                                    <th class="sort" data-sort="client_name">Producto</th>
                                    <th class="sort" data-sort="assignedto">Toneladas</th>
                                    <th class="sort" data-sort="create_date">Ubicación</th>
                                    <th class="sort" data-sort="due_date">Acidez</th>
                                    <th class="sort" data-sort="status">Humedad</th>
                                    <th class="sort" data-sort="priority">Impureza</th>
                                    <th class="sort" data-sort="action">Color</th>
                                    <th class="sort" data-sort="action">Peroxido</th>
                                    <th class="sort" data-sort="action">Referencia</th>
                                    <th class="sort" data-sort="action">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="ticket-list-data">
                                @foreach($tblrecord as $recno)
                                <tr>
                                    <td class="priority">{{date('d/m/Y',strtotime($recno->fecha))}}</td>
                                    <td class="tasks_name">{{$recno->tanque}}</td>
                                    <td class="client_name">{{$recno->producto}}</td>
                                    <td class="assignedto">{{$recno->toneladas}}</td>
                                    <td class="create_date">{{$recno->ubicacion}}</td>
                                    <td class="due_date">{{$recno->acidez}}</td>
                                    <td class="due_date">{{$recno->humedad}}</td>
                                    <td class="due_date">{{$recno->impureza}}</td>
                                    <td class="due_date">{{$recno->color}}</td>
                                    <td class="due_date">{{$recno->peroxido}}</td>
                                    <td class="due_date">{{$recno->referencia}}</td>
                                    <td>
                                        <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a href="" wire:click.prevent="edit({{ $recno->id}})">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                        data-bs-toggle="modal" href="" wire:click.prevent="delete({{ $recno->id }})">
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
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">Lo sentimos! Resultado no encontrado</h5>
                                <p class="text-muted mb-0">Hemos buscado más de 150 tickets.
                                    No encontramos ninguna para tu búsqueda.</p>
                            </div>
                        </div>
                        {{$tblrecord->links()}}
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
                                        <h4>Estás a punto de eliminar un registro ?</h4>
                                        <p class="text-muted fs-14 mb-4">Al eliminar el registro, se eliminará toda 
                                            su información de nuestra base de datos..</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                                Close</button>
                                            <button class="btn btn-danger" id="delete-record" wire:click="deleteData">Si, Eliminar</button>
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
                            <div class="col-lg-6">
                            <div class= "mb-3">    
                                <label for="ticket-tipo" class="form-label">Fecha</label>
                                <input type="date" id="fecha" class="form-control" data-provider="flatpickr"
                                    data-date-format="d M, Y" placeholder="Create Date" wire:model.defer="record.fecha" required  {{$editControl}} />
                            </div>
                            <div class= "mb-3">
                                <label for="ticket-tipo" class="form-label">Tanque</label>
                                <input type="text" id="tanque" class="form-control" placeholder="Tanque"
                                        wire:model.defer="record.tanque" required />
                            </div> </div>
                            <div class="row">
                                <div class= "col-lg-8 mb-3"> 
                                    <label for="ticket-tipo" class="form-label">Producto</label>   
                                    <select class="form-select" data-plugin="choices" name="ticket-tipo"
                                        id="select-producto" wire:model.defer="record.producto">
                                        <option value="P001">Aceite crudo de palma Guineense</option>
                                        <option value="P002">Aceite crudo de Palma Hibrido</option>
                                        <option value="P003">Aceite Refinado de Palma Guineense</option>
                                        <option value="P004">Aceite Refinado de Palma Hibrido</option>
                                        <option value="P005">Lodo de Palma Guineense</option>
                                        <option value="P006">Lodo de Palma Hibrido</option>
                                        <option value="P007">Palmiste Hibrido</option>
                                        <option value="P008">Palmiste Guineense</option>
                                        <option value="P009">Fibra</option>
                                        <option value="P010">Aceite de Palmiste (PKO)</option>
                                        <option value="P011">Pasta de Palmiste</option>
                                        <option value="P012">Cascarilla Limpia</option>
                                        <option value="P013">Cascarilla con fibra</option>
                                        <option value="P014">Acido Graso</option>
                                        <option value="P015">Pome</option>
                                        <option value="P016">Oleina de Palma Guineense</option>
                                        <option value="P017">Oleina de Palma Hibrida</option>
                                        <option value="P018">Estearina de Palma Guineense</option>
                                        <option value="P019">Estearina  de Palma Hibrida</option>
                                        <option value="P020">Aceite de Soya</option>
                                        <option value="P021">Aceite de Palma Reproceso</option>
                                    </select>
                                </div>
                            
                                <div class= "col-lg-4 mb-3">
                                    <label for="ticket-tipo" class="form-label">Toneladas</label>
                                    <input type="numeric" id="tonelada" class="form-control" placeholder="Toneladas"
                                            wire:model.defer="record.tonelada" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class= "mb-3"> 
                                    <label for="ticket-tipo" class="form-label">Ubicación</label>   
                                    <select class="form-select" data-plugin="choices" name="ticket-tipo"
                                            id="select-ubicacion" wire:model.defer="record.ubicacion">
                                            <option value="U001">Extractora - Quevedo</option>
                                            <option value="U002">Refineria - Quevedo</option>
                                            <option value="U003">Palmisteria - Quevedo</option>
                                            <option value="U004">Procepalma- Santo Domingo</option>
                                            <option value="U005">Oleana - Esmeraldas</option>
                                            <option value="U006">Oliojoya - Esmeraldas</option>
                                            <option value="U007">Extractora - Oriente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class= "col-lg-2 mb-3">
                                    <label for="ticket-tipo" class="form-label">Acidez</label>
                                    <input type="numeric" id="acidez" class="form-control" placeholder="Acidez"
                                            wire:model.defer="record.acidez" required />
                                </div>
                                <div class= "col-lg-2 mb-3">
                                    <label for="ticket-tipo" class="form-label">Humedad</label>
                                    <input type="numeric" id="humedad" class="form-control" placeholder="Humedad"
                                            wire:model.defer="record.humedad" required />
                                </div>
                                <div class= "col-lg-2 mb-3">
                                    <label for="ticket-tipo" class="form-label">Impureza</label>
                                    <input type="numeric" id="impureza" class="form-control" placeholder="Impureza"
                                            wire:model.defer="record.impureza" required />
                                </div>
                                <div class= "col-lg-6 mb-3">
                                    <label for="ticket-tipo" class="form-label">Color</label>
                                    <input type="text" id="color" class="form-control" placeholder="Color"
                                            wire:model.defer="record.color" required />
                                </div>
                            </div>
                                <div class="row">
                                <div class= "mb-3">
                                    <label for="ticket-tipo" class="form-label">Peroxido</label>
                                    <input type="numeric" id="peroxido" class="form-control" placeholder="Peroxido"
                                            wire:model.defer="record.peroxido" required />
                                </div>
                                <!--<div class= "mb-3">
                                    <label for="ticket-tipo" class="form-label">Referencia</label>
                                    <input type="text" id="tasksTitle-field" class="form-control" placeholder="Referencia"
                                            wire:model.defer="record.referencia" disabled />
                                </div>-->
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Grabar</button>
                           <!-- <button type="button" class="btn btn-success" id="edit-btn">Modificar</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
