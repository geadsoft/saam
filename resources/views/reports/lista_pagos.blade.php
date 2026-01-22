<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pagos</title>
</head>
<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px;
    }

    .text-center {
        text-align: center;
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
    <section class="header" style ="top: -287px;">
        <table cellpadding="0" cellspancing="0" width="100%">
            <tr>
                <td class="text-center text-uppercase">
                    <span style="font-size: 12px"><strong>QUEVEPALMA</strong></span>
                <td>
            </tr>
            <tr>
                <td class="text-center text-uppercase" style="vertical-align: top; padding-top: 10px">
                    
                    <span style="font-size: 10px"><strong>{{$roldatos['descripcion']}} {{$roldatos['remuneracion']}}</strong></span>
                    <table width="100%" cellpadding="0" cellspancing="0">
                        <tr>
                            <td class="text-center">
                                <span style="font-size: 10px"><strong>DEL </strong>{{$roldatos['fechaini']}}</span>
                                <span style="font-size: 10px"><strong>AL </strong>{{$roldatos['fechafin']}}</span>
                            </td>
                        </tr>
                    </table>
                </td>        
            <tr>
        </table>
        <br>
    </section>

    <section class="header" style ="top: -287px;">
    </section>

    <section style ="margin-top: -110px;">
        <table cellpadding="0" cellspacing="0" class="table table-sm align-middle" style="font-size:9px">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px; text-align: left;">CODIGO</th>
                    <th style="width: 30px; text-align: left;">CÉDULA</th>
                    <th style="width: 150px; text-align: left;">NOMBRE</th>
                    <th style="width: 50px; text-align: right;" >VALOR A RECIBIR</th>
                    <th style="width: 80px; text-align: center;">RECIBI CONFORME</th>
                </tr>
            <thead>
            <tbody>
                @foreach ($tblrecords as $fil => $data)
                <tr>
                    <td>{{str_pad($data['id'], 6, '0', STR_PAD_LEFT)}}</td>
                    <td>{{$data['nui']}}</td>
                    <td>{{$data['nom']}}</td>
                    <td style="text-align: right;" >$ {{number_format($data['TOTPAG'],2)}} </td>
                    <td style="text-align: center;">_____________________</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center">
                        <span><b>TOTAL A PAGAR:<b></span>
                    </td>
                    <td style="text-align: right;">
                        <span><b>$ {{number_format($total,2)}}<b></span>
                    </td>
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
                <td width="35%" style="text-align: left;">
                    <span> SAAM | Accounting and Administrative Management Software</span>
                </td>
                <td width="30%" style="text-align: center;">
                    Usuario:<span> {{auth()->user()->name}} </span>
                </td>
                <td width="15%" style="text-align: right;">
                    Página <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </footer>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>