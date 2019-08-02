<?php
require '../funcs/conexion.php';
include '../funcs/funcs.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/logo.jpg">
    <link rel="stylesheet" href="css/estilobloggs.css">
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
                $usuario = $mysqli->real_escape_string($_POST['usuario']);
                $token = $mysqli->real_escape_string($_POST['token']);

                $password = $mysqli->real_escape_string($_POST['password']);
                $con_password = $mysqli->real_escape_string($_POST['con_password']);

                if(validaPassword($password, $con_password))
                  {
                    $pass_hash = hashPassword($password);

                    if(cambiaPassword($password, $usuario, $token))
                     {
                        echo "La contraseña ha sido modificada correctamente";
                        echo "<br> <a href='../vista/index.php'>Inicio </a> " ;
                    }
                    else{
                        echo 'Error al modificar la contraseña';
                    }

                }else{
                    echo 'Las contraseñas no coinciden';
                }

            ?> 
        </div>
    </div>

</body>
</html>

