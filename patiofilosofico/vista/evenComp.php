<?php

include '../controlador/cn.php';
include '../modelo/Usuario.php';
include '../modelo/evento.php'; 
?>

<html lang="en">
    <head>
        <style>
            .titulos{
                font-family: 'arial narrow';
                font-size: 300%;
                text-align: center;
                color: rgb(0,110,192);
            }
            
            .img-noticia{
                width: 80%;
                height: 300px;
                border: solid black;
            }
            
            .imagen{
                text-align: center;
            }
            
            .descripcion-evento{
                position: relative;
                width: 80%;
                left: 15%;
                height: auto;
                font-family: 'arial narrow';
                font-size: 120%; 
                padding: 10px 0px;

            }
            
            .row h6{
                padding: 10px 0px;
                right: 50px;
            }
            
            .col-12{
                  padding: 20px 0px;
            }
            
            .col-12 .float-right{
                position: relative;
                right: 60%;
            }
            
        </style>    
        
    </head>
    
    <body>

<div class=" main ">
    <div class="media-left col-sm-12 col-md-12">
        <h3 class="titulo">EVENTO</h3>
        <hr class="linea">
        
        <?php
       $idEnvento = $_GET["id"];
        $evento = evento::eventoPorID($idEnvento);
                   // $evento = new evento();
                    setlocale(LC_ALL, "es_CO.UTF-8");
                   // foreach ($todosEventos as $evento) {
//echo strftime("%A %d de %B del %Y");
                        ?>

        <div class="">
                   
    <h5 class="titulos"><?php echo $evento->getNombre(); ?></h5>
    <div class="imagen" >
             <img class="img-noticia" src="<?php echo $evento->getImagen(); ?>"  ></div>           
    </div>
        
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <p  class="descripcion-evento"><?php echo $evento->getInformacion(); ?> </p>
           
            </div>
            
            <div class="col-xs-12 col-sm-3 col-md-3">
                 <h6 class="col-12 text-center"><b>Lugar: </b><?php echo $evento->getLugar(); ?> </h6>
                 <div class="row">  
                     
                     <div class="fecha1">
                        <div class="col-sm-12 col-md-12 row" style="border-right: 2px solid rgba(255, 255, 255, 0.66)">
                              <small class="col-12 text-center"><b>Inicia</b> <br>
                              <!--<small class="col-sm-6 col-md-12 text-center">-->
                                  <?php echo strftime("%d de %b del %Y ", strtotime($evento->getFIni())); ?><br>
                                  <?php echo strftime("%I:%M %p", strtotime($evento->getFIni())); ?>
                              </small>
                          </div>  
                     </div>
                     
                     <div class="fecha2">
                            <div class="col-sm-12 col-md-12 row">
                               <small class="col-12 text-center"><b>Finaliza</b> <br>
                                   <?php echo strftime("%d de %b del %Y ", strtotime($evento->getFFin())); ?><br>
                                   <?php echo strftime("%I:%M %p", strtotime($evento->getFFin())); ?>
                               </small>
                           </div> 
                     </div>
                        <div class="col-12 ">
                           <span style="cursor: pointer;" class="float-right col-3" onclick="verCalendario('<?php echo $evento->getId(); ?>')" title="Calendario evento...">Calendario <i class="fa fa-calendar" ></i> </span> 
                        </div>
                </div>
            </div>
           
            
        </div>
     
    <div class="row info-evento">
       
       
        </div>
    </div>
</div>
        <?php                               
  //  }
 
        ?>
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
    
</div>
    
    </body>
    
</html>