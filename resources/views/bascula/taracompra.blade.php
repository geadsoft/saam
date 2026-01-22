@extends('layouts.master')
@section('title')
    Bascula
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Bascula
        @endslot
        @slot('title')
            Peso Compra
        @endslot
    @endcomponent
    
    @livewire('vc-peso-compras',['id' => $id])

@endsection
@section('script')

    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <!--ecommerce-customer init js -->
   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>

        window.addEventListener('msg-grabar', event => {
            swal("¡Grabado!", "¡Registros han sido grabado exitosamente!", "success");
        })

        window.addEventListener('msg-alerta', event => {
            swal("¡Error!", "!No existen registros!", "warning");
        })

        document.addEventListener("keydown",function(event){
            if (event.key === 'F3' || event.code === 'F3') {
                // Evita el comportamiento por defecto del navegador para F3 (buscar)
                event.preventDefault();
                Livewire.dispatch('runExecutable');
            }
        })
        
        window.addEventListener("set-chofer", event => {
            var codigo
            codigo = event.detail.codigo;

            Livewire.dispatch('loadChofer', { id: codigo });
        })

        window.addEventListener("set-proveedor", event => {
            var codigo
            codigo = event.detail.codigo;

            Livewire.dispatch('loadProveedor', { id: codigo });
        })

    </script>
    
@endsection
