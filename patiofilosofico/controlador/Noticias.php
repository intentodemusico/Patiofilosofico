<?php
include '../controlador/conBD.php';
include '../modelo/Noticia.php';
include '../modelo/Usuario.php';

session_start();
$p = $_POST;
$s = $_SESSION;
$user = NULL;
$conn = NULL;
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);


    
//   echo('conexcion nueva ');


if (isset($p['oper'])) {
    $conn = conBD::conectar();
//    echo $p['tipoMultimedia'];
    if ($p["oper"] == "nueva noticia") {
//        $conn = conBD::conectar();
        //verificacion de archivo multimedia.
//
        $rutaMultimedia = "";
        $tipoMulti = "YOUTUBE";
        if($p["tipoMultimedia"] == "video"){
            $rutaMultimedia = "../vista/Video/noticia/noticia_";
            $tipoMulti = "VIDEO";
        }else{
            $rutaMultimedia = "../vista/Imagenes/noticia/noticia_";
            $tipoMulti = "IMAGEN";
        }
        try {
//se cambio el nombre de multimedia a archivo ...
            if ($_FILES['archivo']["error"] > 0) {
		echo '<br> el error es : '.$_FILES['archivo']["error"];
                throw new RuntimeException('Invalid parameters.');
            }

            // Check $_FILES['archivo']['error'] value.
            switch ($_FILES['archivo']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // You should also check filesize here. 
            if ($_FILES['archivo']['size'] > 8000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

        } catch (RuntimeException $e) {
	    print_r($_FILES);
            echo $e->getMessage();
        
        }
        //fin archivo multimedia
        $hoy = new DateTime('now');
        $hoy = $hoy->format("Y-m-d H:i:s");
        $idUser = $user->getid();
//        echo $idUser;
//        echo $hoy;
        $idNuevoRegistro = Noticia::registroNuevaNoticia(
                        $p['titulo'], $p['subtitulo'], $p['contenido'], '', $tipoMulti, $hoy, $idUser, $p['enlace'], $p["estado"], $hoy,$conn);
        if ($idNuevoRegistro > 0) {
            /* ahora con la funcion move_uploaded_file lo guardaremos en el destino que queramos */
            if (!($_FILES['archivo']["error"] > 0)) {
                $extencion = explode(".", $_FILES['archivo']['name']);
		$rutaMultimedia = $rutaMultimedia. $idNuevoRegistro. "." . end($extencion);
                move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaMultimedia );
//                echo 'File is uploaded successfully.';
                $rutaMultimedia = "Imagenes/noticia/noticia_".$idNuevoRegistro."." . end($extencion);
                Noticia::actualizarNoticiaMultimedia($idNuevoRegistro, $rutaMultimedia , $tipoMulti, $conn, $user->getid());
//                Noticia::actualizarNoticiaEstado($idNuevoRegistro, $p["estado"], $conn, $user->getid());
//                header('Location: ../vista/index.php');
                
            }
        } else {
           
        }
//        echo 'cerrarndo conexion bd';
        mysqli_close($conn);
//        falta validar que si se ejecuta bien el registro
    }else if ($p['oper'] == 'eliminarNoticia') {

        $resp = Noticia::eliminarNoticia($p['idnoticia']);
        if ($resp == 1) {
            ?>
            <script>
                console.log("Noticia eliminada");
                 if (typeof noty !== 'undefined')
                noty.dismiss();
                noty = new NotificationFx({
                    message: '<p>La noticia fue eliminada correctamente. </p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'notice' // notice, warning or error
                });
                noty.show();
                $('#noticia_<?php echo $p['idnoticia']; ?>').remove();
            </script>
            <?php
        } else {
            ?>
            <script>
                console.log("Noticia NO eliminada");
                 if (typeof noty !== 'undefined')
                noty.dismiss();
                noty = new NotificationFx({
                    message: '<p>No fue posible eliminar la noticia. </p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'error' // notice, warning or error
                });
                noty.show();

            </script>
            <?php
        }
    }
} else {
    echo 'no se encontro la variable OPER';
}


