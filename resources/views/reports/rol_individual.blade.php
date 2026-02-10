<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rol Individual</title>
</head>
<style>
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 10px;
}

.text-center {
    text-align: center;
}

.text-left {
    text-align: left;
}

.text-right {
    text-align: right;
}

.text-uppercase {
    text-transform: uppercase;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 4px;
    vertical-align: top;
}
</style>

<body>
    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspancing="0" width="100%">
        </table>
        <br>
    </section>

    <section class="header" style="top: -287px;">
    </section>

    @foreach ($personas as $fil => $record)

    <section style="margin-top: -110px;">
        <table cellpadding="0" cellspancing="0" width="100%">
            <tr>
                <td width="35%">
                    <strong></strong>{{$tblcia['razonsocial']}}<br>
                    <strong>Ruc:</strong>{{$tblcia['ruc']}}<br>
                    <strong>Teléfono:</strong>{{$tblcia['telefono']}}<br>
                    <strong>Dirección:</strong>{{$tblcia['ubicacion']}}
                </td>
                <td width="30%">
                    <div style="text-align:center; margin:10px 0;">
                        <strong style="font-size:12px; text-transform: uppercase;">{{$roldatos['descripcion']}}</strong><br>
                        <span style="font-size:11px;"> {{$roldatos['remuneracion']}} | {{$roldatos['periodo']}}</span><br>
                        <span style="font-size:10px; color:#555;">
                            DEL </strong>{{$roldatos['fechaini']}} AL </strong>{{$roldatos['fechafin']}}
                        </span>
                    </div>
                </td>
                <td width="35%" class="text-right" style="vertical-align: top;">
                    <img src="../public/assets/images/quevepalma.png" width="150px" height="100px" style="display:block; margin-top:-30px;">
                </td>
            </tr>
            <tr><td colspan="3" style="border-top: 0.5px solid #aaa; padding: 0;"></td></tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="5">
            <tr>
                <td width="50%">
                    <strong>Cédula:</strong>{{$record->nui}}<br>
                    <strong>Empleado:</strong>{{$record->apellidos}} {{$record->nombres}}<br>
                    <strong>Sueldo:</strong>{{number_format($record->sueldo,2)}}
                </td>
                <td width="50%">
                    <strong>Departamento:</strong>{{$record->departamento}}<br>
                    <strong>Cargo:</strong>{{$record->cargo}}<br>
                    <strong>Cuenta:</strong> {{$record->tipo_cuenta}} - {{$record->cuenta_banco}}
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" class="table table-sm align-middle" style="font-size:10px">
                <thead class="table-light">
                <tr>
                    <th class="text-center" style="width: 50px; background:#f2f2f2;">INGRESOS</th>
                    <th class="text-center" style="width: 50px; background:#f2f2f2;">EGRESOS</th>
                </tr>
                <thead>
                <tbody>
                    <tr>
                        <td width="50%" class="text-left" style="border: 1px solid gray">
                            <table width="100%" cellpadding="0" cellspancing="0">
                                @foreach ($tblrecords as $fil => $data)

                                @if ($data->tipo=='P' && $data->persona_id == $record->persona_id)
                                <tr>
                                    <td class="text-left"> {{$etiqueta[$data->rubrosrol_id]}} </td>
                                    <td class="text-right"> ${{number_format($data->valor,2)}}</td>
                                </tr>
                                @if($data->rubrosrol_id==$rubroHExtras)
                                @if(isset($hextras[$record->persona_id]))
                                <tr>
                                    <td style="padding-left:15px;">HE25% ({{$hextras[$record->persona_id]->extra25}})</td>
                                    <td class="text-left">${{$hextras[$record->persona_id]->monto25}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:15px;">HE50% ({{$hextras[$record->persona_id]->extra50}})</td>
                                    <td class="text-left">${{$hextras[$record->persona_id]->monto50}}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:15px;">HE100% ({{$hextras[$record->persona_id]->extra100}})</td>
                                    <td class="text-left">${{$hextras[$record->persona_id]->monto100}}</td>
                                </tr>
                                @endif
                                @endif
                                @endif

                                @endforeach
                            </table>
                        </td>
                        <td width="50%" class="text-left" style="border: 1px solid gray">
                            <table width="100%" cellpadding="0" cellspancing="0">
                                @foreach ($tblrecords as $fil => $data)

                                @if ($data->tipo=='D' && $data->persona_id == $record->persona_id)
                                <tr>
                                    <td class="text-left"> {{$etiqueta[$data->rubrosrol_id]}} </td>
                                    <td class="text-right"> ${{number_format($data->valor,2)}}</td>
                                </tr>
                                @endif

                                @endforeach
                            </table>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td width="50%">
                        <table width="100%" cellpadding="0" cellspancing="0">
                            <tr>
                                @foreach ($totales as $fil => $recno)
                                @if ($recno->rubro_total=='TOTING' && $recno->persona_id == $record->persona_id)
                                <td class="text-left"><strong>TOTAL INGRESOS</strong></td>
                                <td class="text-right"> ${{number_format($recno->valor,2)}} </td>
                                @endif
                                @endforeach
                            </tr>
                            <tr>
                                <!--<td class="text-center" colspan=2><strong>RECIBI CONFORME</strong>
                                    <br><br>
                                    <div style="
                                height: 50px;
                                border: 1px solid #c0baba;"></div>
                                </td>-->
                            </tr>
                        </table>
                    </td>
                    <td width="50%">
                        <table width="100%" cellpadding="0" cellspancing="0">
                            <tr>
                                @foreach ($totales as $fil => $recno)
                                @if ($recno->rubro_total=='TOTEGR' && $recno->persona_id == $record->persona_id)
                                <td class="text-left"><strong>TOTAL EGRESOS</strong></td>
                                <td class="text-right"> ${{number_format($recno->valor,2)}} </td>
                                @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($totales as $fil => $recno)
                                @if ($recno->rubro_total=='TOTPAG' && $recno->persona_id == $record->persona_id)
                                <td class="text-left"><strong>NETO A RECIBIR</strong></td>
                                <td class="text-right"><strong>${{number_format($recno->valor,2)}}</strong></td>
                                @endif
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td colspan="2" style="border-top: 0.5px solid #aaa; padding: 0;"></td></tr>
                </tfoot>
        </table>
        <table cellpadding="0" cellspacing="0" class="table table-sm align-middle" style="font-size:10px">
            <tr>
                <td width="30%"></td>
                <td width="40%" class="text-center" colspan=2><strong>RECIBÍ CONFORME</strong>
                    <br><br>
                    <div style="
                height: 50px;
                border: 1px solid #c0baba;"></div>
                </td>
                <td width="30%"></td>
            </tr>
            <tr>
                <td width="30%"></td>
                <td width="40%" class="text-center" colspan=2 style="font-size:8px">Firma del empleado</td>
                <td width="30%"></td>
            </tr>
        </table>
    </section>
    <section>
        <table cellpadding="0" cellspacing="0" class="table-sm" width="100%">
        </table>
    </section>
    <div style="page-break-before: always;">
    </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>