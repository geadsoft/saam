<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Turnos</h5>
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
                                        <th class="sort">Personal</th>
                                        <th class="sort">Horario</th>
                                        <th class="sort">Entrada</th>
                                        <th class="sort">Salida</th>
                                        <th class="sort">HE 25%</th>
                                        <th class="sort">HE 50%</th>
                                        <th class="sort">HE 100%</th>
                                        <th class="sort">Dias HE</th>
                                        <th class="sort">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>{{$record->descripcion}}</td>
                                        <td>{{$record->area->descripcion}}</td>
                                        <td>{{$record->horario->descripcion}}</strong></td>
                                        <td><strong>{{$record->horario->entrada}}</strong></td>
                                        <td><strong>{{$record->horario->salida}}</strong></td>
                                        <td>{{$record->sup_25_porcentaje}}</td>
                                        <td>{{$record->sup_50_porcentaje}}</td>
                                        <td>{{$record->extra_porcentaje}}</td>
                                        <td>{{$record->dias_extra}}</td>
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
                       
                        {{$tblrecords->links('')}}

                    </div>

                    <div wire.ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                                
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        @if($showEditModal)
                                            <span>Editar Turnos &nbsp;</span>
                                        @else
                                            <span>Agregar Turnos  &nbsp;</span>
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
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="hentrada" class="form-label">Tipo Personal</label>
                                                    <select class="form-select" data-choices data-choices-search-false
                                                        name="choices-single-default" id="cmbnivel" wire:model="record.tipo_personal">
                                                        <option value="" selected>Todos</option>
                                                        @foreach ($areas as $area)
                                                            <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                                        @endforeach                                
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="hsalida" class="form-label">Horario Base</label>
                                                    <select class="form-select" data-choices data-choices-search-false
                                                        name="choices-single-default" id="cmbnivel" wire:model="record.horario_id">
                                                        <option value="" selected>Seleccione Horario</option>
                                                        @foreach ($horarios as $horario)
                                                            <option value="{{$horario->id}}">{{$horario->descripcion}}</option>
                                                        @endforeach                                
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="row">
                                            <div class="card-header mb-3">
                                                <h6 class="flex-grow-1 mb-0 text-primary"><i
                                                    class="mdi mdi-account-tie align-middle me-1 text-success"></i>
                                                    Dias Lisbre</h5>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <div class="form-check form-check-secondary mb-3">
                                                        <input class="form-check-input" type="checkbox" id="formCheck7" wire:model.defer="record.nocturno">
                                                        <label class="form-check-label" for="formCheck7">
                                                           Lunes
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->                                   
                                        <div class="row">
                                            <div class="card-header mb-3">
                                                <h6 class="flex-grow-1 mb-0 text-primary"><i
                                                    class="mdi mdi-account-tie align-middle me-1 text-success"></i>
                                                    Horas Suplementarias</h5>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <div class="form-check form-check-secondary mb-3">
                                                        <input class="form-check-input" type="checkbox" id="chkaplica25" wire:model.defer="record.sup_25_aplica">
                                                        <label class="form-check-label" for="chkaplica25">
                                                            Hasta completar jornada
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="importe25-input" step="1" placeholder="0" wire:model.defer="record.sup_25_porcentaje">
                                                        <span class="input-group-text">
                                                            <i class="ri-percent-line"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <div class="form-check form-check-secondary mb-3">
                                                        <input class="form-check-input" type="checkbox" id="chkaplica50" wire:model.defer="record.sup_50_aplica">
                                                        <label class="form-check-label" for="chkaplica50">
                                                            Después de la jornada
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="importe50-input" step="1" placeholder="0" wire:model.defer="record.sup_50_porcentaje">
                                                        <span class="input-group-text">
                                                            <i class="ri-percent-line"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="card-header mb-3">
                                                <h6 class="flex-grow-1 mb-0 text-primary"><i
                                                    class="mdi mdi-account-tie align-middle me-1 text-success"></i>
                                                    Horas Extraordinarias (100%)</h5>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <div>
                                                    <label for="record.descripcion" class="form-label">Días con recargo</label>
                                                    </div>
                                                    @foreach($diasSemana as $key => $dia)
                                                    <div class="form-check form-check-secondary form-check-inline">
                                                        <input class="form-check-input" type="checkbox" wire:model="dias_extra" value="{{ $key }}">
                                                        <label class="form-check-label">{{ $dia }}</label>
                                                    </div>
                                                    @endforeach
                                                    <div class="form-check form-check-secondary form-check-inline">
                                                        <input class="form-check-input" type="checkbox" wire:model="dias_extra" value="feriado">
                                                        <label class="form-check-label">Feriados</label>
                                                    </div>
                                                    <div class="form-check form-check-secondary form-check-inline">
                                                        <input class="form-check-input" type="checkbox" wire:model="dias_extra" value="dialibre">
                                                        <label class="form-check-label">Dia Libre</label>
                                                    </div>
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
