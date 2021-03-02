<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 05/12/2020
Última modificación: 12/12/2020
Versión: 1.00

#validarUsuarioController.php
Fichero que se encarga de llamar a la funcion para validar a un usuario, usando como dato el dni
**********************************-->
<?php
    $dni = $_GET['nif'];
    
    require_once '..\models\usuarios.php';

    Usuario::validarUsuario($dni);
?>