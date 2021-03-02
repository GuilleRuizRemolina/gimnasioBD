<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 13/12/2020
Última modificación: 13/12/2020
Versión: 1.00

#cancelarReservaController.php
Fichero que se encarga de llamar a la funcion de borrado de reservas, recogiendo los valores de dia y hora
**********************************-->
<?php
    $dia = $_GET['dia'];
    $hora = $_GET['hora_inicio'];

    require_once '../models/usuarios.php';
    require_once '../models/reservas.php';

    $usuario_id = Usuario::getId_UsuarioLogado();

    Reserva::borrarReservaUsuario($hora,$dia,$usuario_id);

    //refrescar pagina
    echo "<script>setTimeout(\"location.href = '../views/listaReservasView.php';\",0);</script>";
?>