<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 03/12/2020
Última modificación: 13/12/2020
Versión: 1.00

#listaActividadesView.php
Fichero encargado de generar la tabla de actividades, junto a el boton de crear actividades
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
  
  <h3 id="lb_lista_actividades"><font face="courier" size=5>Lista de actividades:</font></h3>

    <?php
      require '../models/actividades.php';

      $conexion = gimnasioBD::conectarBD();

      $consulta = $conexion -> query("SELECT * FROM actividades");
    ?>
    
    <table id="tabla_actividades" border="3" height="200">
      <tr>
        <th>Nombre</th>
        <th>Aforo</th>
        <th>Descripcion</th>
        
      </tr>
      <?php
        while($fila = $consulta->fetch()) 
        {
          echo '<tr>';
            echo '<td>' . $fila['nombre'] . '</td>';
            echo '<td>' . $fila['aforo'] . '</td>';
            echo '<td>' . $fila['descripcion'] . '</td>';
            echo '<td>' . '<a href="../controllers/borrarActividadesController.php?nombre=' . $fila['nombre'] . ' ">Eliminar</a>' . '</td>';
          echo '</tr>';
        }
      ?>
    </table>

    <form action="../controllers/crearActividadesController.php" method="get">
      <input type="submit" id="bt_actividades_crear" value="Crear actividad">
    </form>

    <form action="../views/adminView.php" method="get">
      <input type="submit" id="bt_actividades_volver" value="Volver">
    </form>

   
  </body>
</html>