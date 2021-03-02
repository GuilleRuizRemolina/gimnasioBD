<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 10/12/2020
Última modificación: 12/12/2020
Versión: 1.00

#adminToUsuarioController
Fichero encargado de llamar ala funcion que convierte un admin a socio usando el dni como dato
**********************************-->
<?php
    $dni = $_GET['nif'];
    
    require_once '..\models\usuarios.php';

    Usuario::convertirAdmin_socio($dni);
?>