<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 15/12/2020
Última modificación: 15/12/2020
Versión: 1.00

#eliminarCuentaView.php
Fichero encargado de generar la vista de eliminar cuenta, solo muestra una confirmacion a la 
hora de borrar tu propio usuario
**********************************-->
<!DOCTYPE html>

<html>
  <head>
  <link href="../Assets/css/estilos.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <tittle> </tittle>
    <meta charset="utf-8">
  </head>
  <body id="fondo_registro">
    <h3 id="lb_pregunta_eliminar"><font face="courier" size=5>¿Esta seguro de que quiere eliminar su cuenta?</font></h3>

    <form action="../controllers/eliminarCuentaController.php" method="get">
      <br><input type="submit" id="bt_pregunta_si" value="Si">
    </form>

    <form action="cambiarDatosView.php" method="get">
      <br><input type="submit" id="bt_pregunta_no" value="No">
    </form>

  </body>
</html>