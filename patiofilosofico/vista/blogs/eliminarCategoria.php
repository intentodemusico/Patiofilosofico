<?php
//  include "cn.php";
//    include "../../controlador/conBD.php";

    eliminarCategoria($_GET['idcategorias']);
 
    function eliminarCategoria($idcategorias){
        
        include "cn.php";
        $identificar = "DELETE FROM categorias WHERE idcategorias='" .$idcategorias. "' ";
        $connect->query($identificar);
    }
    
?>

<script type="text/javascript">
    alert("Categoría eliminada correctamente");
    window.location.href='blog.php';
</script>
