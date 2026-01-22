<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Transacciones Contable</h5>
                        <div class="flex-shrink-0">
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    
                </div>
                <div class="card-body pt-0">
                    
                        <div class="table-responsive table-card mb-1">
                            <table class="table table-sm table-nowrap align-middle scroll-table" style="width:100%">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th style="width: 100px;">Fecha</th>
                                        <th style="width: 450px;">Documento</th>
                                        <th>Observacion</th>
                                        <th class="text-center">Debe</th>
                                        <th class="text-center">Haber</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $detalle)    
                                    <tr>
                                        <td>{{date('d/m/Y', strtotime($detalle->fecha))}}</td>
                                        <td style="text-indent: 15px;">{{$detalle->tipo}} {{$detalle->nombre}} - {{$detalle->documento}}
                                            <div>
                                            <a class="text-muted"> Beneficiario: </a> <a> {{$detalle->beneficiario}} </a>
                                            </div>
                                        </td>
                                        <td>
                                            <textarea class="form-control bg-white border-0" id="exampleFormControlTextarea" rows="3" disabled>{{$detalle->observaciones}}</textarea>
                                        </td>
                                        <td class="text-end">{{number_format($detalle->debito,2)}}</td>
                                        <td class="text-end">{{number_format($detalle->credito,2)}}</td>
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
                        </div>
                        -->
                        {{$tblrecords->links('')}}
                    
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

