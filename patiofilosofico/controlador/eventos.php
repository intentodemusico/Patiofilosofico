<?php
//include '../controlador/conBD.php';
include '../modelo/Usuario.php';
include '../modelo/evento.php';

session_start();
$p = $_POST;
$s = $_SESSION;
$user = new Usuario();
$conn = NULL;
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);

if (isset($p['oper'])) {
    if ($p["oper"] == "nuevo evento") {
        $fechaIni = $p["fini"] . " " . $p["tini"];
        $fechaFin = $p["ffin"] . " " . $p["tfin"];
//print_r( $p);
        $evt = new evento();
        $id = evento::registroEvento($p["nombre"], $p["informacion"], $fechaIni, $fechaFin, $p["lugar"], $user->getId(),$p["web"]);
        if ($id > 0) {
//            if (!($_FILES['archivo']["error"] > 0 && $_FILES['archivo']['size'] < 8000000)) {
                $extencion = explode(".", $_FILES['archivo']['name']);
                $rutaMultimedia = "../vista/Imagenes/evento/evento" . $id . "." . end($extencion);
                move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaMultimedia);
                $rutaMultimedia = "Imagenes/evento/evento" . $id . "." . end($extencion);
                evento::actualizarEventoImagen($id, $rutaMultimedia);
//            }
            $actividad = 1;
            while (isset($p['calfecha'.$actividad])){
                $fechaACT = $p['calfecha'.$actividad];
                $horaACT = $p['calhora'.$actividad];
                $nombreACT = $p['calactividad'.$actividad];
                $evt->registrarActividad($id, $fechaACT, $horaACT, $nombreACT);
                $actividad++;
            }
            ?>
    
    <style>
        .btn a{
            position: absolute;
            z-index: 999999;
        }
    </style>


            <script>
                cargarPagina('crearEvento.php', 'contNuevoevento', true);
//                document.getElementById("formNuevoEvento").reset();
                var noty = new NotificationFx({
                    message: '<h5>Evento creado</h5><p>Se creo corectamente el nuevo evento "<?php echo $p["nombre"]; ?>" .</p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'notice' // notice, warning or error
                });
                noty.show();

            </script>
            <?php
            $todosEventos = evento::getTodosEventos();
            $evento = new evento();
            setlocale(LC_ALL, "es_CO.UTF-8");
            foreach ($todosEventos as $evento) {
                ?>

                <div class="col-md-6 col-sm-10 p-3 cuerpo-evento">
                    <div class="eve-backg">

                        <h5 class="titulo-evento text-uppercase"><?php echo $evento->getNombre(); ?></h5>
                        <div class="col-12 img-evento" style="background-image: url(<?php echo $evento->getImagen(); ?>)">
                            <p  class="descripcion-evento"><?php echo $evento->getInformacion(); ?></p>
                            <div class="btn">
                                <a href="#2" onclick="cargarPagina('evenComp.php?id=<?php echo $evento->getId(); ?>', 'contenedorPrincipal', true)" class="btn btn-primary">Ver mas</a>
                            </div>
                        </div>
                        <div class="row info-evento">
                            <h6 class="col-12 text-center"><b>Lugar: </b><?php echo $evento->getLugar(); ?> 
                                
                            <div class="col-sm-12 col-md-6 row" style="border-right: 2px solid rgba(255, 255, 255, 0.66)">
                                <small class="col-12 text-center"><b>Inicia</b> <br>
                                <!--<small class="col-sm-6 col-md-12 text-center">-->
                                    <?php echo strftime("%d de %b del %Y ", strtotime($evento->getFIni())); ?><br>
                                    <?php echo strftime("%I:%M %p", strtotime($evento->getFIni())); ?>
                                </small>
                            </div>

                            <div class="col-sm-12 col-md-6 row">
                                <small class="col-12 text-center"><b>Finaliza</b> <br>
                                    <?php echo strftime("%d de %b del %Y ", strtotime($evento->getFFin())); ?><br>
                                    <?php echo strftime("%I:%M %p", strtotime($evento->getFFin())); ?>
                                </small>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            if (count($todosEventos) < 1) {
                ?>
                <blockquote class="m-5 p-5 bloq bloq-noranja" style="width: 70%;margin: auto; border-color: orange; color: orange; border-left: 5px solid;">
                    <h5>No hay eventos registrados</h5>
                    <p class="text-muted">Se el primero en crear y compartir un evento, para que toda la comunidad pueda participar </p>
                </blockquote>
                <?php
            }
            ?>

            <?php
        } else {
            ?>
            <script>
                var noty = new NotificationFx({
                    message: '<h5>Error</h5><p>No fue posible crear el evento "<?php echo $p["nombre"]; ?>", por favor verifique que la informacion suministrada sea correcta e inténtalo nuevamente .</p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'error' // notice, warning or error
                });
                noty.show();

            </script>
            <?php
        }
//        mysqli_close($conn);
    } else if ($p["oper"] == "buscar mis eventos") {
        //lista los evento a en los que se es invitado, administrador o participante.
    } else if ($p["oper"] == "buscar  eventos") {
        // lista todos los eventos publicos.
    }
    else if ($p["oper"] == "eliminarEvento") {
        $resp = evento::eliminarEvento($p['idevento']);
        if ($resp == 1) {
            ?>
            <script>
                
                 if (typeof noty !== 'undefined')
                noty.dismiss();
                noty = new NotificationFx({
                    message: '<b>Evento eliminado</b><br><p>El evento fue eliminado satisfactoriamente. </p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'notice' // notice, warning or error
                });
                noty.show();
                $('#evento<?php echo $p['idevento']; ?>').remove();
            </script>
            <?php
        } else {
            ?>
            <script>
                
                 if (typeof noty !== 'undefined')
                noty.dismiss();
                noty = new NotificationFx({
                    message: '<b>No eliminado</b><br><p>No fue posible eliminar el evento, por favor intentelo mas tarde. </p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'error' // notice, warning or error
                });
                noty.show();

            </script>
            <?php
        }
    }
} else {
    echo 'no se encontro la variable OPER';
}


