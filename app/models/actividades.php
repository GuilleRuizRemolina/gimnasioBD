<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 03/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#actividades.php
Fichero creado en base a la tabla de actividades, define la clase, el constructor, funciones getter e inserts
además de todas las funciones definidas de Actividades
**********************************-->
<?php
    require_once 'gimnasioBD.php';

    class Actividad
    {
        private $id;
        private $nombre;
        private $descripcion;
        private $aforo;
        
        //constructor
        function __construct($nombre, $descripcion, $aforo)
        {
            $this->id = Actividad::calcularId();
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->aforo = $aforo;
        }

        //funciones get
        public function getId()
        {
            return $this->id;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function getDescripcion()
        {
            return $this->descripcion;
        }
        public function getAforo()
        {
            return $this->aforo;
        }

        //funcion para insertar nuevas actividades
        public function insertarActividad()
        {
            $conexion = gimnasioBD::conectarBD();

            $idG = $this->id;
            $nombreG = $this->nombre;
            $descripcionG = $this->descripcion;
            $aforoG = $this->aforo;

            //controlar que no exista ya una actividad con el mismo nombre
            $mismoNombre = false;
            $arrayNombres = Actividad::getAllNombres();

            for($i = 0;$i<count($arrayNombres);$i++)
            {
                if($arrayNombres[$i]==$nombreG)
                {
                    $mismoNombre = true;
                }
            }

            if($mismoNombre)
            {
                ?>
                    <script>
                        alert('Ya existe una actividad con ese nombre. Porfavor introduzca un nombre distinto');
                    </script>
                <?php
            }
            else
            {
                //insertar actividad
                $conexion->exec("INSERT INTO actividades 
                (id,nombre,descripcion,aforo) 
                VALUES ('$idG','$nombreG','$descripcionG','$aforoG')");
            }

            //refrescar la pagina
            echo "<script>setTimeout(\"location.href = '../controllers/crearActividadesController.php';\",0);</script>";
        }

        //funcion para borrar actividades pasandole el nombre
        public static function borrarActividad($nombre)
        {
            $conexion = gimnasioBD::conectarBD();

            $consulta = $conexion -> query("SELECT * FROM actividades WHERE nombre='$nombre'");

            $usuario = $consulta->fetchObject();

            if($consulta->rowCount()==0) //el nombre no existe
            {
                ?>
                    <script>
                        alert('No existe niguna actividad con ese nombre');
                    </script>
                <?php
            }
            else //if controlar aqui que no haya ningun tramo con la actividad que se va a borrar
            {
                $consulta = $conexion -> query("SELECT * FROM tramos t 
                                                JOIN actividades a ON a.id=t.actividad_id 
                                                WHERE a.nombre='$nombre'");

                if($consulta->rowCount()!=0) //si hay tramos con esta actividad
                {
                    ?>
                    <script>
                        alert('No se puede borrar esta actividad porque figura en el horario\nBorre primero los tramos');
                    </script>
                <?php
                }
                else
                {
                    $conexion->exec("DELETE FROM actividades WHERE nombre='$nombre'");
                    ?>
                        <script>
                            alert('Actividad eliminada de la base de datos');
                        </script>
                    <?php
                }

                echo "<script>setTimeout(\"location.href = '../views/listaActividadesView.php';\",0);</script>";
            }
        }

        public static function getActividades()
        {
            //conectarse a la base de datos
            $conexion = gimnasioBD::conectarBD();

            $consulta = $conexion -> query("SELECT * FROM actividades");

            return $consulta;
        }

        //para calcular la id en el contructor
        public static function calcularId()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta= $conexion->query("SELECT id from actividades");
            
            $max = 0;

            while($i=$consulta->fetchObject()->id)
            {
                //calcular el maximo
                if($i>$max)
                {
                    $max=$i;
                }
            }
            return ($max + 1);
        }

        public static function getNombreById($id_actividad)
        {
            if($id_actividad==0)
            {
                return '';
            }
            else
            {
                $conexion = gimnasioBD::conectarBD();
                $consulta = $conexion->query("SELECT nombre FROM actividades WHERE id='$id_actividad'");
                $nombre = $consulta-> fetchObject()->nombre;
    
                return $nombre;
            }
        }

        public static function getIdByNombre($nombre)
        {
            $conexion = gimnasioBD::conectarBD();
            $consulta = $conexion->query("SELECT id FROM actividades WHERE nombre='$nombre'");
            $id = $consulta-> fetchObject()->id;

            return $id;
        }

        public static function getAforoById($id_actividad)
        {
            $conexion = gimnasioBD::conectarBD();
            $consulta = $conexion->query("SELECT aforo FROM actividades WHERE id='$id_actividad'");
            $aforo = $consulta-> fetchObject()->aforo;

            return $aforo;
        }

        public static function getAllNombres()
        {
            $conexion = gimnasioBD::conectarBD();
            $consulta = $conexion->query("SELECT nombre FROM actividades");

            for($i=0;$i<$consulta->rowCount();$i++)
            {
                $listaNombres[$i] = $consulta->fetchObject()->nombre;
            }

            return $listaNombres;
        }
        
    }
?> 

