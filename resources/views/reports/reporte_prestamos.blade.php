<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Prestamos</title>
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

    thead th {
        border: 0.3px solid #aaa;
        background-color: #ebe8e8;
        font-weight: bold;
        text-align: center;
        padding: 2px;
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
                        <strong style="font-size:12px; text-transform: uppercase;">LISTADO DE PRESTAMOS</strong><br>
                        <span style="font-size:11px;"> {{$title['area']}} | {{$title['estado']}}</span><br>
                        <span style="font-size:10px; color:#555;">
                            DEL </strong>{{$title['fechaini']}} AL
                            </strong>{{$title['fechafin']}}<br>
                        </span>
                        <span style="font-size:11px;">{{$title['empleado']}}</span>
                    </div>
                </td>
                <td width="35%" class="text-right" style="vertical-align: top;">
                    <img src="../public/assets/images/quevepalma.png" width="150px" height="100px"
                        style="display:block; margin-top:-30px;">
                </td>
            </tr>
            <tr>
                <td colspan="3" style="border-top: 0.5px solid #aaa; padding: 0;"></td>
            </tr>
        </table>
        <br>
        <table cellpadding="0" cellspacing="0" style="font-size:10px">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Documento</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Cuotas</th>
                    <th>Monto</th>
                    <th>Cancelado</th>
                    <th>Saldo</th>
                    <th>Últ. Cuota</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>                
                @foreach ($records as $record)
                <tr>
                    <td>{{$record->apellidos}} {{$record->nombres}}</td>
                    <td>{{$record->id}}</td>
                    <td>{{$record->etiqueta}}</td>
                    <td>{{date('d/m/Y', strtotime($record->fecha))}}</td>
                    <td class="text-center">{{$record->cuota}}/{{ ($record->pagos ?? 0) > 0 ? $record->pagos : 0 }}</td>
                    <td class="text-right">${{number_format($record->monto,2)}}</td>
                    <td class="text-right">${{number_format($record->cancelado,2)}}</td>
                    <td class="text-right">${{number_format($record->monto-$record->cancelado,2)}}</td>
                    <td>{{date('d/m/Y', strtotime($record->ultfecha))}}</td>
                    <td>
                        @if($record->estado=='P')
                        <span class="badge badge-soft-success text-uppercase">PENDIENTE</span>
                        @else
                        <span class="badge badge-soft-info text-uppercase">CANCELADA</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2"><strong>TOTAL =></strong></td>
                    <td class="text-right"><strong>${{number_format($total['monto'],2)}}</strong></td>
                    <td class="text-right"><strong>${{number_format($total['cancelado'],2)}}</strong></td>
                    <td class="text-right"><strong>${{number_format($total['saldo'],2)}}</strong></td>
                </tr>
            </tfoot>
        </table>
    </section>

    <div style="position: absolute;
      display: inline-block;
      bottom: 0;
      width: 100%;
      height: 40px;">
    <footer>
        <table cellpadding="0" cellspacing="0" class="table-sm" width="100%">
            <tr style="font-size:10px">
                <td width="35%" class="text-left">
                    <span> SAAM | © GSD-Instian </span>
                </td>
                <td width="30%" class="text-center">
                    Usuario:<span> {{auth()->user()->name}} </span>
                </td>
                <td width="35%" class="text-right">
                    Página <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </footer>
    </div>

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