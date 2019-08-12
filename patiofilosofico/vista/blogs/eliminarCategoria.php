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

    eliminarCategoria($_GET['idcategorias']);
 
    function eliminarCategoria($idcategorias){
        
        include "cn.php";
        $identificar = "DELETE FROM categorias WHERE idcategorias='" .$idcategorias. "' ";
        $connect->query($identificar);
    }
    
        $query = mysqli_query($connect, "SELECT * FROM usuario WHERE idusuario= ".$user->getId());
        $row= mysqli_fetch_array($query)
               
    ?>

<script type="text/javascript">
    alert("Categoría eliminada correctamente");
    window.location.href='categorias.php?idusuario=<?php echo $row['idusuario'];?>';
</script>