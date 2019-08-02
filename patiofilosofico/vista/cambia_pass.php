<?php
require '../funcs/conexion.php'; ;
include '../funcs/funcs.php';

if(empty($_GET['usuario'])){
    header('Location: index.php');

}

if(empty($_GET['token'])){
    header('Location: index.php');
}

$usuario = $mysqli->real_escape_string($_GET['usuario']);
$token = $mysqli->real_escape_string($_GET['token']);

// echo $usuario;
// echo "<br>".$token;

if(!verificaTokenPass($usuario, $token)){
    echo verificaTokenPass($usuario, $token);
    echo 'No se pudo verificar los datos';
    // exit;
}
?>

<html lang="esp">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Recuperar Contraseña</title>
        <link href="pluging/fontawesome-free-5.3.1-web/css/all.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/x-icon" href="imagenes/logor.jpg">

        <link rel="stylesheet" href="css/flexslid.css" type="text/css">
        <link href="css/loaderEsferas.css" rel="stylesheet" type="text/css"/>
        <!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->
        <!--<link rel="stylesheet" href="css/fontello.css" >-->
        <!--<link rel="stylesheet" href="css/estilos.css" >-->
        <!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->

        <link href="pluging/NotificationStyles/css/ns-default.css" rel="stylesheet" type="text/css"/>
        <link href="pluging/NotificationStyles/css/ns-style-growl.css" rel="stylesheet" type="text/css"/>
        <link href="css/barraDesplazamiento.css" rel="stylesheet" type="text/css"/>
        <link href="pluging/bootstrap4/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
        <link href="css/chats.css" rel="stylesheet" type="text/css"/>

        <!--         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">



        <style>

            /*            .row img{
                            padding: 0px 10px;
                            width: 100%;
                        }*/
            .text-max-170{
                /*width: 90%;*/
                text-align: justify;
                /*width: 90%;*/
                text-align: justify;
                max-height: 244px;
                overflow: hidden;
            }

            .cuerpo-noticia > .row > img{
                max-height: 200px;
            }
            .img-noticia {
                max-width: calc( 99% + 1px );
                width: 100%;
                height: 250px;
                inline-size: auto;
            }
            @media only screen and (max-width: 950px) {
                .text-max-170{
                    max-height: 170px;
                    overflow: hidden;
                }
            }
            .video-noticia{
                width: 100%;
                max-height: 280px;
                background: rgba(17, 17, 17, 0.64);
                margin: 0;
                padding: 0;
                height: 100%;
            }
            .text-noticia-normal{
                overflow-y: hidden;
                max-height: 172px;

            }
            .video-noticia-dest {
                width: 95%;
            }
            a.btn-menu-superior > i {
                padding-bottom: 4px;
                margin-top: 10px;
            }
            a.btn-menu-superior {
                min-height: 50px;
                min-width: 50px;
                margin-left: 4px;
                border: 1px solid #ffffff3b;
                color: #fff;
                font-size: 30px;
                padding: 10px;
                padding-top: 0px;
                border-radius: 7px;
            }

            a.btn-menu-superior:hover {
                border: 1px solid rgba(255, 255, 255, 0.59);
                text-decoration: none;
                font-weight: 600;
                background: #ffffff40;
            }

            ul.menus.row {
                margin: 0px;
                display: table;
                margin: auto;
                margin-top: 10px;
            }

            nav.navegacion {
                margin: 0px;
                align-content: center;
                height: auto;
                /* font-size: 19px; */
            }

            .menus > li {
                display: inline-block;
                margin-left: 5px;
                /* margin-bottom: 5px; */
                border-bottom: 3px #fff solid;
                padding-bottom: 5px;
                padding-left: 5px;
                width: auto
            }

            .menus> li > a > i {
                display: inline-block;
                margin-right: 5px;
            }

            .menus > a > li > span {
                display: inline-block;
            }

            .menus > li > a > span {
                display: inline;
            }

            .menus > li > a {
                display: initial;
                padding: 10px;
            }

            .menus > li > a:hover {
                text-decoration: none;
                color: #338bcc;
            }

            .menus > li:hover {
                border-bottom: 3px solid rgb(48, 156, 238);
            }
            .doit {
                font-size: 14px;
                font-weight: bolder;
                background: #e60e0e;
                border-radius: 50%;
                padding: 2px 5px 3px 3px;
                /* float: left; */
                /* position: relative; */
                /* top: 5px; */
                padding: 5px;
            }

            .m-user:hover > .ul.submenu{
                opacity: 1;
                visibility: visible;
            }
            .m-user {
                font-size: 16px!important;
                line-height: 44px;
            }
            /*            ul.submenu {
                            background: #fff;
                        }
                        .submenu > li {
                            border: 1px solid;
                            border-radius: 40px;
                            list-style: none;
                            padding-left: 20px;
                            font-size: 14px;
                            margin-top: 4px;
                            background: #89b4e69e;
                        }*/
            .flexslider {
                width: 100%;
                height: 370px;
                /* position: relative; */
                top: 10px;
                margin: 0px;
                /* border: 1px solid lightgrey; */
            }

            .container p{
                margin: 20px 0px;
                font-family: 'arial narrow';
                font-size: 120%;
                text-align: justify;
            }
        </style>
    </head>
    <body onload="cargarPagina('noticias.php', 'contenedorPrincipal', true);">
        <div id="imgBanner" class="flexslider" style="background-image:url(Imagenes/mod2.png);    background-size: cover;background-repeat: no-repeat;">
            <ul class="slides">
                <li>
                    <!--<img src="imagenes/mod2.PNG" alt="Portal filoEn">-->
                    <section class="flex-caption">
                        <h1 id="tituloBanner"> El Patio Filosófico </h1>
                        <p id="textoBanner">Un sitio para el encuentro con la filosofía</p>
                    </section>
                </li>
            </ul>
        </div>

        <div id="menu-superior">
            <nav class="navegacion">

                    <ul class="menus row">
                       <!--<li> <a href="index.php"><span><img src="Imagenes/inicio.png" alt="" width="20px"></span> Inicio</a></li>-->
                       <!--<li><a href="#1"><span><img src="Imagenes/personP.png" alt="" width="20px"></span>Personas <span class="icon icon-angle-down"></span> </a>-->
                        <li><a href="index.php"> <i class="fa fa-university"></i><span class="hidden-md-down">Inicio</span> </a>
                        </li>

                    </ul>

            </nav>
        </div>

        <div class="content-fluid" id="contenedorPrincipal" style="margin-top: 30px;"></div>


<div class="container" style="min-height: 300px;">
    <h3 class="titulo">Cambiar contraseña</h3>
    <hr class="linea">

    <div id="resp"></div>
    <div id="contPrincipal">

        <div class="container">
        <p class="infor">
            Escriba su nueva cotraseña para que pueda recuperar la cuenta de usuario de nuestro portal, El patio filosófico.

        </p>
        </div>

        <form id="loginform" class="form-horizontal" role="form" action="../controlador/guarda_pass.php" method="POST" autocomplete="off">

                <input type="hidden" id="usuario" name="usuario" value ="<?php echo $usuario; ?>" />

                <input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />

                <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Nueva contraseña</label>
                        <div class="col-md-9">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                </div>

                <div class="form-group">
                        <label for="con_password" class="col-md-3 control-label">Confirmar contraseña</label>
                        <div class="col-md-9">
                                <input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
                        </div>
                </div>

                <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                                <button id="btn-login" type="submit" class="btn btn-primary">Modificar</a>
                        </div>
                </div>
        </form>

    </div>
</div>

<!--
<footer>
<div class="pie">
    <p>
    <a href="index.php">Inicio</a> |
    <a href="contactenos.php">Contactenos</a> |
    <a href="registro.php">Registro</a> |
    <a href="ingreso.php">Login</a> |
    </p>
        <p>
            Copyright 2018. <a href="http://www.uis.edu.co/" rel="develop">Universidad Industrial de Santander</a>   <a href="http://www.filosofiayensenanza.org/inicio/" rel="develop">Grupo FiloEn</a>
        </p>

</div>
</footer>-->
<script>
    $("#inputEmail3").focus();
</script>
<!--<script src="js/funcionesGenerales.js">

</script>
<script src="pluging/NotificationStyles/js/modernizr.custom.js" type="text/javascript"></script>
<script src="pluging/NotificationStyles/js/classie.js" type="text/javascript"></script>
<script src="pluging/NotificationStyles/js/notificationFx.js" type="text/javascript"></script>-->
<!--
</body>
</html>-->

        <div id="contresultadost"></div>
        <footer>

            <div class="footer1">

                <a href=""><img src="imagenes/ig.png"></a>
                <a href="https://www.facebook.com/"><img src="imagenes/fb.png"></a>
                <a href="https://twitter.com/?lang=es"><img src="imagenes/tw.png"></a>
                <a href=""><img src="imagenes/gg.png"></a>
                <a href="https://www.instagram.com/"><img src="imagenes/in.png"></a>

            </div>


            <div class="pie">
                <p>
                    <a href="index.php">Inicio</a> |
                    <a href="#contactenos.php" onclick="cargarPagina('contactenos.php', 'contenedorPrincipal', true);">Contáctenos</a> |
                    <a href="#registro.php" onclick="cargarPagina('registro.php', 'contenedorPrincipal', true);">Registro</a> |
                    <a href="#ingreso.php" onclick="cargarPagina('ingreso.php', 'contenedorPrincipal', true);">Login</a> |
                </p>
                <p>
                    Copyright 2019. <a href="http://www.uis.edu.co/" rel="develop">Universidad Industrial de Santander. </a>  <span> </span> <a href="#" rel="develop">Grupo Filosofía y enseñanza de la filosofía</a>
                </p>
            </div>
        </footer>


    </body>
</html>
