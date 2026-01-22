<div>
    <div class="row gy-3">
        <div class="col-md-4">
            <div>
            <label for="cc-name" class="form-label">Muestreo de Racimos - {{$record['pesoneto']}} </label>
            </div>
        </div>
        <div class="col-md-8 text-end">            
            <!-- Without labels Radios -->
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="WithoutinlineRadio1" value="15" wire:model="record.muestreo">
                <label class="form-check-label" for="inlineRadioOptions">15</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="WithoutinlineRadio2" value="40" wire:model="record.muestreo">
                <label class="form-check-label" for="inlineRadioOptions">40</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="WithoutinlineRadio3" value="60" wire:model="record.muestreo">
                <label class="form-check-label" for="inlineRadioOptions">60</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="WithoutinlineRadio1" value="80" wire:model="record.muestreo">
                <label class="form-check-label" for="inlineRadioOptions">80</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="WithoutinlineRadio2" value="100" wire:model="record.muestreo">
                <label class="form-check-label" for="inlineRadioOptions">100</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="WithoutinlineRadio3" value="200" wire:model="record.muestreo">
                <label class="form-check-label" for="inlineRadioOptions">200</label>
            </div>
            <div>
            @error('record.muestreo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="card-body">
                <div class="table-responsive table-card mb-3">
                    <table class="table table-nowrap table-sm align-middle" id="orderTable">
                        <thead class="text-muted table-light">
                            <tr class="text-uppercase">
                                <th>Calificación</th>
                                <th class="text-end">N° Racimos</th>
                                <th class="text-end">% Tol</th>
                                <th class="text-end">% Precio</th>
                                <th class="text-end">% Calif</th>
                                <th class="text-end">% Uso</th>
                                <th class="text-end">Peso (Kg)</th>
                                <th class="text-end">Monto ($)</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            @foreach ($rCalifica as $key => $rubro) 
                            <tr>
                                <td>{{$rubro['detalle']}}</td>
                                <td>
                                    <input type="number" class="form-control bg-light border-0 p-1 text-end" id="racimo-{{$key}}" step="1" y min="0" placeholder="0.00" wire:model="rCalifica.{{$key}}.racimos" wire:input="calificaFruta({{$key}})">
                                <td class="text-end">{{$rubro['tolerancia']}}</td>
                                <td class="text-end">{{$rubro['precio']}}</td>
                                <td class="text-end">{{$rubro['calificacion']}}</td>
                                <td class="text-end">{{$rubro['uso']}}</td>
                                <td class="text-end">{{$rubro['peso']}}</td>
                                <td class="text-end">{{$rubro['monto']}}</td>
                            </tr>
                            @endforeach 
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
