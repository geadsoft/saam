<div>
    <div class="row">
        <div class="col-xl-9">
            @if ($pesoManual=='N')
            <div class="card">
                <div class="card-header">    
                    @if ($selectId>0)
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">
                            <a class="badge bg-primary text-wrap fs-14 flex-grow-1 mb-0">Ticket No. {{$selectId}}</a>
                        </h5>
                        <div class="flex-shrink-0">
                        @if($record['peso_bruto']>0)
                            <a href="/bascula-compra/peso-bruto" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" wire:click="addData"><i class="ri-file-2-line fs-22"></i></a>
                            <button onclick="window.open('{{ route('ticketCompra.pdf', $selectId) }}', '_blank')"
                                    class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-printer-fill fs-22"></i>
                            </button>
                            <button onclick="window.open('{{ route('ticketCompra.pdf.download', $selectId) }}')"
                                    class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-download-2-line fs-22"></i>
                                
                            </button>
                        @endif
                        @if($record['peso_neto']>0)    
                            <a href="javascript:void(0);" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-mail-send-line fs-22"></i></a>
                        @endif
                        </div>
                   </div>
                   @endif
                </div>
                <div class="card-body checkout-tab">
                    <form autocomplete="off" wire:submit.prevent="{{ 'createData' }}" id="pesocompra_form">
                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                               
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 {{$activeTab1}}" id="pills-bill-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab"
                                        aria-controls="pills-bill-info" aria-selected="true" data-position="0">
                                        <i
                                            class="ri-user-2-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        Compra
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 {{$activeTab2}}" id="pills-bill-address-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button"
                                        role="tab" aria-controls="pills-bill-address" aria-selected="false"
                                        data-position="1" tabindex="-1">
                                        <i
                                            class="ri-truck-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        Racimos
                                    </button>
                                </li>
                                @if($selectId>0)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 {{$activeTab3}}" id="pills-payment-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab"
                                        aria-controls="pills-payment" aria-selected="false" data-position="2"
                                        tabindex="-1">
                                        <i
                                            class="ri-bank-card-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        Calificación
                                    </button>
                                </li>
                                @endif
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade {{$showTab1}}" id="pills-bill-info" role="tabpanel"
                                aria-labelledby="pills-bill-info-tab">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column mb-3">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">Información de Compra</h4>
                                        <p class="text-muted mb-0">Por favor, complete toda la información a continuación.</p>
                                    </div>
                                    <div class="mt-3 mt-lg-0">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-auto">
                                                <div class="form-check form-switch form-switch-custom form-switch-warning">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck12" wire:click="togglePesoManual" {{ $pesoManual == 'Y' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="SwitchCheck12">Peso Manual</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                                <div>
                                    <fieldset {{$fieldset}}>    
                                    <div class="row">                                        
                                        <div class="col-sm-3 mb-3">
                                            <label for="cmbtiporol" class="form-label">Emisión</label>
                                            <div>
                                                <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="record.fecha" disabled required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 mb-3">
                                            <label for="horamaxima" class="form-label">Hora</label>
                                            <input type="time" step="1" class="form-control" id="horamaxima" wire:model.defer="record.hora" disabled required>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="mb-3 relative">
                                                <label for="billinginfo-firstName" class="form-label">Proveedor</label>
                                                @livewire('vc-incremental-proveedor',['nombre' => $record['proveedor']])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">                                        
                                        <div class="col-sm-6">
                                            <div class="mb-3 relative">
                                                <label for="billinginfo-lastName" class="form-label">Hacienda</label>
                                                @livewire('vc-incremental-hacienda',['nombre' => $record['hacienda']])
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="chofer" class="form-label">Chofer</label>
                                                @livewire('vc-incremental-chofer',['nombre' => $record['chofer']])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="billinginfo-email" class="form-label">Producto</label>
                                                <input type="text" class="form-control" id="chofer" placeholder="Ingrese Nombre del Chofer" wire:model="record.producto" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="billinginfo-phone" class="form-label">Variedad</label>
                                                <select class="form-select" data-choices data-choices-search-false
                                                    name="choices-single-default" id="idStatus" wire:model="record.variedad">
                                                    <option value="GUINNENSIS">GUINNENSIS</option>
                                                    <option value="COARI">COARI</option>
                                                    <option value="TAISHA">TAISHA</option>
                                                    <option value="HIBRIDA">HIBRIDA</option>
                                                    <option value="AMAZON">AMAZON</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="row g-4" {{$time}}>
                                            @if ($selectId==0)
                                           
                                            <div class="col-lg-6">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-check card-radio">
                                                    <input id="shippingMethod01" name="shippingMethod" type="radio"
                                                        class="form-check-input" checked="">
                                                    <label class="form-check-label" for="shippingMethod01">
                                                        <span
                                                            class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">{{$record['peso_bruto']}}</span>
                                                        <span class="fs-14 mb-1 text-wrap d-block">Peso Bruto</span>
                                                        <span class="text-muted fw-normal text-wrap d-block">{{$this->fechaHora}}</span>
                                                        @error('record.peso_bruto')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-lg-4">
                                                <div class="form-check card-radio">
                                                    <input id="shippingMethod01" name="shippingMethod" type="radio"
                                                        class="form-check-input" checked="">
                                                    <label class="form-check-label" for="shippingMethod01">
                                                        <span
                                                            class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">{{$record['peso_bruto']}}</span>
                                                        <span class="fs-14 mb-1 text-wrap d-block">Peso Bruto</span>
                                                        <span class="text-muted fw-normal text-wrap d-block">{{$record['fechabruto']}} - {{$record['horabruto']}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-check card-radio">
                                                    <input id="shippingMethod02" name="shippingMethod" type="radio"
                                                        class="form-check-input" checked="">
                                                    <label class="form-check-label" for="shippingMethod02">
                                                        <span
                                                            class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">{{$record['peso_tara']}}
                                                        </span>
                                                        <span class="fs-14 mb-1 text-wrap d-block">Peso Tara</span>
                                                        <span class="text-muted fw-normal text-wrap d-block">{{$record['fechatara']}} - {{$record['horatara']}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-check card-radio">
                                                    <input id="shippingMethod02" name="shippingMethod" type="radio"
                                                        class="form-check-input" checked="">
                                                    <label class="form-check-label" for="shippingMethod02">
                                                        <span
                                                            class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">{{$record['peso_neto']}}
                                                            Tn</span>
                                                        <span class="fs-14 mb-1 text-wrap d-block">Peso Neto</span>
                                                        <span class="text-muted fw-normal text-wrap d-block">.</span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    </fieldset>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        @if($record['peso_neto']==0)
                                        <button type="submit" class="btn btn-success btn-label right ms-auto nexttab" data-nexttab="pills-payment-tab"><i class=" ri-save-3-line label-icon align-middle fs-16 ms-2"></i>Grabar</button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade {{$showTab2}}" id="pills-bill-address" role="tabpanel"
                                aria-labelledby="pills-bill-address-tab">
                                <div>
                                    <h5 class="mb-1">Detalle de Racimos</h5>
                                    <p class="text-muted mb-4">Por favor, ingrese toda la información a continuación.
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <div class="mb-3 relative">
                                        <label for="billinginfo-lastName" class="form-label">Hacienda</label>
                                        <div class="search-box">
                                            <input type="text" class="form-control" value="{{$record['hacienda']}}" disabled/>
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table-sm table-card mb-3">
                                            <table class="table table-nowrap table-sm align-middle" id="orderTable">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th>Sector</th>
                                                        <th style="width: 180px;" class="text-end">Cantidad</th>
                                                        @if($selectId==0)
                                                        <th style="width: 180px;" class="text-end">Peso Neto</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($racimos as $key => $sector) 
                                                    <tr>
                                                        <td>{{$sector['detalle']}}</td>
                                                        <td><input type="number" class="form-control form-control-sm bg-light border-0 p-1 text-end" id="cantidad-{{$key}}" step="1" y min="0" wire:model="racimos.{{$key}}.cantidad"></td>
                                                        @if($selectId==0)
                                                        <td><input type="number" class="form-control form-control-sm bg-light border-0 p-1 text-end" id="pneto-{{$key}}" step="1" y min="0" wire:model="racimos.{{$key}}.pesoneto" disabled></td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade {{$showTab3}}" id="pills-payment" role="tabpanel"
                                aria-labelledby="pills-payment-tab">
                                <div>
                                    <h5 class="mb-1">Calificación de Fruta</h5>
                                    <p class="text-muted mb-4">Por favor seleccione e ingrese la información</p>
                                </div>

                                <div class="row g-4">
                                    <div class="col-lg-4 col-sm-6">
                                        <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show"
                                            aria-expanded="false" aria-controls="paymentmethodCollapse">
                                            <div class="form-check card-radio">
                                                <input id="paymentMethod01" name="paymentMethod" type="radio"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="paymentMethod01">
                                                    <span class="fs-16 text-muted me-2"><i
                                                            class="ri-paypal-fill align-bottom"></i></span>
                                                    <span class="fs-14 text-wrap">Sin Calificar</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse"
                                            aria-expanded="true" aria-controls="paymentmethodCollapse">
                                            <div class="form-check card-radio">
                                                <input id="paymentMethod02" name="paymentMethod" type="radio"
                                                    class="form-check-input" checked="">
                                                <label class="form-check-label" for="paymentMethod02">
                                                    <span class="fs-16 text-muted me-2"><i
                                                            class="ri-bank-card-fill align-bottom"></i></span>
                                                    <span class="fs-14 text-wrap">Calificar</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6">
                                        <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show"
                                            aria-expanded="false" aria-controls="paymentmethodCollapse">
                                            <div class="form-check card-radio">
                                                <input id="paymentMethod03" name="paymentMethod" type="radio"
                                                    class="form-check-input" value="1" wire:model="record.fruta_optima">
                                                <label class="form-check-label" for="paymentMethod03">
                                                    <span class="fs-16 text-muted me-2"><i
                                                            class="ri-money-dollar-box-fill align-bottom"></i></span>
                                                    <span class="fs-14 text-wrap">Fruta Optima</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="collapse show" id="paymentmethodCollapse">
                                    <div class="card p-4 border shadow-none mb-0 mt-4">
                                        @livewire('vc-califica-fruta',['id' => $selectId])
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="pills-bill-address-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back to
                                        Shipping</button>
                                    <button type="button" class="btn btn-primary btn-label right ms-auto nexttab"
                                        data-nexttab="pills-finish-tab"><i
                                            class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Complete
                                        Order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">    
                    @if ($selectId>0)
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">
                            <a class="badge bg-primary text-wrap fs-14 flex-grow-1 mb-0">Ticket No. {{$selectId}}</a>
                        </h5>
                        <div class="flex-shrink-0">
                            <a href="/bascula-compra/peso-bruto" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" wire:click="addData"><i class="ri-file-2-line fs-22"></i></a>
                            <button onclick="window.open('{{ route('ticketCompra.pdf', $selectId) }}', '_blank')"
                                    class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-printer-fill fs-22"></i>
                            </button>
                            <button onclick="window.open('{{ route('ticketCompra.pdf.download', $selectId) }}')"
                                    class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-download-2-line fs-22"></i>
                                
                            </button>  
                            <a href="javascript:void(0);" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-mail-send-line fs-22"></i></a>
                        </div>
                   </div>
                   @endif
                </div>
                <div class="card-body checkout-tab">
                    <form autocomplete="off" wire:submit.prevent="{{ 'createData' }}" id="pesocompra_form">
                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                               
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 {{$activeTab['T1']}}" id="pills-bill-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab"
                                        aria-controls="pills-bill-info" aria-selected="true" data-position="0" wire:click="selectTab(1)">
                                        <i
                                            class="ri-user-2-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        Compra
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 {{$activeTab['T2']}}" id="pills-bill-address-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" 
                                        aria-controls="pills-bill-address" aria-selected="false" 
                                        data-position="1" wire:click="selectTab(2)">
                                        <i
                                            class="ri-truck-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        Racimos
                                    </button>
                                </li>
                                
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 {{$activeTab['T3']}}" id="pills-payment-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab"
                                        aria-controls="pills-payment" aria-selected="false" data-position="2"
                                         wire:click="selectTab(3)">
                                        <i
                                            class="ri-bank-card-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        Calificación
                                    </button>
                                </li>
                                
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade {{$activeTab['S1']}}" id="pills-bill-info" role="tabpanel"
                                aria-labelledby="pills-bill-info-tab">
                                
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column mb-3">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">Información de Compra</h4>
                                        <p class="text-muted mb-0">Por favor, complete toda la información a continuación.</p>
                                    </div>
                                    <div class="mt-3 mt-lg-0">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-auto">
                                                <div class="form-check form-switch form-switch-custom form-switch-warning">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck12" wire:click="togglePesoManual" {{ $pesoManual == 'Y' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="SwitchCheck12">Peso Manual</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>

                                <div>
                                    <fieldset {{$fieldset}}>    
                                    <div class="row">                                        
                                        <!--<div class="col-sm-3 mb-3">
                                            <label for="cmbtiporol" class="form-label">Emisión</label>
                                            <div>
                                                <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="record.fecha" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 mb-3">
                                            <label for="horamaxima" class="form-label">Hora</label>
                                            <input type="time" step="1" class="form-control" id="horamaxima" wire:model.defer="record.hora" required>
                                        </div>-->
                                        <div class="col-sm-7">
                                            <div class="mb-3 relative">
                                                <label for="billinginfo-firstName" class="form-label">Proveedor</label>
                                                @livewire('vc-incremental-proveedor',['nombre' => $record['proveedor']])
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="mb-3 relative">
                                                <label for="billinginfo-lastName" class="form-label">Hacienda</label>
                                                @livewire('vc-incremental-hacienda',['nombre' => $record['hacienda']])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="mb-3">
                                                <label for="chofer" class="form-label">Chofer</label>
                                                @livewire('vc-incremental-chofer',['nombre' => $record['chofer']])
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="billinginfo-email" class="form-label">Producto</label>
                                                <input type="text" class="form-control" id="chofer" placeholder="Ingrese Nombre del Chofer" wire:model="record.producto" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="billinginfo-phone" class="form-label">Variedad</label>
                                                <select class="form-select" data-choices data-choices-search-false
                                                    name="choices-single-default" id="idStatus" wire:model="record.variedad">
                                                    <option value="GUINNENSIS">GUINNENSIS</option>
                                                    <option value="COARI">COARI</option>
                                                    <option value="TAISHA">TAISHA</option>
                                                    <option value="HIBRIDA">HIBRIDA</option>
                                                    <option value="AMAZON">AMAZON</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="row g-4">
                                            <div class="col-lg-4">
                                                <div class="form-check card-radio">
                                                    <input id="shippingMethod01" name="shippingMethod" type="radio" class="form-check-input" checked="">
                                                    <label class="form-check-label" for="shippingMethod01">
                                                        <div class="mb-3">
                                                            <span class="fs-14 mb-1 text-wrap d-block">Peso Bruto</span>
                                                            <span class="fs-20 text-wrap d-block fw-semibold">
                                                                <input type="number" class="form-control bg-light border-0 p-1 text-end fs-20" placeholder="0.00" aria-label="Peso Bruto" wire:model.defer="record.peso_bruto" wire:blur="pesoNeto" required>
                                                            </span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <span class="text-muted fw-normal text-wrap d-block">
                                                                    <div class="row"> 
                                                                        <div class="col-sm-7">
                                                                            <label for="dfechaini" class="form-label">Emisión</label>
                                                                            <div>
                                                                                <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="record.fechabruto" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <label for="horamaxima" class="form-label">Hora</label>
                                                                            <input type="time" step="1" class="form-control" id="horamaxima" wire:model.defer="record.horabruto" required>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-check card-radio">
                                                    <input id="shippingMethod02" name="shippingMethod" type="radio" class="form-check-input" checked="">
                                                    <label class="form-check-label" for="shippingMethod02">
                                                        <div class="mb-3">
                                                            <span class="fs-14 mb-1 text-wrap d-block">Peso Tara</span>
                                                            <span class="fs-20 text-wrap d-block fw-semibold">
                                                                <input type="number" class="form-control bg-light border-0 p-1 text-end fs-20" placeholder="0.00" aria-label="Peso Tara" wire:model.defer="record.peso_tara" wire:blur="pesoNeto" required>
                                                            </span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <span class="text-muted fw-normal text-wrap d-block">
                                                                    <div class="row"> 
                                                                        <div class="col-sm-7">
                                                                            <label for="dfechaini" class="form-label">Emisión</label>
                                                                            <div>
                                                                                <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="record.fechatara" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <label for="horamaxima" class="form-label">Hora</label>
                                                                            <input type="time" step="1" class="form-control" id="horamaxima" wire:model.defer="record.horatara" required>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-check card-radio">
                                                    <input id="shippingMethod02" name="shippingMethod" type="radio"
                                                        class="form-check-input" checked="">
                                                    <label class="form-check-label" for="shippingMethod02">
                                                        <span
                                                            class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">{{$record['peso_neto']}}
                                                            Tn</span>
                                                        <span class="fs-14 mb-1 text-wrap d-block">Peso Neto</span>
                                                        <span class="text-muted fw-normal text-wrap d-block">.</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </fieldset>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="submit" class="btn btn-success btn-label right ms-auto nexttab" data-nexttab="pills-payment-tab"><i class=" ri-save-3-line label-icon align-middle fs-16 ms-2"></i>Grabar</button> 
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade {{$activeTab['S2']}}" id="pills-bill-address" role="tabpanel"
                                aria-labelledby="pills-bill-address-tab">
                                <div>
                                    <h5 class="mb-1">Detalle de Racimos</h5>
                                    <p class="text-muted mb-4">Por favor, ingrese toda la información a continuación.
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <div class="mb-3 relative">
                                        <label for="billinginfo-lastName" class="form-label">Hacienda</label>
                                        <div class="search-box">
                                            <input type="text" class="form-control" value="{{$record['hacienda']}}" disabled/>
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table-sm table-card mb-3">
                                            <table class="table table-nowrap table-sm align-middle" id="orderTable">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th>Sector</th>
                                                        <th style="width: 180px;" class="text-end">Cantidad</th>
                                                        @if($selectId==0)
                                                        <th style="width: 180px;" class="text-end">Peso Neto</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($racimos as $key => $sector) 
                                                    <tr>
                                                        <td>{{$sector['detalle']}}</td>
                                                        <td><input type="number" class="form-control form-control-sm bg-light border-0 p-1 text-end" id="cantidad-{{$key}}" step="1" y min="0" wire:model="racimos.{{$key}}.cantidad"></td>
                                                        @if($selectId==0)
                                                        <td><input type="number" class="form-control form-control-sm bg-light border-0 p-1 text-end" id="pneto-{{$key}}" step="1" y min="0" wire:model="racimos.{{$key}}.pesoneto" disabled></td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade {{$activeTab['S3']}}" id="pills-payment" role="tabpanel"
                                aria-labelledby="pills-payment-tab">
                                <div>
                                    <h5 class="mb-1">Calificación de Fruta</h5>
                                    <p class="text-muted mb-4">Por favor seleccione e ingrese la información</p>
                                </div>

                                <div class="row g-4">
                                    <div class="col-lg-4 col-sm-6">
                                        <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show"
                                            aria-expanded="false" aria-controls="paymentmethodCollapse">
                                            <div class="form-check card-radio">
                                                <input id="paymentMethod01" name="paymentMethod" type="radio"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="paymentMethod01">
                                                    <span class="fs-16 text-muted me-2"><i
                                                            class="ri-paypal-fill align-bottom"></i></span>
                                                    <span class="fs-14 text-wrap">Sin Calificar</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse"
                                            aria-expanded="true" aria-controls="paymentmethodCollapse">
                                            <div class="form-check card-radio">
                                                <input id="paymentMethod02" name="paymentMethod" type="radio"
                                                    class="form-check-input" checked="">
                                                <label class="form-check-label" for="paymentMethod02">
                                                    <span class="fs-16 text-muted me-2"><i
                                                            class="ri-bank-card-fill align-bottom"></i></span>
                                                    <span class="fs-14 text-wrap">Calificar</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6">
                                        <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show"
                                            aria-expanded="false" aria-controls="paymentmethodCollapse">
                                            <div class="form-check card-radio">
                                                <input id="paymentMethod03" name="paymentMethod" type="radio"
                                                    class="form-check-input" value="1" wire:model="record.fruta_optima">
                                                <label class="form-check-label" for="paymentMethod03">
                                                    <span class="fs-16 text-muted me-2"><i
                                                            class="ri-money-dollar-box-fill align-bottom"></i></span>
                                                    <span class="fs-14 text-wrap">Fruta Optima</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="collapse show" id="paymentmethodCollapse">
                                    <div class="card p-4 border shadow-none mb-0 mt-4">
                                        @livewire('vc-califica-fruta',['id' => $selectId])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif 
            <!--end card-->
            @if ($record['peso_bruto']>0)
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                    </div>
                </div>
                <div class="card-body">

                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="fs-15 las la-dolly-flatbed"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Peso Ingreso - <span
                                                        class="fw-normal">{{$record['diasemana']}}, {{$record['fechabruto']}}</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">El operador ha procesado - peso bruto</h6>
                                        <p class="text-muted mb-0">{{$record['peso_bruto']}} Tm, {{$record['diasemana']}},
                                            {{$record['fechabruto']}} - {{$record['horabruto']}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if ($record['peso_tara']>0)
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingTwo">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="fs-15 las la-truck"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Peso Salida <span
                                                        class="fw-normal">{{$record['diasemana']}}, {{$record['fechatara']}}</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">El operador ha procesado - peso tara</h6>
                                        <p class="text-muted mb-0">{{$record['peso_tara']}} Tm,{{$record['diasemana']}}, {{$record['fechatara']}} - {{$record['horatara']}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($pago)
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingThree">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="fs-15 ri-hand-coin-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Liquidar Pago <span
                                                        class="fw-normal">{{$pago['diasemana']}},{{$pago['fecha']}}</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="fs-14">N° {{$pago['documento']}} - Ch./ {{$pago['cheque']}}</h6>
                                        <h6 class="fs-14">{{$pago['banco']}}</h6>
                                        <h6 class="mb-1">Peso ha sido liquidado</h6>
                                        <p class="text-muted mb-0">{{$pago['diasemana']}}, {{$pago['fecha']}} - {{$pago['hora']}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!--end accordion-->
                    </div>

                </div>
            </div>
            <!--end card-->
            @endif
        </div>
        <!--end col-->
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0"><i
                                class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i>Detalle Logistico
                        </h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="badge badge-soft-info fs-11">Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <fieldset {{$fieldset}}> 
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop"
                            colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                        <!--<h5 class="fs-16 mt-2">RQK Logistics</h5>
                        <p class="text-muted mb-0">ID: MFDS1400457854</p>
                        <p class="text-muted mb-0">Payment Mode : Debit Card</p>-->                        
                        <!-- Basic example -->
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="basic-addon1">Vehículo</span>
                            <input type="text" class="form-control" placeholder="Descripción del vehículo" aria-label="Username"
                                aria-describedby="basic-addon1" wire:model.defer="record.vehiculo" disabled>
                            <li class="list-inline-item">
                                <div class="dropdown">
                                    <button class="btn btn-soft-secondary dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" style="">
                                        @foreach($tblplacas as $placa)
                                        <li><a class="dropdown-item view-item-btn" href="javascript:void(0);" wire:click="getVehiculo({{$placa->Id_Fila}})"><i class="ri-arrow-drop-right-line align-bottom me-2 text-muted"></i>{{$placa->Placa}} -> {{$placa->Nombre}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </div>
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="basic-addon1">Placa</span>
                            <input type="text" class="form-control" placeholder="N° de placa" aria-label="Username"
                                aria-describedby="basic-addon1" wire:model.defer="record.placa">
                        </div>
                    </div>
                    </fieldset>
                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Detalle del Proveedor</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="link-secondary">Ver Perfil</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt=""
                                        class="avatar-sm rounded">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ !empty($persona) ? $persona->nombre_comercial : 'Nombre Comercial' }}</h6>
                                    <p class="text-muted mb-0">{{ !empty($persona) ? $persona->ruc : '999999999001' }}</p>
                                </div>
                            </div>
                        </li>
                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ !empty($persona) ? $persona->email : '@dominio.com' }}</li>
                        <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>+(593) {{ !empty($persona) ? $persona->telefono : '999-999-999' }}</li>
                    </ul>
                </div>
                
            </div>
            <!--end card-->
            
            @if(!empty($pago))
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i
                    class="ri-secure-payment-line align-bottom me-1 text-muted"></i>Detalle de Pago</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Transactions:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">#{{$pago['documento']}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Fecha de Pago:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{$pago['fecha']}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Metodo de Pago:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">Cheque - {{$pago['cheque']}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Total Amount:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">$415.96</h6>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</div>