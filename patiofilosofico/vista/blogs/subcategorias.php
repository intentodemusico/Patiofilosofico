<?php
if (isset($_GET['idusuario'])) {
    $idUserBlog = $_GET["idusuario"];
} else {
    $idNoticia = $_GET["id"];
    $sentenciaUserBlog = mysqli_query($connect, "SELECT idusuario FROM blog WHERE id=" . $idNoticia);
    $connect = conBD::conectar();
    $rowUserBlog = mysqli_fetch_array($sentenciaUserBlog);
    $idUserBlog = $rowUserBlog["idusuario"];
}
?>
<div class="sub_categorias">
    <a href="categorias.php?idusuario=<?php echo $idUserBlog ?>">
        <h5>Categorías <img src="imagenes/menu.png"></h5>
    </a>
    <?php
    $category = mysqli_query($connect, "SELECT * FROM categorias WHERE idusuario= '" . $idUserBlog . "'");
    while ($cat = mysqli_fetch_array($category)) { ?>
        <div class="lista_categorias">
            <a href="category.php?idusuario=<?php echo $idUserBlog ?>&id=<?php echo $cat['idcategorias']; ?>"><?php echo $cat['categoria']; ?></a>
            <hr class="lineal">
        </div> <?php } ?>
</div>