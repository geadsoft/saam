@extends('layouts.master')
@section('title')
    RRHH
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Reportes
        @endslot
        @slot('title')
            Listado de Préstamos
        @endslot
    @endcomponent

    @livewire('vc-report-prestamos')

@endsection
@section('script')

    <script src="{{ URL::asset('assets/libs/list.js/list.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js') }}"></script>

    <!--ecommerce-customer init js -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <script>

        window.addEventListener('report-prestamos', event => {
            const datos = event.detail.data;

            window.open(`/download-pdf/rrhh-prestamos/${datos}`, '_blank');
        });


    </script>
    
@endsection
