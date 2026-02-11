<table>
    <thead>
        <tr>
            <td colspan="{{$colspan['tot']}}"><strong>EXTRACTORA QUEVEPALMA S.A.</strong></td>
        </tr>
        <tr>
            <td colspan="{{$colspan['tot']}}"><strong>{{$cab->descripcion}} | {{$mes[$cab->mes]}} {{$cab->periodo}}</strong></td>
        </tr>
    </thead>
    <tr></tr>
    <tr></tr>
    <thead>
        <tr>
            <th colspan="3"><strong>DATOS GENERALES</strong></th>
            <th colspan="{{$colspan['ing']+4}}"><strong>INGRESOS</strong></th>
            <th colspan="{{$colspan['egr']+2}}"><strong>EGRESOS</strong></th>
            <th colspan="4"><strong>FORMA DE PAGO</strong></th>
            <th colspan="{{$colspan['pro']}}"><strong>PROVISION</strong></th>
        </tr>
        <tr>
            <th><strong>Cédula</strong></th>
            <th><strong>Empleado</strong></th>
            <th><strong>Area</strong></th>
            <th><strong>HE 25%</strong></th>
            <th><strong>HE 50%</strong></th>
            <th><strong>HE 100%</strong></th>
            @foreach ($rubros as $key => $recno)
                @foreach ($recno as $data)
                    <th><strong>{{$data['etiqueta']}}</strong></th>
                @endforeach
                @if($key=='P')
                    <th><strong>Total Ingresos</strong></th>
                @else
                    <th><strong>Total Egresos</strong></th>
                @endif
            @endforeach
            <th><strong>Total a Recibir</strong></th>
            <th><strong>Forma de Pago</strong></th>
            <th><strong>Cta Bancaria</strong></th>
            <th><strong>Tipo Cta. Bancaria</strong></th>
            <th><strong>Bco Empleado</strong></th>
            @foreach ($provision as $prov)
                <th><strong>{{$prov->etiqueta}}</strong></th>
            @endforeach
        </tr>
    <thead>
    @foreach ($records as $per => $record)  
        <tr>
            <td>{{$record['nui']}}</td>
            <td>{{$record['nombres']}}</td>
            <td>{{$record['area']}}</td>
            <td>{{$record['HE25']}}</td>
            <td>{{$record['HE50']}}</td>
            <td>{{$record['HE100']}}</td>
            @foreach ($rubros as $recno)
                @foreach ($recno as $key => $data)
                    <td>{{$records[$per][$data['id']]}}</td>
                @endforeach
                @if($key=='P')
                    <td>{{$records[$per]['TOTING']}}</td>
                @else
                    <td>{{$records[$per]['TOTEGR']}}</td>
                @endif
            @endforeach
            <td>{{$record['TOTPAG']}}</td>
            <td>{{$record['fpago']}}</td>
            <td>{{$record['ctabco']}}</td>
            <td>{{$record['tipocta']}}</td>
            <td>{{$record['bco']}}</td>
            @foreach ($provision as $prov)
                @if(isset($records[$per][$prov->rubro_id]))
                <td>{{$records[$per][$prov->rubro_id]}}</td>
                @else
                <td>0.00</td>    
                @endif
            @endforeach
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
</table>