<div>
    <div class="row justify-content-center">
        <div class="col-xxl-10">
            <div class="card">
                <form autocomplete="off" wire:submit.prevent="{{ 'createData' }}" id="invoice_form">
                    <div class="card-body bg-marketplace d-flex">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 lh-base mb-0">Certificado de Calidad <br> Peso en Bascula N° <span class="text-success">{{$record->Documento}}</span> </h4>
                            <p class="mb-0 mt-2 pt-1 text-muted"></p>
                        </div>
                        <img src="assets/images/bg-d.png" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-4">
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Fecha</label>
                            </div>
                            <div class="col-lg-3">{{date('d/m/Y', strtotime($fecha))}}</div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Producto</label>
                            </div>
                            <div class="col-lg-4">
                               <input type="text" class="form-control bg-white border-0 text-uppercase" data-plugin="producto" id="producto" placeholder="producto" value="{{$record->producto}}" disabled/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Lote N°</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control bg-light border-0" data-plugin="lote" id="lote" placeholder="ingrese referencia del lote" wire:model.defer="lote" required/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Fecha Producción</label>
                            </div>
                            <div class="col-lg-3">
                                <input type="date" class="form-control bg-light border-0" id="fechaActual" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="fechaProduccion" required>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Guia N°</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control bg-white border-0" data-plugin="guia" id="guia" placeholder="guia" value="{{$record->guia}}"/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Cliente</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control bg-white border-0 text-uppercase" data-plugin="cliente" id="cliente" placeholder="cliente" value="{{$record->NombreComercial}}" disabled/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Vehiculo</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control bg-white border-0" data-plugin="vehiculo" id="vehiculo" placeholder="vehiculo" value="{{$record->Vehiculo}}" disabled/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Conductor</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control bg-white border-0" data-plugin="conductor" id="conductor" placeholder="conductor" value="{{$record->Chofer}}" disabled/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Placas</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control bg-white border-0" data-plugin="placa" id="placa" placeholder="placa" value="{{$record->Placa}}" disabled/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Peso Neto</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control bg-white border-0" data-plugin="pneto" id="pneto" placeholder="pneto" value="{{$record->PesoNeto}}" disabled/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Sellos de Seguridad</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control bg-white border-0" data-plugin="sellos" id="sellos" placeholder="sellos" value="({{$record->Sello}}) {{$record->Desde}} - {{$record->Hasta}}"/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Tanque N°</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control bg-light border-0" data-plugin="taque" id="tanque" placeholder="ingrese tanque" wire:model.defer="tanque" required/>
                            </div>
                        </div>
                        <div class="row m-1 align-items-center">
                            <div class="col-lg-2">
                                <label for="fechaActual" class="form-label">Responsable de Producción</label>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-select bg-light border-0" data-choices data-choices-search-false
                                    name="choices-single-default" id="cmbresponsable" wire:model.defer="responsable" required>
                                    <option value="" selected>--Seleccione Usuario--</option>
                                    @foreach ($users as $user)
                                    <option value="{{$user->name}}">{{$user->name}}</option>
                                    @endforeach                               
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="card p-3">
                                    <div class="d-flex align-items-center">
                                        <button type="button" wire:click.prevent="add()" class="btn btn-danger add-btn btn-sm" data-bs-toggle="modal" id="create-btn"
                                            data-bs-target=""><i class="ri-add-line align-bottom me-1"></i>
                                        </button>
                                        <h5 class="card-title mb-0">
                                            <i class="align-middle me-1"></i> Control de Calidad
                                        </h5>
                                        <div class="ms-auto d-flex">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="checkbox" id="formCheck6" wire:model.defer="etiqueta">
                                                <label class="form-check-label fs-14" for="formCheck6">
                                                    Etiqueta
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="formCheck7"  wire:model.defer="empaque">
                                                <label class="form-check-label fs-14" for="formCheck7">
                                                    Lista Empaque
                                                </label>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>                              
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive mb-1">
                                    <table class="table table-nowrap table-sm" id="orderTable">
                                        <thead class="text-muted table-light table-sm">
                                            <tr class="text-uppercase">
                                                <th rowspan="2" style="width: 350px;">Caracteristicas</th>
                                                <th rowspan="2" style="width: 150px;">Valor Obtenido</th>
                                                <th colspan="2" class="text-center">Especificaciones</th>
                                                <th rowspan="2">Método</th>
                                            </tr>
                                            <tr class="text-uppercase">
                                                <th class="text-center">Min.</th>
                                                <th class="text-center">Max.</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach($detalle as $key => $det)
                                                <tr>
                                                    <td>{{$det['nombre']}}</td>
                                                    <td>
                                                        <input type="text" class="form-control bg-light border-0" id="{{$key}}-valor" wire:model="detalle.{{$key}}.valor"/>
                                                    </td>
                                                    <td class="text-center">{{$det['minimo']}}</td>
                                                    <td class="text-center">{{$det['maximo']}}</td>
                                                    <td>{{$det['metodo']}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                                
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            @if ($generado==0)                           
                            <button type="submit" class="btn btn-success"><i class="mdi mdi-*-* mdi-content-save fs-16 me-1"></i> Grabar </button>
                            @endif
                        </div>
                    </div>
                </form>
                <div wire.ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                                
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <span>Agregar Rubro</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form autocomplete="off" wire:submit.prevent="{{ 'createRubro' }}">
                                    
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
            </div>
        </div>
        <!--end col-->
    </div>
</div>

