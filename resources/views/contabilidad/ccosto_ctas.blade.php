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
            Contabilidad
        @endslot
        @slot('title')
            Movimiento de Centro de Costo - Cuentas
        @endslot
    @endcomponent

    @livewire('vc-ccosto_cuentas')

@endsection
@section('script')

    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <!--ecommerce-customer init js -->
   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
        // Escucha el evento que se dispara desde Livewire
        window.addEventListener('redirect-to-url', event => {
            // Asegúrate de que los datos existan y tengan una URL
            const url = event.detail.url;
            if (url) {
                // Abre la URL en una nueva pestaña
                window.open(url, '_blank');
            } else {
                console.error("URL no encontrada en el evento 'redirect-to-url'");
            }
        });
    </script>
    
    
@endsection
