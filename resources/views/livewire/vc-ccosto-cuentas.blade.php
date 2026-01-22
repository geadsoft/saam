<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Centro Costos - Cuentas</h5>
                        <div class="flex-shrink-0">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <label for="cmbtiporol" class="form-label">Periodo</label>
                                <select class="form-select" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbnivel" wire:model="periodo">
                                    @foreach ($tblperiodo as $record) 
                                    <option value="{{$record->periodo}}" selected>{{$record->periodo}}</option>
                                    @endforeach                                
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    
                </div>
                <div class="card-body pt-0">
                    <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                            @foreach($areas as $area)
                            <li class="nav-item">
                                @if($area->codigo==1)
                                <a class="nav-link active All py-3" data-bs-toggle="tab" id="All"
                                    href="#" role="tab" aria-selected="true" wire:click="filtrar({{$area->codigo}})">
                                    <i class="ri-arrow-down-s-line me-1 align-bottom"></i> {{$area->nombre}}
                                </a>
                                @else
                                <a class="nav-link py-3" data-bs-toggle="tab" id="All"
                                    href="#" role="tab" aria-selected="false" wire:click="filtrar({{$area->codigo}})">
                                    <i class="ri-arrow-down-s-line me-1 align-bottom"></i> {{$area->nombre}}
                                </a>
                                @endif
                            </li>
                            @endforeach
                        </ul>

                        <div class="table-responsive table-card mb-1">
                            <table class="table table-sm table-nowrap align-middle scroll-table" style="width:100%">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th rowspan="2">Descripcion</th>
                                        <th rowspan="2">Cuenta</th>
                                        <th colspan="2" class="text-center">Enero</th>
                                        <th colspan="2" class="text-center">Febrero</th>
                                        <th colspan="2" class="text-center">Marzo</th>
                                        <th colspan="2" class="text-center">Abril</th>
                                        <th colspan="2" class="text-center">Mayo</th>
                                        <th colspan="2" class="text-center">Junio</th>
                                        <th colspan="2" class="text-center">Julio</th>
                                        <th colspan="2" class="text-center">Agosto</th>
                                        <th colspan="2" class="text-center">Septiembre</th>
                                        <th colspan="2" class="text-center">Octubre</th>
                                        <th colspan="2" class="text-center">Noviembre</th>
                                        <th colspan="2" class="text-center">Diciembre</th>
                                    </tr>
                                    <tr class="text-uppercase text-center">
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr wire:key="{{ $record->Id }}">
                                        @if ($record->orden==1)
                                            <td><strong>{{$record->referencia}}</strong></td>
                                        @endif
                                        @if ($record->orden==2)
                                            <td style="text-indent: 10px;">
                                                @if($expandedPostId == $record->Id)
                                                    <a href="#" wire:click="mostrarDetalle({{$record->Id}},{{$record->ccosto}},{{$record->codigo}})" class="text-warning d-inline-block me-2">
                                                        <i class="ri-indeterminate-circle-fill fs-16"></i>
                                                    </a>
                                                @else
                                                    <a href="#" wire:click="mostrarDetalle({{$record->Id}},{{$record->ccosto}},{{$record->codigo}})" class="text-primary d-inline-block me-2">
                                                        <i class="ri-add-circle-fill fs-16"></i>
                                                    </a>
                                                @endif
                                                <span class="badge bg-light text-primary">
                                                <i class="text-center fs-12"></i>{{$record->ccosto}}
                                                </span> {{$record->ncosto}}
                                            
                                            </td>
                                        @endif
                                        <td>
                                            <a href="/contabilidad/auxiliar_contable/{{$periodo}}/{{$record->codigo}}/{{$record->ccosto}}" target="_blank">
                                                <strong>{{ $record->codigo }}</strong>
                                            </a> - {{ $record->nombre }}
                                        </td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db01,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr01,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db02,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr02,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db03,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr03,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db04,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr04,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db05,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr05,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db06,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr06,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db07,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr07,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db08,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr08,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db09,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr09,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db10,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr10,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db11,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr11,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->db12,2)}}</td>
                                        <td class="text-end {{ $record->orden == 1 ? 'fw-semibold' : '' }}">{{number_format($record->cr12,2)}}</td>
                                        <!--<td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Editar">
                                                    <a href="" wire:click.prevent="">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                        data-bs-toggle="modal" href="" wire:click.prevent="">
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>-->
                                    </tr>
                                    @if ($expandedPostId == $record->Id)
                                        @foreach ($tbldetalle as $detalle)
                                        <tr>
                                            <td style="text-indent: 15px;">{{$detalle->tipo}} {{$detalle->nombre}} - {{$detalle->documento}}
                                                <div>
                                                <a class="text-muted"> Fecha: </a> <a> {{date('d/m/Y', strtotime($detalle->fecha))}} </a>
                                                </div>
                                                 <div>
                                                <a class="text-muted"> Beneficiario: </a> <a> {{$detalle->beneficiario}} </a>
                                                </div>
                                            </td>
                                            <td>
                                                <textarea class="form-control" id="exampleFormControlTextarea" rows="3" disabled>{{$detalle->observaciones}}</textarea>
                                            </td>
                                            <td class="text-end">{{number_format($detalle->db01,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr01,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db02,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr02,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db03,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr03,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db04,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr04,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db05,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr05,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db06,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr06,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db07,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr07,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db08,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr08,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db09,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr09,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db10,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr10,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db11,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr11,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->db12,2)}}</td>
                                            <td class="text-end">{{number_format($detalle->cr12,2)}}</td>
                                        </tr>
                                        @endforeach
                                    @endif
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
                        </div>
                        -->
                        
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <div wire.ignore.self class="modal fade flip" id="generaDiario" tabindex="-1" aria-hidden="true" wire:model='selectId'>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5 text-center">
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                    </lord-icon>
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                    </lord-icon>
                    <div class="mt-4 text-center">
                        <h4>¿Seguro de generar comprobante diario</h4>
                        <p class="text-muted fs-15 mb-4">Esta opción procesara el registro cambiando a su estado CERRADO. 
                        Esta acción es irreversible</p>
                        <div class="hstack gap-2 justify-content-center remove">
                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                Cancelar</button>
                            <button class="btn btn-danger" id="delete-record"  wire:click="comprobante()"> Si,
                                Continuar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

