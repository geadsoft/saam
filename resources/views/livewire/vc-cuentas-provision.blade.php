<div>
    <div class="row g-4">
        <div class="col-lg-6">
            <h5 class="card-title flex-grow-1 mb-3 text-primary fs-14">
            <i class="mdi mdi-account-cash align-middle me-1 text-success"></i>
                Provisión Aportes Iess</h5>
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="input-group form-group">
                        <label class="input-group-text" for="rubro-select">Aporte Personal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="identidad" id="inputaper" placeholder="Ingrese código" wire:model="ctapai" >
                        </div>
                        <input type="text" class="form-control" name="identidad" id="nomapai" wire:model="nompai" disabled>
                        <a id="btnstudents" class ="input-group-text btn btn-soft-secondary" wire:click="buscarCuenta('PAI')"><i class="ri-user-search-fill me-1"></i></a>
                    </div>                    
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="input-group">
                        <label class="input-group-text" for="rubro-select">Aporte Patronal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="identidad" id="inputapat" placeholder="Ingrese código" wire:model="ctapap" >
                        </div>
                        <input type="text" class="form-control" name="identidad" id="nomapap" wire:model="nompap" disabled>
                        <a id="btnstudents" class ="input-group-text btn btn-soft-secondary" wire:click="buscarCuenta('PAP')"><i class="ri-user-search-fill me-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="input-group">
                        <label class="input-group-text" for="rubro-select">Aporte Secap</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="identidad" id="inputapat" placeholder="Ingrese código" wire:model="ctapas" >
                        </div>
                        <input type="text" class="form-control" name="identidad" id="nomapas" wire:model="nompas" disabled>
                        <a id="btnstudents" class ="input-group-text btn btn-soft-secondary" wire:click="buscarCuenta('PAS')"><i class="ri-user-search-fill me-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="input-group">
                        <label class="input-group-text" for="rubro-select">Aporte Iece</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="identidad" id="inputapat" placeholder="Ingrese código" wire:model="ctapie" >
                        </div>
                        <input type="text" class="form-control" name="identidad" id="nomapie" wire:model="nompie" disabled>
                        <a id="btnstudents" class ="input-group-text btn btn-soft-secondary" wire:click="buscarCuenta('PIE')"><i class="ri-user-search-fill me-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <h5 class="card-title flex-grow-1 mb-3 text-primary fs-14">
            <i class="mdi mdi-cash-multiple align-middle me-1 text-success"></i>
            Provisión Beneficios</h5>
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="input-group">
                        <label class="input-group-text" for="rubro-select">13.° Sueldo</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="identidad" id="nom13" placeholder="Ingrese código" wire:model="ctab13" >
                        </div>
                        <input type="text" class="form-control" name="identidad" id="b13" wire:model="nomb13" disabled>
                        <a id="btnbuscar" class ="input-group-text btn btn-soft-secondary" wire:click="buscarCuenta('PB13')"><i class="ri-user-search-fill me-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="input-group">
                        <label class="input-group-text" for="rubro-select">14.° Sueldo</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="identidad" id="nom14" placeholder="Ingrese código" wire:model="ctab14" >
                        </div>
                        <input type="text" class="form-control" name="identidad" id="b14" wire:model="nomb14" disabled>
                        <a id="btnstudents" class ="input-group-text btn btn-soft-secondary" wire:click="buscarCuenta('PB14')"><i class="ri-user-search-fill me-1"></i></a>
                    </div>
                    
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="input-group">
                        <label class="input-group-text" for="rubro-select">Vacaciones</label>
                        <div class="col-sm-2">  
                            <input type="text" class="form-control" name="identidad" id="nomvac" placeholder="Ingrese código" wire:model="ctabvac" >
                        </div>
                        <input type="text" class="form-control" name="identidad" id="b14" wire:model="nombvac" disabled>
                        <a id="btnstudents" class ="input-group-text btn btn-soft-secondary" wire:click="buscarCuenta('PBVA')"><i class="ri-user-search-fill me-1"></i></a>
                    </div>
                    
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="input-group">
                        <label class="input-group-text" for="rubro-select">Fondo de Reserva</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="identidad" id="inputapat" placeholder="Ingrese código" wire:model="ctabfre" >
                        </div>
                        <input type="text" class="form-control" name="identidad" id="b14" wire:model="nombfre" disabled>
                        <a id="btnstudents" class ="input-group-text btn btn-soft-secondary" wire:click="buscarCuenta('PBFR')"><i class="ri-user-search-fill me-1"></i></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
