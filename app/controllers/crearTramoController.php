<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 04/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#crearTramoController.php
Fichero que se encarga de recoger el dia, la hora y el nombre de la actividad, el nombre de la activdad lo
recoge en un menu que tiene los nombres de todas las actividades que hay en la base de datos, luego recogiendo
estos datos llama a la funcion que crea el tramo
**********************************-->
<?php
    require "../views/listaTramosView.php";
?>
    <h3 id="lb_crear_tramo"><font face="courier" size=5><u>Crear tramo:</u></font></h3>
    
    <!--formulario para crear el tramo-->
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
        </select>
        
        <?php
        //cargar los nombres de actividades en una array
        $arrayNombres = Actividad::getAllNombres();
        ?>
        
        <h3 id="lb_crear_tramo_nombre"><font face="courier" size=5>Actividad:</font></h3>

        <select id="mn_actividad_tramos_crear" name="actividadBox">
            <?php
                for($i=0;$i<count($arrayNombres);$i++)
                {
                    ?>
                        <br><option value="<?php echo $arrayNombres[$i]?>"><?php echo $arrayNombres[$i]?></option>
                    <?php
                }
            ?>
        </select><br>
        <input type="submit" id="bt_crear_tramo_confirmar" value="Comfirmar" name="boton">
    </form>

<?php
    //si se pulsa el boton crear
    if(isset($_POST['boton']))
    {
        //conectarse a la base de datos
        require_once '..\models\tramos.php';
        require_once '..\models\actividades.php';

        $dia = $_POST['semanaBox'];
        $hora_inicio = $_POST['horaBox'];
        $nombreActividad = $_POST['actividadBox'];
        $id_actividad = Actividad::getIdByNombre($nombreActividad);

        $tramoAux = new Tramo($dia,$hora_inicio,$id_actividad);

        $tramoAux->insertarTramo();

        echo "<script>setTimeout(\"location.href = '../controllers/crearTramoController.php';\",0);</script>"; 
    } 
?>