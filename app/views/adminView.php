<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 01/12/2020
Última modificación: 15/12/2020
Versión: 1.00

#adminView.php
Fichero encargado de generar la vista de la pagina del admin
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

    <form action="../views/listaUsuariosView.php" method="get">
      <br><input type="submit" id="bt_gestion_usuarios" value="Gestión de usuarios">
    </form>

    <form action="../views/listaActividadesView.php" method="get">
      <br><input type="submit" id="bt_gestion_actividades" value="Gestión de actividades">
    </form>

    <form action="../views/listaTramosView.php" method="get">
      <br><input type="submit" id="bt_gestion_tramos" value="Modificar horario">
    </form>

    <form action="../views/listaAdminReservasView.php" method="get">
      <br><input type="submit" id="bt_mostrar_reservas" value="Mostrar reservas">
    </form>

    <form action="../views/cambiarDatosView.php" method="get">
      <br><input type="submit" id="bt_editar_perfil" value="Editar mi perfil">
    </form>

    <form action="../controllers/cerrarController.php" method="get">
      <input type="submit" id="bt_cerrar_sesion" value="Cerrar sesión">
    </form>
  </body>
</html>