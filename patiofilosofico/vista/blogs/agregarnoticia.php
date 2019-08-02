<?php
include '../../modelo/Usuario.php';
include '../../controlador/conBD.php';

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
    <title>Nueva entrada</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/logor.jpg">
    <link rel="stylesheet" href="css/estiloblogg.css">
    <link rel="stylesheet" href="css/bloggsgs.css">
    
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/estiloss.css">

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>   
        <script src="http://code.jquery.com/jquery-latest.js"></script>

    </head>

    <body>
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
        
        .container p{
            top: 0px;
            width: 70%;
            margin: 0px 0px 40px 0px;
        }
    </style>
</header>   
</div>

<?php
    $connect = conBD::conectar();
    
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

<div class="row">
    <div class="iblog">     
        <img src="imagenes/logo.png" alt="Filosofia y enseñanza de la filosofia" class="uno" >
    </div>

    <?php
    
        $connect = conBD::conectar();
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
</div>
        
        <h3 class="titulo">NUEVO ARTÍCULO</h3>
        <hr class="linea">

        <div class="container">

	<p>En este formulario, puede agregar artículos de entrada para el Blog. Este formulario es exclusivo para ingresar 
            información solamente para el blog y no permite entradas dirigidas a otras partes del portal educativo. </p>
        
            <form action="transacciones.php" method="POST" enctype="multipart/form-data" name="form1">
                <table >
                    
                    <div class="form-group">
                        <label for="disabledSelect">Seleccionar Categoría *</label>
                        <select id="disabledSelect" class="form-control" name="selecategoria" placeholder="Selecciona una categoría" >
                            
                            <?php 
                                include "cn.php";
//                                  include '../../controlador/conBD.php';
                             ?>
                             <?php
                                    $category = mysqli_query($connect, "SELECT * FROM categorias WHERE idusuario= '".$user->getId()."'");
                                    while ($cat= mysqli_fetch_array($category))                                            
                                    { ?> 
                            
                                <option value="<?php echo $cat['idcategorias' ]; ?>"><?php echo $cat['categoria' ]; ?></option>
                                    <?php
                                    }
                                    ?>
                        </select>
                    </div>
                    <tr>
                        <td>Título*
                            <label for="titulo"></label></td>
                        <td><input type="text" name="titulo" id="titulo" class="tituloo" placeholder="Escribe el título del Artículo" required></td>
                    </tr>
                    <tr><td>Contenido* 
                            <label for="area_comentarios"></label></td>
                        <td><textarea name="articulo" id="ckeditor" class="ckeditor" placeholder="Escribe el cuerpo del Artículo..." required></textarea></td>
                    </tr>
                    <input type="hidden" name="MAX_TAM" value="2097152">                    
                    <td>Imagen<label for="imagen"></label></td>
                    <td><input type="file" name="Imagen" id="imagen" class="imagen" ></td>

                    <tr>  <td colspan="2" align="center"><input type="submit" name="guardar" class="btn btn-primary" value="Publicar Artículo"></td></tr>
                    <tr><td colspan="2" align="center"><a href="blog.php" class="tras">Página de visualización del blog</a></td></tr>

                </table>
            </form>

</div>
        <?php mysqli_close($connect); ?>
<?php
 require 'footer.php';
?>
