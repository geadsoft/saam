<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Horarios</h5>
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
                            <div class="col-xxl-5 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Burcar por descripción..." wire:model="filters.descripcion">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                        </ul>

                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th class="sort">Nombre</th>
                                        <th class="sort">Empieza Entrada</th>
                                        <th class="sort">Entrada</th>
                                        <th class="sort">Termina Entrada</th>
                                        <th class="sort">Empieza Salida</th>
                                        <th class="sort">Salida</th>
                                        <th class="sort">Termina Salida</th>
                                        <th class="sort">Alimentacion</th>
                                        <th class="sort">Estado</th>
                                        <th class="sort">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        @if($record->nocturno==true)
                                        <td>{{$record->descripcion}} <span class="badge badge-pill bg-danger" data-key="t-new">N</span> </td>
                                        @else
                                        <td>{{$record->descripcion}}</td>
                                        @endif 
                                        <td>{{$record->ini_entrada}}</td>
                                        <td><strong>{{$record->entrada}}</strong></td>
                                        <td>{{$record->fin_entrada}}</td>
                                        <td>{{$record->ini_salida}}</td>
                                        <td>{{$record->salida}}</td>
                                        <td><strong>{{$record->fin_salida}}</strong></td>
                                        <td>{{$record->descanso}}</td>
                                        <td>
                                            @if($record->estado)
                                                <span class="badge badge-soft-success text-uppercase">Activo</span>
                                            @else
                                                <span class="badge badge-soft-warning text-uppercase">Inactivo</span>
                                            @endif
                                        </td>
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
                       
                       

                    </div>

                    <div wire.ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                                
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        @if($showEditModal)
                                            <span>Editar Horarios &nbsp;</span>
                                        @else
                                            <span>Agregar Horarios  &nbsp;</span>
                                        @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                                    
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="record.descripcion" class="form-label">Descripción</label>
                                                <input type="text" wire:model.defer="record.descripcion" class="form-control" name="record.descripcion"
                                                    placeholder="Enter name" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="hentrada" class="form-label">Hora Entrada</label>
                                                    <input type="time" wire:model.defer="record.entrada" class="form-control" name="hentrada" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="hsalida" class="form-label">Hora Salida</label>
                                                    <input type="time" wire:model.defer="record.salida" class="form-control" name="hsalida" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-3">
                                                    <label class="form-label" for="importe-input">Tolerancia</label>
                                                    <input type="number" class="form-control" id="importe-input" step="1" placeholder="0" wire:model.defer="record.tolerancia">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-3">
                                                    <label class="form-label" for="importe-input">Jornada</label>
                                                    <input type="number" class="form-control" id="importe-input" step="1" placeholder="0" wire:model.defer="record.jornada">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <div class="form-check form-check-secondary mb-3">
                                                        <input class="form-check-input" type="checkbox" id="formCheck7" wire:model.defer="record.nocturno">
                                                        <label class="form-check-label" for="formCheck7">
                                                            Nocturno
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="hinientrada" class="form-label">Inicio de Entrada</label>
                                                    <input type="time" wire:model.defer="record.ini_entrada" class="form-control" name="hinientrada" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="hinisalida" class="form-label">Inicio de Salida</label>
                                                    <input type="time" wire:model.defer="record.ini_salida" class="form-control" name="hinisalida" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="hinientrada" class="form-label">Hora Max. de Entrada</label>
                                                    <input type="time" wire:model.defer="record.fin_entrada" class="form-control" name="hinientrada" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="hinisalida" class="form-label">Hora Max. de Salida</label>
                                                    <input type="time" wire:model.defer="record.fin_salida" class="form-control" name="hinisalida" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="hinientrada" class="form-label">Alimentación(min)</label>
                                                    <input type="number" class="form-control" id="importe-input" step="1" placeholder="0" wire:model.defer="record.descanso">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="inidescanso" class="form-label">Hora Inicio</label>
                                                    <input type="time" wire:model.defer="record.ini_descanso" class="form-control" name="inidescanso"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="findescanso" class="form-label">Hora Finaliza</label>
                                                    <input type="time" wire:model.defer="record.fin_descanso" class="form-control" name="findescanso"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div>
                                            <label for="record.estado" class="form-label">Status</label>
                                                <select class="form-select" data-trigger name="record.estado" wire:model.defer="record.estado">
                                                <option value="A">Activo</option>
                                                <option value="I">Inactivo</option>
                                                <option value="E">Eliminado</option>
                                            </select>
                                        </div>-->                                        
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

</div>
