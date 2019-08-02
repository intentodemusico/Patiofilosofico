
<?php 
	include '../../modelo/Usuario.php';
        include "cn.php";
	include "funciones.php"; 
//      include '../../controlador/conBD.php';
        
       
        
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
    <title>Categorías "El Patio Filosófico"</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/logor.jpg">
    <link rel="stylesheet" href="css/bloggsgs.css">
    <link rel="stylesheet" href="css/categoriyy.css">
    <link rel="stylesheet" href="css/estiloss.css"> 

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>   
    <script src="http://code.jquery.com/jquery-latest.js"></script>

</head>

<body>
 
<div class="row">
    <a href=""><img src="imagenes/logo.png" class="dos"></a>
</div>
    
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
        
        .menus li a img{
           width: 40px;
        }
    </style>

 <?php 
    $querys = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario = ".$user->getId());
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

<div class="main row">
    <div class="iblog">     
        <img src="imagenes/logo.png" alt="Filosofia y enseñanza de la filosofia" class="uno" >
    </div>

    <?php
         $query = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario= ".$user->getId());
               while($row= mysqli_fetch_array($query))
               {
    ?>

                <div id="container">
                    <nav class="navegacion">
                        <ul class="menus">
                            <li> <a href="../index.php"><img src="Imagenes/ini.png" width="30px">Inicio</a></li>
                            <li> <a href="blog.php?idusuario=<?php echo $row['idusuario'];?>"><img src="Imagenes/lb.png">Blog</a></li>
                            <li> <a href="agregarnoticia.php?idusuario=<?php echo $row['idusuario'];?>"><img src="Imagenes/nuv.png">Nueva Entrada</a></li>
                            <li> <a href="categorias.php?idusuario=<?php echo $row['idusuario'];?>"><img src="Imagenes/cat.png">Agregar Categoría</a></li>

                        </ul>
                    </nav>
                </div>

         <?php
    }
    ?>
</div>

<h3 class="titulo">AGREGAR CATEGORÍA</h3>
<hr class="linea">

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <form name="form1" id="form1" action="" method="POST">
            <div class="form-group">
                <label for="exampleInputFile" class="cate">Nombre Categoría</label>
              <br>
              <input type="text" id="exampleInputFile" class="cat" placeholder="Escriba el nombre de la categoría" name="nombrecategoria" required>
            </div>
           
            <button type="submit" class="btn btn-primary" name="agregar">Agregar</button>
        </form>
        
        <?php
            if(isset($_POST['agregar'])) {
                $query = mysqli_query($connect, "INSERT INTO categorias (categoria, idusuario) values ('".$_POST['nombrecategoria']."','".$user->getId()."') ");
                
                if($query) {
                    echo "La categoría ha sido insertada correctamente";
                }else{
                    echo 'La categoría NO se agregó correctamente';
                }
            }
        ?>
        
        <br>
        <br>
        
        <h2>Mis categorías</h2>
        
        <?php
//        include "cn.php";
        $category = mysqli_query($connect, "SELECT * FROM categorias WHERE idusuario= '".$_GET['idusuario']."' ");
        while ($cat= mysqli_fetch_array($category))
        {  
            
            if($user->getId()== $_GET['idusuario'])
            {

        ?>    
      
        <div class="lista_categorias">
            <?php echo $cat['categoria']; ?>
            <a href="eliminarCategoria.php?idcategorias=<?php echo $cat['idcategorias']; ?>" ><img src="imagenes/eliminar2.png" title="Eliminar"></a>
        <br>            
        </div>
   
        <?php
            }else{
                echo 'No hay categorías creadas para este usuario';
            }
        }
        ?>
        <br>
        <br>
        <a href="blog.php" class="btn btn-dark" >Ir al Blog</a>

    </div>
    
</div>

<?php
require 'footer.php';
?>

<?php            mysqli_close($connect); ?>