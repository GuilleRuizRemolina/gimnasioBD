<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 03/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#listaTramosView.php
Fichero encargado de generar la vista de los tramos, muestra dos tablas, una con las actividades y otra
con el horario, tambien muestra los botones de crear actividades y de borar actividades
**********************************-->
<!DOCTYPE html>

<html>
  <head>
  <link href="../Assets/css/estilos.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <tittle> </tittle>
    <meta charset="utf-8">
  </head>
  <body id="portada_fondo">
    <?php
      require 'CabeceraView.php';
    ?>
    

    <?php
      require "../models/tramos.php";
      require '../models/actividades.php';

      $conexion = gimnasioBD::conectarBD();

      $consulta = $conexion -> query("SELECT * FROM actividades");
    ?>
    
    <!--Mostrar horario-->
    
    <table id="tabla_tramos" border="3" height="200">
      <tr>
        <th>Hora</th>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miércoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sábado</th>
      </tr>
      <?php
        $diasSemana = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
        for($i=7;$i<=22;$i++) //para cada hora
        {
          echo '<tr>';
            echo '<td>' . $i . ':00 - ' . ($i+1) . ':00</td>';
            foreach($diasSemana as $d) //en cada dia de la semana de una misma hora
            {
              echo '<td>' . Tramo::getNombreActividadByHoraDia($i,$d) . '</td>'; //i es la hora y d es el dia de la semana
            }
          echo '</tr>';
        }
      ?>
    </table>
    
    <form action="../controllers/crearTramoController.php" method="get">
      <input type="submit" id="bt_tramos_crear_tramo" value="Crear tramo">
    </form>

    <form action="../controllers/borrarTramoController.php" method="get">
      <input type="submit" id="bt_tramos_eliminar_tramo" value="Borrar tramo">
    </form>

    <form action="../views/adminView.php" method="get">
      <input type="submit" id="bt_tramos_volver" value="Volver">
    </form>

   
  </body>
</html>