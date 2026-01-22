<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Compra {{$peso->Id_Fila}}</title>
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
                        <tr><td style="color: #024750; font-size: 14px; padding:1px 8px;"><strong>Comprobante de Peso - Compra</strong></td></tr>
                        <tr><td style="padding:1px 8px;">N° <a style="font-size: 15px; "><strong>{{$peso->Id_Fila}}</strong></a></td></tr>
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
                            <td width="23%" ><strong>PROVEEDOR</strong></td>
                            <td width="23%" ><strong>HACIENDA</strong></td>
                            <td width="23%" ><strong>CHOFER</strong></td>
                            <td width="10%" style="text-align: right;"><strong>{{ $peso->Peso_Neto > 0 ? 'PESO NETO' : 'PESO BRUTO' }}</strong></td>
                        </tr>
                        <tr>
                            <td>{{ $peso->Peso_Neto > 0 ? $peso->Fecha_Salida : $peso->Fecha_Ingreso }}</td>
                            <td>{{$peso->proveedor}}</td>
                            <td>{{$peso->hacienda}}</td>
                            <td>{{$peso->chofer}}</td>
                            <td style="font-size: 15px; text-align: right; font-weight: bold;">{{ $peso->Peso_Neto > 0 ? $peso->Peso_Neto : $peso->Peso_Ingreso }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ \Carbon\Carbon::parse($peso->Hora_Ingreso)->format('h:i:s A') }} | 
                                
                                {{ $peso->Peso_Neto > 0 ? \Carbon\Carbon::parse($peso->Hora_Salida)->format('h:i:s A') : '' }}
                            </td>
                            <td></td>
                            <td>{{$peso->vehiculo}} -{{$peso->Placa}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspancing="0" width="100%">
            <tr>
                <td style="border:1px solid #ccc; border-radius:5px;">
                    
                    <table cellpadding="0" cellspancing="0" width="100%" style="font-family: Tahoma, Helvetica, sans-serif; font-size: 10px">
                        <tr>   
                            <td  colspan="2"><strong>DETALLE:</strong></td>
                        </tr>
                        <tr> 
                            @if($peso->Peso_Neto>0) 
                                @if(count($racimos)>0) 
                                <td width="50%" style="vertical-align: top;"><div style="text-align: center; background-color: #e0e0e0; font-weight: bold;">RACIMOS</div>
                                
                                <table cellpadding="0" cellspancing="0" width="100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 100px; color: #726e6eff;">Sector</th>
                                            <th style="width: 60px; color: #726e6eff; text-align: right;">Cantidad</th>
                                            <th style="width: 60px; color: #726e6eff; text-align: right;">Peso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($racimos as $racimo)
                                        <tr>
                                            <td>{{$racimo->sector}}</td>
                                            <td style="text-align: right;">{{$racimo->cantidad}}</td>
                                            <td style="text-align: right;">{{$racimo->pesoneto}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody> 
                                </table>
                                
                                </td>
                                @endif
                            @else 
                                <td width="50%" style="vertical-align: top;"><div style="text-align: center; background-color: #e0e0e0; font-weight: bold;">RACIMOS</div>
                                
                                    <table cellpadding="0" cellspancing="0" width="100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 60px; color: #726e6eff;">Muestra</th>
                                                <th style="width: 10px; color: #726e6eff;"></th>
                                                <th style="width: 60px; color: #726e6eff;">Fruta</th>
                                                <th style="width: 10px; color: #726e6eff;"></th>
                                                <th style="width: 60px; color: #726e6eff;">Variedad</th>
                                                <th style="width: 10px; color: #726e6eff;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>15</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td>Optima</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td>GUINNENSIS</td>
                                                <td><span class="cuadrado"></span></td>
                                            </tr>
                                            <tr>
                                                <td>40</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td>Verde</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td>COARI</td>
                                                <td><span class="cuadrado"></span></td>
                                            </tr>
                                            <tr>
                                                <td>60</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td>Grande</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td>TAISHA</td>
                                                <td><span class="cuadrado"></span></td>
                                            </tr>
                                            <tr>
                                                <td>80</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td>Pequeña</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td>HIBRIDA</td>
                                                <td><span class="cuadrado"></span></td>
                                            </tr>
                                            <tr>
                                                <td>100</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td>Mal Formada</td>
                                                <td><span class="cuadrado"></span></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>200</td>
                                                <td><span class="cuadrado"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </td>
                            @endif 
                            <td></td>
                            @if(count($calificacion)>0)
                            <td width="50%"><div style="text-align: center; background-color: #e0e0e0; font-weight: bold;">CALIFICACION</div>
                                
                                <table cellpadding="0" cellspancing="0" width="100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 100px; color: #726e6eff;">Clase</th>
                                            <th style="width: 60px; color: #726e6eff; text-align: right;">Racimos</th>
                                            <th style="width: 60px; color: #726e6eff; text-align: right;">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($calificacion as $calif)
                                        <tr>
                                            <td>{{$calif->Nombre}}</td>
                                            @if($peso->Peso_Neto>0)
                                            <td style="text-align: right;">{{$calif->Racimos}}</td>
                                            <td style="text-align: right;">{{$calif->Porcentaje_Calificacion}}</td>
                                            @else
                                            <td style="text-align: right;">_______</td>
                                            @endif 
                                        </tr>
                                        @endforeach
                                        
                                    </tbody> 
                                </table>
                                
                            </td>
                            @endif
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspancing="0" width="100%" style="font-family: Tahoma, Helvetica, sans-serif; font-size: 10px">
            <tr>
                <td style="border:1px solid #ccc; border-radius:5px; padding:1px 8px;" width="40%">
                    Observacion: variedad: {{$peso->variedad}}
                </td>
                <td></td>
                <td style="border:1px solid #ccc; border-radius:5px;" width="60%">
                    <table cellpadding="0" cellspancing="0" width="100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 30px; text-align: right; background-color: #e0e0e0;">PESO BRUTO</th>
                                <th style="width: 30px; text-align: right; background-color: #e0e0e0;">PESO TARA</th>
                                <th style="width: 30px; text-align: right; background-color: #e0e0e0;">PESO NETO</th>
                            </tr>
                        <thead>
                        <tbody>
                            <tr>
                                <td style="text-align: right;">{{$peso->Peso_Ingreso}}</td>
                                <td style="text-align: right;">{{$peso->Peso_Salida}}</td>
                                <td style="text-align: right;">{{$peso->Peso_Neto}}</td>
                            </tr>
                        </tbody>        
                    </table>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspancing="0" width="100%" style="font-size: 11px" >
            <tr>
                <td width="60%">
                    <div style="border:1px solid #d0d0d0; border-radius:8px; overflow:hidden; font-family: Arial, Helvetica, sans-serif;">
                        <table style="width:100%; border-collapse:collapse; table-layout:fixed;">
                        <thead>
                            <tr>
                            <th style="width:25%; padding:1px 8px; text-align:center; font-weight:700;border-right:1px solid #e6e6e6;">
                                Pesador
                            </th>
                            <th style="width:25%; padding:1px 8px; text-align:center; font-weight:700;border-right:1px solid #e6e6e6;">
                                Chofer
                            </th>
                            <th style="width:50%; padding:1px 8px; text-align:center; font-weight:700;border-right:1px solid #e6e6e6;">
                                
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td style="height:48px; border-top:1px solid #eaeaea; border-right:1px solid #eaeaea; text-align:center;">{{Auth::user()->name}}</td>
                            <td style="height:48px; border-top:1px solid #eaeaea; border-right:1px solid #eaeaea; text-align:center;">{{$peso->chofer}}</td>
                            <td style="height:48px; border-top:1px solid #eaeaea; border-right:1px solid #eaeaea;"></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </td>
                <td></td>
                @if($peso->Peso_Neto>0)
                <td width="40%">
                    <div style="border:1px solid #d0d0d0; border-radius:8px; overflow:hidden; font-family: Arial, Helvetica, sans-serif;">
                        <table style="width:100%; border-collapse:collapse; table-layout:fixed;">
                        <thead>
                            <tr>
                            <th style="width:25%; padding:1px 8px; text-align:center; font-weight:700;border-right:1px solid #e6e6e6;">
                                FIRMA DE RECIBO
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td style="height:48px; border-top:1px solid #eaeaea; border-right:1px solid #eaeaea;"></td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                </td>
                @endif
            </tr>
        </table>

        


        <!--<div class="header">
            <div>
            <img class="logo" src="{{ public_path('images/logo.png') }}" alt="Logo"> {{-- usa public_path para Dompdf --}}
            </div>
            <div>
            <h1>Ticket N° {{ $peso->Id_Fila }}</h1>
            <div>Fecha: {{ $peso->Fecha_Salida }}</div>
            <div>Cliente: {{ $peso->proveedor ?? '-' }}</div>
            </div>
        </div>-->

        <!--<table>
            <thead>
            <tr>
                <th>Item</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th class="right">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4" class="right">Total</td>
                <td class="right">{{ number_format($peso->Peso_Neto, 2) }}</td>
            </tr>
            </tfoot>
        </table>-->

    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>