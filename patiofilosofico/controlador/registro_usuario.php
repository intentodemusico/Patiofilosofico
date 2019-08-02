<?php
include './conBD.php';
include '../modelo/Usuario.php';
include '../funcs/funcs.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registro_usuario
 *
 * @author Juan-desarrollo
 */
if ($_POST["oper"] == "nuevo usuario") {

    $idNuevoRegistro = registro_usuario::registroNuevoUsuario( $_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['ciudad'], $_POST['pais'], $_POST['tipo_usuario'], 'ACTIVO', $_POST['usuario'], $_POST['contrasena'],0,0, 1);

    if ($idNuevoRegistro) {

    }
}
if ($_POST["oper"] == "Actualizar") {
    ?> <script>alert('Esto va a ser la bomba');</script> <?php
}

class registro_usuario {
    /*
     * registra en base de datos los datos iniciales de un nuevo usuario para concederle acceso ala plataforma
     */

    function registroNuevoUsuario( $nombre, $apellido, $correo, $ciudad, $pais, $tipouser, $estado, $user, $pass, $token_password, $password_request, $activacion) {
        $conn = conBD::conectar();
            $sentenciaSQL = "SELECT * FROM `usuario` WHERE   usuario = '" . $user . "' ";
            $existenRegistro = mysqli_query($conn, $sentenciaSQL);
            $existenRegistro1 = mysqli_num_rows($existenRegistro);
            if ($existenRegistro1 > 0) {
                ?><script>var noty = new NotificationFx({
                            message: '<h5>Operacion fallida</h5><p> El nombre de usuario que intenta ingresar ya se encuentra registrado</p>',
                            layout: 'growl',
                            effect: 'slide',
                            type: 'warning' // notice, warning or error
                        });
                        noty.show();
//                        alert('El nombre de usuario ya se encuentra registrado');
                </script> <?php
                return false;
            }  else {
                
                $sentenciasSQL = "SELECT * FROM `usuario` WHERE   correo = '" . $correo . "' ";
                $existenRegistros = mysqli_query($conn, $sentenciasSQL);
                $existenRegistro2 = mysqli_num_rows($existenRegistros);
                if ($existenRegistro2 > 0){
                     ?><script>var noty = new NotificationFx({
                            message: '<h5>Operacion fallida</h5><p>El correo que intenta ingresar ya se encuentra registrado</p>',
                            layout: 'growl',
                            effect: 'slide',
                            type: 'warning' // notice, warning or error
                        });
                        noty.show();
//                        alert('El nombre de usuario ya se encuentra registrado');
                </script> <?php
                return false;
                }else{

                    $insertsql = "INSERT INTO `usuario` (

                    `nombre`,
                    `correo`,
                    `ciudad`,
                    `pais`,
                    `tipo_usuario`,
                    `usuario`,
                    `contrasenna`,
                    `avatar`,
                    `estado`,
                    `token_password`,
                    `password_request`,
                    `activacion`)
                    VALUES
                    (

                    '" . $nombre . " " . $apellido . "',
                    '" . $correo . "',
                    '" . $ciudad . "',
                    '" . $pais . "',
                    '" . $tipouser . "',
                    '" . $user . "',
                    '" . $pass . "',
                    '',
                    '" . $estado . "',
                    '" . $token_password . "',
                    '" . $password_request . "',
                    '" . $activacion . "');";
                    $resp = mysqli_query($conn, $insertsql);
//                    echo "respuesta al insert " . $insertsql;
//            mysqli_query($conn, $sentenciaSQL);
                $userBD = new Usuario();
                $userBD = $userBD->buscarUsuarioByLogin($user);
                session_start();
                $_SESSION["iduser"] = $userBD->getId();
//                           if (! $_SESSION['Usuario'] instanceof Usuario)
                $userBD->registroInicioSession();
                $_SESSION["usuario"] = serialize($userBD);
               ?>
                <script>var noty = new NotificationFx({
                            message: '<h5>Operacion exitosa</h5><br><p>Ha recibido un e-mail de confirmación de registro</p><br><p>El registro fue satisfactorio ya puede comenzar a usar su cuenta en la plataforma </p>',
                            layout: 'growl',
                            effect: 'slide',
                            type: 'notice' // notice, warning or error                           
                        });
                        noty.show();
                        location.href = "";
                </script> 
                
                    <?php
                  
                    $asunto = 'Informe de Registro al Portal';
                    $cuerpo = "Hola $nombre: <br /><br />Se ha Registrado exitosamente a nuestro portal 
                              El patio filosofico.  <br/><br/>Ahora puedes participar activamente y crear 
                              comunidades filosoficas<br/><br/>
                               Su nombre de usuario es: $user <br/> Su contraseña es: $pass ";
                    
                    $email = $correo;
                    
                   if(enviarEmail($email, $nombre, $asunto, $cuerpo) ){
                       echo "Hemos recibido su solicitud de registro a nuestro portal 
                            El Patio Filosófico. <br/><br/> Le hemos enviado al correo 
                            electrónico $correo la confirmación de registro.";
                       exit;
                   }else{
                       $errors[] = "No se ha podido registrar el usuario";
                   }
                   
                     
                    return true;
                }
            }
        }
    }

    //put your code here

