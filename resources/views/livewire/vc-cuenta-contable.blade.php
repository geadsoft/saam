<div>
    <div class="input-group form-group">
        <label class="input-group-text form-label" for="rubro-select">{{$lnNombre}}</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="identidad" id="inputaper" placeholder="Ingrese código" wire:model="cuenta.codigo" required>
        </div>
        <input type="text" class="form-control" name="identidad" id="" wire:model="cuenta.nombre" disabled>
        <a id="btnstudents" class ="input-group-text btn btn-soft-secondary" wire:click="buscarCuenta('PAI')"><i class="ri-user-search-fill me-1"></i></a>
    </div> 
</div>
