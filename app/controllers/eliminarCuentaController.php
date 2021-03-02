<!--********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 15/12/2020
Última modificación: 15/12/2020
Versión: 1.00

#eliminarCuentaController.php
Fichero que se encarga de elimniar la cuenta del usuario que este logado en ese momento
**********************************-->
<?php
    require_once '..\models\usuarios.php';

    Usuario::borrarUsuarioByIdLogado(Usuario::getId_UsuarioLogado());
?>