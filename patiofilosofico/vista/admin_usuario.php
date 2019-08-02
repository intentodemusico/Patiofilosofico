<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include '../modelo/Usuario.php';
session_start();
$user = new Usuario();
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);
// put your code here
//        parametrizar multiselect o individual, si se permite la seleccion. ver perfil 
?>
<link href="css/admin_usuario.css" rel="stylesheet" type="text/css"/>
<h4>usuarios activos</h4>
<?php
$usuarios = $user->buscarUsuarioByEstado("ACTIVO");
$u = new Usuario();
foreach ($usuarios as $u) {
    $adminuser = "";
    if ($u->getTipo_usuario() == "ADMINISTRADOR")
        $adminuser = "admin";
    ?>
    <div class="cont-usuario <?php echo $adminuser; ?>">
        <h5><?php echo $u->getNombre(); ?></h5>
        <div class="img-user" style="background-image: url(<?php echo $u->getAvatar(); ?>);"></div>
        <div class="datos-user">

            <div class="row-fluid">
                <label class="lb-admin">Usuario</label><span > <?php echo $u->getUser(); ?></span>
            </div>
            <div class="row-fluid">
                <label class="lb-admin">tipo usuario </label><span > <?php echo $u->getTipo_usuario(); ?></span>
            </div>
            <div class="row-fluid">
                <label class="lb-admin" >Correo </label><span > <?php echo $u->getCorreo(); ?></span>
            </div>
        </div>
        <div class="btn-group">
            <!--<button class="btn btn-outline-light" title="Modifica a tipo administrador o normal"><i class="fa fa-pen"></i> </button>-->
            <button class="btn btn-outline-light" title="Desactivar este usuario" onclick="desactivarUser('<?php echo $u->getId(); ?>');" value="Inactivar"><i class="fa fa-times"></i> </button>
            <!--<button class="btn btn-outline-light" title="Resetea la contraseña del usuario, se notificara por correo electronico"><i class="fa fa-key"></i> </button>-->
        </div>
    </div>
<?php }
?>
<h4>usuarios desactivados</h4>    
<?php
$usuarios = $user->buscarUsuarioByEstado("BLOQUEADO");
$u = new Usuario();
foreach ($usuarios as $u) {
    $adminuser = "";
    if ($u->getTipo_usuario() == "ADMINISTRADOR")
        $adminuser = "admin";
    ?>
    <div class="cont-usuario user-bloq <?php echo $adminuser; ?>">
        <h5><?php echo $u->getNombre(); ?></h5>
        <div class="img-user" style="background-image: url(<?php echo $u->getAvatar(); ?>);"></div>
        <div class="datos-user">

            <div class="row-fluid">
                <label class="lb-admin">Usuario</label><span > <?php echo $u->getUser(); ?></span>
            </div>
            <div class="row-fluid">
                <label class="lb-admin">tipo usuario </label><span > <?php echo $u->getTipo_usuario(); ?></span>
            </div>
            <div class="row-fluid">
                <label class="lb-admin" >Correo </label><span > <?php echo $u->getCorreo(); ?></span>
            </div>
        </div>
        <div class="btn-group">
            <!--<button class="btn btn-outline-light" title="Modifica a tipo administrador o normal"><i class="fa fa-pen"></i> </button>-->
            <button class="btn btn-outline-light" title="Activar este usuario" onclick="activarUser('<?php echo $u->getId(); ?>');" value="Activar"><i class="fa fa-check"></i> </button>
            <!--<button class="btn btn-outline-light" title="Resetea la contraseña del usuario, se notificara por correo electronico"><i class="fa fa-key"></i> </button>-->
        </div>
    </div>
    <?php
}
?>


<div id="contresp"></div>
<script>
    function desactivarUser(idUsuario) {
        var paqueteDeDatos = new FormData();
        paqueteDeDatos.append("oper", "desactivar Usuario");
        paqueteDeDatos.append("idusuario", idUsuario);
        $.ajax({
            url: "../controlador/usuarios.php",
            type: "POST",
            data: paqueteDeDatos,
            contentType: false,
            processData: false,
            cache: false,
            success: function (result) {
                $("#contresultadost").append(result);
//                    $("#btn_seguir").css('display','inline-block');
//                    $("#btn_dejarSeguir").css('display','none');

            },
            error: function (e) {
                console.log("falla en el envio ajax Seguir");
                $("#contresultadost").append("ha ocurrido un Error en el envio del formulario ");
            }
        });

    }
    function activarUser(idUsuario) {
        var paqueteDeDatos = new FormData();
        paqueteDeDatos.append("oper", "activar Usuario");
        paqueteDeDatos.append("idusuario", idUsuario);
        $.ajax({
            url: "../controlador/usuarios.php",
            type: "POST",
            data: paqueteDeDatos,
            contentType: false,
            processData: false,
            cache: false,
            success: function (result) {
                $("#contresultadost").append(result);
//                    $("#btn_seguir").css('display','inline-block');
//                    $("#btn_dejarSeguir").css('display','none');

            },
            error: function (e) {
                console.log("falla en el envio ajax Seguir");
                $("#contresultadost").append("ha ocurrido un Error en el envio del formulario ");
            }
        });

    }
</script>
