<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Tareas</title>

    <link rel="shortcut icon" type="image/x-icon" href="imagenes/logor.png">
    <link rel="stylesheet" href="css/tareass.css" type="text/css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/estilos.css">

     <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>   
    <script src="http://code.jquery.com/jquery-latest.js"></script> 

</head>
<body>

    <div class="logo">
    <img src="imagenes/logo1.png" alt="Filosofia y enseñanza de la filosofia" width="80px">
    <div class="slogan">
        <h4>Filosfofía y Enseñanza de la Filosofía</h4>
        <h2>FiloEn</h2>
    </div>
</div>

<header>
    <div class="fondo2">
            <h1>LISTA DE TAREAS</h1>

            <div class="boton">
            <nav class="navegacion2">
                <ul class="menu2">
                    <li><a href="inicioEst.php"> <img src="imagenes/inicio2.png" alt="" title="Inicio" width="30px" height="30px"></a></li>
                    <li><a href=""> <img src="imagenes/Opcionesb.png" alt="Opciones" title="Opciones" width="30px" height="30px"></a>
                <ul class="submenu2">
                    <li><a href=""> <span><img src="imagenes/mensajes2.png" width="20px" height="20px"></span> Mensajes</a></li>
                    <li><a href=""> <span><img src="imagenes/solicitud.png" width="20px" height="20px"></span> Solicitudes de Amistad</a></li>
                    <li><a href=""> <span><img src="imagenes/Sgrupo.png" width="20px" height="20px"></span> Solicitudes de Grupo</a></li>
                    <li><a href=""> <span><img src="imagenes/anuncio.png" width="20px" height="20px"></span> Crear un Anuncio</a></li>
                    <li><a href="tareas.php"> <span><img src="imagenes/tareas.png" width="20px" height="20px"></span> Tareas</a></li>
                    <li><a href=""> <span><img src="imagenes/privacidad2.png" width="20px" height="20px"></span> Privacidad</a></li>
                    <li><a href=""> <span><img src="imagenes/config.png" width="20px" height="20px"></span> Configuración</a></li>
                    <li><a href=""> <span><img src="imagenes/problema2.png" width="20px" height="20px"></span> Reportar un Problema</a></li>
                </ul>
                    </li>
                    <li><a href=""> <img src="imagenes/mensajes.png" alt="" title="Chat" width="30px" height="30px"></a></li>
                    <li><a href=""> <img src="imagenes/notificaciones.png" alt="" title="Notificaciones" width="30px" height="30px"></a></li>
                    <li><a href="index.php"> <img src="imagenes/salirb.png" class="salir" alt="Cerrar Sesión" title="Cerrar Sesión" width="30px" height="30px"></a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>                            

 <div id="header">
    <nav class="navegacion">
        <ul class="menus">
            <li> <a href="inicioEst.php"><span><img src="Imagenes/home.png" alt="" width="20px"></span> Inicio</a></li>
            <li> <a href="MuroYPerfEstud.php">Mi Perfil</a></li>
            <li> <a href="#">Nuestra Gente <span class="icon icon-angle-down"></span></a>
        <ul class="submenu">
            <li> <a href="#">Perfiles</a></li>
            <li> <a href="">Comunidad</a></li>
            <li> <a href="Informate_comp.php">Infórmate</a></li>
            <li> <a href="acercaFiloEn_Comp.php">Acerca de FiloEn</a></li>
        </ul> 
    </li>
    <li> <a href="#">Herramientas <span class="icon icon-angle-down"></span></a>
        <ul class="submenu">
            <li> <a href="#">Figuras Retóricas</a></li>
            <li> <a href="http://filosofiayensenanza.uis.edu.co:8080/bibliotecadigitalfiloen">Biblioteca</a></li>
        </ul>
    </li>
    <li> <a href="">Actualidad <span class="icon icon-angle-down"></span></a>
        <ul class="submenu">
            <li> <a href="noticias.php">Noticias</a></li>
            <li> <a href="eventos.php">Eventos</a></li>
        </ul>
    </li>

    <li> <a href="">Aplicaciones <span class="icon icon-angle-down"></span></a>
        <ul class="submenu">
            <li> <a href="foros.php">Crear Foro</a></li>
            <li> <a href="MisGrupos.php">Crear Grupo</a></li>
            <li> <a href="MiBlog.php">Mi Blog</a></li>
            <li> <a href="#">Solicitudes</a></li>
        </ul>
    </li>

    <li> <a href="">Participa <span class="icon icon-angle-down"></span></a>
        <ul class="submenu">
            <li> <a href="foros.php">Foros</a></li>
            <li> <a href="comunidad.php">Grupos Comunidad</a></li>
            <li> <a href="#">Conferencias</a></li>
        </ul>
    </li>

    <li> <a href="contactenos_Comp.php">Contáctenos</a></li>
    </ul>
    </nav>
</div>

<h2 class="titulo1">Lista de Tareas</h2>

    <hr class="linea">

<div class="container">
    <div class="wrap">
        <form class="formulario" action="" method="POST">
            <input type="text" id="tareaInput" placeholder="Agrega tu tarea">
            <input type="button" class="boton" id="btn-agregar" value="Agregar Tarea">
        </form>
    </div>
</div>

<div class="main">
    <div class="tareas">
    <div class="wrap">
        <ul class="lista" id="lista">
            <li><a href="#">Aprender Filosofía con el portal FiloEn <span class="eliminar" id="quitarTarea">Eliminar</span></a></li>
        </ul>
    </div>
</div>
<script src="js/tareas.js"></script>
</div>

<br>
<br>

<?php
require 'blogs/footer.php';
?>