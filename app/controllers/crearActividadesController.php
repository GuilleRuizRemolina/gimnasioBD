<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 03/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#crearActividadesController.php
Fichero que se encarga de recoger los datos de nombre descripcion y aforo para luego crear la actividad con
la funcion pasandole estos datos
**********************************-->
<?php
    require "../views/listaActividadesView.php";
?>
    <h3 id="lb_actividades_crear"><font face="courier" size=5><u>Crear actividad:</u></font></h3>
    
    <!--formulario para crear la actividad-->
    <form action="#" method="post">
        <h3 id="lb_actividades_crear_nombre"><font face="courier" size=5>Nombre:</font></h3>
        <input type="text" maxlength="10" id="tb_actividades_crear_nombre" name="nombreBox">

        <h3 id="lb_actividades_crear_descripcion"><font face="courier" size=5>Descripcion:</font></h3>
        <input type="text" maxlength="50" id="tb_actividades_crear_descripcion" name="descripcionBox">
        
        <h3 id="lb_actividades_crear_aforo"><font face="courier" size=5>Aforo:</font></h3>
        <input type="number" id="tb_actividades_crear_aforo" name="aforoBox">

        <input type="submit" value="Confirmar" id="bt_actividades_crear_confirmar" name="boton">
    </form>

<?php
    //si se pulsa el boton crear
    if(isset($_POST['boton']))
    {
        //conectarse a la base de datos
        require_once '..\models\actividades.php';

        $nombre = $_POST['nombreBox'];
        $descripcion = $_POST['descripcionBox'];
        $aforo = $_POST['aforoBox'];

        //comporbar que todos los campos han sido rellenados
        if($nombre=='' || $descripcion=='' || $aforo=='')
        {
            ?>
                <script>
                    alert('Es necesario rellenar todos los campos para insertar una nueva actividad');
                </script>
            <?php
        }
        else
        {
            //comprobación de aforo
            if($aforo<=0)
            {
                ?>
                <script>
                    alert('El mínimo de aforo por actividad es de 1 persona');
                </script>
                <?php
            }
            else if($aforo>999)
            {
                ?>
                <script>
                    alert('El máximo de aforo por actividad es de 999 personas');
                </script>
                <?php
            }
            else
            {
                $actividadAux = new Actividad($nombre,$descripcion,$aforo);

                $actividadAux->insertarActividad();
            }
        }
    }
?>