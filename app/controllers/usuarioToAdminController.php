<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 01/12/2020
Última modificación: 01/12/2020
Versión: 1.00

#usuarioToAdminController.php
Fichero encargado de llamar a la funcion que convierte un socio a admin usando el dni como dato
**********************************-->
<?php
    
    $dni = $_GET['nif'];
    
    require_once '..\models\usuarios.php';

    
    Usuario::convertirSocio_admin($dni);
    
?>