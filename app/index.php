<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 30/11/2020
Última modificación: 30/11/2020
Versión: 1.00

#index.php
Fichero encargado de iniciar todo los demas ficheros
**********************************-->
<link href="Assets/css/estilos.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

<?php
  //cargar base de datos
  include 'models/gimnasioBD.php';

  //cargar la vista
  include 'views/loginView.php';
?>

