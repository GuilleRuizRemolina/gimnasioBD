<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 03/12/2020
Última modificación: 03/12/2020
Versión: 1.00

#tramo.php
Fichero creado en base a la tabla de tramos, define la clase, el constructor, funciones getter e inserts
además de todas las funciones definidas de Tramos
**********************************-->
<?php
    
    require_once 'gimnasioBD.php';

    class Tramo
    {
        private $id;
        private $dia;
        private $hora_inicio;
        private $actividad_id;
        private $fecha_alta;
    
    
        function __construct($dia, $hora_inicio, $actividad_id) {
            $this->id = Tramo::calcularId();
            $this->dia = $dia;
            $this->hora_inicio = $hora_inicio;
            $this->actividad_id = $actividad_id;
            $this->fecha_alta = Tramo::obtenerFecha();
        }

        public function getId()
        {
            return $this->id;
        }
        public function getdia()
        {
            return $this->dia;
        }
        public function gethora_inicio()
        {
            return $this->hora_inicio;
        }

        //para calcular la id en el contructor
        public static function calcularId()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta= $conexion->query("SELECT id from tramos");
            
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

        public static function obtenerFecha()
        {
            $hoy = getdate();
            return $hoy['mday'] .'/'. $hoy['mon'] .'/'. $hoy['year'];
        }

        //funcion para insertar nuevos tramos
        public function insertarTramo()
        {
            $conexion = gimnasioBD::conectarBD();

            $idG = $this->id;
            $diaG = $this->dia;
            $hora_inicioG = $this->hora_inicio;
            $actividad_idG = $this->actividad_id;
            $fecha_altaG = $this->fecha_alta;

            //controlar que al isnertar un tramo no este ya ocupado el dia y la hora
            $consulta = $conexion->query("SELECT * FROM tramos 
                                          WHERE dia='$diaG' and hora_inicio='$hora_inicioG'");
            
            if($consulta -> rowCount()!=0) //existe ya un tramo con esa hora y ese dia
            {
                ?>
                <script>
                        alert('Ya existe un tramo con esa hora y dia\nIntroduzca otra hora o dia o elimine dicho tramo');
                    </script>
                <?php
            }
            else
            {
                //inserta el tramo
                $conexion->exec("INSERT INTO tramos
                (id,dia,hora_inicio,actividad_id,fecha_alta) 
                VALUES ('$idG','$diaG','$hora_inicioG','$actividad_idG','$fecha_altaG')");
            }
        }

        public static function getIdByHoraDia($hora,$dia)
        {
            $conexion = gimnasioBD::conectarBD();
            $consulta = $conexion->query("SELECT id FROM tramos WHERE hora_inicio='$hora' and dia='$dia'");
            
            if($consulta->rowCount()!=0)
            {
                $id_tramo = $consulta-> fetchObject()->id;
                return $id_tramo;
            }
            else
            {
                return 0;
            }
        }

        public static function getNombreActividadByHoraDia($hora,$dia)
        {
            $conexion = gimnasioBD::conectarBD();
            $consulta = $conexion->query("SELECT nombre FROM actividades a JOIN tramos t ON a.id=t.actividad_id 
                                            WHERE hora_inicio='$hora' and dia='$dia'");
            
            if($consulta->rowCount()!=0)
            {
                $nombreActividad = $consulta-> fetchObject()->nombre;
                return $nombreActividad;
            }
            else
            {
                return '';
            }
        }

        public static function getDiabyId($id_tramo)
        {
            $conexion = gimnasioBD::conectarBD();
            $consulta = $conexion->query("SELECT dia FROM tramos WHERE id='$id_tramo'");
            $dia = $consulta-> fetchObject()->dia;

            return $dia;
        }

        public static function getHoraById($id_tramo)
        {
            $conexion = gimnasioBD::conectarBD();
            $consulta = $conexion->query("SELECT hora_inicio FROM tramos WHERE id='$id_tramo'");
            $hora = $consulta-> fetchObject()->hora_inicio;

            return $hora;
        }

        public static function getActividadIdById($id_tramo)
        {
            $conexion = gimnasioBD::conectarBD();
            $consulta = $conexion->query("SELECT actividad_id FROM tramos WHERE id='$id_tramo'");
            $idActividad = $consulta-> fetchObject()->actividad_id;

            return $idActividad;
        }

    
        //funcion para borrar un tramo con una hora y dia
        public static function borrarTramo($hora,$dia)
        {
            $conexion = gimnasioBD::conectarBD();

            //controlar que al eliminar un tramo existe uno con esa hora y dia
            $consulta = $conexion->query("SELECT * FROM tramos 
                                          WHERE dia='$dia' and hora_inicio='$hora'");
            
            if($consulta -> rowCount()==0) //si no existe un tramo con esa hora y ese dia
            {
                ?>
                <script>
                        alert('No figura en el horario ningún tramo a esa hora y dia');
                    </script>
                <?php
            }
            else
            {
                //eliminar tramo
                $conexion->exec("DELETE FROM tramos WHERE dia='$dia' and hora_inicio='$hora'");

                ?>
                <script>
                    alert('El tramo y sus posibles reservas han sido eliminadas de la base de datos'); 
                </script>
                <?php

                //aqui se enviarian los correos automaticos a los usuarios con reservas para avisar que el tramo ha sido eliminado
                echo "<script>setTimeout(\"location.href = '../views/listaTramosView.php';\",0);</script>";
            }
        }

        public static function exiteTramo($tramo_id)
        {
            $conexion = gimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT * FROM tramos WHERE id='$tramo_id'");
                
            if($consulta -> rowCount()==0) //si no existe un tramo con esa hora y ese dia
            {
                return true;
            }
        }
    } 
?> 