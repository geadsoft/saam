<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Control Fisicoquímico</h5>
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
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.producto">
                                        <option value="0" selected>All</option>
                                         @foreach ($tblproductos as $producto)                                    
                                            <option value="{{$producto->codigo}}">{{$producto->nombre}}</option>
                                        @endforeach                                        
                                    </select>
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
                                        <th class="sort" data-sort="id"> Cateristica</th>
                                        <th class="sort" data-sort="superior">Minima</th>
                                        <th class="sort" data-sort="codigo"> Maxima</th>
                                        <th class="sort" data-sort="descripcion">Metodo</th>
                                        <th class="sort" data-sort="estado">Etiqueta</th>
                                        <th class="sort" data-sort="accion">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>{{$record->nombre}}</td>
                                        <td>{{$record->minimo}}</td>
                                        <td>{{$record->maximo}}</td>
                                        <td>{{$record->metodo}}</td>
                                        <td>{{$record->etiqueta}}</td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a href="" wire:click.prevent="edit({{ $record->id_fila }})">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                        data-bs-toggle="modal" href="" wire:click.prevent="delete({{ $record->id_fila }})">
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
                       
                        <!--<div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>-->
                        {{$tblrecords->links('')}}

                    </div>

                    <div wire.ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                                
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        @if($showEditModal)
                                            <span>Editar Característica Fisicoquímica &nbsp;</span>
                                        @else
                                            <span>Agregar Característica Fisicoquímica  &nbsp;</span>
                                        @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="calidad.nombre" class="form-label">Descripción</label>
                                            <input type="text" wire:model.defer="calidad.nombre" class="form-control" name="calidad.nombre"
                                                placeholder="Enter name" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="calidad.minimo" class="form-label">Minimo/Máximo</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control" step="0.01"  id="minimo" wire:model="calidad.minimo" required/>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control" step="0.01"  id="maximo" wire:model="calidad.maximo" required/>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-sm-8">    
                                                    <label for="calidad.metodo" class="form-label">Método</label>
                                                    <input type="text" wire:model.defer="calidad.metodo" class="form-control" name="calidad.metodo"
                                                        placeholder="Ingrese Método" required />
                                                </div> 
                                                <div class="col-sm-4">    
                                                    <label for="calidad.etiqueta" class="form-label">Etiqueta</label>
                                                    <input type="text" wire:model.defer="calidad.etiqueta" class="form-control" name="calidad.etiqueta"
                                                        placeholder="Ingrese Etiqueta" />
                                                </div> 
                                            </div> 
                                        </div>
                                        <div class="mb-3">
                                            <label for="calidad.producto" class="form-label">Producto</label>
                                            <select class="form-select" data-choices data-choices-search-false
                                                name="choices-single-default" id="cmbproducto" wire:model="calidad.producto">
                                                <option value="" selected>-- Seleccione Producto --</option>
                                                @foreach ($tblproductos as $producto)
                                                <option value="{{$producto->codigo}}">{{$producto->nombre}}</option>
                                                @endforeach                               
                                            </select>
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
