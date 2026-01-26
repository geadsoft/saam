<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Horas Extras</h5>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Generar Horas
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Burcar por apellidos, nui..." wire:model.live="filters.buscar">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-2">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model.live="filters.departamento">
                                        <option value="0" selected>--Todos--</option>
                                         @foreach ($departs as $record)                                    
                                            <option value="{{$record->id}}">{{$record->descripcion}}</option>
                                        @endforeach                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div>
                                    <input id="dfechaini" name="dateIni" type="date" class="form-control"
                                        data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                        wire:model.defer="filters.startDate" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div>
                                    <input id="dfechaini" name="dateIni" type="date" class="form-control"
                                        data-provider="flatpickr" data-date-format="d-m-Y" data-time="true"
                                        wire:model.defer="filters.endDate" required>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                            <!--<li class="nav-item">
                                <a class="nav-link active All py-3" data-bs-toggle="tab" id="All" href="#home1" role="tab"
                                    aria-selected="true">
                                    <i class="ri-store-2-fill me-1 align-bottom"></i> All Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Delivered" data-bs-toggle="tab" id="Delivered" href="#delivered"
                                    role="tab" aria-selected="false">
                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Delivered
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Pickups" data-bs-toggle="tab" id="Pickups" href="#pickups"
                                    role="tab" aria-selected="false">
                                    <i class="ri-truck-line me-1 align-bottom"></i> Pickups <span
                                        class="badge bg-danger align-middle ms-1">2</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Returns" data-bs-toggle="tab" id="Returns" href="#returns"
                                    role="tab" aria-selected="false">
                                    <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Returns
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" id="Cancelled" href="#cancelled"
                                    role="tab" aria-selected="false">
                                    <i class="ri-close-circle-line me-1 align-bottom"></i> Cancelled
                                </a>
                            </li>-->
                        </ul>

                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <!--<th scope="col" style="width: 25px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>-->
                                        <th class="sort" data-sort="id">Empleado</th>
                                        <th class="sort" data-sort="superior">Nui</th>
                                        <th class="sort" data-sort="descripcion">Sueldo</th>
                                        <th class="sort" data-sort="codigo"> Fecha</th>
                                        <th class="sort" data-sort="descripcion">Horas Trabajadas</th>
                                        <th class="sort" data-sort="descripcion">HE 25%</th>
                                        <th class="sort" data-sort="descripcion">Monto 25</th>
                                        <th class="sort" data-sort="descripcion">HE 50%</th>
                                        <th class="sort" data-sort="descripcion">Monto 50</th>
                                        <th class="sort" data-sort="descripcion">HE 100%</th>
                                        <th class="sort" data-sort="descripcion">Monto 100</th>
                                        <th class="sort" data-sort="descripcion">Total</th>
                                        <!--<th class="sort" data-sort="estado">Estado</th>
                                        <th class="sort" data-sort="accion">Acción</th>-->                                        
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>{{$record->apellidos}} {{$record->nombres}}</td>
                                        <td>{{$record->nui}}</td> 
                                        <td>{{$record->sueldo}}</td>
                                        <td>{{date('d/m/Y', strtotime($record->fecha))}}</td>
                                        <td>{{$record->horas}}</td>
                                        <td>{{$record->extra25}}</td>
                                        <td>${{number_format($record->monto25, 2)}}</td>
                                        <td>{{$record->extra50}}</td>
                                        <td>${{number_format($record->monto50, 2)}}</td>
                                        <td>{{$record->extra100}}</td>
                                        <td>${{number_format($record->monto100, 2)}}</td>     
                                        <td>${{$record->total}}</td> 
                                        <!--<td></td>                                   
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
                                        </td>-->
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
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div>
