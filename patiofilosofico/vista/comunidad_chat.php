<!DOCTYPE html>
<?PHP
//include '../controlador/conBD.php';
include '../modelo/Mensajeria.php';
include '../modelo/Usuario.php';
include '../modelo/salaChat.php';

session_start();
$p = $_GET;
$s = $_SESSION;
$user = new Usuario();
if (isset($s['usuario'])) {
    $user = unserialize($s['usuario']);
//    echo "<h3> el usuario es " . $user->getNombre() . "</h3>";
}
//$conn = conBD::conectar();
$idsalachat = $p["idSalaChat"];
$_SESSION["idGrupo"] = $idsalachat;
?>
<link rel="stylesheet" href="css/grupo.css">
<style>
    .cont-Memsaje-comunal{
        font-size: 14px;
        padding-left: 45px;
        border: 1px solid red;
        max-height: 400px;
        height: 700px;
        overflow-y: auto;
        padding-bottom: 20px;
    }
    .participante-sala{
        display: block;
    }
    .nombreChat{
        display: block;
    }
    span.nombreChat {
        font-weight: 400;
        color: rgba(255, 255, 255, 0.87);
        font-size: 13px;

    }
    span.f-h-mensaje {
        font-size: 10px;
        color: #f1eded;
        text-align: right;
        display: block;
    }

    div#participantes {
        min-width: 350px;
        position: absolute;
        right: 0px;
        padding: 12px 25px;
        background-color: #476a90;
        color: #f1f1f1;
        border-radius: 7px;
        box-shadow: 2px 2px 10px #908f8fbf;
        z-index: 20;
    }
    div#participantes .close {
        color: white;
        text-shadow: none;
    }
    div#participantes.collapsing {
        transition: height.2s;
    }

    a.link-participantes {
        color: #fff;
        text-decoration: none;
        display: inline-block;
    }

    a.link-participantes:hover {
        color: #dfecfb;
        /* background: rgba(255, 255, 255, 0.77); */
    }
</style>
<?php
$salaChats = new Mensajeria();
$listParticipantes = array();
$datosSala = $salaChats->buscarSalasChatPorIdSalaChat($idsalachat, "ACTIVO");
$participantes = $salaChats->buscarParticipantesSala($idsalachat);
$datosSala = mysqli_fetch_array($datosSala, MYSQLI_ASSOC);
//                print_r($datosSala);
?>
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-8">
            <h3 class="titulo-grupo"><?php echo $datosSala["titulo"]; ?></h3>
            <p class="descripcion-grupo"> <?php echo $datosSala["descripcion"]; ?></p>
            <h6 class="admin-grupo">Administrador: <b><?php echo $datosSala["administrador"]; ?></b> 
                <?php
                if ($user->tipo_usuario == "ADMINISTRADOR" || $datosSala["idadministrador"] == $user->getId()) {
                    ?>
                    <button type="button" onclick=" $('#idgrupoInivitar').val('<?php echo $idsalachat; ?>');" class="float-right num-participantes btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalInivtarGrupo">Invitar
                    </button>
                <?php } ?>
                <a href="#1" class="float-right num-participantes"  data-toggle="collapse" data-target="#participantes"><?php echo $datosSala["participante"]; ?> Participantes</a></h6>

            <div class="participantes- chat collapse" id="participantes">
                <?php
                while ($up = mysqli_fetch_array($participantes, MYSQLI_ASSOC)) {
                    $listParticipantes[$up["idusuario"]]["nombre"] = $up["nombre"];
                    $listParticipantes[$up["idusuario"]]["avatar"] = $up["avatar"];
                    ?>


                    <div id="userGrupo<?php echo $up["idusuario"]; ?>">

                        <?php if (($user->getTipo_usuario() == "ADMINISTRADOR" || $datosSala["idadministrador"] == $user->getId()) && $up["idusuario"] != $user->getId() && $datosSala["idadministrador"] != $up["idusuario"] ) { ?>
                            <form  action="../controlador/grupo.php" method="post" onsubmit="envioFormulario(this, 'contresultadost', true);return false;">
                                <a href="#1"  class="link-participantes" data-toggle="modal" data-target="#exampleModal" href="#1" onclick="$.('#participantes').toggle();
                                    $('#modal_cuerpo_perfiles').html('');cargarPagina('perfil_Usuario.php?idUser=<?php echo $up["idusuario"]; ?>', 'modal_cuerpo_perfiles', true)" >
                                    <span class="participante-sala"><?php echo $up["nombre"]; ?></span>
                                </a>
                                <a href="#1" class="close" title="Eliminar usuario del grupo" onclick="eliminarPersonaGrupo(this)" value="" >&times;</a> 
                                <input type="hidden" name="iduserGrupo"  value="<?php echo $up["idusuario"]; ?>">
                                <input type="hidden" name="idGrupo"  value="<?php echo $idsalachat; ?>">
                                <input type="hidden" name="oper" value="eliminarUsuarioGrupo">
                            </form>
                        <?php } else {
                            ?>
                            <a href="#1"  class="link-participantes" data-toggle="modal" data-target="#exampleModal" href="#1" onclick="$('#modal_cuerpo_perfiles').html('');cargarPagina('perfil_Usuario.php?idUser=<?php echo $up["idusuario"]; ?>', 'modal_cuerpo_perfiles', true)" >
                                <span class="participante-sala"><?php echo $up["nombre"]; ?></span>
                            </a>
                        <?php }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <form class="form-nueva-publicacion" method="post" enctype="multipart/form-data" action="../controlador/grupo.php" onsubmit="envioFormulario(this, 'cuerpo-publicacion', false);return false;">
                <input type="hidden" name="oper" value="publicar en el grupo">
                <textarea name="publicacion" id="publicacion" required="" placeholder="Crea una nueva publicacion..." ></textarea>              
                <input type="submit" value="Publicar" class="btn btn-sm btn-primary">
            </form>
            <div id="cuerpo-publicacion">
                <?php
                $publicaciones = salaChat::buscarPublicacionesGrupo($idsalachat);
                while ($fila = mysqli_fetch_assoc($publicaciones)) {
                    ?>

                    <div class="publicacion" id="publi_<?php echo $fila["idpublicacion"]; ?>">
                        <?php if ($user->getTipo_usuario() == "ADMINISTRADOR" || $user->getId() == $fila["idusuario"]) { ?>
                            <form action="../controlador/grupo.php" method="post" onsubmit="envioFormulario(this, 'contresultadost', true);return false;">
                                <a href="#1" class="close" title="Eliminar publicacion" onclick="eliminarPublicacion(this)" value="" >&times;</a> 
                                <input type="hidden" name="idpub"  value="<?php echo $fila["idpublicacion"]; ?>">
                                <input type="hidden" name="oper" value="eliminarPublicacion">
                            </form>
                        <?php } ?>
                        <b class="text-info"><?php echo $fila["nombreUser"] ?> <i class="fa fa-arrow-alt-circle-right"></i></b>
                        <p>
                            <?php echo $fila["texto"]; ?>
                            <br><small><?php echo $fila["fecha"]; ?></small>
                        </p>
                        <?php
                        $comentarios = salaChat::buscarComentarioPublicacion($fila["idpublicacion"]);
                        $numcoment = mysqli_num_rows($comentarios);
                        if ($numcoment > 0) {
                            ?>
                            <a href="#1" class="text-muted" data-toggle="collapse" data-target="#coment_public<?php echo $fila["idpublicacion"]; ?>" ><?php echo $numcoment; ?> comentarios</a>
                        <?php } ?>
                        <a href="#1" class="btn btn-sm fa fa-comment-alt" data-toggle="collapse" data-target="#coment_public<?php echo $fila["idpublicacion"]; ?>" > Comentar</a>
                        <div id="coment_public<?php echo $fila["idpublicacion"]; ?>" class="collapse" style="background-color: #fff;">
                            <div class="nuevo-comment">
                                <form id="formComentario<?php echo $fila["idpublicacion"]; ?>" action="../controlador/grupo.php" method="post" onsubmit="envioFormulario(this, 'comment-<?php echo $fila["idpublicacion"]; ?>', false);return false;">
                                    <input type="hidden" name="oper" value="comentar publicacion">
                                    <input type="hidden" name="idpublic" value="<?php echo $fila["idpublicacion"]; ?>">
                                    <textarea class="nuevo-comment" name="comentario" required="" placeholder="Escribe tu comentario..."></textarea >
                                    <input  type="submit" onclick="$(this).parent().find('textarea').text('');" value="Comentar" class="btn btn-sm btn-dark">
                                </form>
                            </div>
                            <div class="comment-publicacion-cont" id="comment-<?php echo $fila["idpublicacion"]; ?>">
                                <?php
//                                $comentarios = salaChat::buscarComentarioPublicacion($fila["idpublicacion"]);
                                while ($commnet = mysqli_fetch_assoc($comentarios)) {
                                    $nombUser = Usuario::buscarNombre($commnet['idusuario']);
                                    ?>
                                    <div class="cuerpo-coment" id="<?php echo 'coment' . $commnet['idcomentario']; ?>">
                                        <?php if ($commnet['idusuario'] == $user->getId() || $user->getTipo_usuario() == "ADMINISTRADOR") { ?>
                                            <form action="../controlador/grupo.php" method="post" onsubmit="envioFormulario(this, 'contresultadost', true);return false;">
                                                <button type="button" class="close" aria-label="Close" title="Eliminar comentario" onclick="eliminarComentario(this);"> 
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <input type="hidden" name="idcomentario" value="<?php echo $commnet['idcomentario']; ?>">
                                                <input type="hidden" name="oper" value="eliminarComentario">
                                            </form>
                                        <?php } ?>
                                        <span class="nomb-coment"><?php echo $nombUser; ?></span>
                                        <p class="text-coment"><?php echo $commnet['comentario']; ?><br> 
                                            <small class="fecha-coment"><?php echo $commnet['fecha']; ?></small></p>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-4 " style="font-size: 15px;" >
            <h4>Mensajes</h4>
            <div class="cont-Memsaje-comunal" id="cont-chatComunidad">
                <div id="cuerpo-chatComunidad">
                    <?php
                    $mensajeChats = $salaChats->buscarMensajesChatPorIdSala($idsalachat);
//                    print_r($listParticipantes);
                    while ($mensaj = mysqli_fetch_array($mensajeChats, MYSQLI_ASSOC)) {
//                        echo $mensaj["idmensaje_sala"];
                        $salaChats->actualizarEstadoMensajeSala($mensaj["idmensaje_sala"], "ENTREGADO");
//            echo $mensaj["iduser_envia"]."||".$user->getId()."<br>";
                        if ($mensaj["iduser_envia"] == $user->getId()) {
                            ?>
                            <div class="mensaje-der">
                                <div class="text-mensaje">

                                    <p class="mensaje"><?php echo $mensaj["mensaje"] ?> </p>
                                    <span class="f-h-mensaje"><?php echo $mensaj["fecha"]; ?></span>
                                </div>
                            </div>
        <!--<script>
        altura = $("#cuerpo-chatComunidad").height();
        alert(altura);
        $("#cont-chatComunidad").scrollTop(altura);
        </script>-->
                            <?php
                        } else {
                            ?>
                            <div class="mensaje-izq">
                                <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="<?php echo $listParticipantes[$mensaj["iduser_envia"]]["avatar"]; ?>"> </div>
                                <div class="text-mensaje">

                                    <p class="mensaje"><b class="mr-2"><?php echo $listParticipantes[$mensaj["iduser_envia"]]["nombre"]; ?> dice : </b> <?php echo $mensaj["mensaje"] ?></p>
                                    <span class="f-h-mensaje"><?php echo $mensaj["fecha"]; ?></span>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    ?>
                </div>
                
            </div>
            <?php if (empty($msg)) { ?>
                        <form method="post" action="../controlador/uploadsala.php" enctype="multipart/form-data">
                            <input name="my_file" type="file">
                            <input type="submit" name="submit" value="Upload"/>
                            <input type="hidden" name="idSala" value="<?php echo $idsalachat ?>" />
                            <input type="hidden" name="idEnvia" value="<?php echo $user->getId() ?>" />
                    </form>
                    <?php 

                } else {
                        echo $msg;
                    } ?>
            <form  action="../controlador/chats.php" method="post" onsubmit="envioFormulario(this, 'cuerpo-chatComunidad', false);
                    $(this).find('textarea').val('');
                    return false;">
                <!--<form action="../controlador/chats.php" method="post" >-->
                <input type="hidden" name="oper" value="envio mensaje sala chat">
                <input type="hidden" name="idSala" value="<?php echo $idsalachat; ?>">
                <textarea name="mensaje"  class="form-control input-chat scroll-item scroll-blue"></textarea>
                <a href="#1" class="btn btn-sm btn-defauld btn-chat" onclick="$(this).parent().submit();"><i class="fa fa-paper-plane"></i></a>
            </form>
        </div>

    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <h5 class="modal-title" id="exampleModalLabel">Perfil Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_cuerpo_perfiles">
                ...
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="row pb-5" id="contresultados"></div>

<!--modal para invitar usuario a grupo-->
<div class="modal fade" id="ModalInivtarGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container cuerpo-modal">
                    <!--onsubmit="envioFormulario('formBuscar', 'contresultados', true); return false;"-->
                    <form onsubmit="envioFormularioMultiPart2('formBuscar', 'contresultadosModalInvitarGrupo', true); return false;" class="row" method="post" id="formBuscar" action="../controlador/chats.php" >
                        <div class="col-sm-12 col-md-6">
                            <div class="btn-group" style="width: 100%">
                                <input name="criterio" type="text" class="form-control" placeholder="Criterios  de busqueda" aria-label="Username" aria-describedby="basic-addon1" required>
                                <button class="btn btn-default" onclick="$('#formBuscar').submit();"><a class="fa fa-search"></a> Buscar</button>
                                <!--<input type="submit" value="Buscar">-->
                            </div>
                        </div>
                        <input type="hidden" name="oper" value="buscar para invitar">
                        <input type="hidden" name="idgrupo" value="9" id="idgrupoInivitar">
                    </form>
                    <div class="row" id="contresultadosModalInvitarGrupo"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Finalizar</button>
            </div>
        </div>
    </div>
</div>

<script>
    altura = $("#cuerpo-chatComunidad").height();
//    alert(altura);
    $("#cont-chatComunidad").scrollTop(altura);
    document.getElementById('cuerpo-chatComunidad').addEventListener("DOMSubtreeModified", function () {
        altura = $(this).height();
        $(this).parent().scrollTop(altura);
    }, false);

    setInterval(function () {
        //                                    alert("buscando");

        //                                    console.log(data);
        $.ajax({
            url: "../controlador/chats.php",
            type: "POST",
            dataType: 'html',
            data: 'oper=cargarNuevoMensajeSalaChat&idSala=<?php echo $idsalachat; ?>',
        }).done(function (respuesta) {
            console.log(respuesta);
            //            alert("exito");
            $("#cuerpo-chatComunidad").append(respuesta);
        });
        //                                    alert('fin');
    }, 3500);

    function eliminarComentario(btn) {
        var resp = confirm("Desea eliminar este comentario?");
        if (resp) {
            $(btn).parent("form").submit();
        }
    }
    function eliminarPublicacion(btn) {
        var resp = confirm("Desea eliminar esta Publicación?");
        if (resp) {
            $(btn).parent("form").submit();
        }
    }
    function eliminarPersonaGrupo(btn) {
        var resp = confirm("Desea eliminar esta persona del grupo?");
        if (resp) {
            $(btn).parent("form").submit();
        }
    }

</script>