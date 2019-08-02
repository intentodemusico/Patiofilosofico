<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<div class="container">
    <form method="post" action="../controlador/eventos.php" onsubmit="envioNuevoEvento(); return false;" id="formNuevoEvento">
    <!--<form method="post" action="../controlador/eventos.php" onsubmit="if($('#imagen').val()==''){};envioFormularioMultiPart2('formNuevoEvento', 'lista_eventos', true); return false;" id="formNuevoEvento">-->
        <!--<input type="hidden" name="oper" value="nuevo evento">-->
        <div class="row">
            <div class="col-4" onclick="$('#imagen').click();" id="pre_imagen" style="background-image: url()">
                <div class="bag-img" ><i class="fa fa-upload"></i> cargar imagen</div>
            </div>
            <div class="col-8 container pl-5">
                <div class="row mb-2">
                    <div class="col-sm-4">Inicia :</div>
                    <div class="col-sm-4"> <input class="form-control input-sm" type="date" name="fini" required="" title="Fecha en la que iniciara el evento <br> ejm 25/04/2018 "></div>
                    <div class="col-sm-4"> <input class="form-control input-sm" type="time" name="tini" required="" value="12:00:00"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4">Finaliza :</div>
                    <div class="col-sm-4"> <input class="form-control input-sm" type="date" name="ffin" required=""></div>
                    <div class="col-sm-4"> <input class="form-control input-sm" type="time" name="tfin" required=""></div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4">Evento :</div>
                    <div class="col-sm-8"> <input class="form-control input-sm" type="text" name="nombre" placeholder="Nombre del evento..." required=""></div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4">Lugar :</div>
                    <div class="col-sm-8"> <input class="form-control input-sm" type="text" name="lugar" placeholder="donde se realizara el evento..."required=""></div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4">pagina web :</div>
                    <div class="col-sm-8"> <input class="form-control input-sm" type="text" name="web" placeholder="la web del evento..."required=""></div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4">Mas información :</div>
                    <div class="col-sm-8"> <textarea class="form-control" name="informacion" placeholder="Recuerda informar de que se trata el evento , temas y la forma de participar en el mismo..." required=""></textarea></div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-4">calendario :</div>
                    <table>
                        <thead>
                        <th>Fecha</th>
                        <th>hora</th>
                        <th>actividad</th>
                        </thead>
                        <tbody id="bodycalendario">
                            <tr>
                                <td><input type="date" name="calfecha1"></td>
                                <td><input type="time" name="calhora1"></td>
                                <td><input type="text" name="calactividad1"></td>
                                <td><a href="#1" class=" btn btn-info " onclick="agregaractividad(this)"><i class="fa fa-plus-square"></i></a></td>
                                <td><a href="#1" class=" btn btn-danger " onclick="eliminaractividad(this)"><i class="fa fa-minus-square"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                    <!--<div class="col-sm-8"> <textarea class="form-control" name="informacion" placeholder="Recuerda informar de que se trata el evento y la forma de participar en el mismo..." required=""></textarea></div>-->
                </div>

                <div class="row-fluid mb-2">
                    <input type="file" class="invisible " name="imagen" id="imagen" onchange="previsualizarImageenDiv(this, 'pre_imagen');" >
                    <!--<input type="button" value="invitar" class="btn btn-defauld">-->
                    <input type="submit" class="float-right btn btn-primary" name="oper" value="nuevo evento" >
                </div>
            </div>
        </div>
    </form>
    <script>
        function agregaractividad(btn) {
            var hijo = $(btn).parents("tbody").find("tr").length;
            hijo++;
            $("#bodycalendario").append('<tr><td><input type="date" name="calfecha'+hijo+'"></td><td><input type="time" name="calhora'+hijo+'"></td><td><input type="text" name="calactividad'+hijo+'"></td><td><a href="#1" class=" btn btn-info " onclick="agregaractividad(this)"><i class="fa fa-plus-square"></i></a></td><td><a href="#1" class=" btn btn-danger " onclick="eliminaractividad(this)"><i class="fa fa-minus-square"></i></a></td></tr>');
        }
        function eliminaractividad(btn) {
            alert($(btn).parents("tbody").find("tr").length);
            if ($(btn).parents("tbody").find("tr").length > 1) {
                $(btn).parents("tr").remove();
                var hijo = 1;
                $("tbody").find("tr").each(function (){
                    $(this).find("input[type = 'date']").attr("name","calfecha"+hijo);
                    $(this).find("input[type = 'time']").attr("name","calhora"+hijo);
                    $(this).find("input[type = 'text']").attr("name","calactividad"+hijo);
                    hijo++;
                });
            }
        }
        function envioNuevoEvento(){
            if($('#imagen').val()==''){
                var noty = new NotificationFx({
                    message: '<b>Sin imagen</b><br><p>No ha seleccionado una imagen para el evento por favor verifique.</p>',
                    layout: 'growl',
                    effect: 'slide',
                    type: 'warning' // notice, warning or error
                });
                noty.show();
                return false;
            }else{
            envioFormularioMultiPart2('formNuevoEvento', 'lista_eventos', true);
            }
        }
    </script>
</div>
