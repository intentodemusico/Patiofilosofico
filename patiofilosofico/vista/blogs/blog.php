
<?php 
//	include "cn.php";
	include "funciones.php";
        include '../../controlador/conBD.php';
	include '../../modelo/Usuario.php';
        
        session_start();
$p = $_POST;
$s = $_SESSION;
$user = new Usuario();
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);



$err = isset($_GET['error']) ? $_GET['error']: null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog "El Patio Filosófico"</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/logor.jpg">
    <link rel="stylesheet" href="css/bloggsgs.css">
    <link rel="stylesheet" href="css/estiloss.css">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>   
    <script src="http://code.jquery.com/jquery-latest.js"></script>
 

</head>

<body>
<?php 
$idUserBlog = $_GET["idusuario"];
 $sentencia = "SELECT * FROM usuario WHERE idusuario = ".$idUserBlog;//$user->getId();

?>
<div class="row">
    <a href=""><img src="imagenes/logo.png" class="dos" ></a>

    
<header>
    <style>
        .nombre{
            position: absolute;
            color: white;
            font-family: 'arial narrow';
            font-size: 120%;
            width: 25%;
            left: 75%;
            top: -70px;
            font-weight: bold;
        }
        
        .nombres{
            position: absolute;
            color: white;
            font-family: 'arial narrow';
            font-size: 100%;
            width: 24%;
            left: 76%;
            top: -48px;
        }
        
        .img-peq{
            position: absolute;
            right: -60px;
            width: 100px;
            height: 200px;
        }
    </style>
</header>   
</div>
    
     <?php
     

    $connect = conBD::conectar();
   
   
    $querys = mysqli_query($connect,$sentencia );
    while ($rowt= mysqli_fetch_array($querys))
    {
    ?>

<div class="fontello">   
    <section class="titulos">
        <h2> Blog Filosófico </h2>
        <p>Publica artículos filosóficos que despierten el interés de la comunidad</p>
        
        <h3 class="nombre"><img src="Imagenes/kk.png" ><?php echo $rowt['nombre']; ?></h3>
        <h3 class="nombres"><?php echo $rowt['tipo_usuario']; ?></h3>
    </section>

</div>
    <?php
    }
    ?>
<div class="row">
    <div class="col-xs-12 col-sm-3 col-md-3">     
        <img src="imagenes/logo.png" alt="Filosofia y enseñanza de la filosofia" class="uno" >
    </div>

    
    <?php
    if ($user->getId()== $user->getId()) {
            $connect = conBD::conectar();
               $query = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario= ". $idUserBlog); //->getId());  //Obteniendo id del usuario de sesión y no del 
               //dueño del post
            while($row= mysqli_fetch_array($query))
            {
    ?>


<div id="container">
    <nav class="navegacion">
        <ul class="menus">
            <li> <a href="../index.php"><img src="Imagenes/ini.png">Inicio</a></li>
            <li> <a href="blog.php?idusuario=<?php echo $row['idusuario'];?>"><img src="Imagenes/lb.png">Blog</a></li>
            <?php if ($user->getId()== $idUserBlog) { //el logeado es el dueño del post -> puede gestionar el blog ?> 
                <li> <a href="agregarnoticia.php?idusuario=<?php echo $row['idusuario'];?>"><img src="Imagenes/nuv.png">Nueva Entrada</a></li>
                <li> <a href="categorias.php?idusuario=<?php echo $row['idusuario'];?>"><img src="Imagenes/cat.png">Agregar Categoría</a></li>
            <?php }?>
        </ul>
    </nav>
</div>

        <?php
        }            
    }else{
          
          if($user->getId()>= 0){

          ?>
            <div id="header">
            <nav class="navegacion">
                <ul class="menus">          
                    <li> <a href="../index.php"><img src="Imagenes/ini.png">Inicio</a></li>
                </ul>
            </nav>
            </div>
    <?php
          }
      }
    ?>
</div>

<h3 class="titulo">ARTÍCULOS</h3>
<hr class="lineas">



<div class="row">
    
    
    <div class="col-xs-12 col-sm-3 col-md-3">
        <?php
                 require 'subcategorias.php';
        ?>
      
    </div>

    <div class="col-xs-12 col-sm-9 col-md-9">
        <p class="categ"> Todos los artículos</p>
        <article class="main"> 
           
 
                <?php 
                    $connect = conBD::conectar();
                    $por_pagina = 5;

                        if (isset($_GET['pagina'])) {
                                $pagina = $_GET['pagina'];
                        }else{
                                $pagina = 1;
                        }

                        //la pagina inicia en 0 y se multiplica $por_pagina

                        $empieza = ($pagina-1)* $por_pagina;

                        //seleccionar los registros de la tabla usuarios con LIMIT

        //                $query = "SELECT * FROM blog LIMIT $empieza, $por_pagina";
        //                $resultado = mysqli_query($connect, $query);

                ?>

                <?php

                    $noticia = mysqli_query($connect, "SELECT * FROM blog WHERE idusuario='".$idUserBlog."' ORDER BY Fecha DESC");
                        while ($fila = mysqli_fetch_assoc($noticia)) {

                 ?>

                <?php 

                $cont = mysqli_query($connect, "SELECT * FROM comentarios WHERE not_id = '".$fila['id']."'");
                $contar = mysqli_num_rows($cont);
                
                 $megusta = mysqli_query($connect, "SELECT COUNT (*) FROM megusta WHERE id_blog = '".$fila['id']."'");

                ?>
        <div>
            <a href="noticiacompleta.php?id=<?php echo $fila['id']; ?>"><h2 class="primo"><?php echo $fila['Titulo']; ?></h2></a>        
            <p><?php echo $fila['Fecha']; ?></p>
            
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <img class="img-peq" src="<?php echo $fila['Imagen']; ?>" >
                </div>
                
                <div class="col-xs-12 col-sm-9 col-md-9">
                    <div class="contenido">
                    <p class="letra"><?php echo $fila['articulo']; ?></p>
                    </div>
                </div>
            </div>
            <?php
            $sql =" select count(*) as num from megusta where id_blog = ".$fila['id'];
            $num = mysqli_query($connect, $sql);
            $arr = mysqli_fetch_assoc($num);
            ?>
            <?php
             $query = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario= ".$idUserBlog);//$user->getId()); ESTABA LLAMANDO AL USUARIO 
            //DE LA SESIÓN Y NO AL PROPIETARIO DEL BLOG
            //VIGILE LOS NOMBRES DE LAS VARIABLES Y LA SINTAXIS
            //LA IDENTACIÓN ES IMPORTANTE PARA LA MÁS FÁCIL LECTURA DE CÓDIGO
            while($rowk= mysqli_fetch_array($query))
            {
            ?>
            <hr class="linea">
            
            <div class="opciones">
                <a href="noticiacompleta.php?id=<?php echo $fila['id'] ?>" class="leer" ><?php echo "Leer más..."; ?></a> 
                <?php if ($user->getId()== $idUserBlog) { //el logeado es el dueño del post -> puede gestionar el blog ?> 
                <a href="eliminarArticulo.php?id=<?php echo $fila['id']; ?>" ><img src="imagenes/Eliminar.png" title="Eliminar"></a>
                <?php } ?>
                <form method="POST" action="../../controlador/blogg.php" onsubmit="envioFormulario(this, 'contenedorPrincipal', true); return false">
                    <input type="hidden" name="oper" value="megusta">
                    <input type="hidden" name="idblog" value="<?php echo $fila['id']; ?>">
                    
                    <a onclick="$(this).parent().submit()" id="megusta_<?php echo $fila['id']; ?>" href="blog.php?idusuario=<?php echo $rowk['idusuario'];?>" class="gusta"><img src="imagenes/gusta.png" title="Me gusta">(<?php echo $arr['num']; ?>)</a> 
	        <?php
               }
               ?>
                </form>
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

                    echo "<a href='blog.php?pagina=1'>".' Primera '."</a>";

                    for ($i= 1; $i<=$total_paginas; $i++) { 
                            echo "<a href='blog.php?pagina= " .$i. "'>" .$i. "</a>";
                    }

                    //link a la ultima página

                    echo "<a href= 'blog.php?pagina=$total_paginas'>".' Última '."</a>";

                     ?>
            </div>
         
</div>

        </article>

    </div>

    
</div>
<script src="../js/funcionesGenerales.js"></script>

<?php
require 'footer.php';
?>
<?php mysqli_close($connect); ?>
