<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 06/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#listaAdminReservasView.php
Fichero encargado de generar la vista de el menu de dia y hora para seleccionar el tramo de el que se
quiere mostrar usuarios
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
    <h3 id="lb_seleccione_reserva"><font face="courier" size=4>Seleccione dia y hora para ver las personas con reservas:</font></h3>

    <form action="../controllers/listaAdminReservasController.php" method="post">
      <h3 id="lb_crear_tramo_dia"><font face="courier" size=5>Dia:</font></h3>
      <select id="mn_semana_tramos_crear" name="semanaBox">
        <br><option value="Lunes">Lunes</option>
        <br><option value="Martes">Martes</option>
        <br><option value="Miércoles">Miércoles</option>
        <br><option value="Jueves">Jueves</option>
        <br><option value="Viernes">Viernes</option>
        <br><option value="Sábado">Sábado</option>
      </select>

      <h3 id="lb_crear_tramo_hora"><font face="courier" size=5>Hora inicio:</font></h3>
        
      <select id="mn_hora_tramos_crear" name="horaBox">
          <?php
          //blucle para escribir todo
              for($i=7;$i<23;$i++)
              {
                  ?>
                      <br><option value="<?php echo $i?>"><?php echo $i . ':00'?></option>
                  <?php
              }
          ?>
      </select>
        
      <input type="submit" id="bt_reservas_mostrar" value="Mostrar usuarios">
    </form>

    <form action="../views/AdminView.php" method="get">
      <input type="submit" id="bt_tramos_volver" value="Volver">
    </form>

   
  </body>
</html>