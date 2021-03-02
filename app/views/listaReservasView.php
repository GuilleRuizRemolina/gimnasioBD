<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 05/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#listaReservasView.php
Fichero encargado de mostrar a un socio la tabla con sus reservas, tambien muestra el horario y el boton
de reservar actividad y el editar mi perfil, funciona como el adminView pero para os socios pues los socios
solo pueden reservas actividades y editar su perfil
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
      require "../models/tramos.php";

      require 'CabeceraView.php';
    ?> 

  <!--Mostrar Horario-->
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

    <?php
      require "../models/reservas.php";

      //obener la id del usuario logeado en el momento para ver sus reservas
      $id_usuarioLogado = Usuario::getId_UsuarioLogado();
    ?> 

<?php

      $conexion = gimnasioBD::conectarBD();

      $consulta = $conexion -> query("SELECT t.dia,t.hora_inicio,a.nombre FROM reservas r 
                                      JOIN tramos t ON t.id=r.tramo_id
                                      JOIN actividades a ON a.id=t.actividad_id
                                      JOIN usuarios u ON u.id=r.usuario_id 
                                      WHERE r.usuario_id='$id_usuarioLogado'");

      if($consulta->rowCount()==0) //si este usuario no tiene reservas
      {
        ?>
        <h3 id="lb_lista_reservas_vacia"><font face="courier" size=5>No tienes ninguna reserva</font></h3>
        <?php
      }
      else
      {
        ?>
          <h3 id="lb_lista_reservas"><font face="courier" size=5>Lista reservas:</font></h3>
          <table id="tabla_reservas_usuario" border="3" height="200">
            <tr>
              <th>Dia</th>
              <th>Hora</th>
              <th>Actividad</th>
            </tr>
            <?php
              while($fila = $consulta->fetch()) 
              {
                echo '<tr>';
                  echo '<td>' . $fila['dia'] . '</td>';
                  echo '<td>' . $fila['hora_inicio'] . ':00' .'</td>';
                  echo '<td>' . $fila['nombre'] . '</td>';
                  echo '<td>' . '<a href="../controllers/cancelarReservaController.php?dia=' . 
                                $fila['dia'] . '&hora_inicio='. $fila['hora_inicio'] . ' ">Cancelar</a>' .'</td>';
                echo '</tr>';
              }
            ?>
          </table>
        <?php
      }
    ?>
    
    <form action="../controllers/crearReservasController.php" method="get">
      <input type="submit" id="bt_socio_reservar" value="Reservar actividad">
    </form>

    <form action="../views/cambiarDatosView.php" method="get">
      <br><input type="submit" id="bt_socio_editar_perfil" value="Editar mi perfil">
    </form>
    
    <form action="../controllers/cerrarController.php" method="get">
      <input type="submit" id="bt_socio_cerrar_sesion" value="Cerrar sesión">
    </form>
   
  </body>
</html>