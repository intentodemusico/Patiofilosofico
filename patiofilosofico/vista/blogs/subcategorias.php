<?php

        
//        session_start();
//$p = $_POST;
//$s = $_SESSION;
//$user = new Usuario();
//if (isset($s['usuario']))
//    $user = unserialize($s['usuario']);
?>


<div class="sub_categorias">
    <a href="categorias.php"><h5>Categorías <img src="imagenes/menu.png" ></h5></a>
        <?php
        if( isset($_GET['idusuario'])){
        $idUserBlog=$_GET["idusuario"];
        } else{
            $idNoticia= $_GET["id"];
$sentenciaUserBlog=mysqli_query($connect,"SELECT idusuario FROM blog WHERE id=".$idNoticia);
$connect = conBD::conectar();

$rowUserBlog= mysqli_fetch_array($sentenciaUserBlog);
$idUserBlog = $rowUserBlog["idusuario"];
        }
        $category = mysqli_query($connect, "SELECT * FROM categorias WHERE idusuario= '".$idUserBlog."'");        
        while ($cat= mysqli_fetch_array($category))
        {
           
        ?>    
      
        <div class="lista_categorias">
            <a href="category.php?id=<?php echo $cat['idcategorias']; ?>"><?php echo $cat['categoria']; ?></a>
        <hr class="lineal">
        </div>
            
        <?php
        
        }
        ?>
    
</div>
