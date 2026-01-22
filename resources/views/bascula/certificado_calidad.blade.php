@extends('layouts.master')
@section('title')
    Laboratorio Refineria
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Certificado
        @endslot
        @slot('title')
            Calidad
        @endslot
    @endcomponent
    
    @livewire('vc-certificado-calidad',[
        'tipo' => $tipo,
        'id' => $id
    ])

@endsection
@section('script')

    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <!--ecommerce-customer init js -->
   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>

        window.addEventListener('imprimir', event => {
           window.open(event.detail.url, '_blank');            
        });

        window.addEventListener('show-form', event => {
            $('#showModal').modal('show');
        })

        window.addEventListener('hide-form', event => {
            $('#showModal').modal('hide');
        })

    </script>
    
@endsection
