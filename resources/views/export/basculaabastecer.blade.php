<table>
    <thead>
        <tr>
            <td colspan="9"><strong>Detalle de Movimiento por Abastecimiento</strong></td>
        </tr>
        <tr>
            <td><strong>Periodo:</strong></td>
            <td>{{$data['periodo']}}</td>
        </tr>
        <tr>
            <td><strong>Mes:</strong></td>
            <td>{{$data['mes']}}</td>
        </tr>
    </thead>
    <tr></tr>
    <tr></tr>
    <thead>
        <tr>
            <th><strong>RAZON SOCIAL</strong></th>
            <th><strong>DOCUMENTO</strong></th>
            <th><strong>FECHA SALIDA</strong></th>
            <th><strong>PRODUCTO</strong></th>
            <th><strong>PESO TARA</strong></th>
            <th><strong>PESO BRUTO</strong></th>
            <th><strong>PESO NETO</strong></th>
        </tr>
    <thead>
    @foreach ($records as $record)  
        <tr>
            <td>{{$record->NombreComercial}}</td>
            <td>{{$record->Documento}}</td>
            <td>{{date('d/m/Y',strtotime($record->FechaSalida))}}</td>
            <td>{{$record->producto}}</td>
            <td>{{$record->PesoTara}}</td>
            <td>{{$record->PesoBruto}}</td> 
            <td>{{$record->PesoNeto}}</td> 
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
</table>