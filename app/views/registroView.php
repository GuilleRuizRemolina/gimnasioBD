<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 01/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#registroView.php
Fichero encargado de generar la vista del registro con todos los campos necesarios para registrarse
tambien permite cancelar el registro
**********************************-->
<!DOCTYPE html>

<html>
  <head>
  <link href="../Assets/css/estilos.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <tittle> </tittle>
    <meta charset="utf-8">
  </head>
  <body id="fondo_registro">
    <form action="../controllers/registroController.php" method="post" enctype="multipart/form-data">
    <h3 id="lb_registro"><font face="courier" size=6><u>Registro:</u></font></h3>
      <h3 id="lb_registro_dni"><font face="courier" size=5>Dni:*</font></h3>
      <input type="text" id="tb_registro_dni" maxlength="9" name="dniBox">

      <h3 id="lb_registro_nombre"><font face="courier" size=5>Nombre:*</font></h3>
      <input type="text" id="tb_registro_nombre" maxlength="18" name="nombreBox">

      <h3 id="lb_registro_apellido1"><font face="courier" size=5>Primer apellido:*</font></h3>
      <input type="text" id="tb_registro_apellido1" maxlength="18" name="apellido1Box">

      <h3 id="lb_registro_apellido2"><font face="courier" size=5>Segundo Apellido:*</font></h3>
      <input type="text" id="tb_registro_apellido2" maxlength="18" name="apellido2Box">

      <h3 id="lb_registro_imagen"><font face="courier" size=5>Imagen:*</font></h3>
      <input type="file" id="ib_registro_imagen" name="imagenBox">

      <h3 id="lb_registro_telefono"><font face="courier" size=5>Telefono:</font></h3>
      <input type="number" id="tb_registro_telefono" maxlength="9" name="telefonoBox">
      
      <h3 id="lb_registro_login"><font face="courier" size=5>Login:*</font></h3>
      <input type="text" id="tb_registro_login" maxlength="18" name="loginBox">

      <h3 id="lb_registro_contrasena"><font face="courier" size=5>Contraseña:*</font></h3>
      <input type="password" id="tb_registro_contrasena" maxlength="18" name="contrasenaBox">

      <h3 id="lb_registro_email"><font face="courier" size=5>Email:*</font></h3>
      <input type="text" id="tb_registro_email" maxlength="25" name="emailBox">

      <h3 id="lb_registro_direccion"><font face="courier" size=5>Dirección:</font></h3>
      <input type="text" id="tb_registro_direccion" maxlength="25" name="direccionBox"><br>

      <input type="submit" id="bt_registro_registrarse" value="Registrarse">
    </form> 

    <form action="../index.php" method="get">
      <input type="submit" id="bt_registro_cancelar" value="Cancelar registro">
    </form>
  </body>
</html>