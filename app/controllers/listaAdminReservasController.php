<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 06/12/2020
Última modificación: 15/12/2020
Versión: 1.00

#listaAdminReservasController.php
Fichero que se encarga de recoger los datos de dia y hora, luego lluego llama a la funcion getSociosByHoraDia
que se encarga de escribir una cadena con los nombres de todos los socios que tengan una reserva ese dia y hora
Tambien muestra el número de socios que hay en esa reserva
**********************************-->
<?php
    
    require "../views/listaAdminReservasView.php";

    $dia = $_POST['semanaBox'];
    $hora = $_POST['horaBox'];
    
    require "../models/reservas.php";

    $cadena = Reserva::getSociosByHoraDia($hora,$dia)['cadenaNombres'];
    $n = Reserva::getSociosByHoraDia($hora,$dia)['numero'];

    if($n==0) //si no ninguna reserva en ese dia y hora
    {
        ?>
            <h3 id="lb_mostrar_reservas_vacio"><font face="courier" size=5>No hay ninguna reserva para el <?php echo$dia?> a las <?php echo$hora?>:00</font></h3>
        <?php
    }
    else
    {
        ?>
            <textarea id="at_personas_con_reservas" disabled>
                <?php echo "\n" . '#Socios con reservas el ' .
                $dia . ' a las ' . $hora . ':00' . "\n" .'-Número de personas reservadas: ' . $n . 
                "\n\n" . $cadena ?>
            </textarea>
        <?php
    }
?>
    


