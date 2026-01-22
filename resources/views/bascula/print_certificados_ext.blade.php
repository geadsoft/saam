<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Autorización Tratamiento de Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            margin: 25px;
        }
        h2 { text-align: center; padding: 0px; }
        p { text-align: justify; font-family: Arial, Helvetica, sans-serif; font-size: 10.8px; }

        /* contenedor por "página" */
        .page {
            position: relative;           /* necesario para posicionar la marca dentro */
            page-break-after: always;     /* fuerza salto de página después del contenedor */
            min-height: 250mm;            /* opcional: ajusta si necesitas altura mínima */
        }

        /* quitar salto en la última página */
        .page:last-child { page-break-after: auto; }

        /* marca de agua dentro de cada página */
        .marca-agua {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.12;
            z-index: 0;       /* detrás del contenido */
            width: 60%;       /* ajusta tamaño según necesites */
            pointer-events: none; /* evita interferir con selección de texto */
        }

        .marca-agua-muestra {
            position: absolute;
            top: 1%;
            left: 14%;
            transform: translate(-10%, -10%);
            opacity: 0.12;
            z-index: 0;       /* detrás del contenido */
            width: 45%;       /* ajusta tamaño según necesites */
            pointer-events: none; /* evita interferir con selección de texto */
        }

        /* el contenido debe estar por encima de la marca */
        .contenido {
            position: relative;
            z-index: 1;
        }

        /* tabla y estilos */
        table.firma { width: 100%; border: none; margin-top: 10px; }
        table.firma td { text-align: center; border: none; padding: 1px; }
        .linea { margin-top: 20px; display: inline-block; border-bottom: 1px solid #000; width: 80%; }
        .mi-tabla { border-collapse: collapse; width: 100%; }
        .mi-tabla th, .mi-tabla td { border: 1px solid #333; padding: 3px; text-align: left; }

        .rot-container{
            position: relative;
            width: 48px;           /* ancho de la celda (antes de rotar) */
            height: 150px;         /* altura que ocupará la etiqueta vertical: ajústala */
            box-sizing: border-box;
            overflow: hidden;      /* opcional: recorta si algo sobresale */
        }

        /* el texto rotado centrado dentro del contenedor */
        .rotated{
            position: absolute;
            left: 50%;
            top: 70%;
            transform: translate(-50%, -50%) rotate(-90deg); /* centra y gira */
            /*transform-origin: center center;*/
            /*white-space: nowrap;*/
            font-weight: bold;
            text-align: left;
            padding: 2px;
            /*box-sizing: border-box;*/
        }

        .analizado-label-transform {
            display: inline-block;
            transform: rotate(-90deg);            /* gira el texto */
            white-space: nowrap;
            width: 50px; /* ancho antes de rotar, ajusta según necesidad */
            box-sizing: border-box;
            text-align: right;
        }

    </style>
</head>
<body>

    <!-- ========== PÁGINA 1 ========== -->
    <div class="page">
        <!-- Marca de agua página 1 -->
        <img src="{{ public_path('assets/images/quevepalma.png') }}" class="marca-agua" alt="Marca de Agua 1">

        <section style="margin-top: -50px;" class="contenido">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="100%" style="border: none;" >
                        <img src="{{ public_path('assets/images/membrete.png') }}" height="150px">
                    </td>
                    <!--<td width="70%" style="border: none; text-align: right;" >
                    </td>-->
                </tr>
            </table>

            <div style="text-align: center; font-weight: bold; font-size: 19px;">CERTIFICADO DE CALIDAD</div>
            <div style="padding: 15px;"></div>

            <table cellpadding="0" cellspacing="0" width="70%">
                <tr><td style="font-weight: bold;">FECHA:</td><td>{{ date('d/m/Y', strtotime($record->FechaSalida)) }}</td></tr>
                <tr><td style="font-weight: bold;">PRODUCTO:</td><td style="text-transform: uppercase;">{{$record->producto}}</td></tr>
                <tr><td style="font-weight: bold;">LOTE N°:</td><td style="text-transform: uppercase;">{{$certificado->lote}}</td></tr>
                <tr><td style="font-weight: bold;">FECHA DE PRODUCCION:</td><td>{{ date('d/m/Y', strtotime($certificado->fecha_produccion)) }}</td></tr>
                <tr><td style="font-weight: bold;">GUIA N°:</td><td>{{$record->guia}}</td></tr>
                <tr><td style="font-weight: bold;">CLIENTE:</td><td style="text-transform: uppercase;">{{$record->NombreComercial}}</td></tr>
                <tr><td style="font-weight: bold;">VEHICULO:</td><td style="text-transform: uppercase;">{{$record->Vehiculo}}</td></tr>
                <tr><td style="font-weight: bold;">CONDUCTOR:</td><td style="text-transform: uppercase;">{{$record->Chofer}}</td></tr>
                <tr><td style="font-weight: bold;">PLACAS:</td><td>{{$record->Placa}}</td></tr>
                <tr><td style="font-weight: bold;">PESO NETO:</td><td>{{ number_format($record->PesoNeto,2) }}</td></tr>
                <tr><td style="font-weight: bold;">SELLOS DE SEGURIDAD:</td><td>({{$record->Sello}}) | {{$record->Desde}} - {{$record->Hasta}}</td></tr>
            </table>

            <div style="padding: 5px;"></div>

            <table class="mi-tabla" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr class="text-uppercase">
                        <th rowspan="2" style="text-align: center; text-transform: uppercase;">Caracteristicas</th>
                        <th rowspan="2" style="text-align: center; text-transform: uppercase;">Valor Obtenido</th>
                        <th colspan="2" style="text-align: center; text-transform: uppercase;">Especificaciones</th>
                        <th rowspan="2" style="text-align: center; text-transform: uppercase;">Método</th>
                    </tr>
                    <tr class="text-uppercase">
                        <th style="text-align: center; text-transform: uppercase;">Min.</th>
                        <th style="text-align: center; text-transform: uppercase;">Max.</th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    @foreach($detalle as $key => $det)
                        <tr>
                            <td>{{$det->nombre}}</td>
                            <td style="text-align: right">{{$det->valor}}</td>
                            <td style="text-align: right">{{ $det->minimo > 0 ? number_format($det->minimo, 2) : '-' }}</td>
                            <td style="text-align: right">{{ $det->maximo > 0 ? number_format($det->maximo, 2) : '-' }}</td>
                            <td>{{$det->metodo}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p>
                La empresa Quevepalma certifica y garantiza este producto con la contra muestra adjunta. El cliente debe verificar la calidad a su llegada de
                destino. El conductor debe estar presente en el momento de romper el sello y tomar la muestra. Si encuentra una inconformidad informará 
                inmediatamente a Extractora Quevepalma S.A. al departamento de ventas, antes de descargar el producto, recuerde revisar el estado de los sellos
                y el peso neto que debe ser verificado en una báscula con mantenimiento por una firma reconocida. LA GERENCIA
            </p>

            <section style="margin-top: 40px;">
                <table style="width: 100%; border: none; margin-top: 30px;">
                    <tr>
                        <td width="50%" style="text-align: center; border: none; color: #1a4b03ff;">
                            <img src="{{ public_path('assets/images/firmas/firma-'.strtolower($certificado->user_produccion).'.png') }}" height="70px">
                        </td>
                        <td width="50%" style="text-align: center; border: none; color: #1a4b03ff;">
                            <img src="{{ public_path('assets/images/firmas/firma-'.strtolower($certificado->user_calidad).'.png') }}" height="70px">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="text-align: center; border: none; color: #1a4b03ff;">
                            <strong>________________________________</strong>
                        </td>
                        <td width="50%" style="text-align: center; border: none; color: #1a4b03ff;">
                            <strong>________________________________</strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="text-align: center; border: none;">
                            <strong>Ing {{$certificado->user_produccion}}</strong>
                        </td>
                        <td width="50%" style="text-align: center; border: none;">
                            <strong>Ing {{$certificado->user_calidad}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="text-align: center; border: none;">
                            <strong>Responsable de Producción</strong>
                        </td>
                        <td width="50%" style="text-align: center; border: none;">
                            <strong>Responsable de Calidad</strong>
                        </td>
                    </tr>
                </table>
            </section>

            <div style="position: absolute; display: inline-block; bottom: 0; width: 100%; height: 100px;">
                <section>
                    <table style="width: 100%; border: none; margin-top: 30px;">
                        <tr>
                            <td colspan="2" style="text-align: center; border: none; color: #025009ff;">
                                <strong>Sebastian Juez, Gerente General; Telf (+593-999193002); sebastianjuez@gmail.com.</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; border: none; color: #025009ff;">
                                <strong>RUC: 1290067126001</strong>
                            </td>
                        </tr>
                    </table>
                </section>
            </div>
        </section>
    </div> <!-- fin page 1 -->

    <!-- ========== PÁGINA 2 ========== -->
    @if ($certificado->muestra=="1") 
    <div class="page">
        <!-- Marca de agua página 2 -->
        <img src="{{ public_path('assets/images/quevepalma.png') }}" class="marca-agua-muestra" alt="Marca de Agua 2">

        <section class="contenido">
        <!-- Aquí comienza el contenido de la segunda página (tu registro de contramuestra) -->
         <table border="1" style="border-collapse: collapse; margin-bottom: 15px;">
            <tr>
                <td colspan="1" rowspan="1"></td>
                <td colspan="4" style="font-size: 13px; text-align: center; font-weight: bold;">ANÁLISIS CONTRAMUESTRA</td>
                <td class="analizado-por" rowspan="8">
                    <div class="analizado-label-transform">ANALIZADO POR: <br>{{$certificado->user_calidad}}</div></td>
            </tr>
            <tr>
                <td colspan="5" style="font-weight: bold; text-transform: uppercase; font-size: 10px; text-align: center;">DESTINO/CLIENTE: <br> {{$record->NombreComercial}} </td>
            </tr>
            <tr>
                <td style="font-weight: bold;"></td>
                <td style="font-weight: bold;">ACIDEZ</td>
                <td style="text-align: center;">{{$cpo['ACIDEZ']}}</td>
                <td colspan="2" style="font-weight: bold;">FECHA</td>
            </tr>
            <tr>
                <td rowspan="5" style="padding:4px; text-align:center; width:48px">
                    <div style="display:flex; align-items:center; justify-content:center; gap:25px;">

                        <div style="display:flex; align-items:center; gap:5px;">
                            <div style="width:14px; height:14px; border:2px solid #000;">{{$cpo['CPO']}}</div>
                            <span class="analizado-label-transform">CPO</span>
                        </div>

                        <div style="display:flex; align-items:center; gap:5px;">
                            <div style="width:14px; height:14px; border:2px solid #000;">{{$cpo['PKO']}}</div>
                            <span class="analizado-label-transform">PKO</span>
                        </div>

                    </div>
                </td>
                <td style="font-weight: bold;">HUMEDAD</td>
                @if(isset($cpo['HUMEDAD']))
                <td style="text-align: center;">{{$cpo['HUMEDAD']}}</td>
                @endif 
                @if(isset($cpo['HUMEDAD (%)']))
                <td style="text-align: center;">{{$cpo['HUMEDAD (%)']}}</td>
                @endif 
                <td colspan="2">{{ date('d/m/Y', strtotime($record->FechaSalida)) }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">IMPUREZAS</td>
                @if(isset($cpo['IMPUREZAS']))
                <td style="text-align: center;">{{$cpo['IMPUREZAS']}}</td>
                @endif 
                @if(isset($cpo['IMPUREZAS (%)']))
                <td style="text-align: center;">{{$cpo['IMPUREZAS (%)']}}</td>
                @endif 
                <td style="font-weight: bold;">TANQUE N.</td>
                <td style="text-align: center;">{{$certificado->tanque}}</td>
            </tr>
            @if (isset($cpo['DOBI']))
            <tr>
                <td style="font-weight: bold;">DOBI</td>
                <td colspan="3" style="text-align: center;">{{$cpo['DOBI']}}</td>
            </tr>
            @endif
            <tr>
                <td style="font-weight: bold;">CONDUCTOR</td>
                <td colspan="3" style="text-align: center;">{{$record->Chofer}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">PLACA</td>
                <td colspan="3" style="text-align: center;">{{$record->Placa}}</td>
            </tr>
        </table>            
        </section>
    </div> <!-- fin page 2 -->
    @endif

    <!-- ========== PÁGINA 3 ========== -->
    @if ($certificado->empaque=="1") 
    <div class="page">
        <section style="margin-top: -50px;" class="contenido">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="30%" style="border: none;" >
                        <img src="{{ public_path('assets/images/logocertificado.png') }}" height="70px">
                    </td>
                    <td width="70%" style="border: none; text-align: right;" >
                        
                    </td>
                </tr>
            </table>

            <!-- Aquí comienza el contenido de la segunda página (tu registro de contramuestra) -->
            <div style="text-align: center; font-weight: bold; font-size: 19px;">LISTA DE EMPAQUE</div>
            <div style="padding: 20px;"></div>
            <div style="padding: 15px;"> Fecha: </div>
            <div style="padding: 15px;"> Caracteristica del empaque: </div>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                <tbody>
                <tr><td>Producto:</td><td style="font-weight: bold;">{{$record->producto}}</td></tr>
                <tr><td>Cantidad:</td><td style="font-weight: bold;">TANQUERO</td></tr>
                <tr><td>Peso Neto:</td><td style="font-weight: bold;">{{$record->PesoNeto}} KILOS</td></tr>
                <tr><td>Peso Bruto:</td><td style="font-weight: bold;">{{$record->PesoBruto}} KILOS</td></tr>
                </tbody>
            </table>
            <table border="1" style="width: 100%; border-collapse: collapse; text-align: center;">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>PLACA</th>
                        <th>PESO NETO KILOS</th>
                        <th>PESO BRUTO KILOS</th>
                        <th>LOTE</th>
                        <th>FECHA ELABORACIÓN</th>
                        <th>FECHA EXPIRACIÓN</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td rowspan="2">1</td>
                    <td>{{$record->Placa}}</td>
                    <td rowspan="2">{{ number_format($record->PesoNeto,2) }}</td>
                    <td rowspan="2">{{ number_format($record->PesoBruto,2) }}</td>
                    <td rowspan="2">{{$certificado->lote}}</td>
                    <td rowspan="2">{{ date('d/m/Y', strtotime($record->FechaSalida)) }}</td>
                    <td rowspan="2">{{ date('d/m/Y', strtotime($record->FechaSalida)) }}</td>
                </tr>
                <tr>
                    <td>{{$record->Placa}}</td>
                </tr>
                <tr>
                    <td colspan="2">PRECINTOS</td>
                    <td colspan="5">{{$record->Desde}}-{{$record->Hasta}}</td>
                </tr>
                </tbody>
            </table>
            <div style="padding: 15px;"></div>
            <div> Puerto de envio: <strong>QUEVEDO-ECUADOR</strong></div>
            <div> Importador: <strong>{{$record->NombreComercial}}</strong></div>
            <section style="margin-top: 100px;">
                <table style="width: 100%; border: none; margin-top: 30px;">
                    <tr>
                        <td width="50%" style="text-align: center; border: none; color: #1a4b03ff;">
                            <strong>________________________________</strong>
                        </td>
                        <td width="50%" style="text-align: center; border: none; color: #1a4b03ff;">
                            <strong>________________________________</strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="text-align: center; border: none;">
                            <strong>Ing {{$certificado->user_produccion}}</strong>
                        </td>
                        <td width="50%" style="text-align: center; border: none;">
                            <strong>Ing {{$certificado->user_calidad}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="text-align: center; border: none;">
                            <strong>Responsable de Producción</strong>
                        </td>
                        <td width="50%" style="text-align: center; border: none;">
                            <strong>Responsable de Calidad</strong>
                        </td>
                    </tr>
                </table>
            </section>
        </section>
    </div> <!-- fin page 3 -->
    @endif
</body>
</html>