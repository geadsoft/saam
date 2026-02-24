<div>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-lg rounded"><img
                                            src="@if ($personas->foto != '') {{ URL::asset('storage/fotos/'.$personas->foto) }}@else{{ URL::asset('assets/images/users/avatar-7.jpg') }} @endif" alt=""
                                            class="member-img img-fluid d-block rounded"></div>
                                </div>
                                <div class="flex-grow-1 ms-3"> <a href="pages-profile.html">
                                        <h5 class="fs-16 mb-1">{{$personas->nombres}} {{$personas->apellidos}}</h5>
                                    </a>
                                    <p class="text-muted mb-0">{{$personas->cargo}}</p>
                                    <p class="text-muted mb-0">{{$personas->nui}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex gap-2 align-items-center ms-3">
                                <h6 class="mb-0 text-muted flex-grow-1">Inicio Contrato</h6>
                                <h6 class="flex-shrink-0 mb-1">{{ date('d/m/Y', strtotime($personas->fecha_ingreso)) }}</h6>
                            </div>
                            <div class="d-flex gap-2 align-items-center ms-3">
                                <h6 class="mb-0 text-muted flex-grow-1">Fin Contrato</h6>
                                <h6 class="flex-shrink-0 mb-1">Indefinido</h6>
                            </div>
                            <div class="d-flex gap-2 align-items-center ms-3">
                                <h6 class="mb-0 text-muted flex-grow-1">Area</h6>
                                <h6 class="flex-shrink-0 mb-1">{{$personas->area}}</h6>
                            </div>
                            <div class="d-flex gap-2 align-items-center ms-3">
                                <h6 class="mb-0 text-muted flex-grow-1">Departamento</h6>
                                <h6 class="flex-shrink-0 mb-1">{{$personas->departamento}}</h6>
                            </div>
                            <div class="d-flex gap-2 align-items-center ms-3">
                                <h6 class="mb-0 text-muted flex-grow-1">Convenio</h6>
                                <h6 class="flex-shrink-0 mb-1">Contrato Laboral</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <h5 class="fs-16 mb-3">Vacaciones Pendientes</h5>
                            <div class="d-flex justify-content-center align-items-center mb-4">
                                <h2 class="me-3 ff-secondary mb-0">{{$dias}}</h2>
                                <div>
                                    <p class="text-muted mb-0">dias</p>
                                    <p class="text-success fw-medium mb-0">
                                        <span class="badge bg-success-subtle text-success p-1 rounded-circle"><i
                                                class="ri-arrow-right-up-line"></i></span>
                                    </p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>
            </div> <!-- end row-->
            <div class="col-xxl-12">
                <div class="card" id="contactList">
                    <ul class="nav nav-tabs nav-border-top nav-border-top-primary" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $this->filters['tab'] == 'resumen' ? 'active' : '' }}"
                                data-bs-toggle="tab" href="#tab-resumen" role="tab">
                                Resumen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $this->filters['tab'] == 'historial' ? 'active' : '' }}"
                                data-bs-toggle="tab" href="#tab-historial" role="tab">
                                Historial
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $this->filters['tab'] == 'solicitud' ? 'active' : '' }}"
                                data-bs-toggle="tab" href="#tab-solicitud" role="tab">
                                Solicitudes
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mb-3">
                        <div class="tab-pane fade {{ $this->filters['tab'] == 'resumen' ? 'show active' : '' }}"
                            id="tab-resumen" role="tabpanel">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div style="overflow-x:auto;">
                                        <table class="table table-sm table-nowrap align-middle" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col" class="text-center">Saldo Actual</th>
                                                    <th scope="col" class="text-center">Total</th>
                                                    <th scope="col" class="text-center">Convenio</th>
                                                    <th scope="col" class="text-center">Bolsa</th>
                                                    <th scope="col" class="text-center">Solicitadas</th>
                                                    <th scope="col" class="text-center">Aprobadas</th>
                                                    <th scope="col" class="text-center">Disfrutadas</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <tr class="detalle">
                                                    <td class="text-center">{{$dias}} dias</td>
                                                    <td class="text-center">{{$dias}} dias</td>
                                                    <td class="text-center">0 dias</td>
                                                    <td class="text-center">0 dias</td>
                                                    <td class="text-center text-warning">{{$vacaciones->solicitadas}}
                                                        dias</td>
                                                    <td class="text-center">{{$vacaciones->aprobadas}} dias</td>
                                                    <td class="text-center">{{$vacaciones->aprobadas}} dias</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $this->filters['tab'] == 'historial' ? 'show active' : '' }}"
                            id="tab-historial" role="tabpanel">
                            <div class="col-xl-12">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div style="overflow-x:auto;">
                                            <table class="table table-sm table-nowrap align-middle" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Tipo</th>
                                                        <th>Solicitud</th>
                                                        <th>Días</th>
                                                        <th>Saldo</th>
                                                    </tr>
                                                </thead>
                                                @foreach($periodos as $periodo)
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $periodo->periodo }}</td>
                                                        <td>Asignación</td>
                                                        <td>-</td>
                                                        <td>{{$periodo->dias_generados}}</td>
                                                        <td>{{$periodo->dias_generados-$periodo->dias_usados}}</td>
                                                    </tr>
                                                    @foreach($periodo->movimientos as $mov)
                                                    <tr>
                                                        <td>    
                                                            <span class="badge badge-soft-primary text-uppercase fs-13">S</span> {{ date('d/m/Y', strtotime($mov->solicitud->fecha)) }} - 
                                                            <span class="badge badge-soft-success text-uppercase fs-13">A</span> {{ date('d/m/Y', strtotime($mov->fecha)) }}
                                                        </td>
                                                        <td>Descuento</td>
                                                        <td>VAC-{{ $mov->solicitud->id ?? '-' }}</td>
                                                        <td>{{ $mov->dias_descontados }}</td>
                                                        <td>{{ $mov->saldo }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $this->filters['tab'] == 'solicitud' ? 'show active' : '' }}"
                            id="tab-solicitud" role="tabpanel">
                            <div class="table-responsive">
                                <div class="card-body">
                                    <div style="overflow-x:auto;">
                                        <table class="table table-nowrap align-middle" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Solicitador Por</th>
                                                    <th scope="col">Fecha Solicitud</th>
                                                    <th scope="col">Fecha Inicio</th>
                                                    <th scope="col">Fecha Fin</th>
                                                    <th class="text-center">Total Dias</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach($tblrecords as $fil => $record)
                                                <tr id="{{$fil}}" class="detalle">
                                                    <td>
                                                        <span class="badge {{$estado[$record->estado]['color']}} text-uppercase">{{$estado[$record->estado]['estado']}}</span>
                                                    </td>
                                                    <td>{{$record->usuario}}</td>
                                                    <td>{{ date('d/m/Y', strtotime($record->fecha)) }}</td>
                                                    <td class="text-success">{{$record->fecha_empieza}}</td>
                                                    <td class="text-info">{{$record->fecha_termina}}</td>
                                                    <td class="text-center">{{$record->dias}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$tblrecords->links('')}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>


        </div> <!-- end col -->
    </div>
</div>