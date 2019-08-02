<?php 
	include "../../controlador/conBD.php";
//        include 'cn.php';
	include "funciones.php";
        
        include '../../modelo/Usuario.php';
        
        session_start();
$p = $_POST;
$s = $_SESSION;
$user = new Usuario();
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);
        
        $connect = conBD::conectar();
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artículo Blog</title>
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

    <div class="col-xs-12 col-sm-9 col-md-9">

      <?php 

	if (isset($_GET['id'])) {
		
            $query = mysqli_query($connect, "SELECT * FROM blog WHERE id = '".$_GET['id']."'");

            while ($row=mysqli_fetch_array($query)) {

            ?>
            <div class="info">
                <h1><?php echo $row['Titulo']; ?></h1>
                <?php echo $row['Fecha']; ?>
                <br/>
                <br/>
                <div class="centro"> <img class="img-noticia" src="<?php echo $row["Imagen"]; ?>"  ></div>
                <p><?php echo $row['articulo']; ?></p>
                        <br/>
                        
                        <?php
                        $queryt = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario= ".$user->getId());
                            while($rowe= mysqli_fetch_array($queryt))
                            {
                        ?>
                        <a href="blog.php?idusuario=<?php echo $row['idusuario'];?>"><?php echo "Volver a Mi Blog"; ?></a>
                        <br/> <br/>
                
		<?php 
                            }
			}
		?>
                    <form id="form1" name="form1" method="post" action="">

                            <h4><label for="textfield">Deja tu comentario</label></h4>

                            <p><textarea name="comentario" cols="90" rows="4" id="textfield" required></textarea></p>

                            <p><input type="submit" class="btn btn-primary" name="guardar" value="Comentar" /></p>

                    </form>
                    <br/>
                    <?php 
                        if (isset($_POST['guardar'])) {

                            $insert = mysqli_query($connect, "INSERT INTO comentarios (comentario, not_id, usuario) values ('".$_POST['comentario']."','".$_GET['id']."','".$user->getNombre()."')"); 

                            if ($insert) { echo "El comentario se ha agregado";}
                            else{
                                echo 'El comentario NO se agregó';}
                        }

                    ?>
                    <div class="letreros">
                        <img src="imagenes/comentarioss.png"><span><h4>Comentarios:</h4></span>
                    </div>

            </div>	
            <?php 

            $coment = mysqli_query($connect, "SELECT * FROM comentarios WHERE not_id = '".$_GET['id']."' ORDER BY id DESC");

            while ($com=mysqli_fetch_array($coment)) {
                    ?>
        <p class="comentarios"><img src="Imagenes/jk.png" width="55px"><label class="text-info "><?php echo $com['usuario']; ?>: </label> <?php echo $com['comentario']; ?></p>
                    <hr class="separador">
                    <hr class="separador">
                    <?php  
            }
                    ?>
		<?php 
			}
		?>
    </div>

</div>

<?php
            require 'footer.php';
?>
