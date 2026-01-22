<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Imprimiendo Factura #{{ $peso->Id_Fila }}</title>
  <style>
    html,body { height:100%; margin:0; }
    iframe { width:100%; height:100%; border: none; }
  </style>
</head>
<body>
  <iframe id="pdfFrame" src="data:application/pdf;base64,{{ $base64 }}"></iframe>

  <script>
    const frame = document.getElementById('pdfFrame');

    // Esperar a que el iframe cargue el PDF (en algunos navegadores puede tardar)
    frame.onload = function() {
      try {
        // Intentar imprimir el contenido del iframe
        frame.contentWindow.focus();
        frame.contentWindow.print();
      } catch (e) {
        // Fallback: abrir el PDF en nueva pestaña para que usuario imprima manualmente
        window.open(frame.src, '_blank');
      }
    };

    // Timeout por si no hay onload
    setTimeout(() => {
      try {
        frame.contentWindow.focus();
        frame.contentWindow.print();
      } catch (e) {
        window.open(frame.src, '_blank');
      }
    }, 2000);
  </script>
</body>
</html>