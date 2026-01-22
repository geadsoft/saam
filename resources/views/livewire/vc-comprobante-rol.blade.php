<div>
    <form id="addrubro-form" autocomplete="off" wire:submit.prevent="procesar()">
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0 text-primary"> {{$tipodoc[$diario['comprobante']]}} - {{$diario['documento']}}  </h5>
                        <div class="flex-shrink-0">
                            @if ($nomina['estado']=='P')
                                <button type="button" data-bs-toggle="" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle dropdown">
                                <i class="ri-exchange-dollar-line fs-22"></i>
                                </button>
                                <button type="button" data-bs-toggle="" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle dropdown">
                                <i class="bx bx-mail-send fs-22"></i>
                                </button>
                                <button type="button" data-bs-toggle="dropdown" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle dropdown">
                                <i class="bx bxs-file-pdf fs-22"></i>
                                </button>
                            @endif
                            <a href="" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-file-excel-2-line align-bottom fs-22"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label"><span class="text-uppercase">{{$nomina->tiposrol->descripcion}}</span></label>
                            <div>
                            <label class="form-label">{{$mes[$nomina['mes']]}} {{$nomina['periodo']}}</label>
                            </div>
                            <div>
                            @if ($diario['estado']=='G')
                                <label class="form-label">ESTADO: <span class="badge badge-soft-success text-uppercase fs-12">GENERADO</span></label>
                            @else
                                <label class="form-label">ESTADO: <span class="badge badge-soft-info text-uppercase fs-12">PROCESADA</span></label>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="cmbtiporol" class="form-label">PERIODO</label>
                            <select type="select" class="form-select" data-trigger id="cmbtiporol" wire:model.defer="nomina.periodosrol_id" disabled>
                                <option value="{{$nomina->periodosrol->id}}">{{date('d/m/Y', strtotime($nomina->periodosrol->fechaini))}} - {{date('d/m/Y', strtotime($nomina->periodosrol->fechafin))}}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="cmbtiporol" class="form-label">EMISIÓN</label>
                            <div>
                                <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="fecha" disabled>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="cmbtiporol" class="form-label">OBSERVACIÓN</label>
                            <div>
                            <textarea type="text" rows="2" id="review" name="review" class="form-control" style="resize: none;" disabled> {{$diario['observacion']}} </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-12">
            <div class="card" id="contactList">
                <div class="card-header">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <h6 class="flex-grow-1 mb-0 text-primary"><i
                                class="text-success"></i>
                                Informacion Contable</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-3">
                            <div style="overflow-x:auto;">
                            <table class="table table-sm align-middle" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <!--<th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="checkAll" value="option">
                                            </div>
                                        </th>-->
                                        <!--<th class="sort" data-sort="id" scope="col">ID</th>-->
                                        <th scope="col" style="width: 50px;" class="text-center">Linea</th>
                                        <th scope="col" style="width: 70px;" class="text-center">Tipo</th>
                                        <th scope="col" style="width: 150px;" class="text-center">Cuenta</th>
                                        <th scope="col" style="width: 300px;" class="text-center">Descripcion</th>
                                        <th scope="col" style="width: 150px;" class="text-center">C. Costo</th>
                                        <th scope="col" style="width: 50px;"  class="text-center">Gasto Deducible</th>
                                        <th scope="col" style="width: 420px;" class="text-center">Concepto</th>
                                        <th scope="col" style="width: 150px;" class="text-center">Debe</th>
                                        <th scope="col" style="width: 150px;" class="text-center">Haber</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($detalle as $data)
                                        <tr class="detalle">
                                            <!--<th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child"
                                                        value="option1">
                                                </div>
                                            </th>-->
                                            <td>
                                                <input type="text" class="form-control bg-light border-0" value='1' disabled/>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control bg-light border-0" id="tipo"  value = "{{$data['tipo']}}" disabled>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control bg-light border-0" id="cuenta"  value = "{{$data['cuenta']}}" disabled>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control bg-light border-0" id="nombre"  value = "{{$data['descripcion']}}" disabled>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control bg-light border-0" id="ccosto"  value = "{{$data['ccosto']}}" disabled>
                                            </td>
                                            <td>
                                               <input type="text" class="form-control bg-light border-0" id="deducible"  value = "{{$data['deducible']}}" disabled>
                                            </td>
                                            <td>
                                                <textarea type="text" rows="2" id="detalle" name="review" class="form-control bg-light border-0" style="resize: none;" disabled>{{$data['detalle']}}</textarea>
                                            </td>
                                            <td>
                                                @if($data['naturaleza']=='D')
                                                    <input type="text" class="form-control bg-light border-0 text-right text-end" id="debe" value = "{{$data['valor']}}" disabled>
                                                @else 
                                                    <input type="text" class="form-control bg-light border-0 text-right text-end" id="debe" value = "0.00" disabled>
                                                @endif 
                                            </td>
                                            <td>
                                                @if($data['naturaleza']=='C')
                                                    <input type="text" class="form-control bg-light border-0 text-end" id="haber " value = "{{$data['valor']}}" disabled>
                                                @else 
                                                    <input type="text" class="form-control bg-light border-0 text-end" id="haber" value = "0.00" disabled>
                                                @endif 
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6"></td>
                                        <td>
                                            <span><strong>TOTALES: </strong></span>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control bg-light border-0 fw-semibold text-end" id="totdebe" value = "{{$totalDebe}}" disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control bg-light border-0 fw-semibold text-end" id="tothaber" value = "{{$totalHaber}}" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"></td>
                                        <td>
                                            <span><strong>DIFERENCIA: </strong></span>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="text" class="form-control bg-light border-0 fw-semibold text-end" id="diferencia" value = "{{$diferencia}}" disabled>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            </div>
                            
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                        trigger="loop" colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ contacts We
                                        did not find any
                                        contacts for you search.</p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="d-flex justify-content-end mt-3">
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
                        
                    </div>

                                        
                    
                </div>
            </div>
            <!--end card--> 
        </div>
        <!--end col-->
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-2">
            </div>                        
            <div class="col-md-auto ms-auto">
                <div class="hstack text-nowrap gap-2">
                    @if($diario['estado']=='G')
                    <button type="submit" class="btn btn-info w-sm" ><i class="ri-save-3-fill align-bottom me-1"></i>Procesar</button>                   
                    @endif
                </div>
            </div>
        </div>
        
        <!--end col-->
    </div>
              
    
    </form>
    <!--end row-->
</div>

