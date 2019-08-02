<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

date_default_timezone_set('America/Bogota');

class conBD {

//    var $host = "mysql7003.site4now.net";
//    var $dbuser = "a41246_filoen1";
//    var $dbpwd = "filoen123";
//    var $db = "db_a41246_filoen1";
    
    var $host = "mysql7001.site4now.net";
    var $dbuser = "a4591b_patiofi";
    var $dbpwd = "patiofilosofico1";
    var $db = "db_a4591b_patiofi";

//    var $host = "localhost";
//    var $dbuser = "root";
//    var $dbpwd = "buffalo1";
//    var $db = "dbfiloen";

    public function functionName($param) {
        echo 'hola mundo' . $param;
    }

    public function conectar() {
//	$host = "mysql7001.site4now.net";
//	$dbuser = "a430c2_filoen2";
//	$dbpwd = "0987654321a";
//	$db = "db_a430c2_filoen2";
//        $host = "localhost";
//        $dbuser = "root";
//        $dbpwd = "buffalo1";
//        $db = "dbfiloen";
        
        $host = "mysql7001.site4now.net";
        $dbuser = "a4591b_patiofi";
        $dbpwd = "patiofilosofico1";
        $db = "db_a4591b_patiofi";
        
        
//        $host= "localhost";
//	$dbuser = "root";
//	$dbpwd = "123buf";
//	$db = "db_a41246_filoen1";
//        $host = "sql10.freemysqlhosting.net";
//        $dbuser = "sql10269487";
//        $dbpwd = "rMqAwZWS8X";
//        $db = "sql10269487";
        $connect = mysqli_connect( $host, $dbuser, $dbpwd, $db);
//        print_r($connect);
        return $connect;
    }
    static public function conectarStatico() {
//	$host = "mysql7003.site4now.net";
//	$dbuser = "a41246_filoen1";
//	$dbpwd = "filoen123";
//	$db = "db_a41246_filoen1";
//        $host = "localhost";
//        $dbuser = "root";
//        $dbpwd = "buffalo1";
//        $db = "dbfiloen";
//        $host = "mysql7001.site4now.net";
//	$dbuser = "a430c2_filoen2";
//	$dbpwd = "0987654321a";
//	$db = "db_a430c2_filoen2";
        $host = "sql10.freemysqlhosting.net";
        $dbuser = "sql10269487";
        $dbpwd = "rMqAwZWS8X";
        $db = "sql10269487";
        $connect = mysqli_connect($host, $dbuser, $dbpwd, $db);
//        print_r($connect);
        return $connect;
    }

    static function ejecutarInsert($sentencia) {
        $conn1 = conBD::conectarStatico();
        $resp = mysqli_query($conn1, $sentencia);
        mysqli_close($conn1);
        return $resp;
    }

    static function getFechaActual() {
        $hoy = new DateTime('now');
        $hoy = $hoy->format("Y-m-d H:i:s");
//        $h = getdate();
//        print_r($h);
        return $hoy;
    }

}
