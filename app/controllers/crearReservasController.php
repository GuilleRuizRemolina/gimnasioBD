<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 05/12/2020
Última modificación: 13/12/2020
Versión: 1.00

#crearReservaController.php
Fichero que se encarga de recoger los datos de dia y hora y de crear la reserva. Controla varias cosas como
que no se pueda reservas un tramo que no existe, el numero de reservas por dia y el aforo de las actividades
a la hora de reservar
**********************************-->
<?php
    require "../views/listaReservasView.php";
?>
    <h3 id="lb_reservar_actividad"><font face="courier" size=5>Reservar actividad:</font></h3>
    
    <!--formulario para crear la reserva-->
    <form action="#" method="post">
        <h3 id="lb_crear_tramo_dia"><font face="courier" size=5>Dia:</font></h3>
        <select id="mn_semana_tramos_crear" name="semanaBox">
            <br><option value="Lunes">Lunes</option>
            <br><option value="Martes">Martes</option>
            <br><option value="Miércoles">Miércoles</option>
            <br><option value="Jueves">Jueves</option>
            <br><option value="Viernes">Viernes</option>
            <br><option value="Sábado">Sábado</option>
        </select>
        
        <h3 id="lb_reservar_hora"><font face="courier" size=5>Hora inicio:</font></h3>
        
        <select id="mn_hora_reservar" name="horaBox">
            <?php
            //blucle para escribir todo
                for($i=7;$i<23;$i++)
                {
                    ?>
                        <br><option value="<?php echo $i?>"><?php echo $i . ':00'?></option>
                    <?php
                }
            ?>
        </select><br>
        <input type="submit" id="bt_confirmar_reserva" value="Confirmar Reserva" name="boton">
    </form>

<?php
    //si se pulsa el boton crear
    if(isset($_POST['boton']))
    {
        //conectarse a la base de datos
        require_once '..\models\actividades.php';
        require_once '..\models\tramos.php';
        require_once '..\models\usuarios.php';
        require_once '..\models\reservas.php'; 

        $dia = $_POST['semanaBox'];
        $hora = $_POST['horaBox'];

        //obtener la id del tramo con el dia y la hora
        $id_tramo = Tramo::getIdByHoraDia($hora,$dia);

        //obtener la id del usuario logeado
        $id_usuarioLogado = Usuario::getId_UsuarioLogado();

        //obtener la id de la actividad
        $id_actividad = Tramo::getActividadIdById($id_tramo);

        //obtener el aforo de la actividad
        $aforo = Actividad::getAforoById($id_actividad);
        
        //variables que guarda cuantos estan apuntados
        $participantes = Reserva::getSociosByHoraDia($hora,$dia)['numero'];

        //obtener numero de reservas de un usuario en un dia
        $nReservas = Reserva::getNreservasUsuarioUnDia($id_usuarioLogado,$dia);

        //comprobar que el tramo existe
        if(Tramo::exiteTramo($id_tramo))
        {
            ?>
            <script>
                alert('No hay ninguna actividad programada para esa hora en ese dia');
            </script>
            <?php
        }
        else
        {
            //comprobar que un usuario no tenga dos actividades un mismo dia
            if($nReservas>=2)
            {
                ?>
                <script> 
                    alert('Ya tiene dos reservas para ese dia\nCancele una reserva primero');
                </script>
                <?php
            }
            else
            {
                //comprobar aforo
                if($participantes>=$aforo)
                {
                    ?>
                    <script>
                        alert('La actividad no permites más reservas. Su aforo esta completo'); 
                    </script>
                    <?php
                }
                else
                {
                    $reservaAux = new Reserva($id_tramo,$id_usuarioLogado);

                    $reservaAux->insertarReserva();
                }
            }
        }
        
        //refrescar la pagina
        echo "<script>setTimeout(\"location.href = 'crearReservasController.php';\",0);</script>"; 
    }
?>