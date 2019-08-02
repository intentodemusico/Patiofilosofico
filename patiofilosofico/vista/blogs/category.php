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
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categorías</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/logor.jpg">
    <link rel="stylesheet" href="css/noticiacompletas.css">

    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/estiloss.css">


    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>   
    <script src="http://code.jquery.com/jquery-latest.js"></script>

</head>

<style>
    
     .nombre{
            position: absolute;
            color: white;
            font-family: 'arial narrow';
            font-size: 120%;
            width: 20%;
            left: 78%;
            top: 20px;
            font-weight: bold;
            text-align: center;
        }
        
        .nombres{
            position: absolute;
            color: white;
            font-family: 'arial narrow';
            font-size: 100%;
            width: 20%;
            text-align: center;
            left: 78%;
            top: 45px;
        }
    
    .img-peq{
        position: absolute;
        right: 0px;
        top: 20px;
        width: 220px;
        height: 200px;
    }
    
    .eliminar img{
        position: relative;
       width: 30px;
       left: 10px;
    }
</style>

<body>
 
<div class="roww">
   
    <h1>BLOG EL PATIO FILOSÓFICO</h1>  

    <a href=""><img src="imagenes/logo.png" class="dos"></a>

</div>

<header>
    
     <?php
    $connect = conBD::conectar();
    
    $querys = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario = ".$user->getId());
    while ($rowt= mysqli_fetch_array($querys))
    {
    ?>
    <div class="fondo1">
            <h1>ARTÍCULO</h1>
            
        <h3 class="nombre"><img src="Imagenes/kk.png" ><?php echo $rowt['nombre']; ?></h3>
        <h3 class="nombres"><?php echo $rowt['tipo_usuario']; ?></h3>
    </div>

    <?php
    }
    ?>
</header>

    <?php
           $query = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario= ".$user->getId());
               while($row= mysqli_fetch_array($query))
               {
    ?>

                    <div id="container">
                        <nav class="navegacion">
                            <ul class="menus">
                               <li> <a href="../index.php"><img src="Imagenes/ini.png">Inicio</a></li>
                               <li> <a href="blog.php?idusuario=<?php echo $row['idusuario'];?>"><img src="Imagenes/lb.png">Blog</a></li>
                               <li> <a href="agregarnoticia.php?idusuario=<?php echo $row['idusuario'];?>"><img src="Imagenes/nuv.png">Nueva Entrada</a></li>
                               <li> <a href="categorias.php?idusuario=<?php echo $row['idusuario'];?>"><img src="Imagenes/cat.png">Agregar Categoría</a></li>

                            </ul>
                        </nav>
                    </div>

         <?php
    }
    ?> 

<div class="row">
    
    <div class="col-xs-12 col-sm-3 col-md-3">
        
        <?php
                 require 'subcategorias.php';
        ?>

    </div>
    
    <div class="col-xs-12 col-sm-9 col-md-9 >
         
        <?php
          $nombrecat = mysqli_query($connect, "SELECT * FROM categorias WHERE idcategorias = '".$_GET['id']."' AND idusuario= ".$user->getId()." ");
          while($roww= mysqli_fetch_array($nombrecat))
            {
        ?>  
                
                <h5 class="secondo">Categoría: <?php echo $roww['categoria']; ?></h5>
                <br>
           
        <?php
            }
        ?>
        
         <?php
        if(isset($_GET['id'])){
        
            $query = mysqli_query($connect, "SELECT * FROM blog WHERE selecategoria = '".$_GET['id']."' AND idusuario= ".$user->getId());
            while($row= mysqli_fetch_array($query))
            {
             
               ?>

               <?php 
                    $cont = mysqli_query($connect, "SELECT * FROM comentarios WHERE not_id = '".$row['id']."'");
                    $contar = mysqli_num_rows($cont);
               ?>

            <a href="noticiacompleta.php?id=<?php echo $row['id']; ?>"><h2 class="primo"><?php echo $row['Titulo']; ?></h2></a>

            <p><?php echo $row['Fecha']; ?></p>

            <div class="contenido">                
                <div class="row">             
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <img class="img-peq" src="<?php echo $row['Imagen']; ?>" >
                    </div>
                    
                    <div class="col-xs-12 col-sm-9 col-md-9">
                        <div class="contenido">
                            <p class="letra"><?php echo $row['articulo']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
             <?php
            $sql =" select count(*) as num from megusta where id_blog = ".$row['id'];
            $num = mysqli_query($connect, $sql);
            $arr = mysqli_fetch_assoc($num);
            ?>


            <hr class="linea">
            
            
            <div class="opciones">
	        <a href="noticiacompleta.php?id=<?php echo $row['id']; ?>" class="leer" ><?php echo "Leer más..."; ?></a>  
                <a href="eliminarArticulo.php?id=<?php echo $fila['id']; ?>" class="eliminar" ><img src="imagenes/Eliminar.png" title="Eliminar"></a>
                <form method="POST" action="../../controlador/blogg.php" onsubmit="envioFormulario(this, 'contenedorPrincipal', true); return false">
                    <input type="hidden" name="oper" value="megusta">
                    <input type="hidden" name="idblog" value="<?php echo $row['id']; ?>">
                                              
                    <a onclick="$(this).parent().submit()" id="megusta_<?php echo $rows['id']; ?>" href="" class="gusta"><img src="imagenes/gusta.png" title="Me gusta">(<?php echo $arr['num']; ?>)</a>
                    
	        </form>
                <div class="coment"><img src="imagenes/comentarioss.png" title="Comentarios"> (<?php echo $contar; ?>)</div>
            </div>

            <hr class="linea">
             <br/> 

        <?php            
        } 
        }
        ?>

    </div>

</div>
    
<?php
    require 'footer.php';
?>