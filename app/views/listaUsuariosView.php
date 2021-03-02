<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 01/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#listaUsuariosView.php
Fichero encargado de generar la vista de la tabla de usuarios, en la misma tabla se muestra las operaciones
que se puede hacer a cada usuario: validar, eliminar, asignar y desasignar
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
    <h3 id="lb_lista_de_usuarios"><font face="courier" size=5>Lista de usuarios:</font></h3>

    <?php

      $conexion = gimnasioBD::conectarBD();

      $consulta = $conexion -> query("SELECT * FROM usuarios");
    ?>
    
    <table id="tabla_usuarios" border="3" height="200">
      <tr>
        <th>DNI</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Imagen</th>
        <th>Rol</th>
        <th>Operaciones</th>
      </tr>
      <?php
        while($fila = $consulta->fetch()) 
        {
          echo '<tr>';
            echo '<td>' . $fila['nif'] . '</td>';
            echo '<td>' . $fila['nombre'] . '</td>';
            echo '<td>' . $fila['apellido1'] . ' ' . $fila['apellido2'] .'</td>';
            echo '<td>' . $fila['email'] . '</td>';
            echo '<td>';
              if($fila['imagen']!=null)
              {
                echo '<img src="../Assets/img/imagenesPerfil/' . $fila['imagen'] . ' " width="100" />';
              }
              else
              {
                echo 'sin imagen';
              }
            echo '</td>';
            echo '<td>' . $fila['rol'] . '</td>';
            echo '<td>' . '<a href="../controllers/validarUsuariosController.php?nif=' . $fila['nif'] . ' ">Validar</a>' . 
             ' ' .'<a href="../controllers/borrarUsuariosController.php?nif=' . $fila['nif'] . ' ">Eliminar</a>' .
             ' ' . '<a href="../controllers/usuarioToAdminController.php?nif=' . $fila['nif'] . ' ">Asignar</a>' . 
             ' ' . '<a href="../controllers/adminToUsuarioController.php?nif=' . $fila['nif'] . ' ">Desasignar</a>' .'</td>';
          echo '</tr>';
        }
      ?>
    </table>

    <form action="../views/adminView.php" method="get">
      <input type="submit" id="bt_usuario_volver" value="Volver">
    </form>
  </body>
</html>