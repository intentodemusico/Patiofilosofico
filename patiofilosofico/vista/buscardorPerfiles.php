<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--<html>
    <head>

    </head>
    <body>-->
<?php
include '../modelo/Usuario.php';
session_start();
$user = new Usuario();
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);
// put your code here
//        parametrizar multiselect o individual, si se permite la seleccion. ver perfil 
?>


<style>
    
</style>
<div class="container" style="min-width: 100%;min-height: 500px;">
    <h3>Buscar usuarios</h3>
    <!--onsubmit="envioFormulario('formBuscar', 'contresultados', true); return false;"-->
    <form class="mb-5" onsubmit="envioFormularioMultiPart2('formBuscar', 'contresultados', true); return false;" class="row" method="post" id="formBuscar" action="../controlador/usuarios.php" >
        <div class="col-sm-12 col-md-6">
            <div class="btn-group" >
                <input name="criterio" type="text" class="form-control" placeholder="Criterios  de busqueda" aria-label="Username" aria-describedby="basic-addon1" required>
                <button class="btn btn-default" onclick="$('#btnSubmitBusqueda').click();"><a class="fa fa-search"></a> Buscar</button>
                <div class="input-group-append"> 
                    <input type="submit" value="Buscar" style="display: none;" id="btnSubmitBusqueda">
                </div>
            </div>
        </div>
        <input type="hidden" name="oper" value="Buscar perfiles">

    </form>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header btn-info">
                    <h5 class="modal-title" id="exampleModalLabel">Perfil Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_cuerpo_perfiles">
                    ...
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5" id="contresultados"></div>
    <?php 
     if($user->getId()==0){
         ?>
    <script>
        var paqueteDeDatos = new FormData();
        paqueteDeDatos.append("criterio", "");
        paqueteDeDatos.append("oper", "Buscar perfiles");
        $.ajax({
            url: "../controlador/usuarios.php",
            type: "POST",
            data: paqueteDeDatos,
            contentType: false,
            processData: false,
            cache: false,
            success: function (result) {
                    $("#contresultados").append(result);
            },
            error: function (e) {
                console.log("falla en el envio ajax Seguir");
                $("#contresultados").append("ha ocurrido un Error en el envio del formulario ");
            }
        });
    </script>
    <?php
     } 
    ?>
</div>
<script>
    function cargarPerfiles(){
        
        
    }
</script>
</body>
</html>
