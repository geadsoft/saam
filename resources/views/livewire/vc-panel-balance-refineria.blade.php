<div>
    <div class="row">
        <div class="col-xxl-12 order-xxl-0 order-first">
            <div class="row h-100">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                        <i class="ri-money-dollar-circle-fill align-middle"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">
                                        Total Invested</p>
                                    <h4 class=" mb-0">$<span class="counter-value" data-target="2390.68">0</span>
                                    </h4>
                                </div>
                                <div class="flex-shrink-0 align-self-end">
                                    <span class="badge badge-soft-success"><i
                                            class="ri-arrow-up-s-fill align-middle me-1"></i>6.24
                                        %<span>
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
                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                        <i class="ri-arrow-up-circle-fill align-middle"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">
                                        Total Change</p>
                                    <h4 class=" mb-0">$<span class="counter-value" data-target="19523.25">0</span>
                                    </h4>
                                </div>
                                <div class="flex-shrink-0 align-self-end">
                                    <span class="badge badge-soft-success"><i
                                            class="ri-arrow-up-s-fill align-middle me-1"></i>3.67
                                        %<span>
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
                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                        <i class="ri-arrow-down-circle-fill align-middle"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Day
                                        Change</p>
                                    <h4 class=" mb-0">$<span class="counter-value" data-target="14799.44">0</span>
                                    </h4>
                                </div>
                                <div class="flex-shrink-0 align-self-end">
                                    <span class="badge badge-soft-danger"><i
                                            class="ri-arrow-down-s-fill align-middle me-1"></i>4.80
                                        %<span>
                                        </span></span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

        </div>
        @foreach($balance as $recno)
        <div class="col-xxl-3 order-xxl-0 order-first">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">{{$recno->referencia}}</h4>
                            </div>
                            <div class="p-3 alert alert-warning border-0">
                                <div class="float-end ms-2">
                                    <h6 class="text-warning mb-0">TM : <span class="text-body fs-16">1696.20</span></h6>
                                </div>
                                <h6 class="mb-0 text-primary">Inventario Inicial</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled vstack gap-2 mb-0">
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-question-answer-line"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h6 class="mb-0">Recepción</h6>
                                                    </div>
                                                    <div class="col-5">
                                                        <small class="text-muted fs-15">{{ number_format($recno->ingr, 2) }} </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-mac-line"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h6 class="mb-0">Despacho</h6>
                                                    </div>
                                                    <div class="col-5">
                                                        <small class="text-muted fs-15">{{ number_format($recno->egr, 2) }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-earth-line"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h6 class="mb-0">Transferencias</h6>
                                                    </div>
                                                    <div class="col-5">
                                                        <small class="text-muted fs-15">{{ number_format($recno->transf, 2) }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xxs text-muted">
                                                <i class="ri-charging-pile-2-line"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h6 class="mb-0">Abastecimiento</h6>
                                                    </div>
                                                    <div class="col-5">
                                                        <small class="text-muted fs-15">{{ number_format($recno->abast, 2) }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-warning border-0">
                                <div class="float-end ms-2">
                                    <h6 class="text-warning mb-0">TM : <span class="text-body fs-16">2161.33</span></h6>
                                </div>
                                <h6 class="mb-0 text-primary">Inventario Final</h6>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
        </div><!-- end col -->
        @endforeach
    </div><!-- end row -->
</div>