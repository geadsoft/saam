<div>
    <div class="row g-4">
        @if ($selectId==0)
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
                <div class="form-check card-radio">
                    <input id="shippingMethod01" name="shippingMethod" type="radio" class="form-check-input" checked="">
                    <label class="form-check-label" for="shippingMethod01">
                        <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">{{$pesoTara}}</span>
                        <span class="fs-14 mb-1 text-wrap d-block">Peso Tara</span>
                        <span class="text-muted fw-normal text-wrap d-block">15 Dec 2021 - 05:34PM</span>
                    </label>
                </div>
            </div>
        @else
        <div class="col-lg-4">
            <div class="form-check card-radio">
                <input id="shippingMethod01" name="shippingMethod" type="radio" class="form-check-input" checked="">
                <label class="form-check-label" for="shippingMethod01">
                    <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">{{$pesoTara}}</span>
                    <span class="fs-14 mb-1 text-wrap d-block">Peso Tara</span>
                    <span class="text-muted fw-normal text-wrap d-block">15 Dec 2021 - 05:34PM</span>
                </label>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-check card-radio">
                <input id="shippingMethod02" name="shippingMethod" type="radio" class="form-check-input" checked="">
                <label class="form-check-label" for="shippingMethod02">
                    <div wire:poll.5000ms> {{-- Actualiza cada 5 segundos --}}
                    <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">
                        @foreach($lecturas as $lectura)
                        {{ $lectura->valor }}
                        @endforeach
                    </span>
                    </div>
                    <span class="fs-14 mb-1 text-wrap d-block">Peso Bruto</span>
                    <span class="text-muted fw-normal text-wrap d-block">15 Dec 2021 - 05:45PM</span>
                </label>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-check card-radio">
                <input id="shippingMethod02" name="shippingMethod" type="radio" class="form-check-input" checked="">
                <label class="form-check-label" for="shippingMethod02">
                    <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">{{$pesoNeto}} Tn</span>
                    <span class="fs-14 mb-1 text-wrap d-block">Peso Neto</span>
                    <span class="text-muted fw-normal text-wrap d-block">.</span>
                </label>
            </div>
        </div>
        @endif
    </div>
</div>
