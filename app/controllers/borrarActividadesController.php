<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 08/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#borrarActividadesController.php
Fichero que se encarga de llamar a la funcion que borra actividades recogiendo el dato del nombre de la 
actividad
**********************************-->
<?php
    $nombre = $_GET['nombre'];

    require_once '..\models\actividades.php';

    Actividad::borrarActividad($nombre);
?>