<?php	
//include 'conBD.php';
include '../modelo/Chats.php';
include '../modelo/Usuario.php';
include '../modelo/Mensajeria.php';
if (($_FILES['my_file']['name']!="")){
// Where the file is going to be stored
 $target_dir = "../upload/";
 $file = $_FILES['my_file']['name'];
 $path = pathinfo($file);
 $filename = $path['filename'];
 $ext = $path['extension'];
 $temp_name = $_FILES['my_file']['tmp_name'];
 $path_filename_ext = $target_dir.$filename.".".$ext;
 
// Check if file already exists
if (file_exists($path_filename_ext)) {
 echo "Sorry, file already exists.";
 }else{
 move_uploaded_file($temp_name,$path_filename_ext);
 echo "Congratulations! File Uploaded Successfully.";
 }
}
$a='<a href="'.$path_filename_ext.'">'.$filename.".".$ext.'</a>';
if (Chats::envioMensaje($_POST['idEnvia'], $_POST['idRecibe'], $a)) {
    $fecha = new DateTime(conBD::getFechaActual());
    $fecha = $fecha->format("d M | H:i");
}
header("Location: ../vista/index.php");
exit();    
?>