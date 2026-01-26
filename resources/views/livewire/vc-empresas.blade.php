<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body checkout-tab">

                    <form autocomplete="off" wire:submit.prevent="{{ $addNew ? 'createData' : 'updateData' }}">
                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab"
                                        aria-controls="pills-bill-info" aria-selected="true"><i
                                            class="ri-user-2-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                        Empresa</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3" id="pills-bill-address-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-bill-address" type="button" role="tab"
                                        aria-controls="pills-bill-address" aria-selected="false"><i
                                            class="ri-truck-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                        RRHH</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel"
                                aria-labelledby="pills-bill-info-tab">
                                <div>
                                    <h5 class="mb-1">Información de Empresa</h5>
                                    <p class="text-muted mb-4">Por favor complete toda la información a continuación</p>
                                </div>
                                <fieldset {{$estado}}>
                                    <div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="record.razonsocial" class="form-label">Razón Social</label>
                                                <input type="text" wire:model.defer="record.razonsocial"
                                                    class="form-control" placeholder="Ingrese la Razón Social"
                                                    required />
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="record.nombrecomercial" class="form-label">Nombre
                                                        Comercial</label>
                                                    <input type="text" wire:model.defer="record.nombrecomercial"
                                                        class="form-control" placeholder="Ingrese Nombre Comercial"
                                                        required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="record.ruc" class="form-label">RUC</label>
                                                    <input type="text" wire:model.defer="record.ruc"
                                                        class="form-control" placeholder="Ingrese Ruc" required />
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="record.telefono" class="form-label">Teléfono</label>
                                                    <input type="text" wire:model.defer="record.telefono"
                                                        class="form-control" placeholder="Ingrese Teléfono" required />
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="record.email" class="form-label">Contacto Email</label>
                                                    <input type="text" wire:model.defer="record.email"
                                                        class="form-control" placeholder="Ingrese Mail" required />
                                                </div>
                                            </div>

                                        </div>

                                        <div class="mb-3">
                                            <label for="record.provincia" class="form-label">Provincia</label>
                                            <input type="text" wire:model.defer="record.provincia" class="form-control"
                                                placeholder="Ingrese Provincia" required />
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="record.ciudad" class="form-label">Ciudad</label>
                                                    <input type="text" wire:model.defer="record.ciudad"
                                                        class="form-control" placeholder="Ingrese ciudad" required />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="record.canton" class="form-label">Cantón</label>
                                                    <input type="text" wire:model.defer="record.canton"
                                                        class="form-control" placeholder="Ingrese Cantón" required />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="record.ubicacion" class="form-label">Ubicación</label>
                                                    <input type="text" wire:model.defer="record.ubicacion"
                                                        class="form-control" placeholder="Ingrese Ubicación" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="record.representante" class="form-label">Representante
                                                        Legal</label>
                                                    <input type="text" wire:model.defer="record.representante"
                                                        class="form-control" placeholder="Ingrese Representante Legal"
                                                        required />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="record.identificacion"
                                                        class="form-label">Identificación</label>
                                                    <input type="text" wire:model.defer="record.identificacion"
                                                        class="form-control" placeholder="Ingrese Identificación"
                                                        required />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="record.website" class="form-label">Pagina Web</label>
                                                    <input type="text" wire:model.defer="record.website"
                                                        class="form-control" placeholder="Ingrese Pagina Web"
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade mb-3" id="pills-bill-address" role="tabpanel"
                                aria-labelledby="pills-bill-address-tab">
                                <div>
                                    <h5 class="mb-1">Información de Departamento</h5>
                                    <p class="text-muted mb-4">Por favor complete toda la información a continuación</p>
                                </div>
                                <div class="mt-4">
                                    <fieldset {{$estado}}>
                                    <div class="row">
                                        <div class="col-md-8">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="periodo" class="form-label">Ejercicio</label>
                                                <input type="text" wire:model.defer="periodo" class="form-control"
                                                    placeholder="" required />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="record.canton" class="form-label">Salario Básico</label>
                                                <input type="number" wire:model.defer="record.salario_basico"
                                                    class="form-control" placeholder="Ingrese Cantón" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-lg-4">
                                            <h5 class="card-title flex-grow-1 mb-3 text-primary fs-14">
                                                <i class="mdi mdi-account-cash align-middle me-1 text-success"></i>
                                                Rubros - Aportación Iess
                                            </h5>
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="input-group form-group">
                                                        <label for="record.rubro_appersonal" class="input-group-text">%
                                                            Aporte Personal</label>
                                                        <div class="col-sm-2">
                                                            <input type="number" class="form-control" id="txtappersonal"
                                                                placeholder="0.00" step="0.01" min="0"
                                                                inputmode="decimal"
                                                                wire:model.defer="record.aporte_personal" required>
                                                        </div>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select"
                                                            wire:model.defer="record.rubro_appersonal" required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="input-group form-group">
                                                        <label for="record.rubro_appatronal" class="input-group-text">%
                                                            Aporte Patronal</label>
                                                        <div class="col-sm-2">
                                                            <input type="number" class="form-control" id="txtappatronal"
                                                                placeholder="0.00" step="0.01" min="0"
                                                                inputmode="decimal"
                                                                wire:model.defer="record.aporte_patronal" required>
                                                        </div>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select"
                                                            wire:model.defer="record.rubro_appatronal" required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 mb-3">
                                                    <div class="input-group form-group">
                                                        <label for="record.rubro_secap" class="input-group-text">%
                                                            Aporte Secap</label>
                                                        <div class="col-sm-2">
                                                            <input type="number" class="form-control" id="txtapsecap"
                                                                placeholder="0.00" step="0.01" min="0"
                                                                inputmode="decimal"
                                                                wire:model.defer="record.aporte_secap" required>
                                                        </div>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select" wire:model.defer="record.rubro_apsecap"
                                                            required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="input-group form-group">
                                                        <label for="record.rubro_iece" class="input-group-text">%
                                                            Aporte Iece</label>
                                                        <div class="col-sm-2">
                                                            <input type="number" class="form-control" id="txtapiece"
                                                                placeholder="0.00" step="0.01" min="0"
                                                                inputmode="decimal"
                                                                wire:model.defer="record.aporte_iece" required>
                                                        </div>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select" wire:model.defer="record.rubro_apiece"
                                                            required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <h5 class="card-title flex-grow-1 mb-3 text-primary fs-14">
                                                <i class="mdi mdi-cash-multiple align-middle me-1 text-success"></i>
                                                Beneficios
                                            </h5>
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="input-group form-group">
                                                        <label for="record.decimo_tercero" class="input-group-text">13.º
                                                            Sueldo</label>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select" wire:model.defer="record.decimo_tercero"
                                                            required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">

                                                    <div class="input-group form-group">
                                                        <label for="record.decimo_cuarto" class="input-group-text">14.º
                                                            Sueldo</label>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select" wire:model.defer="record.decimo_cuarto"
                                                            required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="input-group form-group">
                                                        <label class="input-group-text"
                                                            for="rubro-select">Vacaciones</label>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select" wire:model.defer="record.vacaciones"
                                                            required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="input-group form-group">
                                                        <label class="input-group-text" for="rubro-select">Fondo
                                                            Reserva</label>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select" wire:model.defer="record.rubro_freserva"
                                                            required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <h5 class="card-title flex-grow-1 mb-3 text-primary fs-14">
                                                <i class="mdi mdi-currency-usd align-middle me-1 text-success"></i>
                                                Horas Extras
                                            </h5>
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="input-group form-group">
                                                        <label for="extras25" class="input-group-text">H.Extra 25%</label>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select" wire:model.defer="record.extra25"
                                                            required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">

                                                    <div class="input-group form-group">
                                                        <label for="extras50" class="input-group-text">H. Extra 50%</label>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select" wire:model.defer="record.extra50"
                                                            required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="input-group form-group">
                                                        <label class="input-group-text"
                                                            for="rubro-select">H. Extra 100%</label>
                                                        <select type="select" class="form-select" data-trigger
                                                            name="rubro-select" wire:model.defer="record.extra100"
                                                            required>
                                                            <option value="">Seleccione Rubro</option>
                                                            @foreach ($tblrubros as $rubro)
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="row g-4">
                                        @livewire('vc-cuentas-provision')
                                    </div>--}}
                                    </fieldset>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade mb-3" id="pills-payment" role="tabpanel"
                                aria-labelledby="pills-payment-tab">
                                <div>
                                    <h5 class="mb-1">Payment Selection</h5>
                                    <p class="text-muted mb-4">Please select and enter your billing
                                        information</p>
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
                                                    <span class="fs-14 text-wrap">Paypal</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse"
                                            aria-expanded="true" aria-controls="paymentmethodCollapse">
                                            <div class="form-check card-radio">
                                                <input id="paymentMethod02" name="paymentMethod" type="radio"
                                                    class="form-check-input" checked>
                                                <label class="form-check-label" for="paymentMethod02">
                                                    <span class="fs-16 text-muted me-2"><i
                                                            class="ri-bank-card-fill align-bottom"></i></span>
                                                    <span class="fs-14 text-wrap">Credit / Debit
                                                        Card</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6">
                                        <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show"
                                            aria-expanded="false" aria-controls="paymentmethodCollapse">
                                            <div class="form-check card-radio">
                                                <input id="paymentMethod03" name="paymentMethod" type="radio"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="paymentMethod03">
                                                    <span class="fs-16 text-muted me-2"><i
                                                            class="ri-money-dollar-box-fill align-bottom"></i></span>
                                                    <span class="fs-14 text-wrap">Cash on
                                                        Delivery</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="collapse show" id="paymentmethodCollapse">
                                    <div class="card p-4 border shadow-none mb-0 mt-4">
                                        <div class="row gy-3">
                                            <div class="col-md-12">
                                                <label for="cc-name" class="form-label">Name on
                                                    card</label>
                                                <input type="text" class="form-control" id="cc-name"
                                                    placeholder="Enter name">
                                                <small class="text-muted">Full name as displayed on
                                                    card</small>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="cc-number" class="form-label">Credit card
                                                    number</label>
                                                <input type="text" class="form-control" id="cc-number"
                                                    placeholder="xxxx xxxx xxxx xxxx">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="cc-expiration" class="form-label">Expiration</label>
                                                <input type="text" class="form-control" id="cc-expiration"
                                                    placeholder="MM/YY">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="cc-cvv" class="form-label">CVV</label>
                                                <input type="text" class="form-control" id="cc-cvv" placeholder="xxx">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-muted mt-2 fst-italic">
                                        <i data-feather="lock" class="text-muted icon-xs"></i> Your
                                        transaction is secured with SSL encryption
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="pills-bill-address-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                        to Shipping</button>
                                    <button type="button" class="btn btn-primary btn-label right ms-auto nexttab"
                                        data-nexttab="pills-finish-tab"><i
                                            class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Complete
                                        Order</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="pills-finish" role="tabpanel"
                                aria-labelledby="pills-finish-tab">
                                <div class="text-center py-5">

                                    <div class="mb-4">
                                        <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                                            colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">
                                        </lord-icon>
                                    </div>
                                    <h5>Thank you ! Your Order is Completed !</h5>
                                    <p class="text-muted">You will receive an order confirmation email
                                        with
                                        details of your order.</p>

                                    <h3 class="fw-semibold">Order ID: <a href="apps-ecommerce-order-details"
                                            class="text-decoration-underline">VZ2451</a></h3>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                        <div class="card">
                            <div class="card-body">
                                <div class="text-end">
                                    @if($estado=='disabled')
                                    <button type="button" class="btn btn-success w-sm" wire:click="edit">Editar</button>
                                    @else
                                    <button type="submit" class="btn btn-success w-sm">Grabar</button>
                                    @endif
                                    <a class="btn btn-secondary w-sm" href="/form/rubros"><i class="me-1 align-bottom"></i>Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    {{--<div wire.ignore.self class="modal fade" id="showCuentas" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content border-0">

                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span> Consultas de cuentas &nbsp;</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                <form autocomplete="off">

                    <div class="modal-body">
                        @livewire('vc-buscar-cuentas',['target'=>'vc-cuentas-provision'])
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>--}}

</div>