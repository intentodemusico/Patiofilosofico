<!DOCTYPE html>
<?php
include '../modelo/Mensajeria.php';
include '../modelo/Usuario.php';
?>
<style>
    .cont-group {
        background: #615e5e;
        width: 33%;
        color: #eae9e9;
        border-radius: 6px;
        box-shadow: 2px 2px 7px #6d6d6d;
        margin-right: 15px;
        display: inline-block;
    }

    .cont-group > a {
        display: block;
        color: #a4d4f1;
    }

    .cont-group > a:hover {
        color: #cee3fb;
        text-decoration: none;
        cursor: pointer;
    }

    .fecha {
        font-size: 12px;
        padding: 5px;
        display: inline-block;
        text-align: right;
        width: 100%;
        color: #caebff;
    }

</style>
<?php
session_start();
$user = new Usuario();
if (isset($_SESSION["usuario"])) {
    $user = unserialize($_SESSION['usuario']);
}
?>

<h3 class="titulo">Grupos</h3>
<hr class="linea">
<section class="main container col-md-12">
    <div class="row pl-4 pr-4">
        <div class="col-md-9">
            <section class="wrapper">
                <?php
                if ($user->getId() > 0) {
                    ?>
                    <h5 class="text-info mb-3">Mis Grupos</h5>

                    <div class="contenido" id="misgrupos">
                        <?php
                        $mens = new Mensajeria();
                        $MISgrupos = $mens->buscarSalasChatPorIdUsuario($user->getId(), 'ACTIVO');
                        if ($MISgrupos->num_rows == 0) {
                            ?><blockquote class="blockquote col-10 offset-1">
                                <i class="text-muted">No estas participando aun en ningun grupo , unete y participa en los grupos disponibles</i>
                            </blockquote> <?php
                        }
                        while ($fila = mysqli_fetch_array($MISgrupos, MYSQLI_ASSOC)) {
                            ?>
                        <div class="cont-group mb-3 p-3" id="comunidad<?php echo $fila["idsala_chat"]; ?>">
                                 <button type="button" class="close" aria-label="Close"  title="Eliminar Comunidad" onclick="eliminarComunidad(this,'<?php echo $fila["idsala_chat"]; ?>');"> 
                                                <span aria-hidden="true">&times;</span>
                                 </button>
                                <a href="#1" onclick="envioFormularioDataForm('', 'comunidad_chat.php?idSalaChat=<?php echo $fila["idsala_chat"]; ?>', 'contenedorPrincipal', true);"><span class="text-uppercase"><?php echo $fila["titulo"]; ?></span></a><br>
                                <span class="text-lowercase"><?php echo $fila["descripcion"]; ?></span><br>
                                <span class="fecha"><?php echo $fila["fecha"]; ?></span><br>
                                <!--<input type="button" value="Unirse" class="btn btn-sm btn-defauld">-->
                            </div>
                            <?php
                        }
                        ?>
                        
                <h5 class="text-info ">Grupos disponibles</h5>
                <div class="contenido">
                    <?php
                    $mens = new Mensajeria();
                    $grupos = $mens->buscarSalasChatDisponibleUnirse($user->getId(), 'ACTIVO');
                    if ($grupos->num_rows == 0) {
                            ?><blockquote class="blockquote col-10 offset-1">
                                <i class="text-muted">No se encontrarón grupos disponibles, puedes crear tu grupo y ayudar a crecer esta comunidad...</i>
                            </blockquote> <?php
                        }
                    while ($fila = mysqli_fetch_array($grupos, MYSQLI_ASSOC)) {
                        ?>
                        <div class=" cont-group mb-3 p-3" id="unir_grupo<?php echo $fila["idsala_chat"]; ?>">
                            <span class="text-uppercase"><?php echo $fila["titulo"]; ?></span><br>
                            <span class="text-lowercase"><?php echo $fila["descripcion"]; ?></span><br>
                            <span class="fecha"><small><?php echo $fila["fecha"]; ?></small></span><br>
                            <?php
                            if ($user->getId() > 0) {
                                ?>
                                <form action="../controlador/chats.php" method="post" 
                                      onsubmit="envioFormulario(this, 'misgrupos', true);return false;">
                                    <input type="hidden" name="oper" value="unirseGrupo">
                                    <input type="hidden" name="idgrupo" value="<?php echo $fila["idsala_chat"]; ?>">
                                    <input type="submit" value="Unirse" class="btn btn-sm btn-defauld">
                                    <input type="submit" value="Salirse" class="btn btn-sm btn-defauld">   <!-- Salirse   -->
                                </form>
                                <?php
                            }
                            ?>
                        </div>

                        <?php
                    }
                    ?>

                </div>
                        
                    </div>
                    <div class="content" id="invitacionGrupos">
                        <h5 class="text-info  mb-5">invitaciones de grupo</h5>
                        <?php
                        $mens = new Mensajeria();
                        $MISgrupos = $mens->buscarSalasChatPorIdUsuario($user->getId(), 'INVITADO');
                        
                        if ($MISgrupos->num_rows == 0) {
                            ?><blockquote class="blockquote col-10 offset-1">
                                <i class="text-muted">No tiene invitaciones a grupos pendientes...</i>
                            </blockquote> <?php
                        }

                        while ($fila = mysqli_fetch_array($MISgrupos, MYSQLI_ASSOC)) {
                            ?>
                            <div class="cont-group-inv mb-3 p-3 " id="invitavionGrupo<?php echo $fila["idsala_chat"]; ?>">
                                <span >
                                    <?php echo $fila["nombAdmin"]; ?>" Te han invitado al grupo </span><b><?php echo $fila["titulo"]; ?> </b><br>
                                <p><?php echo $fila["descripcion"]; ?></p>
                                <form class="form-horizontal"  action="../controlador/chats.php" method="post" onsubmit="envioFormulario(this, 'misgrupos', true);return false;">
                                    <input type="submit" value="aceptar" id="btn_acep<?php echo $fila["idsala_chat"]; ?>" class="btn btn-sm btn-primary">
                                    <input type="hidden" name="oper" value="aceptar invitacion grupo">
                                    <input type="hidden" name="idgrupo" value="<?php echo $fila["idsala_chat"]; ?>">
                                </form>
                            </div>

                            <?php
                        }
                        ?>

                    </div>
                    <?php
                }
                ?>

            </section>
        </div>
    </div>
    
    <hr class="linea">
    <?php
    if ($user->getId() > 0) {
        ?>
        <div class="controles col-6 offset-2 mb-3" id="nuevogrupo">
            <h3 class="text-info">Nuevo grupo</h3>
            <form method="post" action="../controlador/chats.php" onsubmit="envioFormulario(this, 'nuevogrupo', false);return false;">
                <div class="form-group">
                    <label>Nombre del grupo</label>
                    <input class="form-control" name="nombre" maxlength="80" placeholder="maximo 80 caracteres" required>
                </div>
                <div class="form-group">
                    <label>Descripcion</label>
                    <textarea class="form-control" name="descripcion" maxlength="65530" placeholder="Una breve descripcion  sobre el grupo..." required></textarea>
                </div>
                <input type="hidden" name="oper" value="nuevo grupo"><hr>
                <input type="submit" value="Guardar" class="btn tbn-sm btn-primary">
                <!--<button name="oper" class="btn btn-primary" value="nuevo grupo" onclick="$(this).parent().submit();">Nuevo grupo</button>-->
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ModalInivtarGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container cuerpo-modal">
                            <!--onsubmit="envioFormulario('formBuscar', 'contresultados', true); return false;"-->
                            <form onsubmit="envioFormularioMultiPart2('formBuscar', 'contresultados', true); return false;" class="row" method="post" id="formBuscar" action="../controlador/chats.php" >
                                <div class="col-sm-12 col-md-6">
                                    <div class="btn-group" style="width: 100%">
                                        <input name="criterio" type="text" class="form-control" placeholder="Criterios  de busqueda" aria-label="Username" aria-describedby="basic-addon1" required>
                                        <button class="btn btn-default" onclick="$('#formBuscar').submit();"><a class="fa fa-search"></a> Buscar</button>
                                        <!--<input type="submit" value="Buscar">-->
                                    </div>
                                </div>
                                <input type="hidden" name="oper" value="buscar para invitar">
                                <input type="hidden" name="idgrupo" value="9" id="idgrupoInivitar">
                            </form>
                            <div class="row" id="contresultados"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Finalizar</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
<!--         <img src="imagenes/17.5.jpg" width="100%" height="200px" class="portada">-->
</section>
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

function eliminarComunidad(btn, idComunidad){
    var r = confirm("La eliminacion de una comunidad no se puede recuperar, al eliminarla se borrara toda la informacion y conversaciones de la misma. \n¿Desea continuar?")
    if(r){
        ejecutarFuncionElm('../controlador/grupo.php','eliminarComunidad',idComunidad,'contresultadost',true);
    }
}
//            ejecutarFuncion('../controlador/chats.php','cargarMisGrupos','misgrupos',true);
</script>

<!--    </body>
</html>-->