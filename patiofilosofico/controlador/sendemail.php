<!--Author: Obed Alvarado
Author URL: http://obedalvarado.pw
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/ !-->
<?php
include './conBD.php';
include '../funcs/funcs.php';
/*Configuracion de variables para enviar el correo*/
//				$mail_username="elpatiofilosofico@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
//				$mail_userpassword="patio0987654321";//Tu contraseÃ±a de gmail
//				$mail_addAddress="elpatiofilosofico@gmail.com";//correo electronico que recibira el mensaje
//				$template="../vista/email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje
//				
//				/*Inicio captura de datos enviados por $_POST para enviar el correo */
//				$mail_setFromEmail=$_POST['correo'];
//				$mail_setFromName=$_POST['nombre'];
//				$txt_message=$_POST['mensaje'];
//				$mail_subject=$_POST['asunto'];
                                
//                                sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject);//Enviar el mensaje
//                                sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template);//Enviar el mensaje
			
//function sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template){
//	require '../vista/pluging/PHPMailer/PHPMailerAutoload.php';
//	$mail = new PHPMailer;
//	$mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
//	$mail->Host = 'smtp.gmail.com';             // Especificar el servidor de correo a utilizar 
//	$mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
//	$mail->Username = $mail_username;          // Correo electronico saliente ejemplo: tucorreo@gmail.com
//	$mail->Password = $mail_userpassword; 		// Tu contraseña de gmail
//	$mail->SMTPSecure = 'tls';                  // Habilitar encriptacion, `ssl` es aceptada
//	$mail->Port = 587;                          // Puerto TCP  para conectarse 
//	$mail->setFrom($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
//	$mail->addReplyTo($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
//	$mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
//	$message = file_get_contents($template);
//	$message = str_replace('{{first_name}}', $mail_setFromName, $message);
//	$message = str_replace('{{message}}', $txt_message, $message);
//	$message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);
//	$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
	
//	$mail->Subject = $mail_subject;
//	$mail->msgHTML($message);
//	if(!$mail->send()) {
//		echo '<p style="color:red">No se pudo enviar el mensaje..';
//		echo 'Error de correo: ' . $mail->ErrorInfo."</p>";
//	} else {
//		echo '<p style="color:green">Tu mensaje ha sido enviado!</p>';
//	}
//}
            $email = "ferramirezalbarracin@gmail.com";
            $campo_nombre = $_POST["nombre"];
            $campo_email = $_POST["correo"];
            $campo_asunto = $_POST["asunto"];
            $mensaje = $_POST["mensaje"];
            $campo_mensaje = "<b>Nombre del usuario</b>: $campo_nombre <br> ";
            $campo_mensaje .= "<b>E-mail</b>: $campo_email <br> ";
            $campo_mensaje .= "<b>Asunto</b>: $campo_asunto <br><br> ";
            $campo_mensaje .= "<b><h2>Mensaje:</h2></b><p> $mensaje </p> <br> ";

            $asunto = $campo_asunto;
            $cuerpo = $campo_mensaje;

           if(enviarEmail($email, $nombre, $asunto, $cuerpo) ){
 
               
               header("Location: ../vista/index.php");
               exit;
           }else{
               $errors[] = "No se ha podido registrar el usuario";
           }

//$destino= "ferramirezalbarracin@gmail.com";
//$nombre= $_POST["nombre"];
//$ausnto= $_POST["asunto"];
//$correo= $_POST["correo"];
//$mensaje= $_POST["mensaje"];
//
//$contenido = "nombre: " . $nombre . "\nAsunto: " . $ausnto . "\nCorreo: " . $correo . "\nMensaje: " . $mensaje;
//
//mail($destino,"Contacto", $contenido);
//header("Location: ../vista/contactenos_comp.php");

?>