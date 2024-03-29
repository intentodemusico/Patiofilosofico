<!DOCTYPE html>
<?PHP
include '../controlador/conBD.php';

session_start();
$limiteNoticias = 2;
$idUserAdmin = 0;
if (isset($_SESSION["iduser"])) {
    $limiteNoticias = 10;
}

$conn = conBD::conectar();
$sentenciaSQL = "SELECT * FROM `noticia` ";
$existenRegistro = mysqli_query($conn, $sentenciaSQL);
$iduserAdmin = mysqli_query($conn, "SELECT * FROM usuario where tipo_usuario = 'ADMINISTRADOR'");
// print_r(mysqli_fetch_assoc($iduserAdmin));
$idAdmin = "";
while ($row = mysqli_fetch_assoc($iduserAdmin)) {
    $idAdmin = $idAdmin . "'" . $row["idusuario"] . "',";
//     echo $row["idusuario"];
}
if (substr($idAdmin, strlen($idAdmin) - 1) == ",")
    $idAdmin = substr($idAdmin, 0, strlen($idAdmin) - 1);
?>

<h3 class="titulo">Últimas Noticias</h3>
<hr class="linea">
<div class="cont-noticiaDestacada">
    <?php
    // noticias destacadas
    $sql = "SELECT `noticia`.`idnoticia`,
    `noticia`.`titulo`,
    `noticia`.`subtitulo`,
    `noticia`.`contenido`,
    `noticia`.`imagen`,
    `noticia`.`tipo_multimedia`,
    `noticia`.`fecha`,
    `noticia`.`idusuario`,
    `noticia`.`enlace`,
    `noticia`.`estado`,
    `noticia`.`fecha_modifico`
FROM `noticia` WHERE estado = 'DESTACADA' AND idusuario IN (" . $idAdmin . ") order by fecha DESC  limit " . $limiteNoticias;
    $resultado = mysqli_query($conn, $sql);
 $sinNoticias = false;
    if (mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            ?>
    <div class="row mb-6 mb-5" >
                <div class="col-sm-10 offset-1 col-md-4">

                            <!--<img  class="media-object img-noticia" src="Imagenes/28.png" width="300px" alt="...">-->
                    <?php if ($fila["tipo_multimedia"] == "VIDEO") {
                        ?> 
                        <video width="100%" class="video-noticia-dest" controls id="noticia_<?php echo $fila["idnoticia"] ?>" >
                            <source src="<?php echo $fila["imagen"] ?>" >
                            Your browser does not support HTML5 video.
                        </video>
                        <?php
                    } else
                    if ($fila["tipo_multimedia"] == "IMAGEN") {
                        ?><img class="img-noticia" src="<?php echo $fila["imagen"]; ?>" alt="" ><?php
                    } else
                    if ($fila["tipo_multimedia"] == "YOUTUBE") {
                        ?><img class="media-object img-noticia" width="300px" src="<?php echo $fila["imagen"]; ?>" alt="" ><?php
                    }
                    ?>

                </div>
                <div class="col-texto-noticia col-sm-10 offset-sm-1 offset-md-0 col-md-6 ">
                    <h4 class="col-12 text-info text-uppercase p-0"><?php echo $fila["titulo"]; ?></h4>
                    <h6 class="clol-12  text-info "><?php echo $fila["subtitulo"]; ?></h6>
                    <p class="text-max-170 " ><?php echo $fila["contenido"]; ?><p>
                        <?php if ($fila["enlace"] != "") echo '<a href="' . $fila["enlace"] . '" target="noticia" class="btn btn-primary btn">Leer más</a>'; ?>
                        <br></p>
                </div>

            </div>
            <?php
        }
        $sinNoticias = true;
    }
    ?>
</div>
<div class="content-fluid">
    <div class="row col-10 offset-1 ">
        <?php
// noticias normales
        $sql1 = "SELECT `noticia`.`idnoticia`,
    `noticia`.`titulo`,
    `noticia`.`subtitulo`,
    `noticia`.`contenido`,
    `noticia`.`imagen`,
    `noticia`.`tipo_multimedia`,
    `noticia`.`fecha`,
    `noticia`.`idusuario`,
    `noticia`.`enlace`,
    `noticia`.`estado`,
    `noticia`.`fecha_modifico`
FROM `noticia` WHERE estado = 'ACTIVA' AND idusuario IN (" . $idAdmin . ") order by fecha DESC  limit " . $limiteNoticias;
        $resultado1 = mysqli_query($conn, $sql1);
        $numero = 1;
//        echo mysqli_num_rows($resultado1);
        if (mysqli_num_rows($resultado1) >0) {
            while ($fila = mysqli_fetch_array($resultado1, MYSQLI_ASSOC)) {

                if ($numero == 1) {
                    echo '<div class="col-md-5 pl-3 pr-3 mb-3 ">';
                    $numero = 2;
                } else {
                    echo '<div class="col-md-5 ml-4 pl-3 pr-3 mb-3">';
                    $numero = 1;
                }
                ?>

                <!--<div class="col-md-5 offset-1   pl-3 pr-3 mb-3">-->
                <div class="cuerpo-noticia">
                    <div class="col-10 offset-1 mb-1">
                        <?php if ($fila["tipo_multimedia"] == "VIDEO") {
                            ?> 
                            <video width="400" class="video-noticia" controls id="noticia_<?php echo $fila["idnoticia"] ?>">
                                <source src="<?php echo $fila["imagen"] ?>" >
                                Your browser does not support HTML5 video.
                            </video>
                            <?php
                        } else
                        if ($fila["tipo_multimedia"] == "IMAGEN") {
                            ?><img class="img-noticia" src="<?php echo $fila["imagen"]; ?>" alt="" ><?php
                        } else
                        if ($fila["tipo_multimedia"] == "YOUTUBE") {
                            ?><img class="img-noticia" src="<?php echo $fila["imagen"]; ?>" alt="" ><?php
                        }
                        ?>

                    </div>
                    <div class="row  mt-4">
                        <h4 class="text-info col-12 text-uppercase"><?php echo $fila["titulo"]; ?></h4>
                        <h6 class="text-info col-12 "><?php echo $fila["subtitulo"]; ?></h6>
                        <p class="text-noticia-normal pl-3 pr-3 text-justify col-12"><?php echo $fila["contenido"]; ?></p> <br>
                        <div class="row-flow mt-2 mb-1 pl-3">
                            <?php if ($fila["enlace"] != "") echo '<a href="' . $fila["enlace"] . '" target="_Black" class="btn btn-primary btn">Leer más</a>'; ?>
                            <!--<a href="#" target="noticia" class="btn btn-primary btn-sm">Leer más</a>-->
                        </div>

                    </div>
                </div>
            </div>

            <?php
        }
        $sinNoticias = true;
    }
    
    if(!$sinNoticias){
        ?>
        <blockquote >
            <h5 class="text-info">Sin Noticias</h5>
            <p>Lo sentimos no se han encontrados noticias, muy pronto te se estaran subiendo nuevas noticias de interes para la comunidad. <br>Gracias por tu comprención.
        </blockquote>
        <?php
    }
    ?>
</div>
</div>




