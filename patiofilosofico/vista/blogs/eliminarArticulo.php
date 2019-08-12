<?php

include 'cn.php';
include '../../modelo/Usuario.php';

 session_start();
$p = $_POST;
$s = $_SESSION;
$user = new Usuario();
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);
//  include "cn.php";
//    include "../../controlador/conBD.php";

    eliminarArticulo($_GET['id']);
 
    function eliminarArticulo($id){
        
        include "cn.php";
        $identificar = "DELETE FROM blog WHERE id='" .$id. "' ";
        $connect->query($identificar);
    }    

        $query = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario= ".$user->getId());
        $row= mysqli_fetch_array($query)
?>

<script type="text/javascript">
    alert("Artículo eliminado correctamente");
    window.location.href='blog.php?idusuario=<?php echo $row['idusuario'];?>';
</script>