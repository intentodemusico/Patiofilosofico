<?php
//include './conBD.php';
include '../modelo/Chats.php';
include '../modelo/Usuario.php';
include '../modelo/Mensajeria.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$p = $_POST;
$g = $_GET;
$s = $_SESSION;
$user = new Usuario();
//$conn = NULL;
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);
//if (isset($s['conexionBD']))
//    $conn = $s['conexionBD'];
//else
//    $conn = conBD::conectar();
//echo $p['oper'];
//print_r($p);
if (isset($p['oper'])) {

    //    switch ($p["oper"]) {
    if ($p["oper"] == "envio mensaje") {
        //        case 'envio mensaje': {
        $idR = $p["idRecibe"];
        $mensaje = $p["mensaje"];
        if (Chats::envioMensaje($user->getId(), $idR, $mensaje)) {
            $fecha = new DateTime(conBD::getFechaActual());
            $fecha = $fecha->format("d M | H:i");
            ?>
            <!--            <script>
                                    agregarMensaje('chat_< ?php echo $idR; ?>', '< ?php echo $mensaje; ?>');
                                </script>-->
            <div class="mensaje-der">
                <!--<div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="../../vista/Imagenes/22.png"> </div>-->
                <div class="text-mensaje">
                    <p class="mensaje"><?php echo $mensaje; ?> </p>
                    <span class="f-h-mensaje"><?php echo $fecha; ?></span>
                </div>
            </div>
        <?php
        }
        // } break;

    }
    if ($p["oper"] == "envio mensaje sala chat") {
        // case 'envio mensaje sala chat': {
        $idR = $p["idSala"];
        $mensaje = $p["mensaje"];
        $salaChat = new Mensajeria();
        if ($salaChat->enviarMensajeSalaChat($idR, $user->getId(), $mensaje) > 0) {
            $fecha = new DateTime(conBD::getFechaActual());
            $fecha = $fecha->format("d M | H:i");
            ?>
            <!--            <script>
                                    agregarMensaje('chat_< ?php echo $idR; ?>', '< ?php echo $mensaje; ?>');
                                </script>-->
            <div class="mensaje-der">
                <!--<div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="../../vista/Imagenes/22.png"> </div>-->
                <div class="text-mensaje">
                    <p class="mensaje"><?php echo $mensaje; ?> </p>
                    <span class="f-h-mensaje"><?php echo $fecha; ?></span>
                </div>
            </div>
        <?php
        }
    }
    if ($p["oper"] == "nuevo grupo") {
        $nombre = $p["nombre"];
        $descripcion = $p["descripcion"];
        $grupo = new Mensajeria();
        $respSql = $grupo->crearNuevaSala($nombre, $descripcion, $user->getId());
        if ($respSql != false && $respSql > 0) {
            $fecha = new DateTime(conBD::getFechaActual());
            $fecha = $fecha->format("d M | H:i");
            ?>
            <script>
                var noty = new NotificationFx({
                    message: '<p>Se creo correctamente el nuevo grupo</p><h5><?php echo $titulo; ?> </h5>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'notice' // notice, warning or error
                });
                noty.show();
            </script>
            <?php
            ?>
            <div class="mensaje-izq">
                <div class="text-mensaje">
                    <h6>El Grupo fue creado</h6>
                    <p class="mensaje"><?php echo $nombre; ?> </p>

                    <span class="f-h-mensaje"><?php echo $descripcion; ?></span>
                    <!--                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mod_InvitarAGrupo">
                                                    invitar al grupo
                                                </button>-->
                    <button type="button" onclick=" $('#idgrupoInivitar').val('<?php echo $respSql; ?>');" class="btn btn-primary" data-toggle="modal" data-target="#ModalInivtarGrupo">Invitar
                    </button>
                </div>
            </div>
        <?php
        } else {
            ?>
            <script>
                var noty = new NotificationFx({
                    message: '<p>No fue posible completar el registro del nuevo grupo</p><h5><?php echo $titulo; ?> </h5>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'warning' // notice, warning or error
                });
                noty.show();
            </script>
        <?php
        }
    }
    if ($p["oper"] == "buscar para invitar") {
        $idGrupo = $p["idgrupo"];
        $resultados = array();
        //    $tipousuario = "";
        //    if (isset($p["tipo_usuario"]))
        //        $tipousuario = $p["tipo_usuario"];
        $resultado = $user->buscarUsuarioInvitarGrupo($p["criterio"], $idGrupo);
        $r = new Usuario();
        //        echo '<div id="invitarUsuariosGrupo"><input type="hidden" name="oper" value="Enviar invitacion grupo">';

        foreach ($resultado as $r) {
            //            print_r($r);
            ?>
            <div class="col-6 row" id="invitacion_<?php echo $r->getId(); ?>">
                <div class="col-3">
                    <div class="imgAvatarUsuario" style="background: url(<?php echo $r->avatar ?>)"></div>
                </div>
                <div class="col-7 ">
                    <!--<div class="img-perfil-invi" style="background-image: url(<?php echo $r->avatar ?>)"></div>-->
                    <span class=""><?php echo $r->getNombre(); ?></span>
                    <input type="hidden" name="invitado" value="<?php echo $r->getId(); ?>">
                    <input type="hidden" name="oper" value="invitar a grupo">
                    <input type="hidden" name="nombInvitado" value="<?php echo $r->getNombre(); ?>">
                    <input type="hidden" name="idgrupo" value="<?php echo $idGrupo; ?>">
                </div>
                <input id="btn_invt<?php echo $r->getId(); ?>" type="button" class="float-right btn btn-primary btn-sm" value="invitar" onclick="envioFormularioDataForm(zerialisForm('invitacion_<?php echo $r->getId(); ?>'), '../controlador/chats.php', 'invitacion_<?php echo $r->getId(); ?>', false);">
            </div>
        <?php
        }
    }
    if ($p["oper"] == "invitar a grupo") {
        $idGrupo = $p["idgrupo"];
        $idInvitado = $p["invitado"];
        $nombInvitado = $p["nombInvitado"];
        $resultados = array();
        $resultado = $user->invitarSalaChat($idInvitado, $idGrupo);
        if ($resultado) {
            ?>
            <script>
                var noty = new NotificationFx({
                    message: '<p>Se envio correctamente la invitacion a <?php echo $nombInvitado; ?> para que participe en este grupo</p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'notice' // notice, warning or error
                });
                noty.show();
                $btn = $('#btn_invt<?php echo $idInvitado; ?>');
                $($btn).attr("class", "float-right btn btn-defauld");
                $($btn).attr("disabled", "");
                //            $($btn).attr("value","cancelar");
            </script>
        <?php
            //                    return true;
        } else {
            ?>
            <script>
                var noty = new NotificationFx({
                    message: '<p>No fue posible enviar la invitacion a <?php echo $nombInvitado; ?> </p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'warning' // notice, warning or error
                });
                noty.show();
            </script>
        <?php
            //                    return false;
        }
    }
    if ($p["oper"] == "aceptar invitacion grupo") {
        $idGrupo = $p["idgrupo"];
        $idInvitado = $user->getId();
        $invitacion = new Mensajeria();
        $resultado = $invitacion->aceptarInvitacionGrupo($idGrupo, $idInvitado);

        if ($resultado) {
            $grupo = $invitacion->buscarSalasChatPorIdSalaChat($idGrupo, "ACTIVO");
            while ($fila = mysqli_fetch_assoc($grupo)) {
                ?>
                <div class="cont-group mb-3 p-3">
                    <a href="#1" onclick="envioFormularioDataForm('', 'comunidad_chat.php?idSalaChat=<?php echo $idGrupo; ?>', 'contenedorPrincipal', true);"><span class="text-uppercase"><?php echo $fila["titulo"]; ?></span></a><br>
                    <span class="text-lowercase"><?php echo $fila["descripcion"]; ?></span><br>
                    <span class="fecha"><?php echo $fila["fecha"]; ?></span><br>
                    <!--<input type="button" value="Unirse" class="btn btn-sm btn-defauld">-->
                </div>

                <a href="#1">Ya puedes comenzar a participar en este grupo </a> <br>
                <script>
                    $("#btn_acep<?php echo $idGrupo; ?>").remove();
                </script>

            <?php
            }
        } else {
            ?>
            <script>
                var noty = new NotificationFx({
                    message: '<p>No fue posible enviar la invitacion a <?php echo $nombInvitado; ?> </p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'warning' // notice, warning or error
                });
                noty.show();
            </script>
        <?php

        }
    }
    if ($p["oper"] == "unirseGrupo") {
        $idgrupo = $p["idgrupo"];
        $mens = new Mensajeria();
        $MISgrupos = $mens->unirseGrupo($user->getId(), $idgrupo);
        if ($MISgrupos) {
            ?>
            <script>
                var noty = new NotificationFx({
                    message: '<p>Te has unido al grupo, ya puedes practicipar, compartir y aprender en este grupo. </p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'notice' // notice, warning or error
                });
                noty.show();
            </script>
        <?php
        } else {
            ?>
            <script>
                var noty = new NotificationFx({
                    message: '<p>No fue posible unirse al grupo en este momento. intentelo mas tarde </p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'warning' // notice, warning or error
                });
                noty.show();
            </script>
        <?php
        }
        //            } break;
    }
    if ($p["oper"] == "cargarMisGrupos") {
        //        case 'cargarMisGrupos': {

        $mens = new Mensajeria();
        $MISgrupos = $mens->buscarSalasChatPorIdUsuario($user->getId(), 'ACTIVO');
        if ($MISgrupos->num_rows == 0) {
            ?><blockquote class="blockquote col-10 offset-1">
                <i class="text-muted">No estas participando aun en ningun grupo , unete y participa en los grupos disponibles</i>
            </blockquote> <?php
                        }
                        while ($fila = mysqli_fetch_array($MISgrupos, MYSQLI_ASSOC)) {
                            ?>
            <div class=" mb-3 p-3">
                <span class="text-uppercase"><?php echo $fila["titulo"]; ?></span><br>
                <span class="text-lowercase"><?php echo $fila["descripcion"]; ?></span><br>
                <span class="fecha"><?php echo $fila["fecha"]; ?></span><br>
                <!--<input type="button" value="Unirse" class="btn btn-sm btn-defauld">-->
            </div>

        <?php
        }
        //            } break;
    }
    if ($p["oper"] == "cargarNuevoMensaje") {
        //        case 'cargarNuevoMensaje': {
        $idRecibe = $p["idchat"];
        $mens = new Mensajeria();
        $MISgrupos = $mens->buscarNuevosMensajesChatPorIdUser($user->getId(), $idRecibe);

        while ($fila = mysqli_fetch_array($MISgrupos, MYSQLI_ASSOC)) {

            $newMensaj = new Mensajeria();
            //                                    $newMensaj->actualizarEstadoMensaje($fila["idmensaje"], "ENTREGADO");
            //                                    $newMensaj->cargarDatosMensaje($fila["idmensaje"], $fila["idenvia"], $fila["idrecibe"], $fila["mensaje"], $fila["fecha"], $fila["estado"]);

            if ($fila["idrecibe"] == $idRecibe) {
                ?>
                <div class="mensaje-der">
                    <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="../../vista/Imagenes/22.png"> </div>
                    <div class="text-mensaje">
                        <p class="mensaje"><?php echo $fila["mensaje"] ?> </p>
                        <span class="f-h-mensaje"><?php echo $fila["fecha"]; ?></span>
                    </div>
                </div>
            <?php
            } else {
                if ($fila["estado"] == "ENVIADO") {
                    $newMensaj->actualizarEstadoMensaje($fila["idmensaje"], "ENTREGADO");
                }
                ?>
                <div class="mensaje-izq">
                    <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="<?php echo $fila["avatar"] ?>"> </div>
                    <div class="text-mensaje">
                        <p class="mensaje"><?php echo $fila["mensaje"] ?></p>
                        <span class="f-h-mensaje"><?php echo $fila["fecha"]; ?></span>
                    </div>
                </div>
            <?php
            }
        }
        //            }break;
    }
    if ($p["oper"] == "cargarNuevoMensajeSalaChat") {
        //        case 'cargarNuevoMensajeSalaChat': {
        $idRecibe = $p["idSala"];
        $mens = new Mensajeria();
        $MISgrupos = $mens->buscarNuevosMensajesChatPorIdSala($user->getId(), $idRecibe);

        while ($fila = mysqli_fetch_array($MISgrupos, MYSQLI_ASSOC)) {

            $newMensaj = new Mensajeria();
            if ($fila["estado"] == "ENVIADO") {
                $mens->actualizarEstadoMensajeSala($fila["idmensaje_sala"], 'ENTREGADO');
            }
            if (!($fila["iduser_envia"] == $user->getId())) {
                $userEnvio = new Usuario();
                $userEnvio->buscarUsuarioByiD($fila["iduser_envia"]);
                ?>
                <div class="mensaje-izq">
                    <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="<?php echo $userEnvio->getAvatar(); ?>"> </div>
                    <div class="text-mensaje">

                        <p class="mensaje">
                            <b class="mr-2"><?php echo $userEnvio->getNombre(); ?> dice : </b><?php echo $fila["mensaje"] ?></p>
                        <span class="f-h-mensaje"><?php echo $fila["fecha"]; ?></span>
                    </div>
                </div>

            <?php
            } else {
                ?>

            <?php
            }
        }
        //            }break;
    }

    if ($p['oper'] == 'cargar conversacion Usuario') {
        //            echo $p['oper'];

        //        case 'carga conversacion Usuario': {
        //       'ver conversacion Usuario'
        ?>
        <div class="conversacion">
            <?php
            $idRecibe = $p["idrecibe"];
            if ($user->getId() == $idRecibe) {
                ?>
                <script>
                    var noty = new NotificationFx({
                        message: '<p>No es posible enviarse mensajes a usted mismo...</p>',
                        layout: 'growl',
                        effect: 'slide',
                        type: 'notice' // notice, warning or error
                    });
                    noty.show();
                </script>
                <?php
                return;
            }
            $mensajes = new Mensajeria();
            $resp = $mensajes->buscarMensajesChatPorIdUser($user->getId(), $idRecibe);
            $userRecibe = new Usuario();
            $userRecibe = $userRecibe->UsuarioPorID($idRecibe);
            //                echo 'XXXXXXX';
            ?>
            <div class="titulo-chat row-flow" data-toggle="collapse" data-target="#chat_<?php echo $idRecibe; ?>">
                <span class="nomb-chat col-11"><?php echo $userRecibe->getNombre() ?></span><a href="#1" class="btn-closed col-1" onclick="$(this).parents('.conversacion').remove();clearInterval(inter<?php echo $idRecibe; ?>);">x</a>
            </div>
            <div class="collapse show" id="chat_<?php echo $idRecibe; ?>">
                <div class="cuerpo-chat scroll-item scroll-blue" id="chat_cuerpo_<?php echo $idRecibe; ?>">
                    <div class="cont-cuerpo-chat" id="contCuerpoChat<?php echo $idRecibe; ?>">

                        <?php
                        //                            print_r($mensajes);
                        while ($fila = mysqli_fetch_array($resp, MYSQLI_ASSOC)) {
                            $newMensaj = new Mensajeria();
                            $newMensaj->cargarDatosMensaje($fila["idmensaje"], $fila["idenvia"], $fila["idrecibe"], $fila["mensaje"], $fila["fecha"], $fila["estado"]);
                            if ($fila["idrecibe"] == $idRecibe) {
                                ?>
                                <div class="mensaje-der">
                                    <div class="text-mensaje">
                                        <p class="mensaje"><?php echo $fila["mensaje"] ?> </p>
                                        <span class="f-h-mensaje"><?php echo $fila["fecha"]; ?></span>
                                    </div>
                                </div>
                            <?php
                            } else {
                                if ($fila["estado"] == "ENVIADO") {
                                    $newMensaj->actualizarEstadoMensaje($fila["idmensaje"], "ENTREGADO");
                                }
                                ?>
                                <div class="mensaje-izq">
                                    <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="<?php echo $userRecibe->getAvatar(); ?>"> </div>
                                    <div class="text-mensaje">
                                        <p class="mensaje"><?php echo $fila["mensaje"] ?></p>
                                        <span class="f-h-mensaje"><?php echo $fila["fecha"]; ?></span>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        if (mysqli_num_rows($resp) == 0) {
                            ?>
                            <i class="pensamiento-inicial text-muted text-center p-4 pb-3" title="Diógenes de Sinope, uno de los más &#10;aclamados pensadores griegos,nos &#10;deja esta curiosa reflexión.">"Cuanto más conozco a la gente, más quiero a mi perro " <br></i><small>Diógenes el Cínico</small>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="mensaje-chat ">
                    <script>
                        inter<?php echo $idRecibe; ?> = setInterval(function() {
                            //                                    alert("buscando");
                            console.log('buscando chat para <?php echo $idRecibe; ?>');
                            var misdata = {
                                'oper': 'cargarNuevoMensaje',
                                'idchat': '<?php echo $idRecibe; ?>'
                            };
                            //                                    console.log(data);
                            $.ajax({
                                url: "../controlador/chats.php",
                                type: "POST",
                                dataType: 'html',
                                data: 'oper=cargarNuevoMensaje&idchat=<?php echo $idRecibe; ?>',
                            }).done(function(respuesta) {
                                //                                console.log(respuesta);
                                //            alert("exito");
                                $("#contCuerpoChat<?php echo $idRecibe; ?>").append(respuesta);
                                console.log('***** respuesta fue : ' + respuesta);
                            });
                            //                                    alert('fin');
                        }, 3700);
                        //                                alert("la funcion sirve");
                    </script>





                    <form action="../controlador/chats.php" method="post" onsubmit="envioFormulario(this, 'contCuerpoChat<?php echo $idRecibe; ?>', false);
                                                                    $(this).find('textarea').val('');
                                                                    return false;">
                        <!--<form action="../controlador/chats.php" method="post" >-->
                        <input type="hidden" name="oper" value="envio mensaje">
                        <input type="hidden" name="idRecibe" value="<?php echo $idRecibe; ?>">
                        <textarea name="mensaje" class="form-control input-chat scroll-item scroll-blue"></textarea>
                        <a href="#1" class="btn btn-sm btn-defauld btn-chat" onclick="$(this).parent().submit();"><i class="fa fa-paper-plane"></i></a>
                    </form>
                    <?php if (empty($msg)) { ?>
                        <form method="post" action="../controlador/upload.php" enctype="multipart/form-data">
                            <input name="my_file" type="file">
                            <input type="submit" name="submit" value="Upload" />
                            <input type="hidden" name="idRecibe" value="<?php echo $idRecibe ?>" />
                            <input type="hidden" name="idEnvia" value="<?php echo $user->getId() ?>" />
                            <!--<script type="text/javascript" src="../jquery.min.js"></script>
                            <script type="text/javascript"> 
                                $(document).ready(function() {
                                    $('form').submit(function() {
                                        var formdata = $(this).serialize();
                                        // validate and process form here 
                                    });
                                });
                                //alert (dataString);return false;
                                $.ajax({
                                    type: "POST",
                                    url: "localhost/controlador/upload.php",
                                    data: formdata,
                                    success: function() {
                                        $('#contact_form').html("<div id='message'></div>");
                                        $('#message').html("<h2>¡Archivo enviado!</h2>")
                                            .append("<p>We will be in touch soon.</p>")
                                            .hide()
                                            .fadeIn(1500, function() {
                                                $('#message').append("<img id='checkmark' src='images/check.png' />");
                                            });
                                    }
                                });
                            </script>-->
                        </form>

                    <?php } else {
                        echo $msg;
                    } ?>
                </div>
            </div>

            <script type="text/javascript">
                //                        var timers = [[0, "vacio"]];
                document.getElementById('contCuerpoChat<?php echo $idRecibe; ?>').addEventListener("DOMSubtreeModified", function() {
                    altura = $(this).height();
                    $(this).parent().scrollTop(altura);
                }, false);

                altura = $("#contCuerpoChat<?php echo $idRecibe; ?>").height();
                $("#contCuerpoChat<?php echo $idRecibe; ?>").parent().scrollTop(altura);
            </script>

        </div>
    <?php
        //            }break;
    }
    if ($p['oper'] == 'ver conversacion Usuario') {
        //        case 'ver conversacion Usuario': {
        ?>
        <div class="conversacion">
            <?php
            $idRecibe = $p["idrecibe"];

            $mensajes = new Mensajeria();
            $resp = $mensajes->buscarMensajesChatPorIdUser($user->getId(), $idRecibe);
            $userRecibe = new Usuario();
            $userRecibe = $userRecibe->UsuarioPorID($idRecibe);
            ?>
            <!--                    <div class="titulo-chat row-flow" data-toggle="collapse" data-target="#chat_< ?php echo $idRecibe; ?>">
                        <span class="nomb-chat col-11">< ?php echo $userRecibe->getNombre() ?></span><a href="#1" class="btn-closed col-1"  onclick="$(this).parents('.conversacion').remove();clearInterval(inter< ?php echo $idRecibe; ?>);">x</a>
                    </div>-->
            <div class="collapse show" id="chat_<?php echo $idRecibe; ?>">
                <div class="cuerpo-chat-completo scroll-item scroll-blue" id="chat_cuerpo_<?php echo $idRecibe; ?>">
                    <div class="cont-cuerpo-chat" id="contCuerpoChat<?php echo $idRecibe; ?>">

                        <?php
                        //                            print_r($mensajes);
                        while ($fila = mysqli_fetch_array($resp, MYSQLI_ASSOC)) {
                            $newMensaj = new Mensajeria();
                            $newMensaj->cargarDatosMensaje($fila["idmensaje"], $fila["idenvia"], $fila["idrecibe"], $fila["mensaje"], $fila["fecha"], $fila["estado"]);
                            if ($fila["idrecibe"] == $idRecibe) {
                                ?>
                                <div class="mensaje-der">
                                    <div class="text-mensaje">
                                        <p class="mensaje"><?php echo $fila["mensaje"] ?> </p>
                                        <span class="f-h-mensaje"><?php echo $fila["fecha"]; ?></span>
                                    </div>
                                </div>
                            <?php
                            } else {
                                if ($fila["estado"] == "ENVIADO") {
                                    $newMensaj->actualizarEstadoMensaje($fila["idmensaje"], "ENTREGADO");
                                }
                                ?>
                                <div class="mensaje-izq">
                                    <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="<?php echo $userRecibe->getAvatar(); ?>"> </div>
                                    <div class="text-mensaje">
                                        <p class="mensaje"><?php echo $fila["mensaje"] ?></p>
                                        <span class="f-h-mensaje"><?php echo $fila["fecha"]; ?></span>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        if (mysqli_num_rows($resp) == 0) {
                            ?>
                            <i class="pensamiento-inicial text-muted text-center p-4 pb-3" title="Diógenes de Sinope, uno de los más &#10;aclamados pensadores griegos,nos &#10;deja esta curiosa reflexión.">"Cuanto más conozco a la gente, más quiero a mi perro " <br></i><small>Diógenes el Cínico</small>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="mensaje-chat ">
                    <script>
                        inter<?php echo $idRecibe; ?> = setInterval(function() {
                            //                                    alert("buscando");
                            console.log('buscando chat para <?php echo $idRecibe; ?>');
                            var misdata = {
                                'oper': 'cargarNuevoMensaje',
                                'idchat': '<?php echo $idRecibe; ?>'
                            };
                            //                                    console.log(data);
                            $.ajax({
                                url: "../controlador/chats.php",
                                type: "POST",
                                dataType: 'html',
                                data: 'oper=cargarNuevoMensaje&idchat=<?php echo $idRecibe; ?>',
                            }).done(function(respuesta) {
                                //                                console.log(respuesta);
                                //            alert("exito");
                                $("#contCuerpoChat<?php echo $idRecibe; ?>").append(respuesta);
                                console.log('***** respuesta fue : ' + respuesta);
                            });
                            //                                    alert('fin');
                        }, 3700);
                        //                                alert("la funcion sirve");
                    </script>
                    <form action="../controlador/chats.php" method="post" onsubmit="envioFormulario(this, 'contCuerpoChat<?php echo $idRecibe; ?>', false);
                                                                    $(this).find('textarea').val('');
                                                                    return false;">
                        <!--<form action="../controlador/chats.php" method="post" >-->
                        <input type="hidden" name="oper" value="envio mensaje">
                        <input type="hidden" name="idRecibe" value="<?php echo $idRecibe; ?>">
                        <textarea name="mensaje" class="form-control input-chat scroll-item scroll-blue"></textarea>
                        <a href="#1" class="btn btn-sm btn-defauld btn-chat" onclick="$(this).parent().submit();"><i class="fa fa-paper-plane"></i></a>
                        </form>
                </div>
            
            </div>

            <script type="text/javascript">
                //                        var timers = [[0, "vacio"]];
                document.getElementById('contCuerpoChat<?php echo $idRecibe; ?>').addEventListener("DOMSubtreeModified", function() {
                    altura = $(this).height();
                    $(this).parent().scrollTop(altura);
                }, false);

                altura = $("#contCuerpoChat<?php echo $idRecibe; ?>").height();
                $("#contCuerpoChat<?php echo $idRecibe; ?>").parent().scrollTop(altura);
            </script>

        </div>
    <?php
        //            }break;
    }
    if ($p["oper"] == "comprovar nuevas conversaciones") {
        //        case 'comprovar nuevas conversaciones': {
        //verifica si te han enviado mensajes en los chats y no los has leido;
        $chat = new Chats();
        $nuevoChat = $chat->buscarMensajesSinLeer($user->getId());
        //                echo $nuevoChat;

        if ($nuevoChat > 0) {
            ?>
            <script>
                $("#numbNuevoMensaje").text("<?php echo $nuevoChat; ?>");
                $("#numbNuevoMensaje").css("display", "inherit");
            </script>
        <?php
        } else {
            ?>
            <script>
                //                alert("< ?php echo $nuevoChat; ?>");
                $("#numbNuevoMensaje").css("display", "none");
                $("#numbNuevoMensaje").text(" ");
            </script>
        <?php
        }
        ?>

    <?php
        //            }break;
    }

    if ($p['oper'] == 'salirseGrupo') {
        $idgrupo = $p["idgrupo"];
        $mens = new Mensajeria();
        $MISgrupos = $mens->salirseGrupo($user->getId(), $idgrupo);
        if ($MISgrupos) {
            ?>
            <script>
                var noty = new NotificationFx({
                    message: '<p>Has salido del grupo. </p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'notice' // notice, warning or error
                });
                noty.show();
            </script>
        <?php

        }
    }
} else {
    echo "No se encontro la varible 'oper'";
}
?>