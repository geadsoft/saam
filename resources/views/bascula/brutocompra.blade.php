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

    @livewire('vc-peso-compras',['id' => 0])

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

        /*document.addEventListener("keydown",function(event){
            if (event.key === 'F3' || event.code === 'F3') {
                // Evita el comportamiento por defecto del navegador para F3 (buscar)
                event.preventDefault();
                Livewire.dispatch('runExecutable');
            }
        })*/

        document.addEventListener("keydown", function(event) {
        if (event.key === 'F3' || event.code === 'F3') {
            event.preventDefault();
            Livewire.dispatch('requestRun'); // dispara el método en Livewire que hace dispatchBrowserEvent
        }
        });

        window.addEventListener('run-bascula', async (e) => {
        const raw = e.detail;
        // Si Livewire envía [ {...} ] usamos el primer elemento
        const payload = Array.isArray(raw) ? raw[0] : raw;
        console.log('[DEBUG] payload enviado al agente:', payload);

        try {
            const res = await fetch('http://localhost:5025/run', {
            method: 'POST',
            mode: 'cors',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify(payload)
            });

            const text = await res.text().catch(()=>null);
            console.log('fetch status=', res.status, 'body=', text);
            if (res.ok) 
                console.log('Báscula ejecutada en esta PC');
            else alert('Error al ejecutar la báscula localmente. Revisa consola (Network).');
        } catch(err) {
            console.error('Error fetch:', err);
            alert('No se pudo conectar con el agente local (ver consola).');
        }
        });
        
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

        window.addEventListener("set-hacienda", event => {
            var codigo
            codigo = event.detail.codigo;

            Livewire.dispatch('loadHacienda', { id: codigo });
        })

    </script>
    
@endsection
