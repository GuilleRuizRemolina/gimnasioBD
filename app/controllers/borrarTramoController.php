<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 09/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#borrarTramoController.php
Fichero que se encarga de mostrar los menus de dia y hora para luego llamar a la funcion de elminar tramo
con los datos recogidos
**********************************-->
<?php
    
    require "../views/listaTramosView.php";
    ?>
        <h3 id="lb_borrar_tramo"><font face="courier" size=5><u>Eliminar tramo:</u></font></h3>
        
        <!--formulario para borrar el tramo-->
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
            
            <h3 id="lb_crear_tramo_hora"><font face="courier" size=5>Hora inicio:</font></h3>
            
            <select id="mn_hora_tramos_crear" name="horaBox">
                <?php
                //blucle para escribir todo
                    for($i=7;$i<23;$i++)
                    {
                        ?>
                            <br><option value="<?php echo $i?>"><?php echo $i . ':00'?></option>
                        <?php
                    }
                ?>
            </select> <br>

            <input type="submit" id="bt_crear_tramo_confirmar_eliminar" value="Confirmar eliminación" name="boton">
    </form>

<?php
    //si se pulsa el boton crear
    if(isset($_POST['boton']))
    {
        //conectarse a la base de datos
        require_once '..\models\tramos.php';
        require_once '..\models\reservas.php';

        $dia = $_POST['semanaBox'];
        $hora = $_POST['horaBox'];

        //borrar reservas del tramo
        Reserva::borrarReserva($hora,$dia);
        //borrar tramo
        Tramo::borrarTramo($hora,$dia);
    } 
?>
    
    
