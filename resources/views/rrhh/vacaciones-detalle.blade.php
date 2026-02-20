@extends('layouts.master')
@section('title')
    RRHH
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Vacaciones
        @endslot
        @slot('title')
            Detalle de Vacaciones
        @endslot
    @endcomponent

    @livewire('vc-vacaciones-historial',[
        'id' => $id,
    ])

@endsection

@section('script')

    
    <script src="{{ URL::asset('assets/libs/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ URL::asset('assets/js/pages/calendar.js') }}"></script>

    <script>
       
        window.addEventListener('show-form', event => {
            $('#showModal').modal('show');
        })

        window.addEventListener('hide-form', event => {
            $('#showModal').modal('hide');
        })

        window.addEventListener('show-delete', event => {
            $('#deleteOrder').modal('show');
        })

        window.addEventListener('hide-delete', event => {
            $('#deleteOrder').modal('hide');
        })

        window.addEventListener('msg-grabar', event => {
            swal("¡Grabado!", "Registro ha sido grabado exitosamente!", "success");
        })

        window.addEventListener('msg-actualizar', event => {
            swal("Actualizado!", "Registro ha sido actualizado exitosamente!", "success");
        })

        function viewEvent(idEvent) {
            Livewire.emit('postAdded',idEvent);
        }

        function newEvent() {
            
            Livewire.emit('newEvent');
        }

        let calendarInstance = null;

        window.addEventListener('load-calendar', (e) => {

            const events = e.detail.events;
            const calendarEl = document.getElementById('calendar');

            if (!calendarEl) {
                console.warn('calendar aún no existe');
                return;
            }

            if (!calendarInstance) {
                calendarInstance = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 'auto',
                    events: events
                });

                calendarInstance.render();
            } else {
                calendarInstance.removeAllEvents();
                calendarInstance.addEventSource(events);
            }
        });

        document.addEventListener('shown.bs.tab', () => {
            calendar?.render();
        });

    </script>
    
@endsection
