<?php
//	include "cn.php";
include "funciones.php";
include '../../controlador/conBD.php';
include '../../modelo/Usuario.php';
?>
<!DOCTYPE html>
<html lang="esp">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Blog "El Patio Filosófico"</title>
        <link rel="shortcut icon" type="image/x-icon" href="blogs/imagenes/logor.jpg">
        <link rel="stylesheet" href="blogs/css/blogss.css">
        <link rel="stylesheet" href="blogs/css/estiloss.css">
        <!--<link href="../css/menuInicio.css" rel="stylesheet" type="text/css"/>-->

        <link rel="stylesheet" type="text/css" href="blogs/css/bootstrap.min.css">
        <script type="text/javascript" src="blogs/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="blogs/js/jquery-3.3.1.min.js"></script>   
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!--<link href="../pluging/bootstrap4/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
        <!--<link href="../pluging/fontawesome-free-5.3.1-web/css/all.min.css" rel="stylesheet" type="text/css"/>-->
        <!--<script src="../js/funcionesGenerales.js" type="text/javascript"></script>-->
        <style>
            #menu-superior{
                display: none;
            }
            #imgBanner{position: relative;
                       top: -30px;
                       background-image: url(../imagenes/mod2.png);
                       background-size: cover;
                       background-position: center center;
                       width: 100%;
                       height: 325px;}
            .navegacion {
                position: relative;
                top: -44px;
                width: 200%;
                padding: 6px 0px;
                border-radius: 5px;
                text-align: center;
                box-shadow: rgb(193, 194, 196) 2px 2px 2px 2px;
            }
        </style>
    </head>

    <body>
        <!--        <div class="row">
                    <a href=""><img src="imagenes/logo.png" class="dos" ></a>
        
                    <h1>BLOG EL PATIO FILOSÓFICO</h1>
                    <header>
        
                    </header>   
                </div>-->
        <script>
            $("#imgBanner").css("background-image", "imagenes/logo.png");
            $("#tituloBanner").html("Blog Filosófico");
            $("#textoBanner").html("Publica artículos filosóficos que despierten el interés de la comunidad");

        </script>
        <!--        <div class="fontello">
        
                    <section class="titulos">
                        <h2> Blog Filosófico </h2>
                        <p>Publica artículos filosóficos que despierten el interés de la comunidad</p>
                    </section>
        
                </div>-->

        <div class="row">
            <div class="iblog">     
                <img src="imagenes/logo.png" alt="Filosofia y enseñanza de la filosofia" class="uno" >
            </div>

            <?php
            require 'navegacion.php';
            ?>
        </div>

        <div id="contenedorBlog">

            <h3 class="titulo">ARTÍCULOS</h3>
            <hr class="linea">

            <p class="categ"> Todos los artículos</p>

            <div class="row">

                <div class="col-xs-12 col-sm-3 col-md-3">
                    <?php
                    require 'subcategorias.php';
                    ?>

                </div>

                <div class="col-xs-12 col-sm-9 col-md-9">

                    <article class="main"> 

                        <?php
                        $connect = conBD::conectar();
                        $por_pagina = 5;

                        if (isset($_GET['pagina'])) {
                            $pagina = $_GET['pagina'];
                        } else {
                            $pagina = 1;
                        }

                        //la pagina inicia en 0 y se multiplica $por_pagina

                        $empieza = ($pagina - 1) * $por_pagina;

                        //seleccionar los registros de la tabla usuarios con LIMIT

                        $query = "SELECT * FROM blog LIMIT $empieza, $por_pagina";
                        $resultado = mysqli_query($connect, $query);
                        ?>

                        <?php
                        $noticia = mysqli_query($connect, "SELECT * FROM blog ORDER BY Fecha DESC");

                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>

                            <?php
                            $cont = mysqli_query($connect, "SELECT * FROM comentarios WHERE not_id = '" . $fila['id'] . "'");
                            $contar = mysqli_num_rows($cont);
                            ?>
                            <div>
                                <a href="noticiacompleta.php?id=<?php echo $fila['id']; ?>"><h2 class="primo"><?php echo $fila['Titulo']; ?></h2></a>        
                                <p><?php echo $fila['Fecha']; ?></p>
                                <div class="contenido">
                                    <p class="letra"><?php echo $fila['articulo']; ?></p>
                                </div>

                                <hr class="linea">
                                <div class="opciones">
                                    <a href="noticiacompleta.php?id=<?php echo $fila['id']; ?>" class="leer" ><?php echo "Leer más..."; ?></a>  
                                    <a href="megusta.php?n=si&id=<?php echo $fila['id']; ?>" class="gusta"><img src="imagenes/gusta.png" title="Me gusta">(<?php ?>)</a> 
                                    <div class="coment"><img src="imagenes/comentarioss.png" title="Comentarios"> (<?php echo $contar; ?>)</div>
                                </div>
                                <hr class="linea">
                                <br/> 
                                <hr>
                                <?php
                            }
                            ?>

                            <div class="paginacion">
                                <?php
                                //seleccionar todo sobre la tabla de blog

                                $query = "SELECT * FROM blog";

                                $resultado = mysqli_query($connect, $query);

                                //contar el total de registros

                                $total_registros = mysqli_num_rows($resultado);

                                //usando ceil para dividir el total de registros entre $por_pagina

                                $total_paginas = ceil($total_registros / $por_pagina);

                                // link a la primera página

                                echo "<a href='blog.php?pagina=1'>" . ' Primera ' . "</a>";

                                for ($i = 1; $i <= $total_paginas; $i++) {
                                    echo "<a href='blog.php?pagina= " . $i . "'>" . $i . "</a>";
                                }

                                //link a la ultima página

                                echo "<a href= 'blog.php?pagina=$total_paginas'>" . ' Última ' . "</a>";
                                ?>
                            </div>

                        </div>

                    </article>

                </div>


            </div>
        </div>

        <?php
//        require 'footer.php';
        ?>
        <?php mysqli_close($connect); ?>

