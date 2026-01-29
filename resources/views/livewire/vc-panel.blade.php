<div>
<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Buen día, {{ Auth::user()->name }} </h4>
                            <!--<p class="text-muted mb-0">Here's what's happening with your store
                                today.</p>-->
                        </div>
                        <div class="mt-3 mt-lg-0">
                            <form>
                                <div class="row g-3 mb-0 align-items-center">
                                    <div class="col-sm-auto">
                                        <div class="input-group">
                                            <select type="select" class="form-select" data-trigger id="cmbtiporol" wire:model="mes">
                                            @for($x = 1; $x<=12; $x++)
                                                <option value={{$x}}>{{$objmes[$x]}}</option>
                                            @endfor
                                            </select>
                                            <input id="input-periodo" type="text" class="form-control" wire:model="periodo" disabled>
                                            
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <a class="btn btn-soft-secondary add-btn" href="/payroll/rolpago"><i
                                        class="ri-add-circle-line me-1 align-middle "></i> General Rol</a>
                                        
                                    </div>
                                    <!--end col-->
                                    <!--<div class="col-auto">
                                        <button type="button"
                                            class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                class="ri-pulse-line"></i></button>
                                    </div>-->
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate bg-primary ">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-bold text-white-75 text-truncate mb-0">
                                        Personal Total </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-white fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                        <!--+16.24 %-->
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                            class="counter-value" data-target="{{$total}}">{{$total}}</span>
                                    </h4>
                                    <a href="" class="text-decoration-underline text-white-50">Visualizar</a>
                                </div>
                                <!--<div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3">
                                        <i class="bx bx-dollar-circle text-white"></i>
                                    </span>
                                </div>-->
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate bg-secondary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-bold text-white-75 text-truncate mb-0">
                                        Personal Mujeres</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-white fs-14 mb-0">
                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                        <!---3.57 %-->
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                            class="counter-value" data-target="{{$mujeres}}">{{$mujeres}}</span></h4>
                                    <a href="" class="text-decoration-underline text-white-50">Visualizar</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3">
                                        <i class="bx bx-shopping-bag text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate bg-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-bold text-white-75 text-truncate mb-0">
                                        Personal Hombres</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-white fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                        <!--+29.08 %-->
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                            class="counter-value" data-target="{{$hombres}}">{{$hombres}}</span>
                                    </h4>
                                    <a href="" class="text-decoration-underline text-white-50">Visualizar</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3">
                                        <i class="bx bx-user-circle text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate bg-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                        Nomina Total</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-white fs-14 mb-0">
                                        +0.00 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4">$<span
                                            class="counter-value" data-target="{{$monto}}">{{$monto}}</span>
                                    </h4>
                                    <a href="/payroll/nominas"
                                        class="text-decoration-underline text-white-50">Visualizar Nominas</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3">
                                        <i class="bx bx-wallet text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

            <div class="row">
                <body onload="loadGraphs({{$chartsrol}},{{$charts2}},{{$charts3}})">
                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Total Nómina</h4>
                        </div>
                        <div class="card-body">
                            <div id="registros">
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Nomina Total por Área</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="w-100">
                                <div class="mb-3">
                                </div>
                                <div id="monto"></div>
                            </div>
                            <div>
                                <span class="text-center text-muted" style="font-size: 11px"></span>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Ingresos - Egresos</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="w-100">
                                <div class="mb-3">
                                </div>
                                <div id="container"></div>
                            </div>
                            <div>
                                <span class="text-center text-muted" style="font-size: 11px"></span>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div>
                </body>
            </div>
            
        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>
