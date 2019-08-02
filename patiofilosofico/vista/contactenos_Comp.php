

<!DOCTYPE html>
<!--<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contáctenos "El Patio Filosófico"</title>

    <link rel="shortcut icon" type="image/x-icon" href="imagenes/logo2.png">
    <link rel="stylesheet" href="css/contactenos_Regs.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/estilos.css">


    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>   
    <script src="http://code.jquery.com/jquery-latest.js"></script> 

</head>
<body>

<div class="logo">
    <img src="imagenes/logo.jpeg" alt="Filosofia y enseñanza de la filosofia">
</div>-->
    
     <?php
//        if (isset($_POST['enviar'])){
//            
//            $campo_nombre = $_POST["nombre"];
//            $campo_email = $_POST["correo"];
//            $campo_asunto = $_POST["asunto"];
//            $campo_mensaje = $_POST["mensaje"];
//                
//            $para = "ferramirezalbarracin@gmail.com";
//            $asunto = "Formulario de contacto El Patio Filosófico";
//            $mensaje = "<h2> Formulario enviado desde el Portal El Patio Filosófico </h2> <br>";
//            $mensaje .= "<b>Nombre</b>: $campo_nombre <br> ";
//            $mensaje .= "<b>E-mail</b>: $campo_email <br> ";
//            $mensaje .= "<b>Asunto</b>: $campo_asunto <br> ";
//            $mensaje .= "<b>Mensaje</b>: $campo_mensaje <br> ";
//            
//            
//            $cabeceras = "From: ferramirezalbarracin@gmail.com\r\n";
//            $cabeceras .= "Replay-To: ferramirezalbarracin@gmail.com\r\n";
//            $cabeceras .= "MINE-Version: 1.0\r\n";
//            $cabeceras .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//            
//            mail($para, $asunto, $mensaje, $cabeceras);
//        
//        }
    ?>
        <h3 class="titulo">IMPORTANTE</h3>
    <hr class="linea">

<div class="container">

    <div class="col-md-12">

        <p class="buzon">Por medio del buzón de sugerencias ayudará a mejorar los servicios de nuestro portal con 
            sus opiniones. Ante cualquier inquietud que tenga acerca de nuestro portal, puede escribirnos para recibir
            más información del grupo de Filosofía y Enseñanaza de la Filosofía. Le enviaremos un correo electrónico
            como respuesta a su inquietud o solicitud recibida por medio de este formulario.</p>
    </div>

    <div class="row">

        <div class="col-md-8">
            <form action="../controlador/sendemail.php" method="POST">
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nombre*</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nombre" id="inputPassword3" placeholder="Nombre" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label" hidden>Asunto</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asunto" id="inputPassword" placeholder="Asunto" value="Formulario de Contactenos del portal El Patio Filosofico" hidden>
                    </div>
                </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email*</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="correo" id="inputEmail3" placeholder="Email" required>
                </div>
              </div>
              
              <div class="form-group row">
                    <label for="mensaje" class="col-sm-2 col-form-label">Mensaje*</label>
                    <div class="col-sm-10">
                        <textarea name="mensaje" class="form-control" id="mensaje" placeholder=" &#128388; Escriba aquí su mensaje..." required></textarea>
                    </div>
                </div>
              
              <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="enviar" >Enviar Correo</button>
                </div>
              </div>
            </form>

        </div>

        <div class="col-md-4">
        <h2>Grupo Filosofía y Enseñanza de la Filosofía</h2>
        <p class="buzon">
                Su opinión es muy importante para nosotros... <br> Gracias por dejar su comentario
                <br>
                <br>
                Email <br>
                fil.yensenanzadelafil@gmail.com <br> <br>
                <a href="">Portal El patio filosófico</a>
        </p>

        <!--<img src="imagenes/a.png">-->
        </div>   
    </div>

</div>  
</div>
<!--

</body>
</html>-->