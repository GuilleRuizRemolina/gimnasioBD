<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 30/11/2020
Última modificación: 30/11/2020
Versión: 1.00

#usuarios.php
Fichero creado en base a la tabla de usuarios, define la clase, el constructor, funciones getter e inserts
además de todas las funciones definidas de Usuarios
**********************************-->
<?php
    
    require_once 'gimnasioBD.php';

    class Usuario
    {
        private $id;
        private $nif;
        private $nombre;
        private $apellido1;
        private $apellido2;
        private $imagen;
        private $usuarioLogin;
        private $contrasena;
        private $email;
        private $telefono;
        private $direccion;
        private $rol;
        private $logado;

        //constructor
        function __construct($nif, $nombre, $apellido1, $apellido2, $imagen , $usuarioLogin, $contrasena, $email, $telefono, $direccion, $rol, $logado)
        {
            $this->id = Usuario::calcularId();
            $this->nif = $nif;
            $this->nombre = $nombre;
            $this->apellido1 = $apellido1;
            $this->apellido2 = $apellido2;
            $this->imagen = $imagen;
            $this->usuarioLogin = $usuarioLogin;
            $this->contrasena = $contrasena;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->rol = $rol;
            $this->logado = $logado;
        }

        //funciones get
        public function getId()
        {
            return $this->id;
        }
        public function getNif()
        {
            return $this->nif;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function getApellido1()
        {
            return $this->apellido1;
        }
        public function getApellido2()
        {
            return $this->apellido2;
        }
        public function getImagen()
        {
            return $this->imagen;
        }
        public function getUsuarioLogin()
        {
            return $this->usuarioLogin;
        }
        public function getConstrasena()
        {
            return $this->contrasena;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public function getTelefono()
        {
            return $this->telefono;
        }
        public function getDireccion()
        {
            return $this->direccion;
        }
        public function getRol()
        {
            return $this->rol;
        }

        //funcion para insertar nuevos usuarios
        public function insertarUsuario()
        {
            $conexion = gimnasioBD::conectarBD();

            $idG = $this->id;
            $dniG = $this->nif;
            $nombreG = $this->nombre;
            $apellido1G = $this->apellido1;
            $apellido2G = $this->apellido2;
            $imagenG = $this->imagen;
            $usuarioLoginG = $this->usuarioLogin;
            $contrasenaG = $this->contrasena;
            $emailG = $this->email;
            $telefonoG = $this->telefono;
            $direccionG = $this->direccion;
            $rolG = $this->rol;
            $logadoG = $this->logado;

            $conexion->exec("INSERT INTO usuarios 
            (id,nif,nombre,apellido1,apellido2,imagen,usuarioLogin,contrasena,email,telefono,direccion,rol,logado) 
            VALUES ('$idG','$dniG','$nombreG','$apellido1G','$apellido2G','$imagenG','$usuarioLoginG',
            '$contrasenaG','$emailG','$telefonoG','$direccionG','$rolG','$logadoG')");
            
        }

        //para calcular la id en el contructor
        public static function calcularId()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta= $conexion->query("SELECT id from usuarios");
            
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

        public static function setLogado($usuarioLogin,$valor)
        {
            $conexion = GimnasioBD::conectarBD();

            $conexion->exec("UPDATE usuarios SET logado='$valor' WHERE usuarioLogin='$usuarioLogin'");

        }

        public static function getId_UsuarioLogado()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT id FROM usuarios WHERE logado=1");

            return $consulta->fetchObject()->id;            
        }

        public static function getUsuarioLogin_UsuarioLogado()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT usuarioLogin FROM usuarios WHERE logado=1");

            return $consulta->fetchObject()->usuarioLogin;  
        }

        public static function getNombre_UsuarioLogado()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT nombre FROM usuarios WHERE logado=1");

            return $consulta->fetchObject()->nombre;  
        }

        public static function getApellido1_UsuarioLogado()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT apellido1 FROM usuarios WHERE logado=1");

            return $consulta->fetchObject()->apellido1;  
        }

        public static function getApellido2_UsuarioLogado()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT apellido2 FROM usuarios WHERE logado=1");

            return $consulta->fetchObject()->apellido2;  
        }

        public static function getTelefono_UsuarioLogado()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT telefono FROM usuarios WHERE logado=1");

            return $consulta->fetchObject()->telefono;  
        }

        public static function getDireccion_UsuarioLogado()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT direccion FROM usuarios WHERE logado=1");

            return $consulta->fetchObject()->direccion;  
        }

        public static function getRol_UsuarioLogado()
        {
            $conexion = GimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT rol FROM usuarios WHERE logado=1");

            return $consulta->fetchObject()->rol;  
        }

        public static function getDatosById($id_usuario)
        {
            $contenido = '';
            
            $conexion = GimnasioBD::conectarBD();

            $consulta = $conexion->query("SELECT * FROM usuarios WHERE id='$id_usuario'");

            $objeto = $consulta->fetchObject();

            $contenido = $objeto->nombre . ' ' . $objeto->apellido1 . ' ' . $objeto->apellido2 . "\n";
            
            return $contenido;
        }

        public static function deslogar_todos()
        {
            $conexion = GimnasioBD::conectarBD();

            $conexion->exec("UPDATE usuarios SET logado=0");
        }

        public static function validarUsuario($dni)
        {
            $conexion = gimnasioBD::conectarBD();

            $consulta = $conexion -> query("SELECT * FROM usuarios WHERE nif='$dni'");

            $usuario = $consulta->fetchObject();

            if($consulta->rowCount()==0) //el dni no existe
            {
                ?>
                    <script>
                        alert('El dni que ha introducido no existe en la base de datos');
                    </script>
                <?php
            }
            else if($usuario->rol=='A') //en caso de que sea ya admin
            {
                ?>
                <script>
                    alert('Este usuario es un administrador');
                </script>
            <?php
            }
            else if($usuario->rol=='S') //en caso de ser socio ya
            {
                ?>
                <script>
                    alert('Este usuario ya esta validado');
                </script>
            <?php
            }
            else if($usuario->rol=='U')
            {
                $conexion->exec("UPDATE usuarios SET rol='S' WHERE nif='$dni'");
                ?>
                    <script>
                        alert('El usuario ha sido validado');
                    </script>
                <?php
            }
            echo "<script>setTimeout(\"location.href = '../views/listaUsuariosView.php';\",0);</script>";
        }

        //funcion que buscando por el dni cambia el rol de un admin a el de un socio
        public static function convertirAdmin_socio($dni)
        {
            $conexion = gimnasioBD::conectarBD();

            $consulta = $conexion -> query("SELECT * FROM usuarios WHERE nif='$dni'");

            $usuario = $consulta->fetchObject();

            if($consulta->rowCount()==0) //el dni no existe
            {
                ?>
                    <script>
                        alert('El dni que ha introducido no existe en la base de datos');
                    </script>
                <?php
            }
            else if($usuario->rol=='S' || $usuario->rol=='U') //en caso de ser admin ya
            {
                ?>
                <script>
                    alert('Este usuario no es administrador. Seleccione un administrador');
                </script>
            <?php
            }
            else if($usuario->rol=='A')
            {
                $conexion->exec("UPDATE usuarios SET rol='S' WHERE nif='$dni'");
                ?>
                    <script>
                        alert('Este usuario ya no es un administrador');
                    </script>
                <?php
            }
            echo "<script>setTimeout(\"location.href = '../views/listaUsuariosView.php';\",0);</script>";
        }

        //funcion que buscando por el dni cambia un socio a admin
        public static function convertirSocio_admin($dni)
        {
            $conexion = gimnasioBD::conectarBD();

            $consulta = $conexion -> query("SELECT * FROM usuarios WHERE nif='$dni'");

            $usuario = $consulta->fetchObject();

            if($consulta->rowCount()==0) //el dni no existe
            {
                ?>
                    <script>
                        alert('El dni que ha introducido no existe en la base de datos');
                    </script>
                <?php
            }
            else if($usuario->rol=='A') //en caso de ser admin ya
            {
                ?>
                <script>
                    alert('Este usuario ya es administrador');
                </script>
            <?php
            }
            else if($usuario->rol=='U') //en caso de ser admin ya
            {
                ?>
                <script>
                    alert('Un usuario que no esta validado no puede ser administrador');
                </script>
            <?php
            }
            else if($usuario->rol=='S')
            {
                $conexion->exec("UPDATE usuarios SET rol='A' WHERE nif='$dni'");
                ?>
                    <script>
                        alert('Este usuario es ahora administrador');
                    </script>
                <?php
            }
            echo "<script>setTimeout(\"location.href = '../views/listaUsuariosView.php';\",0);</script>";
        }

        public static function borrarUsuario($dni)
        {
            $conexion = gimnasioBD::conectarBD();

            $consulta = $conexion -> query("SELECT * FROM usuarios WHERE nif='$dni'");

            $usuario = $consulta->fetchObject();

            if($consulta->rowCount()==0) //el dni no existe
            {
                ?>
                    <script>
                        alert('El dni que ha introducido no existe en la base de datos');
                    </script>
                <?php
            }
            else if($usuario->rol=='A') //el usuario es un administrador
            {
                ?>
                <script>
                    alert('No se puede borrar un usuario que es administrador');
                </script>
            <?php
            }
            else if($usuario->rol=='U' || $usuario->rol=='S') //controlar que no tenga reservas
            {
                $conexion->exec("DELETE FROM usuarios WHERE nif='$dni'");
                ?>
                    <script>
                        alert('El usuario y sus reservas han sido eliminadas de la base de datos');
                    </script>
                <?php
            }
            echo "<script>setTimeout(\"location.href = '../views/listaUsuariosView.php';\",0);</script>";
        }

        //funcion para borrar las reservas de un usuario
        public static function borrarReservas($dni)
        {
            $conexion = gimnasioBD::conectarBD();

            $conexion->exec("DELETE FROM reservas WHERE id IN 
                            (SELECT r.id FROM reservas r JOIN usuarios u ON u.id=r.usuario_id WHERE u.nif='$dni')");
            
        }

        public static function getImagenByUsuarioLogado($id_usuario)
        {
            $conexion = gimnasioBD::conectarBD();

            $consulta = $conexion -> query("SELECT imagen FROM usuarios WHERE id='$id_usuario'");

            return $consulta->fetchObject()->imagen;
        }

        public static function updateImagenUsuarioLogado($id_usuario,$imagen)
        {
            $conexion = gimnasioBD::conectarBD();

            $conexion->exec("UPDATE usuarios SET imagen='$imagen' WHERE id='$id_usuario'");
        }

        public static function updateDatosUsuarioLogado($id_usuario,$nombre,$apellido1,$apellido2,$telefono,$direccion)
        {
            $conexion = gimnasioBD::conectarBD();

            $conexion->exec("UPDATE usuarios SET nombre='$nombre', apellido1='$apellido1' ,
                             apellido2='$apellido2' , telefono='$telefono' , direccion='$direccion' 
                             WHERE id='$id_usuario'");
        }

        public static function borrarUsuarioByIdLogado($usuario_id)
        {
            $conexion = gimnasioBD::conectarBD();

            $consulta = $conexion -> query("SELECT * FROM usuarios WHERE id='$usuario_id'");

            $usuario = $consulta->fetchObject();

            $dni = $usuario->nif; //conseguir dsu dni para borrar las reservas usando la funcion borrarReservas

            if($usuario->rol=='S') //si el usuario es un socio tambien queremos que borre sus reservas
            {
                //borrar reservas
                Usuario::borrarReservas($dni);
                ?>
                    <script>
                        alert('Su cuenta junto a sus reservas ha sido eliminada de la base de datos');
                    </script>
                <?php
            }
            if($usuario->rol=='A')
            {
                ?>
                    <script>
                        alert('Su cuenta ha sido eliminada de la base de datos');
                    </script>
                <?php
            }
            
            //borrar usuario
            $conexion->exec("DELETE FROM usuarios WHERE id='$usuario_id'");

            echo "<script>setTimeout(\"location.href = '../index.php';\",0);</script>";
        }
    }

?>