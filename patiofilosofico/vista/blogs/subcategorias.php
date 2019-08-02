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
        
        $category = mysqli_query($connect, "SELECT * FROM categorias WHERE idusuario= '".$user->getId()."'");        
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
