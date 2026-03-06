<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diario Contable {{$diario->documento}}</title>
    <style>
    .opcion {
        display: inline-flex;
        align-items: center;
        margin-right: 25px; /* separación entre opciones */
        font-weight: bold;
    }
    .cuadrado {
        width: 12px;
        height: 12px;
        border: 1px solid black;
        display: inline-block;
        margin-left: 5px;
        vertical-align: middle;
    }
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <section class="header" style ="top: -287px;">
        <table cellpadding="0" cellspancing="0" width="100%">
        </table>
        <br>
    </section>

    <section style ="margin-top: -110px;">
        <table cellpadding="0" cellspancing="0" width="100%" style="font-family: Tahoma, Helvetica, sans-serif; font-size: 12px">
            <tr>
                <td style="border:1px solid #ccc; border-radius:5px;">
                    <table cellpadding="0" cellspancing="0" width="100%">
                        <tr><td style="color: #024750; padding:1px 8px;"><strong>EXTRACTORA QUEVEPALMA S.A.</strong></td></tr>
                        <tr><td style="color: #726e6eff; font-size: 10px; padding:1px 8px;">1290067126001</td></tr>
                        <tr><td style="color: #726e6eff; font-size: 10px; padding:1px 8px;">Km 5.5 Via Quevedo Buena Fe</td></tr>
                        <tr><td style="color: #726e6eff; font-size: 10px; padding:1px 8px;">05-3912031 | 0999508222</td></tr>
                    </table>
                </td>
                <td></td>
                <td style="border:1px solid #ccc; border-radius:5px;">
                    <table cellpadding="0" cellspancing="0" width="100%">
                        <tr><td style="color: #024750; font-size: 14px; padding:1px 8px;"><strong>Diario Contable - {{ $diario->comprobante == 'N' ? 'Nómina' : 'Provisión' }}</strong></td></tr>
                        <tr><td style="padding:1px 8px;">N° <a style="font-size: 15px; "><strong>{{$diario->documento}}</strong></a></td></tr>
                        <tr><td style="color: white;">.</td></tr>
                        <tr><td style="color: white;">.</td></tr>
                    </table>
                </td>
            </tr>
        </table>
        <table cellpadding="10" cellspancing="0" width="100%">
            <tr>
                <td style="border:1px solid #ccc; border-radius:5px;">
                    <table cellpadding="0" cellspancing="0" width="100%" style="font-family: Tahoma, Helvetica, sans-serif; font-size: 10px">
                        <tr>   
                            <td width="10%" ><strong>FECHA</strong></td>
                            <td width="23%" ><strong>AREA</strong></td>
                            <td width="23%" ><strong>PERIODO</strong></td>
                            <td width="23%" ><strong>REMUNERACIÓN</strong></td>
                            <!--<td width="10%" style="text-align: right;"><strong></strong></td>-->
                        </tr>
                        <tr>
                            <td>{{date('d/m/Y', strtotime($diario->fecha))}}</td>
                            <td>{{$diario->tiporol}}</td>
                            <td>{{$mes[$diario->mes]}} {{$diario->periodo}}</td>
                            <td>{{ $diario->remuneracion == 'M' ? 'ROL MENSUAL' : 'ROL QUINCENAL' }}</td>
                            <!--<td style="font-size: 15px; text-align: right; font-weight: bold;"></td>-->
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspancing="0" width="100%">
            <tr>
                <td style="border:1px solid #ccc; border-radius:5px;">
                    
                    <table  style="font-family: Tahoma, Helvetica, sans-serif; font-size: 10px;">
                        <tr>   
                            <td  colspan="6"><strong>DETALLE:</strong></td>
                        </tr>
                        <thead class="table-light">
                            <tr>
                                
                                <th style="width: 70px; background-color: #e0e0e0;">CUENTA</th>
                                <th style="background-color: #e0e0e0;">DESCRIPCION</th>
                                <th style="width: 50px; background-color: #e0e0e0;">C. COSTO</th>
                                <th style="background-color: #e0e0e0;">DETALLE</th>
                                <th style="width: 80px; text-align: right; background-color: #e0e0e0;">DEBE</th>
                                <th style="width: 80px; text-align: right; background-color: #e0e0e0;">HABER</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                         
                            @foreach ($detalle as $data)
                            <tr>
                                <td>{{$data['cuenta']}}</td>
                                <td>{{$data['descripcion']}}</td>
                                <td>{{$data['ccosto']}}</td>
                                <td>{{$data['detalle']}}</td>
                                @if($data['naturaleza']=='D')
                                    <td style="text-align: right;">${{number_format($data['valor'],2)}}</td>
                                @else 
                                    <td style="text-align: right;">0.00</td>
                                @endif                                 
                                
                                @if($data['naturaleza']=='C')
                                    <td style="text-align: right;">${{number_format($data['valor'],2)}}</td>
                                @else 
                                    <td style="text-align: right;">0.00</td>
                                @endif                                 
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspancing="0" width="100%" style="font-family: Tahoma, Helvetica, sans-serif; font-size: 10px">
            <tr>
                <td style="border:1px solid #ccc; border-radius:5px; padding:1px 8px;" width="40%">
                    <strong>Observacion:</strong> {{$diario->observacion}}   
                </td>
                <td></td>
                <td style="border:1px solid #ccc; border-radius:5px;" width="60%">
                    <table cellpadding="0" cellspancing="0" width="100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 30px; text-align: right; background-color: #e0e0e0;">DEBITO</th>
                                <th style="width: 30px; text-align: right; background-color: #e0e0e0;">CREDITO</th>
                                <th style="width: 30px; text-align: center; background-color: #e0e0e0;">ESTADO</th>
                            </tr>
                        <thead>
                        <tbody>
                            <tr>
                                <td style="text-align: right;">${{number_format($diario->debito,2)}}</td>
                                <td style="text-align: right;">${{number_format($diario->credito,2)}}</td>
                                <td style="text-align: center;">PROCESADO</td>
                            </tr>
                        </tbody>        
                    </table>
                </td>
            </tr>
        </table>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>