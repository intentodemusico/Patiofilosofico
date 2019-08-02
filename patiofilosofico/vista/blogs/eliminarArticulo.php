<?php
//  include "cn.php";
//    include "../../controlador/conBD.php";

    eliminarArticulo($_GET['id']);
 
    function eliminarArticulo($id){
        
        include "cn.php";
        $identificar = "DELETE FROM blog WHERE id='" .$id. "' ";
        $connect->query($identificar);
    }
    
?>

<script type="text/javascript">
    alert("Artículo eliminado correctamente");
    window.location.href='blog.php';
</script>
