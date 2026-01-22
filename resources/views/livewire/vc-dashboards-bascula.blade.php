<div>
    <div class="row">
        <div class="col-xxl-8">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-stack-line align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">
                                            Total Fruta</p>
                                        <h4 class=" mb-0">{{$totalFruta}} Tm</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-end">
                                        <span class="badge badge-soft-success"><i
                                                class="ri-arrow-up-s-fill align-middle me-1"></i>${{$promedioTotal}}<span>
                                            </span></span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-arrow-up-circle-fill align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">
                                            Quevedo</p>
                                        <h4 class=" mb-0">${{$quevedo}} Tm</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-end">
                                        <span class="badge badge-soft-success"><i
                                                class="ri-arrow-up-s-fill align-middle me-1"></i>${{$precioQuevedo}}<span>
                                            </span></span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-arrow-up-circle-fill align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Oriente</p>
                                        <h4 class=" mb-0">{{$oriente}} Tm</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-end">
                                        <span class="badge badge-soft-success"><i
                                                class="ri-arrow-up-s-fill align-middle me-1"></i>${{$precioOriente}}<span>
                                            </span></span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>  
        </div>
        <div class="col-xxl-4">
            <form>
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-md-4 mb-3">
                    <select type="select" class="form-select" id="cmbperiodo" wire:model="periodo">
                    @foreach($tblperiodo as $ejercicio)
                        <option value="{{$ejercicio->periodo}}">{{$ejercicio->periodo}}</option>
                    @endforeach
                    </select>
                    </div>
                    <div class="col-md-8 mb-3">
                        <select type="select" class="form-select" data-trigger id="cmbsemana" wire:model="semana" wire:change="loadSemana">
                        @foreach($tblsemana as $calendario)
                            <option value="{{$calendario->Semana}}">{{$calendario->Semana}} - {{date('d/m/Y', strtotime($calendario->FechaInicio))}} {{date('d/m/Y', strtotime($calendario->FechaFin))}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="col-xxl-5">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    @foreach($acopios as $acopio)

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0 fs-12 text-uppercase">{{$acopio->EntregaFruta}}</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">{{ number_format($acopio->Tn, 2) }}<span class="fs-11">Tm</span>
                                        </h2>      
                                        <p class="mb-0 text-muted">
                                            <span class="badge bg-light text-primary mb-0">
                                                <i class="align-middle fs-12">$</i>
                                                {{ number_format($acopio->Promedio, 2) }}
                                            </span>
                                            <span class="badge bg-light text-success mb-0 ms-2">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                                {{ number_format($acopio->MaximoValor, 2) }}
                                            </span>
                                            <span class="badge bg-light text-danger mb-0 ms-2">
                                                <i class="ri-arrow-down-line align-middle"></i>
                                                {{ number_format($acopio->MinimoValor, 2) }}
                                            </span>
                                        </p>    
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                <i class="ri-luggage-cart-line align-middle text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    @endforeach
                </div> <!-- end row-->
            </div>
        </div> <!-- end col-->
        
        <div class="col-xxl-7">
            <body onload="loadDashboard({{$charts1}},{{$charts2}},{{$charts3}},{{$charts4}},{{$charts5}})">
            <div class="row h-100">
                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <figure class="highcharts-figure">
                            <div id="container1"></div>
                        </figure>
                    </div><!-- end card -->
                </div> <!-- end col-->

                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <figure class="highcharts-figure">
                            <div id="container2"></div>
                        </figure>
                    </div><!-- end card -->
                </div> <!-- end col-->

            </div> <!-- end row-->
        </div><!-- end col -->
    </div> <!-- end row-->

    <div class="row">
        <div class="col-xl-5">
            <figure class="highcharts-figure">
            <div id="container4"></div>
            </figure>
        </div><!-- end col -->
        <div class="col-xl-7">
            <figure class="highcharts-figure">
                <div id="container5"></div>
            </figure>
        </div>
    </div>    
    
    <div class="row">
        <div class="col-xl-12">
            <figure class="highcharts-figure">
            <div id="container3"></div>
        </figure>
        </div>

        <!--<div class="col-xl-6">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Audiences Sessions by Country</h4>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span
                                    class="text-muted">Current Week<i
                                        class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Last Week</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">Current Year</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div>
                        <div id="audiences-sessions-country-charts"
                            data-colors='["--vz-success", "--vz-info"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>
