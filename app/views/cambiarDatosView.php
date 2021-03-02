<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 15/12/2020
Última modificación: 15/12/2020
Versión: 1.00

#cambiarDatosView.php
Fichero encargado de generar la vista de cambio de datos, para editar el perfil de el usuario, tambien
muestra el boton para elminar tu propia cuenta
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
        require_once "../models/usuarios.php";
        require 'CabeceraView.php';
      
        //obtener datos del usuario logado
        $nombre = Usuario::getNombre_UsuarioLogado();
        $apellido1 = Usuario::getApellido1_UsuarioLogado();
        $apellido2 = Usuario::getApellido2_UsuarioLogado();
        $telefono = Usuario::getTelefono_UsuarioLogado();
        $direccion = Usuario::getDireccion_UsuarioLogado();

      ?>
    <form action="../controllers/cambiarDatosController.php" method="post" enctype="multipart/form-data">
      <h3 id="lb_editar_datos"><font face="courier" size=5>Editar datos:</font></h3>
      <h3 id="lb_aviso_imagen"><font face="courier" size=4>No seleccionar una nueva imagen si desea mantener la que ya tiene</font></h3>

      <h3 id="lb_editar_nombre"><font face="courier" size=5>Nombre:</font></h3>
      <input type="text" value="<?php echo$nombre ?>" id="tb_editar_nombre" name="nombreBox">
      
      <h3 id="lb_editar_apellido1"><font face="courier" size=5>Primer apellido:</font></h3>
      <input type="text" value="<?php echo$apellido1 ?>" id="tb_editar_apellido1" name="apellido1Box">
      
      <h3 id="lb_editar_apellido2"><font face="courier" size=5>Segundo Apellido:</font></h3>
      <input type="text" value="<?php echo$apellido2 ?>" id="tb_editar_apellido2" name="apellido2Box">

      <h3 id="lb_editar_imagen"><font face="courier" size=5>Imagen:</font></h3>
      <input type="file" id="ib_editar_imagen" name="imagenBox">

      <!--El campo telefono seria un campo number normalmente pero no consigo que recuperre los datos del usuario
      siendo un tipo number, por eso lo he daejado como tipo text y luego hago una validación para comprobar que lo 
      que es escribe es un numero-->

      <h3 id="lb_editar_telefono"><font face="courier" size=5>Telefono:</font></h3>
      <input type="text" value="<?php echo$telefono ?>" id="tb_editar_telefono" name="telefonoBox">
     
      <h3 id="lb_editar_direccion"><font face="courier" size=5>Direccion:</font></h3>
      <input type="text" value="<?php echo$direccion ?>" id="tb_editar_direccion" name="direccionBox">
      
      <input type="submit" id="bt_guardar_cambios" value="Guardar cambios">
    </form> 

    <form action="../views/eliminarCuentaView.php" method="get">
      <input type="submit" id="bt_eliminar_cuenta" value="Eliminar mi cuenta">
    </form>

    <?php
    //detectar si eres administrador o socio para saber a donde volver
    if(Usuario::getRol_UsuarioLogado()=='A')
    {
      ?>
        <form action="adminView.php" method="get">
          <input type="submit" id="bt_tramos_volver" value="Volver">
        </form>
      <?php
    }
    if(Usuario::getRol_UsuarioLogado()=='S')
    {
      ?>
        <form action="listaReservasView.php" method="get">
          <input type="submit" id="bt_tramos_volver" value="Volver">
        </form>
      <?php
    }
    ?>
    

      
  </body>
</html>