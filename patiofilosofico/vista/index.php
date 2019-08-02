<?php
include '../modelo/Usuario.php';
include '../modelo/Mensajeria.php';

?>
<html lang="esp">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Portal El patio filosófico</title>
        <link href="pluging/fontawesome-free-5.3.1-web/css/all.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/x-icon" href="imagenes/logor.jpg">

        <link rel="stylesheet" href="css/flexslid.css" type="text/css">
        <link href="css/loaderEsferas.css" rel="stylesheet" type="text/css"/>

        <link href="pluging/NotificationStyles/css/ns-default.css" rel="stylesheet" type="text/css"/>
        <link href="pluging/NotificationStyles/css/ns-style-growl.css" rel="stylesheet" type="text/css"/>
        <link href="css/barraDesplazamiento.css" rel="stylesheet" type="text/css"/>
        <link href="pluging/bootstrap4/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/chats.css" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">


        <?php
        session_start();
        $user = new Usuario();
        if (isset($_SESSION["usuario"])) {
//            print_r($_SESSION["usuario"]) ;
            $user = unserialize($_SESSION['usuario']);
        }
        ?>

        <style>


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

            .nombreUsuario {
                display: inline-block;
                width: 100%;
                color: white;
                text-align: right;
                padding-right: 20px;
            }
            .name-usuario {
                display: block;
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
                <?php
                if ($user->getId() > 0) {
                    
                    if ($user->getTipo_usuario() == "ADMINISTRADOR") {
                            ?>               
                        <ul class="menus row">
                            <!--<li> <a href="inicioEst.php"><span><img src="Imagenes/inicio.png" alt="" width="20px"></span> Inicio</a></li>-->
                            <li class=""> <a href="#1">
                                    <i class="fa fa-user-alt"></i><span class="hidden-md-down">Personas</span><i class="icon icon-angle-down"></i></a>
                                <ul class="submenu">
                                    <li> <a href="#1" onclick="cargarPagina('buscardorPerfiles.php', 'contenedorPrincipal', true)">Perfiles</a></li>
                                    <!--<li> <a href="#1" onclick="cargarPagina('inicioUsuario.php', 'contenedorPrincipal', true)">Mi Perfil</a></li>-->

                                </ul>
                            </li>
                            <!--<li> <a href="#"><span><img src="Imagenes/grupo_1.png" alt="" width="20px"></span> Comunidad<span class="icon icon-angle-down"></span></a>-->
                            <li class=""> <a href="#1" class=" "><i class="fa fa-users"></i><span class="hidden-md-down"> Comunidad</span><span class="icon icon-angle-down"></span></a>
                                <ul class="submenu">
                                    <li> <a href="#1" onclick="cargarPagina('grupos.php', 'contenedorPrincipal', true);">Comunidades</a></li>
                                    
                                    <!--<li> <a href="#1" onclick="cargarPagina('Informate_comp.php', 'contenedorPrincipal', true)">Infórmate</a></li>-->
                                </ul>
                            </li>
                            <li><a href="#1" onclick="cargarPagina('noticias_Completas.php', 'contenedorPrincipal', true)">
                                    <i class="fa fa-newspaper"></i><span class="hidden-md-down">Noticias</span> </a></li>

                            <li class=""> <a href="#22" class=" " onclick="cargarPagina('eventos.php', 'contenedorPrincipal', true)" ><i class="fa fa-trophy"></i><span class="hidden-md-down"> Eventos</span></a></li>                                

                            
                            <li class=""> <a href="#1"> <i class="fa fa-user-shield"></i><span class="hidden-md-down">  Administrador</span><span class="icon icon-angle-down"></span></a>
                                 <ul class="submenu">
                            <li> <a href="#1" onclick="cargarPagina('admin_usuario.php', 'contenedorPrincipal', true)">Admin usuarios</a></li>

                            </ul>
                            </li>
                        </ul>

                            <?php
                        } else{
                             $connect = conBD::conectar();
                            
                            $query = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario= ".$user->getId());
                            while($row= mysqli_fetch_array($query))
                            {
                        ?>
 
                    <ul class="menus row">
                        <!--<li> <a href="inicioEst.php"><span><img src="Imagenes/inicio.png" alt="" width="20px"></span> Inicio</a></li>-->
                        <li class=""> <a href="#1">
                                <i class="fa fa-user-alt"></i><span class="hidden-md-down">Personas</span><i class="icon icon-angle-down"></i></a>
                            <ul class="submenu">
                                <!--<li> <a href="#1" onclick="cargarPagina('inicioUsuario.php', 'contenedorPrincipal', true)">Mi Perfil</a></li>-->
                                <li> <a href="blogs/blog.php?idusuario=<?php echo $row['idusuario'];?>">Mi Blog</a></li>
                                <li> <a href="#1" onclick="cargarPagina('buscardorPerfiles.php', 'contenedorPrincipal', true)">Perfiles</a></li>
                            </ul>
                        </li>
                        <!--<li> <a href="#"><span><img src="Imagenes/grupo_1.png" alt="" width="20px"></span> Comunidad<span class="icon icon-angle-down"></span></a>-->
                        <li class=""> <a href="#1" class=" "><i class="fa fa-users"></i><span class="hidden-md-down"> Comunidad</span><span class="icon icon-angle-down"></span></a>
                            <ul class="submenu">
                                <li> <a href="#1" onclick="cargarPagina('grupos.php', 'contenedorPrincipal', true);">Comunidades</a></li>
                                <!--<li> <a href="#1" onclick="cargarPagina('buscardorPerfiles.php', 'contenedorPrincipal', true)">Demás perfiles</a></li>-->
                                <!--<li> <a href="#1" onclick="cargarPagina('Informate_comp.php', 'contenedorPrincipal', true)">Infórmate</a></li>-->
                            </ul>
                        </li>
                        <li><a href="#1" onclick="cargarPagina('noticias_Completas.php', 'contenedorPrincipal', true)">
                                <i class="fa fa-newspaper"></i><span class="hidden-md-down">Noticias</span> </a></li>

                        <li class=""> <a href="#22" class=" " onclick="cargarPagina('eventos.php', 'contenedorPrincipal', true)" ><i class="fa fa-trophy"></i><span class="hidden-md-down"> Eventos</span></a></li>
                        <li class="">
                            <a href="#1" class=" ">
                                <i class="fa fa-cogs"></i> <span class="hidden-md-down">Herramientas</span>
                                <span class="icon icon-angle-down"></span>
                            </a>
                            <ul class="submenu">
                                <li> <a href="">Modelo de Toulmin</a></li>
                                <li> <a href="">Figuras Retóricas</a></li>
                                <li> <a href="">Biblioteca</a></li>
                            </ul>
                        </li>
                        <li> <a href="#1"> <i class="fa fa-envelope"></i><span class="hidden-md-down">  Contáctenos </span><span class="icon icon-angle-down"></span></a>
                            <ul class="submenu">
                                <li> <a href="#1" onclick="cargarPagina('contactenos_comp.php', 'contenedorPrincipal', true)">Contáctenos</a></li>
                                <li> <a href="#Informate_comp.php" onclick="cargarPagina('Informate_comp.php', 'contenedorPrincipal', true)">Infórmate</a></li>
                                <li> <a href="#acercaFiloEn_Comp.php" onclick="cargarPagina('acercaFiloEn_Comp.php', 'contenedorPrincipal', true)">Grupo Filosofía y enseñanza de la filosofía</a></li>
                            </ul>
                        </li>
                       
                    </ul>
                    <?php
                        }
                        }
                } else {
                    ?>
                    <ul class="menus row">
                       <!--<li> <a href="index.php"><span><img src="Imagenes/inicio.png" alt="" width="20px"></span> Inicio</a></li>-->
                       <!--<li><a href="#1"><span><img src="Imagenes/personP.png" alt="" width="20px"></span>Personas <span class="icon icon-angle-down"></span> </a>-->
                        <li><a href="index.php"> <i class="fa fa-university"></i><span class="hidden-md-down">Inicio</span> </a>
                        </li>
                        <li><a href="#1"> <i class="fa fa-user-alt"></i><span class="hidden-md-down">Personas</span>
                            </a>
                            <ul class="submenu">
                                <li> <a href="#1" onclick="cargarPagina('buscardorPerfiles.php', 'contenedorPrincipal', true);">Perfiles</a></li>
                            </ul>
                        </li>
                        <li class=""> <a href="#1" class=" "><i class="fa fa-users"></i><span class="hidden-md-down"> Comunidad</span>
                                <!--<small class="fa fa-chevron-down"> </small>-->
                            </a>
                            <ul class="submenu">
                                <li> <a href="#1" onclick="cargarPagina('grupos.php', 'contenedorPrincipal', true);">Comunidades</a></li>
                                <!--<li> <a href="#1" onclick="cargarPagina('buscardorPerfiles.php', 'contenedorPrincipal', true)">DemÃ¡s perfiles</a></li>-->
                            </ul>
                        </li>
                        <li class="">
                            <a href="#1" class=" ">
                                <i class="fa fa-cogs"></i> <span class="hidden-md-down">Herramientas</span>
                                <!--<small class="fa fa-chevron-down"> </small>-->
                            </a>
                            <ul class="submenu">
                                <li> <a href="#1" onclick="cargarPagina('toulmin.php', 'contenedorPrincipal', true);">Modelo de Toulmin</a></li>
                                <li> <a href="">Figuras Retóricas</a></li>
                                <li> <a href="">Biblioteca</a></li>
                            </ul>
                        </li>
                        <li> <a href="#2"> <i class="fa fa-envelope"></i><span class="hidden-md-down">  Contáctenos </span><span class="icon icon-angle-down"></span></a>
                            <ul class="submenu">
                                <li> <a href="#1" onclick="cargarPagina('contactenos_comp.php', 'contenedorPrincipal', true)">Contáctenos</a></li>
                                <li> <a href="#1" onclick="cargarPagina('informate_comp.php', 'contenedorPrincipal', true);">Infórmate</a></li>
                                <li> <a href="#1" onclick="cargarPagina('acercaFiloEn_Comp.php', 'contenedorPrincipal', true);">Grupo Filosofía y enseñanza de la filosofía</a></li>
                            </ul>
                        </li>
                    </ul>

                <?php
                }
                ?>
            </nav>
        </div>

        <div class="ingreso">
            <?php
            if ($user->getId() == 0) {
                ?>
                <li><a href="#1" onclick="cargarPagina('ingreso.php', 'contenedorPrincipal', true)"><span><img src="Imagenes/iniciar.png" alt=""  width="20px" ></span> Iniciar Sesión</a></li>
                <li><a href="#1" onclick="cargarPagina('registro.php', 'contenedorPrincipal', true)"><span><img src="Imagenes/registro.png" alt="" width="20px"></span> Registrarse</a></li>
                <?php
            } if ($user->getId() > 0) {
                ?>

                <a href="logout.php" class="btn-menu-superior float-right" style="font-family: 'Lato', Calibri, Arial, sans-serif;" title="Salir del sistema">&phi;</a>

                <a href="#1" class="btn-menu-superior float-right" title="Chats" onclick="cargarPagina('inicioUsuario.php?pag=contactos.php', 'contenedorPrincipal', true)"><i class="fa fa-comment"><span class="doit" id="numbNuevoMensaje">0</span></i></a>
                <a href="#1" class="btn-menu-superior float-right" title="Notificaciones"><i class="fa fa-globe"></i></a>
                <!--<span class="badge">42</span>-->
                <a href="#1" class="btn-menu-superior float-right" onclick="cargarPagina('inicioUsuario.php', 'contenedorPrincipal', true)" title="Mi perfil"> <i class="fa fa-child"></i></a>
                <a href="" class="btn-menu-superior float-right " title="Inicio"><i class="fa fa-university"></i></a>


                <div class="nombreUsuario">
                    <b class="name-usuario"><?php echo $user->getNombre(); ?></b>
                    <label ><?php echo $user->getTipo_usuario(); ?></label>
                </div>
            <?php } ?>
        </div>
        <div class="content-fluid" id="contenedorPrincipal" style="margin-top: 30px;"></div>
        <div id="loader"></div>
        <?php
        if ($user->getId() > 0) {
            ?>
            <div id="chat-content" style="overflow: hidden;">

            </div>

            <?php
        }
        ?>       
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


        <!--<script src="js/jquery.min.js"></script>-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->


<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="pluging/bootstrap4/js/bootstrap.js" type="text/javascript"></script>
        <script src="js/funcionesGenerales.js" type="text/javascript"></script>
        <script src="js/jquery.flexslider.js"></script>
        <script src="pluging/NotificationStyles/js/modernizr.custom.js" type="text/javascript"></script>
        <script src="pluging/NotificationStyles/js/classie.js" type="text/javascript"></script>
        <script src="pluging/NotificationStyles/js/notificationFx.js" type="text/javascript"></script>
        <script src="pluging/lineControlEditor/editor.js" type="text/javascript"></script>
        <script src="../vista/pluging/bootstrap4/js/popper.min.js"></script>
        <script src="js/funcionesChat.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8">
                        $(window).load(function () {
                            $('.flexslider').flexslider();
                            inicioLoader();

                        });
//                        document.getElementById('contCuerpoChat7').addEventListener("DOMSubtreeModified", handler, true);

//                        function handler() {
//                            alert("hola");
//                        }
        </script>
        <script>
            $("#numbNuevoMensaje").css("display", "none");
            $("#numbNuevoMensaje").text(" ");
            //verificar mensajes sin leer y crea la notificacion
            var paqueteDeDatos = new FormData();
            paqueteDeDatos.append("oper", "comprovar nuevas conversaciones");
            $.ajax({
                url: "../controlador/chats.php",
                type: "POST",
                data: paqueteDeDatos,
                contentType: false,
                processData: false,
                cache: false,
                success: function (result) {
//                        console.log("comprovar nuevas conversaciones < ?php echo $user->getId(); ?>");
                    $("#contresultadost").html(result);
                },
                error: function (e) {
                    console.log("falla al comprovar mensajes sin leer " + e);
                    //                            $("#contresultados").append("ha ocurrido un Error al verificar mensajes sin leer");
                }
            });
            setInterval(function () {
                paqueteDeDatos = new FormData();
                paqueteDeDatos.append("oper", "comprovar nuevas conversaciones");
                $.ajax({
                    url: "../controlador/chats.php",
                    type: "POST",
                    data: paqueteDeDatos,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (result) {
//                        console.log("comprovar nuevas conversaciones < ?php echo $user->getId(); ?>");
                        $("#contresultadost").html(result);
                    },
                    error: function (e) {
                        console.log("falla al comprovar mensajes sin leer " + e);
                        //                            $("#contresultados").append("ha ocurrido un Error al verificar mensajes sin leer");
                    }
                });
                //                                    alert('fin');
            }, 7000);
        </script>
    </body>
</html>
