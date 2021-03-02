<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 30/11/2020
Última modificación: 04/12/2020
Versión: 1.00

#loginController.php
Fichero que se encarga de recoger los datos de usuario y contraseña y permite entrar al usuario al la pagina
Diferencia entre administradores y socios y tambien entre usuarios sin autentificar, cambia el valor de
logado del usuario a 1 para hacer saber a la palicacion que el usuario esta logado
**********************************-->

<?php

  require_once '../models/usuarios.php';
  Usuario::deslogar_todos();

  //capturar los datos
  $usuarioLogin = $_GET['usuarioBox'];
  $contrasena = $_GET['contrasenaBox'];

  //comprobar que los campos no estan vacios
  if($usuarioLogin=='' || $contrasena=='')
  {
    ?>
    <script>
      alert('Porfavor rellene los campos'); 
    </script>
    <?php
    echo "<script>setTimeout(\"location.href = '../index.php';\",0);</script>";
  }

  //conectarse a la base de datos
  require_once '..\models\gimnasioBD.php';

  $conexion = gimnasioBD::conectarBD();

  $consulta = $conexion -> query("SELECT * FROM usuarios WHERE usuarioLogin='$usuarioLogin'");
  
  if(!$consulta)
  {
    ?>
    <script>
      alert('Usuario o contraseña incorrectos'); //no se ha encontrado el usaurio
    </script>
    <?php
    echo "<script>setTimeout(\"location.href = '../index.php';\",0);</script>";
  }
  else
  {
    //comprobar contraseña
    $cliente = $consulta->fetchObject();
    if($cliente->contrasena!=$contrasena)
    {
      ?>
      <script>
        alert('Usuario o contraseña incorrectos'); //contrasena incorrecta
      </script>
      <?php
      echo "<script>setTimeout(\"location.href = '../index.php';\",0);</script>";
    }
    else
    {
      //detectar el tipo de usuario que esta entrando
      if($cliente->rol=='U') //si es un usuario sin validar
      {
        ?>
          <script>
            alert('Usuario sin autentificar'); 
          </script>
        <?php
        echo "<script>setTimeout(\"location.href = '../index.php';\",0);</script>";
      }
      else if ($cliente->rol=='A') //si es un administrador
      {
        //logeado activado=1
        require_once '..\models\usuarios.php';
        Usuario::setLogado($usuarioLogin,1); //1 indica que el usuario esta logado
        
        require_once '..\views\adminView.php'; 
      }
      else if ($cliente->rol=='S') //si es un socio
      {
        require_once '..\models\usuarios.php';
        Usuario::setLogado($usuarioLogin,1); //1 indica que el usuario esta logado
        require_once '..\views\listaReservasView.php'; 
      }
    }
  }
?>