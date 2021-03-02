<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 01/12/2020
Última modificación: 010/12/2020
Versión: 1.00

#registroController.php
Fichero que se encarga de recoger los datos del formulario incluido la image. Tras haber validado estos
llama a la funcion de insertarUsuarios pasandole estos datos, pone el rol a U del usuario e informa del
registro
**********************************-->
<?php
  //capturar datos
  $dni = $_POST['dniBox'];
  $nombre = $_POST['nombreBox'];
  $apellido1 = $_POST['apellido1Box'];
  $apellido2 = $_POST['apellido2Box'];
  $usuarioLogin = $_POST['loginBox'];
  $contrasena = $_POST['contrasenaBox'];
  $email = $_POST['emailBox'];
  $telefono = $_POST['telefonoBox'];
  $direccion = $_POST['direccionBox'];

  //campos obligatorios
  if($dni=='' || $nombre=='' || $apellido1=='' || $apellido2=='' || $email=='' || $usuarioLogin=='' || $contrasena=='')
  {
    ?>
    <script>
      alert('Los campos señalados con un asterisco son obligatorios');
    </script>
    <?php
    echo "<script>setTimeout(\"location.href = '../views/registroView.php';\",0);</script>";
  }
  else
  {
    //asegurarnos que el nombre va a ser unico
    $nombreFicheroImagen = time() . '-' . $_FILES['imagenBox']['name'];

    //mover el fichero de la carpeta temporal a la nuestra
    $destino = '../Assets/img/imagenesPerfil/' . $nombreFicheroImagen;

    $origen = $_FILES['imagenBox']['tmp_name'];

    $moverFicheroImagen = move_uploaded_file($origen,$destino);

    //comprobar que se selecciono imagen
    if(!$moverFicheroImagen)
    {
      ?>
      <script>
        alert('Error. Imagen no cargada. Porfavor seleccione una imagen para su perfil');
      </script>
      <?php
      echo "<script>setTimeout(\"location.href = '../views/registroView.php';\",0);</script>";
    }
    else
    {
      require_once '..\models\gimnasioBD.php';

      $conexion = gimnasioBD::conectarBD();
  
      //para añadir la id
      $consulta = $conexion -> query("SELECT * FROM usuarios");
  
      $nUsuarios = $consulta -> rowCount() + 1;
  
      $consulta = $conexion -> query("SELECT * FROM usuarios WHERE nif='$dni' or usuarioLogin='$usuarioLogin' or email='$email'");
  
      //comprobar si no existe en la base de datos un usuario con el mismo dni, usuario login o email
      if($consulta-> rowCount()>0)  
      {
        ?>
        <script>
          alert('Ya exite en la base datos un usuario con su mismo DNI, nombre de usuario o email, porfavor cambie estos campos');
        </script>
        <?php
        echo "<script>setTimeout(\"location.href = '../views/registroView.php';\",0);</script>";
      }
      else
      {
        //comprobar que el valor de numero no excede de caracteres
        if($telefono>999999999)
        {
          ?>
          <script>
            alert('El campo telefono no puede superar las 9 cifras');
          </script>
          <?php
          echo "<script>setTimeout(\"location.href = '../views/registroView.php';\",0);</script>";
        }
        else
        {
          //conectarse a la base de datos
          require_once '..\models\usuarios.php';
            
          $rol = 'U'; //los usuarios que se registren tendran el rol U: usuario sin autentificar
          $logado = 0;
          $imagen = $nombreFicheroImagen;

          $usuarioAux = new Usuario($dni,$nombre,$apellido1,$apellido2,$imagen,$usuarioLogin,$contrasena,
                                    $email,$telefono,$direccion,$rol,$logado);

          $usuarioAux->insertarUsuario();

          ?>
          <script>
            alert('Registro completado, un administrador debera verificar su usuario para poder inicar sesión');
          </script>

          <?php
          echo "<script>setTimeout(\"location.href = '../index.php';\",0);</script>";
        }
      }
    }
  }
?>