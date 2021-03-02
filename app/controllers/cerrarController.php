<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 07/12/2020
Última modificación: 09/12/2020
Versión: 1.00

#cerrarController.php
Fichero que se encarga de cambiar la columna "usuarioLogado" a 0, recogiendo la id del usuario que este logado
en el momento, se usa cuando se cierra sesión
**********************************-->
<?php
  require_once '../models/usuarios.php';

  $usuarioLogin_Logado = Usuario::getUsuarioLogin_usuarioLogado();

  Usuario::setLogado($usuarioLogin_Logado,0); //1 indica que el usuario esta logado

  echo "<script>setTimeout(\"location.href = '../';\",0);</script>";

?>