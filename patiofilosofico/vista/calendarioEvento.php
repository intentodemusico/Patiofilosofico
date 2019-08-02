<?php
include '../modelo/Usuario.php';
include '../controlador/conBD.php';

session_start();

$idEvento = $_POST['id'];
$sql= "SELECT `evento_actividad`.`idevento_actividad`,
    `evento_actividad`.`idevento`,
    `evento_actividad`.`fecha`,
    `evento_actividad`.`hora`,
    `evento_actividad`.`actividad`
FROM `evento_actividad` WHERE idevento = '".$idEvento."' ;";
 $conn = conBD::conectar();
$resp = mysqli_query($conn, $sql);
?>
<table class="table tb-actividades">
    <tr>
    <th>Actividad</th>
    <th>Fecha</th>
    <th>Hora</th>
    
</tr>
<?php
while ($acti = mysqli_fetch_assoc($resp)){
    ?>
<tr>
    <td><?php echo $acti["actividad"]; ?></td>
    <td><?php echo $acti["fecha"]; ?></td>
    <td><?php echo $acti["hora"]; ?></td>
   
</tr>
<?php
}

?>
</table>