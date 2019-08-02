<?php
include '../controlador/conBD.php';
include '../modelo/Noticia.php';
include '../modelo/Usuario.php';

session_start();
$p = $_POST;
$s = $_SESSION;
$user = new Usuario();
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);


    
//   echo('conexcion nueva ');


if (isset($p['oper'])) {
    $conn = conBD::conectar();
//    echo $p['tipoMultimedia'];
    if ($p["oper"] == "megusta") {
        
        $idblog= $p['idblog'];
        $sql= "INSERT INTO `megusta`
(
`id_blog`,
`idusuario`)
VALUES
( 
".$idblog."
, ".$user->getId().")";
        mysqli_query($conn, $sql);
        
        
        ?>
            <script>
                
                 
                $('#megusta_<?php echo $idblog; ?>').html('<?php echo $arr['num']; ?>');
            </script>
            <?php
        
            $sql =" select count(*) as num from megusta where id_blog =".$idblog;
            $num = mysqli_query($conn, $sql);
            $arr = mysqli_fetch_assoc($num);
            ?>
            <script>
                console.log("Noticia eliminada");
                 
                $('#megusta_<?php echo $idblog; ?>').html('<?php echo $arr['num']; ?>');
            </script>
            <?php
        
        
        
    }
} else {
    echo 'no se encontro la variable OPER';
}


