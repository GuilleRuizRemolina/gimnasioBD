<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 15/12/2020
Última modificación: 15/12/2020
Versión: 1.00

#cambiarDatosController.php
Fichero que se encarga de recoger los datos escritos y llamar a la funcion que actualiza estos datos
**********************************-->
<?php
    $nombre = $_POST['nombreBox'];
    $apellido1 = $_POST['apellido1Box'];
    $apellido2 = $_POST['apellido2Box'];

    $telefono = $_POST['telefonoBox'];
    $direccion = $_POST['direccionBox'];

    //comprobar si los campos estan vacios
    if($nombre=='' || $apellido1=='' || $telefono=='' || $direccion=='')
    {
        ?>
        <script>
            alert('No se puede dejar ningun campo en blanco');
        </script>
        <?php
        echo "<script>setTimeout(\"location.href = '../views/cambiarDatosView.php';\",0);</script>";
    }
    else
    {
        //comprobar que el telefono es un valor numerico
        if(!is_numeric($telefono))
        {
            ?>
            <script>
                alert('El telefono debe ser un valor numérico');
            </script>
            <?php
            echo "<script>setTimeout(\"location.href = '../views/cambiarDatosView.php';\",0);</script>";
        }
        else
        {
            //asegurarnos que el nombre va a ser unico
            $nombreFicheroImagen = time() . '-' . $_FILES['imagenBox']['name'];

            //mover el fichero de la carpeta temporal a la nuestra
            $destino = '../Assets/img/imagenesPerfil/' . $nombreFicheroImagen;

            $origen = $_FILES['imagenBox']['tmp_name'];

            $moverFicheroImagen = move_uploaded_file($origen,$destino);

            require_once '../models/usuarios.php';

            //si se ha seleccionado una imagen, esta se actualizara
            if($moverFicheroImagen)
            {
                Usuario::updateImagenUsuarioLogado(Usuario::getId_UsuarioLogado(),$nombreFicheroImagen);
            }
            
            //editar el resto de campos
            Usuario::updateDatosUsuarioLogado(Usuario::getId_UsuarioLogado(),$nombre,$apellido1,$apellido2,$telefono,$direccion);

            ?>
            <script> 
                alert('Los datos se han editado correctamente');
            </script>
            <?php

            //dependiendo de si erers administrador o socio volvera a distintos sitios
            if(Usuario::getRol_UsuarioLogado()=='A')
            {
                echo "<script>setTimeout(\"location.href = '../views/adminView.php';\",0);</script>";
            }
            if(Usuario::getRol_UsuarioLogado()=='S')
            {
                echo "<script>setTimeout(\"location.href = '../views/listaReservasView.php';\",0);</script>";
            }
        }
    }                                                                                              
?>