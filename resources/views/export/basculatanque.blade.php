<table>
    <thead>
        <tr>
            <td colspan="9"><strong>Detalle de Movimiento de Tanque Bascula</strong></td>
        </tr>
        <tr>
            <td><strong>Fecha:</strong></td>
            <td>{{$data['fechaini']}} al {{$data['fechafin']}}</td>
        </tr>
    </thead>
    <tr></tr>
    <tr></tr>
    <thead>
        <tr>
            <th><strong>ID</strong></th>
            <th><strong>FECHA INGRESO</strong></th>
            <th><strong>FECHA SALIDA</strong></th>
            <th><strong>PESO TARA</strong></th>
            <th><strong>PESO BRUTO</strong></th>
            <th><strong>PESO NETO</strong></th>
        </tr>
    <thead>
    @foreach ($records as $record)  
        <tr>
            <td>{{$record->id_fila}}</td>
            <td>{{date('d/m/Y',strtotime($record->fecha_ingreso))}}</td>
            <td>{{date('d/m/Y',strtotime($record->fecha_salida))}}</td>
            <td>{{$record->peso_tara}}</td>
            <td>{{$record->peso_bruto}}</td> 
            <td>{{$record->peso_neto}}</td> 
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
</table>