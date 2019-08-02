
<?php 
	include "cn.php";
	include "funciones.php"; 
//      include '../../controlador/conBD.php';
  
 ?>

<?php
         if(isset($_GET['n']))
    {
            $contarmegusta = mysqli_query($connect, "UPDATE megusta SET megustas = megustas + 1 WHERE not_id = '".$_GET['id']."'");
  
            echo 'se ha agregado el megusta';
            
    }
?>