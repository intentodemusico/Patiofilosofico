<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include '../modelo/Usuario.php';
?>
<!--<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>-->

<?php
// listara los contactos que sigue el usuario logueado
session_start();
$user = new Usuario();
if (isset($_SESSION["usuario"])) {
//            print_r($_SESSION["usuario"]) ;
    $user = unserialize($_SESSION['usuario']);
}
//        $contactos = array();
$contactos = $user->buscarContactosMensaje();
$u = new Usuario();
?>
<link href="css/admin_usuario.css" rel="stylesheet" type="text/css"/>
<style>
    .img-contacto {
        width: 40px;
        height: 40px;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        /* border: red solid 1px; */
        display: inline-block;
        /*border-radius: 50%;*/
    }

    span.nomb-contacto {
        display: inline-block;
        vertical-align: middle;
        line-height: 40px;
        padding: 0px 10px;
        width: calc( 100% - 80px);
    }

    .lista-contacto > li {display: flex;border: 1px solid #cecdcd;border-radius: 9px;padding: 4px;}

    span.num-mens {
        line-height: 40px;
        padding: 0px 10px;
        background: #0d77b6;
        width: 40px;
        text-align: center;
        border-radius: 50%;
        color: #45f3f5;
        font-size: 13px;
        font-weight: bold;
    }

    .lista-contacto > li:hover {
        box-shadow: 2px 2px 5px #a2a1a1b3;
        background: #95b7cc;
        transform: scale(1.04);
        cursor: pointer;
        color: #fff;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-5">
            <ul class="lista-contacto">
                <?PHP
                foreach ($contactos as $u) {
                    ?>
                <li class="m-2" onclick="verComversacion('cont-chatsCompleto','<?php echo $u->getId(); ?>');">
                        <div class="img-contacto" style="background-image: url(<?php echo $u->getAvatar(); ?>);"></div>
                        <span class="nomb-contacto"><?php echo $u->getNombre(); ?></span>
                       <?php if($u->getMensaje()>0){ ?> <span class="num-mens"><?php echo $u->getMensaje(); ?></span> <?php } ?>
                    </li>

                    <!--                    <div class="cont-usuario ">
                                            <h5><?php echo $u->getNombre(); ?></h5>
                                            <div class="img-user" style="background-image: url(<?php echo $u->getAvatar(); ?>);"></div>
                                            <div class="datos-user">
                    
                                                <div class="row-fluid">
                                                    <label class="lb-admin">Usuario</label><span > <?php echo $u->getUser(); ?></span>
                                                </div>
                                                <div class="row-fluid">
                                                    <label class="lb-admin">tipo usuario </label><span > <?php echo $u->getTipo_usuario(); ?></span>
                                                </div>
                                            </div>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-info" data-dismiss="modal" onclick="iniciarComversacion('<?php echo $u->getId(); ?>');" id="btn_seguir" title="Contactar por mensaje"><i class="fa fa-comments"></i></button>
                                               </div>
                                        </div>-->


                    <?php
                }
                ?>
            </ul>

        </div>
        <div class="col-6" id="cont-chatsCompleto" style="transform: rotateZ(180deg);">

        </div>
    </div>
</div>
<script>
    var $idUsuarioSeguir = '<?php echo $user->getId(); ?>';
</script>