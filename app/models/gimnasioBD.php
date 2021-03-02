<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 30/11/2020
Última modificación: 30/11/2020
Versión: 1.00

#gimnasioBD.php
Fichero encargado del establecimiento de la conexión con la base de datos creada en phpmyadmin
**********************************-->
<?php
    abstract class gimnasioBD
    {
        private static $server = 'localhost';
        private static $bd = 'gimnasio';
        private static $usuario = 'root';
        private static $contrasena = 'usuario';

        public static function conectarBD()
        {
            try {
                $conexion = new PDO("mysql:host=".self::$server.";dbname=".self::$bd.";charset=utf8",self::$usuario, self::$contrasena);
            } 
            catch (PDOException $error)
            {
                echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
                die ("Error: " . $error->getMessage());
            }
            return $conexion;
        }
    }

    //establecer conexion: $conexion = gimnasioBD::conectarBD()

?>