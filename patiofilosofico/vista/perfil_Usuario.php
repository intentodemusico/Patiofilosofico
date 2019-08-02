<?php
include '../modelo/Usuario.php';
session_start();
$g = $_GET;
$iduser = 0;
$user = new Usuario();
$usuario = new Usuario();
//        session_start();
if (isset($_SESSION['usuario'])) {
    $user = unserialize($_SESSION['usuario']);
}
if (isset($g['idUser'])) {
    $usuario = $usuario->UsuarioPorID($g['idUser']);
}
?>

<!--   

        <div class="cbp-spmenu-push" id="cont-push">
            <a href="buscardorPerfiles.php"></a>
            

            <div class="container" id="cuerpo-principal-perfil">-->
<link href="css/perfil_usuario.css" rel="stylesheet" type="text/css"/>
<div class="row mb-2">

    <div class="col-md-12 col-lg-4">
        <!--                            <div class="content-imagen col-4" id="avatar_perfil" style="background: url(../../Imagenes/17.5.jpg);">
                                    </div>-->
        <?php
        $avatar = $usuario->getAvatar();
        if ($avatar == "") {
            $avatar = "Imagenes/sin-avatar.png";
        }
        ?>
        <div class="ch-item ch-img-1" id="imgPerfil" style="background: url(<?php echo $avatar; ?>)">
            <div class="ch-info ">


            </div>
        </div>
        <div class="row pt-2 pb-2">
            <div class="center-block" style="margin: auto;">
                <a class="btn btn-sm btn-warning" target="_blank" href="../vista/blogs/blog.php?idusuario=<?php echo $usuario->getId(); ?>"><i class="fab fa-blogger"></i> Blog</a>
                <?php
                if (($user->getId() > 0 ) && ($user->getId() != $usuario->getId())) {
                    ?>
                    <button class="btn btn-sm btn-default" onclick="dejarSeguirUsuario(<?php echo $usuario->getId(); ?>);" id="btn_dejarSeguir" title="Dejar de seguir para no recibir notifcaciones"><i class="fa fa-user-times"></i> </button>
                    <?php // if ($user->getId() != $usuario->getId()) { ?>
                        <button class="btn btn-sm btn-info" onclick="seguirUsuario(<?php echo $usuario->getId(); ?>);" id="btn_seguir" title="Seguir para recibir notifcaciones sobre nuevos contenidos de esta persona"><i class="fa fa-user-plus"></i></button>
                        <button class="btn btn-sm btn-info" data-dismiss="modal" onclick="iniciarComversacion(<?php echo $usuario->getId(); ?>);" id="btn_seguir" title="Contactar por mensaje"><i class="fa fa-comments"></i></button>
                    <?php // } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-8 text-muted row">
        <div class="col-12"><h5  class="text-info ">Información Personal</h5></div>
        <div class="col-12  info-perfil-3 mb-1">
            <span><?php echo $usuario->getTipo_usuario(); ?></span>
        </div>
        <div class="col-12  info-perfil-3 mb-1 row">
            <span class=" col-md-4 col-sm-12">Nombre: </span>
            <span ><?php echo $usuario->getNombre(); ?> </span>
            <!--<input type="text" class="input-editable form-control" disabled="true" value="" name="txtNombre" id="txtNombre">-->
        </div> 
        <div class="col-12  info-perfil-3 mb-1 row">
        <span class=" col-md-4 col-sm-12">País: </span>
            <span ><?php echo $usuario->getPais(); ?> </span>
        </div>
        <div class="col-12  info-perfil-3 mb-1 row">
             <span class=" col-md-4 col-sm-12">Ciudad: </span>
            <span ><?php echo $usuario->getCiudad(); ?> </span>
        </div>

        <div class="col-12 pt-2 mt-2"><h5  class="text-info ">Información de Contacto</h5></div>
        <div class="col-md-12 col-12 btn-group info-perfil-3 ">                        
            <span class="text-right text-muted col-md-3 col-sm-12">Email: </span>
            <span ><?php echo $usuario->getCorreo(); ?></span >

            <!--                                <div class="input-group-append">
                                                <button title="Editar" class="btn btn-outline-secondary btn-sm btn-hover-editar" type="button" onclick="editarCampo('txtEmail', this)"><i class="fa fa-pen"></i> </button>
                                            </div>-->
        </div>

    </div>
</div>



<div class="container-fluid" id="contacademia">
    <div class="col-12"><h5  class="text-info ">Información Academica</h5></div>
    <?php
    ?>
    <div class="row" id="cont_estudioAcademico">
        <?php
        $infoAcademica = Usuario::buscarInfoAcademicaByIdUser($usuario->getId());
//                        print_r($infoAcademica);
        if (count($infoAcademica) <= 0) {
            ?>
            <blockquote style="width: 70%;margin: auto; border-color: orange; color: orange" >
                <h5 >Sin registros académicos</h5>
                <p class="text-muted">No se han registrado datos académicos para este perfil. </p>
            </blockquote >
            <?php
        }
        foreach ($infoAcademica as $info) {
            ?>
            <div class="row col-12 col-sm-10  offset-xs-0 offset-sm-1 mt-3 border-top">
                <span class="col-4 text-right text-muted">Título:</span><span class="col-8"><?php echo $info["titulo"]; ?></span>
                <span class="col-4 text-right text-muted">Institución:</span><span class="col-8"><?php echo $info["institucion"]; ?></span>
                <span class="col-4 text-right text-muted">año:</span><span class="col-8"><?php echo $info["anno"]; ?></span>
            </div>    
            <?php
        }
        ?>
    </div>
</div>
<?php
if ($user->getId() > 0 && $user->comprovarSigueUsuario($usuario->getId())) {
    ?>
    <script>
        $("#btn_seguir").css('display', 'none');
        $("#btn_dejarSeguir").css('display', 'inline-block');
    </script>
    <?php
} else {
    ?>
    <script>
        $("#btn_seguir").css('display', 'inline-block');
        $("#btn_dejarSeguir").css('display', 'none');
    </script>
    <?php
}
?>
<script>
    $idUsuarioSeguir = '<?php echo $usuario->getId(); ?>';
</script>