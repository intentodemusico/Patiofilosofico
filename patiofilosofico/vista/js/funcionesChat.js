/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function seguirUsuario() {
//        var datos = {"oper": "seguir usuario", "idseguir": $idUsuarioSeguir};

    var paqueteDeDatos = new FormData();
    paqueteDeDatos.append("oper", "seguir usuario");
    paqueteDeDatos.append("idseguir", $idUsuarioSeguir);
    console.log('inicio de ajax, Data = ');
    console.log(paqueteDeDatos);
    $.ajax({
        url: "../controlador/usuarios.php",
        type: "POST",
        data: paqueteDeDatos,
        contentType: false,
        processData: false,
        cache: false,
        success: function (result) {
            $("#contresultados").append(result);
//                    $("#btn_dejarSeguir").css('display','inline-block');
//                    $("#btn_seguir").css('display','none');


        },
        error: function (e) {
            console.log("falla en el envio ajax Seguir");
            $("#contresultados").append("ha ocurrido un Error en el envio del formulario ");
        }
    });
}
function dejarSeguirUsuario() {
//        var datos = {"oper": "seguir usuario", "idseguir": $idUsuarioSeguir};

    var paqueteDeDatos = new FormData();
    paqueteDeDatos.append("oper", "dejar de seguir usuario");
    paqueteDeDatos.append("idseguir", $idUsuarioSeguir);
    $.ajax({
        url: "../controlador/usuarios.php",
        type: "POST",
        data: paqueteDeDatos,
        contentType: false,
        processData: false,
        cache: false,
        success: function (result) {
            $("#contresultados").append(result);
//                    $("#btn_seguir").css('display','inline-block');
//                    $("#btn_dejarSeguir").css('display','none');

        },
        error: function (e) {
            console.log("falla en el envio ajax Seguir");
            $("#contresultados").append("ha ocurrido un Error en el envio del formulario ");
        }
    });
}
function iniciarComversacion() {
//        var datos = {"oper": "seguir usuario", "idseguir": $idUsuarioSeguir};
    if ($("#chat_" + $idUsuarioSeguir).length == 0) {
        var paqueteDeDatos = new FormData();
        paqueteDeDatos.append("oper", "carga conversacion Usuario");
//        paqueteDeDatos.append("oper", "carga conversacion Usuario");
        paqueteDeDatos.append("idrecibe", $idUsuarioSeguir);
        $.ajax({
            url: "../controlador/chats.php",
            type: "POST",
            data: paqueteDeDatos,
            contentType: false,
            processData: false,
            cache: false,
            success: function (result) {
                $("#chat-content").append(result);
//                    $("#btn_seguir").css('display','inline-block');
//                    $("#btn_dejarSeguir").css('display','none');

            },
            error: function (e) {
                console.log("falla en el envio ajax Seguir");
                $("#contresultados").append("ha ocurrido un Error en el envio del formulario ");
            }
        });
    }
}
function verComversacion(idContenedor, idUser) {
//        var datos = {"oper": "seguir usuario", "idseguir": $idUsuarioSeguir};
    $idUsuarioSeguir = idUser;
//        if ($("#chat_" + $idUsuarioSeguir).length == 0) {
    var paqueteDeDatos = new FormData();
    paqueteDeDatos.append("oper", "ver conversacion Usuario");
    paqueteDeDatos.append("idrecibe", $idUsuarioSeguir);
    $.ajax({
        url: "../controlador/chats.php",
        type: "POST",
        data: paqueteDeDatos,
        contentType: false,
        processData: false,
        cache: false,
        success: function (result) {
            $("#" + idContenedor).html(result);
//                    $("#btn_seguir").css('display','inline-block');
//                    $("#btn_dejarSeguir").css('display','none');

        },
        error: function (e) {
            console.log("falla en el envio ajax Seguir");
            $("#contresultados").append("ha ocurrido un Error en el envio del formulario ");
        }
    });
//        }
}
function iniciarComversacion($idUsuarioSeguir) {
//        var datos = {"oper": "seguir usuario", "idseguir": $idUsuarioSeguir};
    if ($("#chat_" + $idUsuarioSeguir).length == 0) {
        var paqueteDeDatos = new FormData();
        paqueteDeDatos.append("oper", "cargar conversacion Usuario");
        paqueteDeDatos.append("idrecibe", $idUsuarioSeguir);
        $.ajax({
            url: "../controlador/chats.php",
            type: "POST",
            data: paqueteDeDatos,
            contentType: false,
            processData: false,
            cache: false,
            success: function (result) {
                $("#chat-content").append(result);
//                    $("#btn_seguir").css('display','inline-block');
//                    $("#btn_dejarSeguir").css('display','none');

            },
            error: function (e) {
                console.log("falla en el envio ajax Seguir");
                $("#contresultados").append("ha ocurrido un Error en el envio del formulario ");
            }
        });
    }
}


