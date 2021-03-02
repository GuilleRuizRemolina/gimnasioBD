<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 04/12/2020
Última modificación: 14/12/2020
Versión: 1.00

#reservas.php
Fichero creado en base a la tabla de reservas, define la clase, el constructor, funciones getter e inserts
además de todas las funciones definidas de Reservas
**********************************-->
<?php
    
    require_once 'gimnasioBD.php';
    require_once '../models/actividades.php';
    require_once '../models/tramos.php';
    require_once '../models/usuarios.php';

    class Reserva
    {
        private $id;
        private $tramo_id;
        private $usuario_id;
        private $fecha_reserva;
    
    
        function __construct($tramo_id, $usuario_id) {
            $this->id = Reserva::calcularId();
            $this->tramo_id = $tramo_id;
            $this->usuario_id = $usuario_id;
            $this->fecha_reserva = Reserva::obtenerFecha();
        }

        public function getId()
        {
            return $this->id;
        }
        public function getTramo_id()
        {
            return $this->tramo_id;
        }
        public function getUsuario_id()
        {
            return $this->usuario_id;
        }

        //para calcular la id en el contructor
        public static function calcularId()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta= $conexion->query("SELECT id FROM reservas");
            
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
        public function insertarReserva()
        {
            $conexion = gimnasioBD::conectarBD();

            $idG = $this->id;
            $tramo_idG = $this->tramo_id;
            $usuario_idG = $this->usuario_id;
            $fecha_reservaG = $this->fecha_reserva;

            //controlar que el usuario no pueda reservar una reserva que ya tiene reservada
            $consulta = $conexion->query("SELECT * FROM reservas
                                          WHERE tramo_id='$tramo_idG' and usuario_id='$usuario_idG'");
            
            if($consulta -> rowCount()!=0) //si existe significa que ya a hecho esa reserva
            {
                ?>
                <script>
                        alert('Ya tiene una reserva para esa hora y dia');
                    </script>
                <?php
            }
            else
            {
                $conexion->exec("INSERT INTO reservas
                (id,tramo_id,usuario_id,fecha_reserva) 
                VALUES ('$idG','$tramo_idG','$usuario_idG','$fecha_reservaG')");
            }
        }

        //escribe la lista de socios apuntados a un tramo dandole el dia y la hora
        public static function getSociosByHoraDia($hora,$dia)
        {
            //array asociativo para devolver con la misma funcion una cadena con los nombres de las 
            //personas y el numero de personas reservedas
            $datos = array('cadenaNombres','numero');

            $contenido = "";

            $n = 0;

            //obtengo la id del tramo con el dia y la hora
            $id_tramo = Tramo::getIdByHoraDia($hora,$dia);

            //obtener los usuarios_id con el id_tramo
            $conexion = gimnasioBD::conectarBD();

            $consulta= $conexion->query("SELECT usuario_id FROM reservas WHERE tramo_id='$id_tramo'");

            while($registro=$consulta->fetchObject())
            {
                $contenido = $contenido . Usuario::getDatosById($registro->usuario_id);
            }

            $n = $consulta->rowCount();

            $datos['cadenaNombres'] = $contenido;
            $datos['numero'] = $n;

            return $datos;
        }

        public static function getNreservasUsuarioUnDia($usuario_id,$dia)
        {
            $conexion = gimnasioBD::conectarBD();

            $consulta= $conexion->query("SELECT r.id FROM reservas r 
            JOIN tramos t ON t.id=r.tramo_id
            JOIN usuarios u ON u.id=r.usuario_id
            WHERE t.dia='$dia' and u.id='$usuario_id'");

            return $consulta->rowCount();
        }

        public static function borrarReservaUsuario($hora,$dia,$usuario_id)
        {
            $conexion = gimnasioBD::conectarBD();

            $conexion->exec("DELETE FROM reservas WHERE id IN 
                            (SELECT r.id FROM reservas r 
                            JOIN tramos t ON t.id=r.tramo_id
                            JOIN usuarios u ON u.id=r.usuario_id
                            WHERE t.hora_inicio='$hora' and t.dia='$dia' and u.id='$usuario_id')");
        }

        public static function borrarReserva($hora,$dia)
        {
            $conexion = gimnasioBD::conectarBD();

            $conexion->exec("DELETE FROM reservas WHERE id IN 
                            (SELECT r.id FROM reservas r 
                            JOIN tramos t ON t.id=r.tramo_id
                            WHERE t.hora_inicio='$hora' and t.dia='$dia')");
        }
    } 
?> 