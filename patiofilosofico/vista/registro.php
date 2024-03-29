<?php
session_start();
//include "cn.php";
//include "funciones.php";

ini_set('error_reporting', 0);
?>

<div class="container">
    <h2 class="titulo1">Registro de Usuario</h2>

    <p class="informacion">Todos los campos con asterisco <span>(*)</span> son obligatorios. Es aconsejable que digites todos los campos para obtener mayor información y veracidad en el registro.</p>

    <h4 class="subtitulo1">Información Personal</h4>
   

    <div id="resp"></div>

    <div class="container mb-5">
        <form name="form1" id="formRegistroUser" action="../controlador/registro_usuario.php" onsubmit="envioFormulario(this, 'resp', true);return false;" method="post">
            <input type="hidden" name="oper" value="nuevo usuario">
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="nombre">Nombre *</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="txtNombre" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="apellido">Apellido *</label>
                    <input type="text" class="form-control" placeholder="Apellido" name="apellido" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control"  placeholder="Email" name="correo" required>
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                
            </div>      

            <div class="form-row">
                
                 <div class="form-group col-md-6">
                    <label for="inputCity">País *</label>
                    <input type="text" class="form-control" id="inputCity" placeholder="pais" name="pais" required >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">Ciudad</label>
                    <input type="text" class="form-control" id="inputCity" placeholder="ciudad" name="ciudad" >
                </div>
               
                <div class="form-group col-md-4">
                    <label for="inputState">Tipo de Usuario *</label >
                    <select id="inputState" class="form-control" name="tipo_usuario">
                        <option selected value="ESTUDIANTE">Estudiante</option>
                        <option value="PROFESOR">Profesor</option>
                        <option value="PROFESIONAL">Profesional</option>
                    </select>
                </div>

<!--                <div class="form-group col-md-2">
                    <label for="inputZip">Código *</label>
                    <input type="text" class="form-control" name="codigo" value="" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                    event.returnValue = false;" id="inputZip" placeholder="Código de Usuario" required>  
                </div>-->
            </div>
            <h4 class="mt-3">Información de cuenta</h4>
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre de Usuario *</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="usuario" placeholder="Ingresar nombre de Usuario" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Ingresa su Contraseña *</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="contraseña" name="contrasena" maxlength="20" required>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Confirmar Contraseña *</label>
                <input type="password" class="form-control" id="exampleInputPassword" placeholder="Confirmar contraseña" name="cclave" maxlength="20" required>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" name="aceptar_terminos" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        <a href="aceptoterminos.php" target="_blank" > Acepto los términos y condiciones </a>
                    </label>
                    <div class="invalid-feedback">
                        Debe aceptar antes de enviar.
                    </div>
                </div>
            </div>

            <button id="btn-registro" type="submit" name="guardar" class="btn btn-primary">Registrarme</button>

        </form>




    </div>  
</div>  
<script>
    $("#txtNombre").focus();
</script>
<!--        <br>

        <footer>
            <div class="pie">
                <p>
                    <a href="index.php">Inicio</a> | 
                    <a href="contactenos.php">Contáctenos</a> |
                    <a href="registro.php">Registro</a> |
                    <a href="ingreso.php">Login</a> |                                                
                </p>
                <p>
                    Copyright 2018. <a href="http://www.uis.edu.co/" rel="develop">Universidad Industrial de Santander</a>   <a href="http://www.filosofiayensenanza.org/inicio/" rel="develop">Grupo FiloEn</a>
                </p>                   
            </div>
        </footer>
        <script src="js/funcionesGenerales.js"></script>
        <script src="pluging/NotificationStyles/js/modernizr.custom.js" type="text/javascript"></script>
        <script src="pluging/NotificationStyles/js/classie.js" type="text/javascript"></script>
        <script src="pluging/NotificationStyles/js/notificationFx.js" type="text/javascript"></script>

    </body>
</html>-->
