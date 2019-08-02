<?php 

require 'cn.php';

$consulta = '';

if($connect->connect_errno){
    echo 'error en la conexion';
    exit;
}
	function clean($str) {
	$var = strip_tags(addslashes(stripcslashes(htmlspecialchars($str))));
	return $var;
}
	
function laConsulta(){
    global $connect, $consulta;
    $sql = 'SELECT * FROM categorias';
    return $connect->query($sql);
}

function borrar($idCategorias){
    global $connect;
    $sql = "DELETE FROM categorias WHERE id = {$idCategorias}";
    $connect->query($sql);
}

function borrarr($id){
    global $connect;
    $sql = "DELETE FROM blog WHERE id = {$id}";
    $connect->query($sql);
}
 ?>