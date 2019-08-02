
<?php
include '../modelo/Usuario.php';
session_start();

if ($_SESSION['usuario']) {
    $nombre = unserialize($_SESSION['usuario']);
    ?><?php
} else {

    echo 'no se encuentra la varialbe de session';
}
?>
<!--<div class="container">-->
<div id="ctn_notificacion"></div>
<form enctype="multipart/form-data" id="formMultimedia" method="post" class="container mt-3" action="../controlador/Noticias.php"  onsubmit="envioFormularioMultiPart2('formMultimedia', 'ctn_notificacion', true); return false;">
    <input type="hidden" name="oper" id="oper" value="nueva noticia" >
    <input type="hidden" name="MAX_FILE_SIZE" value="9000000" />
    <div class="row">
        <div class="col-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Desea marcar como destacada esta noticia?</label><br>
                <select name="estado" size="1" id="estado" class="form-control input-md">
                    <option value="ACTIVA">Normal </option>
                    <option value="DESTACADA">Destacada </option>
                </select>
                <br>
                <i class="text-muted texto6">Las noticias destacadas se muestran en la parte superior y con un mayor tamaño.</i>
            </div>
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" name="titulo" id="titulo" required="">
            </div>
            <div class="form-group">
                <label>Subtitulo</label>
                <input type="text" class="form-control" name="subtitulo">
            </div>
            <div class="form-group">
                <label>Contenido</label>
                <textarea class="form-control" rows="10" style="resize: none;" id="txtEditor" name="contenido" placeholder="El contenido de la noticia..." required></textarea> 
            </div>
        </div>
        <div class="col-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="link_noticia">Enlace noticia:</label>
                <input type="text" class="form-control" name="enlace" placeholder="enlace de la noticia completa..." maxlength="500" id="link_noticia" required>
            </div>
            <div class="form-group">
                <label for="multimedia">Multimedia:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="urlMultimedia" required="" readonly="">
                    <div class="input-group-btn">
                        <a href="#1" class="btn btn-lg btn-default form-control" onclick="ocultarVideo('multimedia');" style="width: 100%;"><i class="fa fa-image"></i></a>
                    </div>
                    <div class="input-group-btn">
                        <a href="#1" class="btn btn-lg btn-defauld form-control" onclick="ocultarImagen('multimedia');" style="width: 100%;"><i class="fa fa-film"></i></a>
                    </div>

                </div>

                <i class="text-muted texto6">seleccione el archivo de la imagen o video relacionado a esta noticia, tambien puede copiar el enlace si se ecuentra almacenado en algun servidor externo.</i>                         
            </div>
            <div class="form-group">
                <img id="prev_imagen" width="50%" height="50%" src="" />
                <video width="400" class="video-noticia" controls id="rep_video" >
                    <source src="" id="prev_video">
                    Your browser does not support HTML5 video.
                </video>
            </div>
            <div class="form-group">
                <!--<div class="form-group">-->
                <input type="submit" value="Publicar" class="btn btn-primary">
                <!--</div>-->
            </div>
        </div>
    </div>
    <input type="file" name="multimedia" id="multimedia"  style="display: none" required>
    <input type="hidden" name="tipoMultimedia" id="tipoMultimedia"  value="x" id="operMultimedia">
</form>



<div id="mensaje"></div>
<script>

    $('#rep_video').hide();
    $('#prev_imagen').hide();
    $maxiTamanoArchivo = 8000000;
    function ocultarVideo(filImg) {
        $('#rep_video').hide();
        document.getElementById('rep_video').pause();
        $("#" + filImg).val('');
//		$("#multimedia").off('change');
        $("#multimedia").change(function () {
            var fileSize = this.files[0].size;
            if (fileSize > $maxiTamanoArchivo) {
                var noty = new NotificationFx({message: '<h5>Tamaño superado</h5><p>El archivo no debe superar los 8MB, por favor verifique e intente de nuevo</p>',
                    layout: 'growl', effect: 'slide', type: 'warning'});
                noty.show();
                $("#multimedia").val('');
            } else {
                previsualizarImage(this, 'prev_imagen');
            }
            previsualizarImage(this, 'prev_imagen');

        });
        $("#tipoMultimedia").val('imagen');
        $("#multimedia").attr("accept", "image/x-png,image/gif,image/jpeg");
        $("#multimedia").click();

//                var $source = $(#rep_video).children('source');
//                $source[0].src = URL.createObjectURL('');
    }
//	    function validarArchivo() {
//		var fileSize = $("#multimedia").files[0].size;
//		if (fileSize > maxi_tamano_archivo) {
//		    var noty = new NotificationFx({message: '<h5>Tamaño superado</h5><p>El archivo no debe superar los 8MB, por favor verifique e intente de nuevo</p>',
//			layout: 'growl', effect: 'slide', type: 'warning'});
//		    noty.show();
//		}else{
//		    envioFormularioMultiPart('formMultimedia', 'ctn_notificacion', true);
//		}
//	    }
    function ocultarImagen(filVid) {
        $('#prev_imagen').hide();
        $("#" + filVid).val('');
//		$("#multimedia").off('change');
        $("#multimedia").change(function () {
            var fileSize = this.files[0].size;
            if (fileSize > $maxiTamanoArchivo) {
                var noty = new NotificationFx({message: '<h5>Tamaño superado</h5><p>El archivo no debe superar los 8MB, por favor verifique e intente de nuevo</p>',
                    layout: 'growl', effect: 'slide', type: 'warning'});
                noty.show();
                $("#multimedia").val('');
            } else {
                previsualizarVideo(this, 'rep_video');
            }

        });
        $("#tipoMultimedia").val('video');
        $("#multimedia").attr("accept", "video/mp4,video/x-m4v,video/*");
        $("#multimedia").click();
    }
    function previsualizarImage(inpuFile, contImagen) {
        $('#rep_video').hide();
        var file = inpuFile.files[0],
                imageType = /image.*/;

        if (!file.type.match(imageType))
            return;

        var reader = new FileReader();
        reader.onload = function fileOnload(e) {
            var result = e.target.result;
            $('#' + contImagen).attr("src", result);
            $('#' + contImagen).show();
        };
        reader.readAsDataURL(file);
        $("#urlMultimedia").val($(inpuFile).val());
    }

    function previsualizarVideo(inputFile, contVideo) {
        var $source = $('#' + contVideo).children('source');
        $source[0].src = URL.createObjectURL(inputFile.files[0]);
        $source.parent()[0].load();
//                   document.getElementById(contVideo).pause()
        $('#' + contVideo).show();
        $("#urlMultimedia").val($(inputFile).val());
    }

//                function fileOnload(e) {
//                    var result = e.target.result;
//                    $('#imgSalida').attr("src", result);
//                }

</script>

<script>
    $(document).ready(function () {
//                $("#txtEditor").Editor();
        $("#titulo").focus();
    }
    );
</script>
