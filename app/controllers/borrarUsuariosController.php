<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 08/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#borrarUsuariosController.php
Fichero que se encarga de llamar a las funciones para borrar tanto el usuario como sus posibles reservas
recogiendo el dni como dato
**********************************-->
<?php
    $dni = $_GET['nif'];
    
    //conectarse a la base de datos
    require_once '..\models\usuarios.php';

    Usuario::borrarReservas($dni);
    Usuario::borrarUsuario($dni);
?>