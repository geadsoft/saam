@extends('layouts.master')
@section('title')
    @lang('translation.orders')
@endsection
@section('css')
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Nómina
        @endslot
        @slot('title')
            Enlaces Contables
        @endslot
    @endcomponent

    @livewire('vc-enlace-contables')

@endsection
@section('script')

<!--ecommerce-customer init js -->
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
       
        window.addEventListener('show-form', event => {
            $('#showCuentas').modal('show');
        })

        window.addEventListener('hide-form', event => {
            $('#showCuentas').modal('hide');
        })

        window.addEventListener('show-form-ccosto', event => {
            $('#showCCosto').modal('show');
        })

        window.addEventListener('hide-form-ccosto', event => {
            $('#showCCosto').modal('hide');
        })

        window.addEventListener('show-delete', event => {
            $('#deleteOrder').modal('show');
        })

        window.addEventListener('hide-delete', event => {
            $('#deleteOrder').modal('hide');
        })

        window.addEventListener('msg-grabar', event => {
            swal("¡Grabado!", "Su registro ha sido grabado exitosamente!", "success");
        })

        window.addEventListener('msg-actualizar', event => {
            swal("Grabado!", "Su registro ha sido modificado exitosamente!", "success");
        })

        window.addEventListener('msg-ccosto', event => {
            swal("Error!", "Cuenta contable utiliza centro de costo...", "warning");
        })

        window.addEventListener("set-cuenta", event => {
            var codigo
            codigo = event.detail.cuenta;
            
            Livewire.dispatch('loadCuenta', { cuenta: codigo });
        })

    </script>
    
@endsection
