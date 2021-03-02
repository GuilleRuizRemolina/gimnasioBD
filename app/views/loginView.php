<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 30/11/2020
Última modificación: 30/11/2020
Versión: 1.00

#loginView.php
Fichero encargado de generar la vista del login msotrando el boton de registrarse
**********************************-->

<!DOCTYPE html>

<html>
  <head>
  <link href="../Assets/css/estilos.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <tittle> </tittle>
    <meta charset="utf-8">
  </head>
  <body id="login_fondo">
    <h3 id="lb_login"><font face="courier" size=6><u>Iniciar sesión:</u></font></h3>
    <form action="controllers/loginController.php" method="get">
      <h3 id="lb_login_usuario"><font face="courier" size=5>Usuario:</font></h3>
      <input type="text" name="usuarioBox" id="tb_login_usuario" maxlength="18" value="gui888"><br>
      <h3 id="lb_login_contrasena"><font face="courier" size=5>Contraseña:</font></h3>
      <input type="password" name="contrasenaBox" id="pb_login_contrasena" maxlength="18" value="contraseña"><br>
      <input type="submit" id="bt_iniciar" value="Iniciar Sesión">
    </form>  

    <form action="views/registroView.php" method="get">
      <input type="submit" id="bt_registro" value="Registrarse">
    </form>

  </body>
</html>