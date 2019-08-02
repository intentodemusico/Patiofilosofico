<?php
include './conBD.php';
include '../modelo/Usuario.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ($_POST["oper"] == "incio session") {
    iniciosession::iniciarSession($_POST['usuario'], $_POST['contrasena']);
}
if ($_POST["oper"] == "salir session") {
    ?> <script>alert('Esto va a ser la bomba');</script> <?php
}

class iniciosession {

    public function iniciarSession($userName, $pass) {
//        include ('../modelo/Usuario.php');
        ini_set("session.cookie_lifetime", "7200");
        ini_set("session.gc_maxlifetime", "7200");
        session_start();
        $connect = conBD::conectar();
//        $usuario = new Usuario();
//        $usuario = mysqli_query($connect, "SELECT * FROM usuario WHERE usuario = '" . $user . "'  ");
//        $contarUser = mysqli_num_rows($usuario);
        $user = new Usuario();
        $user = $user->buscarUsuarioByLogin($userName);
// $contarPass = mysqli_num_rows($contrasena);

        if ($user->getId() == 0) {
            ?> <script>
                var noty = new NotificationFx({
                    message: '<p>El nombre de usuario no se encuentra registrado, por favor verifique</p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'warning' // notice, warning or error
                });
                noty.show();
            </script> <?php
        } else 
//            if ($contarUser == 1) 
//                {
            //verificamos el estado del usuario
            if ($user->getEstado() == "BLOQUEADO") {
                ?> <script>
                    var noty = new NotificationFx({
                        message: '<h6>LO SENTIMOS</h6><p>El usuario <b><?php echo $user->getUser(); ?> </b> se encuentra inactivo, por favor comuníquese con el administrador y verifique el estado de su cuenta.</p>',
                        layout: 'growl',
                        effect: 'slide',
                        type: 'notice' // notice, warning or error
                    });
                    noty.show();
                </script> <?php
                return false;
            }
            //verificamos que la contrase�a sea la correcta
//            $row = mysqli_fetch_row($usuario);
//            $row = mysqli_fetch_array($usuario);
//            $connect = conBD::conectar();
//            $contrasena = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario = '" . $user->getId(). "' and ESTADO = 'ACTIVO'");
//            $row = mysqli_fetch_array($contrasena);
            if ($user->getPass() == $pass) {
//                $user = new Usuario();
//                $user = new Usuario();
//                $user->buscarUsuarioByiD($row["idusuario"]);
//                $user->nuevoUsuario($row["idusuario"], $row["nombre"], $row["codigo"], $row["correo"], $row["ciudad"], $row["direccion"], $row["identificacion"], $row["tipo_usuario"], $row["usuario"], $row["contrasenna"], $row["avatar"], $row["estado"]);

//                           $usuario = Usuario::Usuario($row["idusuario"], $row["nombre"], $row["codigo"], $row["correo"],
//                                   $row["ciudad"], $row["direccion"], $row["identificacion"], $row["tipo_usuario"], $row["usuario"], $row["contrasenna"]);
//                $_SESSION["conexionBD"] =  serialize($connect);
                $_SESSION["iduser"] = $user->getId();
//                           if (! $_SESSION['Usuario'] instanceof Usuario)
                $user->registroInicioSession();
                $_SESSION["usuario"] = serialize($user);
                $nuevoUser = $_SESSION['usuario'];
                $nuevoUser = unserialize($nuevoUser);
//                         header("Location: index.php");
                ?> <script>
                    var noty = new NotificationFx({
                        message: '<p>Bienvenido a El Patio Filosófico </p><h6><?php echo $nuevoUser->getNombre() ?></h6>',
                        layout: 'growl',
                        effect: 'slide',
                        type: 'notice' // notice, warning or error
                    });
                    noty.show();
                    location.href = "";
                </script> <?php
            } else {
                ?> <script>
                    var noty = new NotificationFx({
                        message: '<p>Contraseña incorrecta, verifique por favor</p>',
                        layout: 'growl',
                        effect: 'slide',
                        type: 'warning' // notice, warning or error
                    });
                    noty.show();
                </script> <?php
            }
//        } else {
            ?> <script> 
//                var noty = new NotificationFx({
//                    message: '<h5>Error de duplicidad</h5><p>Existe un problema de duplicidad, por favor informe al administrador.</p>',
//                    layout: 'growl',
//                    effect: 'slide',
//                    type: 'error' // notice, warning or error
//                });
//                noty.show();
            </script> <?php
//        }
    }

}
