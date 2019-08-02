<?php 
	include "../../controlador/conBD.php";
//	include "funciones.php";
        include '../../modelo/Usuario.php';
        
        if($_FILES['Imagen']['size']> 2000000){
            echo 'La imagen pesa más de 2MB';
            exit;
        }
        
        $dir = "imgtemporales/";
        $nombre_archivo = $_FILES['Imagen']['name'];
        /* esta parte es la que me genera el error */
        if(!move_uploaded_file($_FILES['Imagen']['tmp_name'], $dir.$nombre_archivo)){
            echo 'Error en la subida del archivo';
            exit;
        }
        
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
    <title>Publicación Exitosa</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/logo.jpg">
    <link rel="stylesheet" href="css/estiloblogg.css">
    <link rel="stylesheet" href="css/estiloss.css">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>   
    <script src="http://code.jquery.com/jquery-latest.js"></script>

</head>

<body>

    <div class="fondo">
        
        <div class="container">
            <?php

            if (isset($_POST['guardar'])) {
		$connect = conBD::conectar();
			$query = mysqli_query($connect, "INSERT INTO blog (Titulo, articulo, Fecha, Imagen, selecategoria, idusuario) values ('".$_POST['titulo']."','".$_POST['articulo']."', NOW(),'".$dir.$nombre_archivo."', '".$_POST['selecategoria']."','".$user->getId()."') ");

		if ($query) {
			echo "<p>El artículo se ha publicado exitosamente</p>";
		}else{
			echo "El artículo no se ha podido publicar";
		}
	}

            ?>
            <br>
            <a href="agregarnoticia.php">Ir al Formulario</a> <a href="blog.php"> Ir a Mi Blog</a>
        </div>
    </div>

</body>
</html>
<?php            mysqli_close($connect); ?>
