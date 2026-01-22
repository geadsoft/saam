@extends('layouts.master')
@section('title')
    Flujo Producción
@endsection
@section('css')

    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


@endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Dashboards @endslot
        @slot('title') Flujo Negocio @endslot
    @endcomponent

    @livewire('vc-panel-negocio')

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/dashboard-crypto.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/themes/adaptive.js"></script>
    <script src="{{ URL::asset('/assets/js/pages/dashboard-negocios.js') }}"></script>

    <script>

        window.addEventListener('graph-1', event => {
            const jsonString = event.detail.newObj;
            alert(jsonString)
            const objgraphs = JSON.parse(jsonString);
            
            viewGraphs1(objgraphs);
        });

    </script>

@endsection