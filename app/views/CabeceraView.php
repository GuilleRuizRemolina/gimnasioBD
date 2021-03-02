<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 14/12/2020
Última modificación: 15/12/2020
Versión: 1.00

#CabeceraView.php
Fichero encargado de generar la vista de la cabecera, msotrando el nomrbe del usuario y su imagen
**********************************-->
<!DOCTYPE html>

<!--hallar el nombre del usuario-->

<html>
  <head>
  <link href="../Assets/css/estilos.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <tittle> </tittle>
    <meta charset="utf-8">
  </head>
  <body>
      <?php
        require_once "../models/usuarios.php";
        $nombre_logado = Usuario::getNombre_UsuarioLogado();

        //obtener la imagen de la base de datos del usuario logado
        $direccion = Usuario::getImagenByUsuarioLogado(Usuario::getId_UsuarioLogado());
        $URL = '../Assets/img/imagenesPerfil/' . $direccion;

      ?>
        <h3 id="lb_nombreGimnasio"><font face="courier" size=5>Gimnasio LifeChange</font></h3>

        <h3 id="lb_nombreLogado"><font face="courier" size=5><?php echo $nombre_logado ?></font></h3>
        
        <img id="img_usuarioLogado" src="<?php echo $URL ?>"  width="150"/>

        <?php
          //si es un administrador
          if(Usuario::getRol_UsuarioLogado()=='A')
          {
            ?>
              <h3 id="lb_rol_A"><font face="courier" size=5>Administrador</font></h3>
            <?php
          }
          if(Usuario::getRol_UsuarioLogado()=='S')
          {
            ?>
              <h3 id="lb_rol_S"><font face="courier" size=5>Socio</font></h3>
            <?php
          }
        ?>
        
      <?php

      ?>
  </body>
</html>