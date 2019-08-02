<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//    include '../../controlador/usuarios.php';
include '../../modelo/Usuario.php';
session_start();
$s = $_SESSION;
$user = new Usuario();
//    $conn = NULL;
if (isset($s['usuario']))
    $user = unserialize($s['usuario']);
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <link href="../../vista/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../../vista/pluging/fontawesome-free-5.3.1-web/css/all.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../../vista/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="../../vista/js/funcionesGenerales.js" type="text/javascript"></script>
        <style>

            /*::-webkit-scrollbar {
              width: 9px;
              height: 9px;
            }
            ::-webkit-scrollbar-button {
              width: 0px;
              height: 0px;
            }
            ::-webkit-scrollbar-thumb {
              background: #9f9f9f;
              border: 0px none #ffffff;
              border-radius: 50px;
            }
            ::-webkit-scrollbar-thumb:hover {
              background: #b5b5b5;
            }
            ::-webkit-scrollbar-thumb:active {
              background: #636476;
            }
            ::-webkit-scrollbar-track {
              background: #666666;
              border: 0px none #ffffff;
              border-radius: 50px;
            }
            ::-webkit-scrollbar-track:hover {
              background: #666666;
            }
            ::-webkit-scrollbar-track:active {
              background: #333333;
            }
            ::-webkit-scrollbar-corner {
              background: transparent;
            }*/
            .scroll-item::-webkit-scrollbar {
                width: 9px;
                height: 9px;
            }
            .scroll-item::-webkit-scrollbar:horizontal {height:9px}
            .scroll-item::-webkit-scrollbar:vertical {width:9px} 
            /*.scroll-item::-webkit-scrollbar{width:6px}*/
            .scroll-item::-webkit-scrollbar-track{background-color:rgba(0,0,0,.1)}
            .scroll-item::-webkit-scrollbar-thumb{background-color:#fff}
            .scroll-gris-claro::-webkit-scrollbar{width:5px;background-color:#fff}
            .scroll-gris-claro::-webkit-scrollbar-track{background-color:rgba(38,50,56,.19)}
            .scroll-gris-claro::-webkit-scrollbar-thumb{background-color:#263238;border-radius:10px}
            .scroll-gris::-webkit-scrollbar{width:10px;background-color:#cecece}
            .scroll-blue::-webkit-scrollbar-track{
                background-color:rgba(0,0,0,.3);
                -webkit-box-shadow:inset 0 0 10px rgba(0,0,0,.38)
            }
            .scroll-blue::-webkit-scrollbar-thumb{
                background-color:#ababab;border-radius:10px;
                /*-webkit-box-shadow:inset 0 2px 15px #fff;*/
                /*-webkit-box-shadow:inset 0 2px 15px rgba(255, 255, 255, 0.31);*/
            }
            .scroll-blue::-webkit-scrollbar{
                width:8px;
                background-color:#000}
            .scroll-blue::-webkit-scrollbar-track{
                background-color:#fff}
            .scroll-blue::-webkit-scrollbar-thumb{
                background-color:#00BCD4;
                border-radius:10px;
                background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.3) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.3) 50%,rgba(255,255,255,.3) 75%,transparent 75%,transparent)}
            .scroll-verde::-webkit-scrollbar{width:8px;background-color:#000}
            .scroll-verde::-webkit-scrollbar-track{
                background-color:#fff}
            .scroll-verde::-webkit-scrollbar-thumb{
                background-color:#8BC34A;
                border-radius:10px;
                background-image:-webkit-linear-gradient(45deg,rgba(0,0,0,.3) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.3) 50%,rgba(0,0,0,.3) 75%,transparent 75%,transparent)}
            textarea6::-webkit-scrollbar{
                width:12px;
                background-color:#000}
            textarea6::-webkit-scrollbar-track{
                background-color:#fff}
            textarea6::-webkit-scrollbar-thumb{
                background-color:#8BC34A}
            textarea6::-webkit-scrollbar-button{
                background-color:#009688}
            </style>
            <style>
            body{
                height: 200%;
            }
            div#chat-content {
                position: fixed;
                bottom: 0px;
                right: 0px;
                /* max-height: 50%; */
                overflow-y: auto;
            }

            .conversacion {
                max-width: 300px;
                font-size: 13px;
                margin-right: 5px;
                background: rgb(236, 245, 255);
                border: 1px solid #d6d6d6;
                padding: 6px 5px 30px 17px;
                border-radius: 5px 5px 0px 0px;
            }
            .cuerpo-chat {
                max-height: 310px;
                /*border: 1px solid red;*/
                overflow-y: auto;
                padding-left: 40px;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            p.mensaje {
                margin-bottom: 2px;
            }
            .text-mensaje {
                border-radius: 5px;
                border: 1px solid #007bff;
                padding: 13px;
                background: rgba(124, 162, 204, 0.94);
                color: #f9f9f9;
                width: 93%;
            }

            .mensaje-izq {
                margin-top: 5px;
                /* margin-bottom: 5px; */
            }
            .mensaje-der {
                margin-top: 13px;
                display: table;
            }
            .mensaje-der .nomb-cuerpo-chat {
                display: none;
                margin-top: 10px;
            }
            .mensaje-der > .text-mensaje {
                background: #ececec;
                border: 1px solid #cccaca;
                color: #5a5a5a;
                float: right;
                margin-right: 6px;
            }
            .mensaje-der > .text-mensaje > span.f-h-mensaje {
                color: #827e7e;
            }

            span.f-h-mensaje {
                font-size: 10px;
                color: #f1eded;
            }
            img.img-user-chat {
                /* max-height: 40px; */
                /* max-width: 40px; */
                height: 34px;
                width: 34px;
                border-radius: 50%;
                border: 3px solid rgba(0, 123, 255, 0.5);
                position: relative;
                /* left: -30px; */
                /* margin-top: 16px; */
                float: left;
                background: #fff;
                border: 3px solid #71b5ff;
                margin-left: -37px;
            }
            .input-chat {
                height: 40px;
                font-size: 14px;
                line-height: 17px;
                max-height: 120px;
                resize: none;
                padding-right: 29px;
            }
            .input-chat:focus {
                border: none;
            }
            .btn-chat{
                color: #00cc66;
                float: right;
                position: relative;
                top: -34px;
                margin-right: 12px;
                border-radius: 10px;
                background: rgba(239, 237, 237, 0.89);
                border: 1px solid rgba(17, 17, 17, 0.21);
            }
            .btn-chat:hover{
                color: #00da40;
                font-weight: bold;
                border-radius: 10px;
                background: #fff;

            }
            .btn-chat i.fa.fa-paper-plane {
                -webkit-transform: rotate(15deg);
                -moz-transform: rotate(15deg);
                rotation: 15deg;
                transform: rotate(16deg);
            }
            .mensaje-chat{
                margin-top: 5px;
            }
        </style>
    </head>
    <body>
        <textarea id="text-area" rows="1" cols="50"></textarea>
        <?php
        echo "<h3>la persona es </h3>" . $user->getNombre();
        echo " con nombre de usuario: " . $user->getUser();
        ?>
        <script type="text/javascript" language="javascript">
//            resizeIt = function() {
//              var str = $('text-area').value;
//              var cols = $('text-area').cols;
//
//              var linecount = 0;
//              $A(str.split("\n")).each( function(l) {
//                  linecount += Math.ceil( l.length / cols ); // Take into account long lines
//              })
//              $('text-area').rows = linecount + 1;
//            };
//
//            // You could attach to keyUp, etc. if keydown doesn't work
////            Event.observe('text-area', 'keydown', resizeIt );
//            $("#text-area").on('keyup',function (){
//                resizeIt();
//            });
//
//            resizeIt(); //Initial on load

            function textAreaAjustable(textareas) {
                textareas.each(function () {
                    var textarea = $(this);

                    if (!textarea.hasClass('autoHeightDone')) {
//            textarea.addClass('autoHeightDone');

                        var extraHeight = parseInt(textarea.css('padding-top')) + parseInt(textarea.css('padding-bottom')), // to set total height - padding size
                                h = textarea[0].scrollHeight - extraHeight;

                        // init height
                        textarea.height('auto').height(h);

                        textarea.bind('keyup', function (e) {

                            var code = (e.keyCode ? e.keyCode : e.which);
                            if (code == 13) {
                                alert("se enviara el formulario");
                                return false;
                            }
                            textarea.removeAttr('style'); // no funciona el height auto

                            h = textarea.get(0).scrollHeight - extraHeight;

                            textarea.height(h + 'px'); // set new height
                        });
                    }
                });

            }
            $(function () {
                textAreaAjustable($('textarea'));
            });
        </script>
        
        <div id="chat-content">
            <div class="conversacion">
                <div class="titulo-chat">
                </div>
                <div class="cuerpo-chat scroll-item scroll-blue" id="chat_7">
                    <div class="mensaje-izq">
                        <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="../../vista/Imagenes/22.png"> </div>
                        <div class="text-mensaje">
                            <p class="mensaje">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, </p>
                            <span class="f-h-mensaje">24 abr 2017 | 23:45</span>
                        </div>
                    </div>
                    <div class="mensaje-der">
                        <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="../../vista/Imagenes/22.png"> </div>
                        <div class="text-mensaje">
                            <p class="mensaje">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, </p>
                            <span class="f-h-mensaje">24 abr 2017 | 23:45</span>
                        </div>
                    </div>
                    <div class="mensaje-izq">
                        <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="../../vista/Imagenes/22.png"> </div>
                        <div class="text-mensaje">
                            <p class="mensaje">Lorem Ipsum es. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, </p>
                            <span class="f-h-mensaje">24 abr 2017 | 23:45</span>
                        </div>
                    </div>
                    <div class="mensaje-izq">
                        <div class="nomb-cuerpo-chat"> <img class="img-user-chat" src="../../vista/Imagenes/22.png"> 
                        </div>
                        <div class="text-mensaje">
                            <p class="mensaje">Lorem Ipsum es. desde el año 1500, </p>
                            <span class="f-h-mensaje">24 abr 2017 | 23:45</span>
                        </div>
                    </div>
                </div>
                <div class="mensaje-chat ">

                    <form action="../../controlador/chats.php" method="post" onsubmit="envioFormulario(this,'chat_7',false); return false;">
                        <input type="hidden" name="oper" value="envio mensaje">
                        <input type="hidden" name="idRecibe" value="7">
                        <textarea name="mensaje"  class="form-control input-chat scroll-item scroll-blue"></textarea>
                        <a href="#1" class="btn btn-sm btn-defauld btn-chat" onclick="$(this).parent().submit();"><i class="fa fa-paper-plane"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

