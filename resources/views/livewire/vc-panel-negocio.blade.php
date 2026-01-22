<div>
    <div class="row">
        <div class="col-xxl-3">
            <div class="card card-height-100">
                <div class="card-header border-0 align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Costo Proyectado - CPO</h4>
                </div><!-- end cardheader -->
                <div class="card-body">
                    <!--<body onload="loadDashboard({{$charts}})">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        
                    </figure>-->
                    <ul class="list-group list-group-flush border-dashed mb-0 mt-3 pt-2">
                        @foreach($costos as $costo)
                        @if($costo->codigo == 299 || $costo->codigo == 498 || $costo->codigo == 499 || $costo->codigo == 598 || $costo->codigo == 599)
                        <li class="list-group-item px-0">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <span class="avatar-title bg-light p-1 rounded-circle">
                                        <img src="{{ URL::asset('assets/images/svg/crypto-icons/usd.svg') }}"
                                            class="img-fluid" alt="">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-1">{{$costo->nombre}}</h6>
                                    
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1"><strong>${{ number_format($costo->total+$costo->cst_tm, 2) }}</strong></h6>
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                       <!--<li class="list-group-item px-0">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <span class="avatar-title bg-light p-1 rounded-circle">
                                        <img src="{{ URL::asset('assets/images/svg/crypto-icons/eth.svg') }}"
                                            class="img-fluid" alt="">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-1">Ethereum</h6>
                                    <p class="fs-12 mb-0 text-muted"><i
                                            class="mdi mdi-circle fs-10 align-middle text-info me-1"></i>ETH
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1">ETH 2.25842108</h6>
                                    <p class="text-danger fs-12 mb-0">$40552.18</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <span class="avatar-title bg-light p-1 rounded-circle">
                                        <img src="{{ URL::asset('assets/images/svg/crypto-icons/ltc.svg') }}"
                                            class="img-fluid" alt="">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-1">Litecoin</h6>
                                    <p class="fs-12 mb-0 text-muted"><i
                                            class="mdi mdi-circle fs-10 align-middle text-warning me-1"></i>LTC
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1">LTC 10.58963217</h6>
                                    <p class="text-success fs-12 mb-0">$15824.58</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pb-0">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <span class="avatar-title bg-light p-1 rounded-circle">
                                        <img src="{{ URL::asset('assets/images/svg/crypto-icons/dash.svg') }}"
                                            class="img-fluid" alt="">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-1">Dash</h6>
                                    <p class="fs-12 mb-0 text-muted"><i
                                            class="mdi mdi-circle fs-10 align-middle text-success me-1"></i>DASH
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1">DASH 204.28565885</h6>
                                    <p class="text-success fs-12 mb-0">$30635.84</p>
                                </div>
                            </div>
                        </li>-->
                    </ul><!-- end -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xxl-9 order-xxl-0 order-first">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-money-dollar-circle-fill align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">
                                            FRUTA COMPRADA</p>
                                        <h4 class=" mb-0"><span class="counter-value"
                                                data-target="{{$totalFruta}}">0</span> Tm</h4>
                                    </div>
                                    
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-money-dollar-circle-fill align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">
                                            FRUTA PROCESADA</p>
                                        
                                            <h4 class=" mb-0"><span class="counter-value"
                                                data-target="{{$produccion->procesado}}">0</span> Tm</h4>
                                        
                                        
                                    </div>
                                    
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-lg-3 col-md-6">
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
                                            Aceite Extraido</p>
                                        <h4 class=" mb-0"><span class="counter-value"
                                                data-target="{{$produccion->extraido}}">0</span> Tm</h4>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-arrow-down-circle-fill align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Transferido</p>
                                        <h4 class=" mb-0"><span class="counter-value"
                                                data-target="{{$refineria->toneladas}}">0</span> Tm</h4>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
                <div class="row">
                    <div class="col-xxl-6 col-lg-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Facturado</h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0">
                                <div data-simplebar style="height: 390px;">
                                    <div class="p-3">
                                        <h6 class="text-muted text-uppercase mb-3 fs-11">VENTAS</h6>
                                        @foreach($facturado as $venta)
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs flex-shrink-0">
                                                <span class="avatar-title bg-light rounded-circle">
                                                    <i class="ri-share-forward-2-line text-success fs-15 align-middle"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="text-uppercase fs-14 mb-1">{{$venta->nombre}}</h6>
                                                <p class="text-muted fs-12 mb-0">
                                                    <i class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                                </p>
                                            </div>
                                            <div class="flex-shrink-0 text-end">
                                                <h6 class="mb-1 text-primary">{{number_format($venta->toneladas,2)}}<span
                                                        class="text-uppercase ms-1">Tm</span></h6>
                                                <p class="text-muted fs-13 mb-0">${{number_format($venta->subtotal,2)}}</p>
                                            </div>
                                        </div><!-- end -->
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xxl-6 col-lg-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Por Facturar</h4>
                            </div><!-- end card header -->
                            <div class="card-body p-0">
                                <div data-simplebar style="height: 390px;">
                                    <div class="p-3">
                                        <h6 class="text-muted text-uppercase mb-3 fs-11">DESPACHOS VENTAS</h6>
                                        @foreach($facturar as $venta)
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs flex-shrink-0">
                                                <span class="avatar-title bg-light rounded-circle">
                                                    <i class="ri-share-forward-2-line text-success fs-15 align-middle"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="text-uppercase fs-14 mb-1">{{$venta->nombre}}</h6>
                                                <p class="text-muted fs-12 mb-0">
                                                    <i class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                                </p>
                                            </div>
                                            <div class="flex-shrink-0 text-end">
                                                <h6 class="mb-1 text-primary">{{number_format($venta->toneladas,2)}}<span
                                                        class="text-uppercase ms-1">Tm</span></h6>
                                                <p class="text-muted fs-13 mb-0">${{number_format($venta->subtotal,2)}}</p>
                                            </div>
                                        </div><!-- end -->
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>    

                <!--<div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Market Graph</h4>
                                <div>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        1H
                                    </button>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        7D
                                    </button>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        1M
                                    </button>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        1Y
                                    </button>
                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                        ALL
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div
                                    class="bg-soft-light border-top-dashed border border-start-0 border-end-0 border-bottom-dashed py-3 px-4">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="d-flex flex-wrap gap-4 align-items-center">
                                                <h5 class="fs-19 mb-0">0.014756</h5>
                                                <p class="fw-medium text-muted mb-0">$75.69 <span
                                                        class="text-success fs-11 ms-1">+1.99%</span>
                                                </p>
                                                <p class="fw-medium text-muted mb-0">High <span
                                                        class="text-dark fs-11 ms-1">0.014578</span></p>
                                                <p class="fw-medium text-muted mb-0">Low <span
                                                        class="text-dark fs-11 ms-1">0.0175489</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div
                                                    class="d-flex justify-content-end text-end flex-wrap gap-4 ms-auto">
                                                    <div class="pe-3">
                                                        <h6 class="mb-2 text-truncate text-muted">Total
                                                            Balance</h6>
                                                        <h5 class="mb-0">$72.8k</h5>

                                                    </div>
                                                    <div class="pe-3">
                                                        <h6 class="mb-2 text-muted">Profit</h6>
                                                        <h5 class="text-success mb-0">+$49.7k</h5>
                                                    </div>
                                                    <div class="pe-3">
                                                        <h6 class="mb-2 text-muted">Loss</h6>
                                                        <h5 class="text-danger mb-0">-$23.1k</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0 pb-3">
                                <div id="Market_chart" data-colors='["--vz-success", "--vz-danger"]'
                                    class="apex-charts" dir="ltr">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="swiper cryptoSlider">
                <div class="swiper-wrapper">
                    @foreach($tblrecords as $key => $record)
                    <div class="swiper-slide">
                        <div class="card">
                            <div class="card-body">                                
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-light text-primary rounded-circle fs-3">
                                            <i class="ri-luggage-cart-line align-middle"></i>
                                        </span>
                                    </div>
                                    <h6 class="ms-2 mb-0 fs-14">{{$record->EntregaFruta}}</h6>
                                </div>
                                <div class="row">
                                    
                                        <h5 class="mb-1 mt-4">{{number_format($record->toneladas,2)}} Tm</h5>
                                        <p class="text-secondary fs-13 fw-medium mb-0">${{number_format($record->liquidar,2)}}<span
                                                class="text-muted ms-2 fs-10 text-uppercase">${{number_format($record->precio,2)}}</span>
                                        </p>
                                    
                                </div><!-- end row -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end -->
                    @endforeach                    
                </div><!-- end swiper wrapper -->
            </div><!-- end swiper -->
        </div><!-- end col -->
    </div><!-- end row -->

    <!--<div class="row">
        <div class="col-xxl-4 col-lg-6">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Recent Activity</h4>
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
                    <div data-simplebar style="height: 390px;">
                        <div class="p-3">
                            <h6 class="text-muted text-uppercase mb-3 fs-11">25 Dec 2021</h6>
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0">
                                    <span class="avatar-title bg-light rounded-circle">
                                        <i data-feather="arrow-down-circle"
                                            class="icon-dual-success icon-sm"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">Bought Bitcoin</h6>
                                    <p class="text-muted fs-12 mb-0">
                                        <i
                                            class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                        Visa Debit Card ***6
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1 text-success">+0.04025745<span
                                            class="text-uppercase ms-1">Btc</span></h6>
                                    <p class="text-muted fs-13 mb-0">+878.52 USD</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div class="avatar-xs flex-shrink-0">
                                    <span class="avatar-title bg-light rounded-circle">
                                        <i data-feather="send" class="icon-dual-warning icon-sm"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">Sent Eathereum</h6>
                                    <p class="text-muted fs-12 mb-0">
                                        <i
                                            class="mdi mdi-circle-medium text-warning fs-15 align-middle"></i>
                                        Sofia Cunha
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1 text-muted">-0.09025182<span
                                            class="text-uppercase ms-1">Eth</span></h6>
                                    <p class="text-muted fs-13 mb-0">-659.35 USD</p>
                                </div>
                            </div>

                            <h6 class="text-muted text-uppercase mb-3 mt-4 fs-11">24 Dec 2021</h6>
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0">
                                    <span class="avatar-title bg-light rounded-circle">
                                        <i data-feather="arrow-up-circle"
                                            class="icon-dual-danger icon-sm"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">Sell Dash</h6>
                                    <p class="text-muted fs-12 mb-0">
                                        <i
                                            class="mdi mdi-circle-medium text-danger fs-15 align-middle"></i>
                                        www.cryptomarket.com
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1 text-danger">-98.6025422<span
                                            class="text-uppercase ms-1">Dash</span></h6>
                                    <p class="text-muted fs-13 mb-0">-1508.98 USD</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div class="avatar-xs flex-shrink-0">
                                    <span class="avatar-title bg-light rounded-circle">
                                        <i data-feather="arrow-up-circle"
                                            class="icon-dual-danger icon-sm"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">Sell Dogecoin</h6>
                                    <p class="text-muted fs-12 mb-0">
                                        <i
                                            class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                        www.coinmarket.com
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1 text-danger">-1058.08025142<span
                                            class="text-uppercase ms-1">Doge</span></h6>
                                    <p class="text-muted fs-13 mb-0">-89.36 USD</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div class="avatar-xs flex-shrink-0">
                                    <span class="avatar-title bg-light rounded-circle">
                                        <i data-feather="arrow-up-circle"
                                            class="icon-dual-success icon-sm"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">Bought Litecoin</h6>
                                    <p class="text-muted fs-12 mb-0">
                                        <i
                                            class="mdi mdi-circle-medium text-warning fs-15 align-middle"></i>
                                        Payment via Wallet
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1 text-success">+0.07225912<span
                                            class="text-uppercase ms-1">Ltc</span></h6>
                                    <p class="text-muted fs-13 mb-0">+759.45 USD</p>
                                </div>
                            </div>

                            <h6 class="text-muted text-uppercase mb-3 mt-4 fs-11">20 Dec 2021</h6>
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0">
                                    <span class="avatar-title bg-light rounded-circle">
                                        <i data-feather="send" class="icon-dual-warning icon-sm"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">Sent Eathereum</h6>
                                    <p class="text-muted fs-12 mb-0">
                                        <i
                                            class="mdi mdi-circle-medium text-warning fs-15 align-middle"></i>
                                        Sofia Cunha
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1 text-muted">-0.09025182<span
                                            class="text-uppercase ms-1">Eth</span></h6>
                                    <p class="text-muted fs-13 mb-0">-659.35 USD</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <div class="avatar-xs flex-shrink-0">
                                    <span class="avatar-title bg-light rounded-circle">
                                        <i data-feather="arrow-down-circle"
                                            class="icon-dual-success icon-sm"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">Bought Bitcoin</h6>
                                    <p class="text-muted fs-12 mb-0">
                                        <i
                                            class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>
                                        Visa Debit Card ***6
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="mb-1 text-success">+0.04025745<span
                                            class="text-uppercase ms-1">Btc</span></h6>
                                    <p class="text-muted fs-13 mb-0">+878.52 USD</p>
                                </div>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="javascript:void(0);"
                                    class="text-muted text-decoration-underline">Load More</a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-lg-6">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Top Performers</h4>
                    <div>
                        <button type="button" class="btn btn-soft-info btn-sm">
                            1H
                        </button>
                        <button type="button" class="btn btn-soft-info btn-sm">
                            1D
                        </button>
                        <button type="button" class="btn btn-soft-info btn-sm">
                            7D
                        </button>
                        <button type="button" class="btn btn-soft-primary btn-sm">
                            1M
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush border-dashed mb-0">
                        <li class="list-group-item d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('assets/images/svg/crypto-icons/btc.svg') }}" class="avatar-xs"
                                    alt="">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-14 mb-1">Bitcoin</h6>
                                <p class="text-muted mb-0">$18.7 Billions</p>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <h6 class="fs-14 mb-1">$12,863.08</h6>
                                <p class="text-success fs-12 mb-0">+$67.21 (+4.33%)</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('assets/images/svg/crypto-icons/eth.svg') }}" class="avatar-xs"
                                    alt="">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-14 mb-1">Eathereum</h6>
                                <p class="text-muted mb-0">$27.4 Billions</p>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <h6 class="fs-14 mb-1">$08,256.04</h6>
                                <p class="text-success fs-12 mb-0">+$51.19<span
                                        class="ms-1">(+5.64%)</span></p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('assets/images/svg/crypto-icons/aave.svg') }}" class="avatar-xs"
                                    alt="">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-14 mb-1">Avalanche</h6>
                                <p class="text-muted mb-0">$12.9 Billions</p>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <h6 class="fs-14 mb-1">$11,896.13</h6>
                                <p class="text-danger fs-12 mb-0">-$59.01<span
                                        class="ms-1">(-4.08%)</span></p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('assets/images/svg/crypto-icons/doge.svg') }}" class="avatar-xs"
                                    alt="">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-14 mb-1">Dogecoin</h6>
                                <p class="text-muted mb-0">$09.5 Billions</p>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <h6 class="fs-14 mb-1">$15,999.06</h6>
                                <p class="text-success fs-12 mb-0">+$74.05<span
                                        class="ms-1">(+3.12%)</span></p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('assets/images/svg/crypto-icons/bnb.svg') }}" class="avatar-xs"
                                    alt="">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-14 mb-1">Binance</h6>
                                <p class="text-muted mb-0">$14.2 Billions</p>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <h6 class="fs-14 mb-1">$13,786.18</h6>
                                <p class="text-danger fs-12 mb-0">-$61.05<span
                                        class="ms-1">(-9.22%)</span></p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('assets/images/svg/crypto-icons/ltc.svg') }}" class="avatar-xs"
                                    alt="">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-14 mb-1">Litecoin</h6>
                                <p class="text-muted mb-0">$09.5 Billions</p>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <h6 class="fs-14 mb-1">$10,604.27</h6>
                                <p class="text-success fs-12 mb-0">+$76.12<span
                                        class="ms-1">(+4.92%)</span></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">News Feed</h4>
                    <div>
                        <button type="button" class="btn btn-soft-primary btn-sm">
                            View all
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex align-middle">
                        <div class="flex-shrink-0">
                            <img src="{{ URL::asset('assets/images/small/img-1.jpg') }}" class="rounded img-fluid"
                                style="height: 60px;" alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base"><a href="#" class="text-reset">One stop shop
                                    destination on all the latest news in crypto currencies</a></h6>
                            <p class="text-muted fs-12 mb-0">Dec 12, 2021 <i
                                    class="mdi mdi-circle-medium align-middle mx-1"></i>09:22 AM</p>
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="flex-shrink-0">
                            <img src="{{ URL::asset('assets/images/small/img-2.jpg') }}" class="rounded img-fluid"
                                style="height: 60px;" alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base"><a href="#" class="text-reset">Coin Journal is
                                    dedicated to delivering stories on the latest crypto</a></h6>
                            <p class="text-muted fs-12 mb-0">Dec 03, 2021 <i
                                    class="mdi mdi-circle-medium align-middle mx-1"></i>12:09 PM</p>
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="flex-shrink-0">
                            <img src="{{ URL::asset('assets/images/small/img-3.jpg') }}" class="rounded img-fluid"
                                style="height: 60px;" alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base"><a href="#" class="text-reset">The bitcoin-holding
                                    U.S. senator is trying to “fully integrate” crypto </a></h6>
                            <p class="text-muted fs-12 mb-0">Nov 22, 2021 <i
                                    class="mdi mdi-circle-medium align-middle mx-1"></i>11:47 AM</p>
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="flex-shrink-0">
                            <img src="{{ URL::asset('assets/images/small/img-6.jpg') }}" class="rounded img-fluid"
                                style="height: 60px;" alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base"><a href="#" class="text-reset">Cryptocurrency price
                                    like Bitcoin, Dash, Dogecoin, Ripple and Litecoin</a></h6>
                            <p class="text-muted fs-12 mb-0">Nov 18, 2021 <i
                                    class="mdi mdi-circle-medium align-middle mx-1"></i>06:13 PM</p>
                        </div>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="javascript:void(0);" class="text-muted text-decoration-underline">View
                            all News</a>
                    </div>

                </div>
            </div>
        </div>
    </div>-->
</div>
