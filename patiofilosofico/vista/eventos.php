<!DOCTYPE html>
<?php
include '../modelo/evento.php';
include '../modelo/Usuario.php';

session_start();
$limiteNoticias = 10;
$idUserAdmin = 0;
$user = new Usuario();
//$conn = NULL;
if (isset($_SESSION['usuario']))
    $user = unserialize($_SESSION['usuario']);

?>
<link href="css/evento.css" rel="stylesheet" type="text/css"/>

<header>
    
    <style>
        .btn a{
            position: absolute;
            z-index: 999999;
        }
    </style>

</header>                            

<section class="main container">

    <div class="row">

        <div class="col-12">


            <h3 class="titulo">Eventos Filosofía 
            </h3>
            <hr class="linea">

            <!--<img src="imagenes/Socrates.jpg" width="100%" class="portada">-->

            <button class="btn btn-sm btn-primary mb-5" data-target="#contNuevoevento" data-toggle="collapse" ><i class="fa fa-plus-square"></i> Crear evento</button>

            <section class="nuevo-evento collapse" id="contNuevoevento">
                <div class="col-md-12 "   >

                </div>
            </section>

            <section class="container">
                <div class="row" id="lista_eventos">
                    <?php
//             $event = new Evento();
                    $todosEventos = evento::getTodosEventos();

                    $evento = new evento();
                    setlocale(LC_ALL, "es_CO.UTF-8");
                    foreach ($todosEventos as $evento) {
//echo strftime("%A %d de %B del %Y");
                        ?>

                    <div class="col-md-6 col-sm-10 p-3 cuerpo-evento" id="evento<?php echo $evento->getId(); ?>">
                            <div class="eve-backg">
 <?php if (($user->getTipo_usuario() == "ADMINISTRADOR" || $evento->getIdAdmi() == $user->getId())  ) { ?>
                            <form  action="../controlador/eventos.php" method="post" onsubmit="envioFormulario(this, 'contresultadost', true);return false;">
                               
                                <a href="#1" class="close" title="Eliminar el evento" onclick="eliminarEventoClick(this)" value="" >&times;</a> 
                                <input type="hidden" name="idevento"  value="<?php echo $evento->getId(); ?>">
                                <input type="hidden" name="oper" value="eliminarEvento">
                            </form>
                        <?php } ?>
                                <h5 class="titulo-evento text-uppercase"><?php echo $evento->getNombre(); ?></h5>
                                <div class="col-12 img-evento" style="background-image: url(<?php echo $evento->getImagen(); ?>)">
                                    <p  class="descripcion-evento"><?php echo $evento->getInformacion(); ?>
                                    <?php
                                    if( $evento->getWeb() != ""){
                                        ?><br>
                                    <div class="btn">
                                        <a href="#2" onclick="cargarPagina('evenComp.php?id=<?php echo $evento->getId(); ?>', 'contenedorPrincipal', true)" class="btn btn-primary">Ver mas</a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    </p>
                                    
                                </div>
                                <div class="row info-evento">
                                    <h6 class="col-12 text-center"><b>Lugar: </b><?php echo $evento->getLugar(); ?> 
                                         </h6>
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
                                    <div class="col-12 ">
                                       
                                        <span style="cursor: pointer;" class="float-right col-3" onclick="verCalendario('<?php echo $evento->getId(); ?>')" title="Calendario evento...">Calendario <i class="fa fa-calendar" ></i> </span> 

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
    <!--            <section class="container">
    <div class="row">-->

                </div>
            </section>

            <script>
                cargarPagina('crearEvento.php', 'contNuevoevento', true);
            </script>

        </div>

    </div>
    
</section>
<div class="modal fade" id="modalCalendario" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header btn-info">
                    <h5 class="modal-title" >Calendario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_cuerpo_calendario">
                    ...
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <button type="button" class="btn btn-primary" data-dismiss="modal">cerrar</button>
                </div>
            </div>
        </div>
    </div>

<script>
    function verCalendario(idevento){
        var paqueteDeDatos = new FormData();
        paqueteDeDatos.append("id", idevento);
        $.ajax({url: "calendarioEvento.php",
            type: "POST",
            data: paqueteDeDatos,
            contentType: false,
            processData: false,
            cache: false,
            success: function (result) {
                $("#modal_cuerpo_calendario").html(result);
            }
        });
       $("#modalCalendario").modal();
    }
    
    function eliminarEventoClick(btn) {
        var resp = confirm("Desea eliminar este evento?");
        if (resp) {
            $(btn).parent("form").submit();
        }
    }
</script>