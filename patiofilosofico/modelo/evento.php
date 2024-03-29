<?php

//use conBD;
include '../controlador/conBD.php';

class evento {

    var $id = 0, $nombre = "SIN DEFINIR", $informacion = "", $fIni = "", $fFin = "", $lugar = "", $estado = "", $idAdmi = "", $participantes = "", $imagen = "", $web = "", $calendario = array() ;

    function evento($id, $nombre, $informacion, $fIni, $fFin, $lugar, $estado, $idAdmi, $participantes, $imagen,$web) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->informacion = $informacion;
        $this->fIni = $fIni;
        $this->fFin = $fFin;
        $this->lugar = $lugar;
        $this->estado = $estado;
        $this->idAdmi = $idAdmi;
        $this->participantes = $participantes;
        $this->imagen = $imagen;
        $this->web = $web;
    }


    function __construct() {

    }

    function getImagen() {
        return $this->imagen;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getInformacion() {
        return $this->informacion;
    }

    function getFIni() {
        return $this->fIni;
    }

    function getFFin() {
        return $this->fFin;
    }

    function getLugar() {
        return $this->lugar;
    }

    function getEstado() {
        return $this->estado;
    }

    function getIdAdmi() {
        return $this->idAdmi;
    }

    function getParticipantes() {
        return $this->participantes;
    }
    function getWeb() {
        return $this->web;
    }

    function getCalendario() {
        return $this->calendario;
    }

        function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setInformacion($informacion) {
        $this->informacion = $informacion;
    }

    function setFIni($fIni) {
        $this->fIni = $fIni;
    }

    function setFFin($fFin) {
        $this->fFin = $fFin;
    }

    function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setIdAdmi($idAdmi) {
        $this->idAdmi = $idAdmi;
    }

    function setParticipantes($participantes) {
        $this->participantes = $participantes;
    }
    function setWeb($web) {
        $this->web = $web;
    }

    function setCalendario($calendario) {
        $this->calendario = $calendario;
    }


    static public function eventoPorID($id) {
//        include_once '../controlador/conBD.php';
        $query = "SELECT `evento`.`idevento`,
    `evento`.`nombre`,
    `evento`.`inicio`,
    `evento`.`final`,
    `evento`.`lugar`,
    `evento`.`informacion`,
    `evento`.`estado`,
    `evento`.`idusuario`,
    `evento`.`imagen`,
    `evento`.`web`
FROM `evento` WHERE idevento = '" . $id . "';";
//        echo $query;
        $conn = conBD::conectar();

        //$participante = $this->participantesEvento($id);
        $result = mysqli_query($conn, $query);

        $datos_evento = mysqli_fetch_array($result);

        $mievento = new Evento();
        $mievento->evento($datos_evento['idevento'], $datos_evento['nombre'], $datos_evento['informacion'], $datos_evento['inicio'], $datos_evento['final'], $datos_evento['lugar'], $datos_evento['estado'], $datos_evento['idusuario'], 0, $datos_evento['imagen'],$datos_evento['web']);
        return $mievento;
        mysqli_close($conn);
        
    }

    static public function invitarAlEvento($idevento, $idusuario) {
//        include_once '../controlador/conBD.php';
        $query = "INSERT INTO `participante_evento`
(
`idusuario`,
`idevento`,
`estado`)
VALUES
(
'" . $idusuario . "',
'" . $idevento . "',
'INVITADO');";
//        echo $query;
        $conn = conBD::conectar();
        $result = mysqli_query($conn, $query);
        mysqli_close($conn);
    }

    static function participantesEvento($idevento) {

//        echo $query;
        $conn = conBD::conectar();
        $sql = "SELECT `participante_evento`.`idparticipante_evento`,
    `participante_evento`.`idusuario`,
    `participante_evento`.`idevento`,
    `participante_evento`.`estado`
FROM `participante_evento` WHERE idevento= '" . $idevento . "' ";

        $respuesta = mysqli_query($conn, $sql);
        $participante = [];
        while ($part = mysqli_fetch_assoc($respuesta)) {
            $userP = new Usuario();
            $userP->buscarUsuarioByiD($part["idusuario"]);
            array_push($participante, $userP);
        }

        //mysqli_close($conn);
        return $participante;
    }

    static function getTodosEventos() {

        $conn = conBD::conectar();
        $hoy = conBD::getFechaActual();
        $sql = "SELECT `evento`.`idevento`,
    `evento`.`nombre`,
    `evento`.`inicio`,
    `evento`.`final`,
    `evento`.`lugar`,
    `evento`.`informacion`,
    `evento`.`estado`,
    `evento`.`idusuario`,
    `evento`.`imagen`,
    `evento`.`web`
FROM `evento` WHERE estado = 'ACTIVO' AND final > '" . $hoy . "' ;";
//        echo $sql;
        $respuesta = mysqli_query($conn, $sql);
        $respEventos = [];
        while ($datos_evento = mysqli_fetch_assoc($respuesta)) {
            $miEve = new Evento();
            $partici = evento::participantesEvento($datos_evento['idevento']);
            $miEve->evento($datos_evento['idevento'], $datos_evento['nombre'], $datos_evento['informacion'], $datos_evento['inicio'], $datos_evento['final'], $datos_evento['lugar'], $datos_evento['estado'], $datos_evento['idusuario'], $partici, $datos_evento['imagen'], $datos_evento['web']);
            array_push($respEventos, $miEve);
        }
        return $respEventos;
        mysqli_close($conn);
    }

    static function registroEvento($nombre, $informacion, $fIni, $fFin, $lugar, $idAdmi,$web) {
        $conn = conBD::conectar();
        if($fFin == "" or $fFin == " "){
            $fFin = 'null';
        }else{
            $fFin = "'".$fFin."'";
        }
        $sql = "INSERT INTO `evento`
(
`nombre`,
`inicio`,
`final`,
`lugar`,
`informacion`,
`estado`,
`web`,
`idusuario`
)
VALUES
(
'" . $nombre . "',
'" . $fIni . "',
" . $fFin . ",
'" . $lugar . "',
'" . $informacion . "',
'ACTIVO',
'".$web."',
" . $idAdmi . ");";
//        echo $sql;
        if (mysqli_query($conn, $sql)) {
            $id = mysqli_insert_id($conn);
            mysqli_close($conn);
            return $id;
        } else {
            mysqli_close($conn);
            return 0;
        }
    }

    static function actualizarEventoImagen($idevento, $imagen) {
        $conn = conBD::conectar();
        $sql = "UPDATE `evento`
SET
`imagen` = '" . $imagen . "'
WHERE `idevento` = '" . $idevento . "';";
        if (mysqli_query($conn, $sql)) {
            $id = mysqli_insert_id($conn);
            mysqli_close($conn);
            return $id;
        } else {
            mysqli_close($conn);
            return 0;
        }
    }

     function registrarActividad($idevento, $fecha, $hora, $actividad) {
        $conn = conBD::conectar();
        $sql = "INSERT INTO `evento_actividad`
(
`idevento`,
`fecha`,
`hora`,
`actividad`)
VALUES
(
'".$idevento."',
'".$fecha."',
'".$hora."',
'".$actividad."');";
        if (mysqli_query($conn, $sql)) {
            $id = mysqli_insert_id($conn);
            mysqli_close($conn);
            return $id;
        } else {
            mysqli_close($conn);
            return 0;
        }
    }

    static function eliminarEvento($idevento) {
        $sql = "DELETE FROM `evento` WHERE idevento='".$idevento."' ;";
        $conn = conBD::conectar();
//        echo 'buscando comentarios ' . $sql;
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

}
