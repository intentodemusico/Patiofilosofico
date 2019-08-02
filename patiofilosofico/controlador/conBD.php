<?php

date_default_timezone_set('America/Bogota');

class conBD
{

    static public function conectar()
    {
        $host = "localhost:3306";
        $dbuser = "laravel";
        $dbpwd = "laravel";
        $db = "patiofilosofico";

        $connect = mysqli_connect($host, $dbuser, $dbpwd, $db);
        return $connect;
    }


    static function ejecutarInsert($sentencia)
    {
        $conn1 = conBD::conectar();
        $resp = mysqli_query($conn1, $sentencia);
        mysqli_close($conn1);
        return $resp;
    }

    static function getFechaActual()
    {
        $hoy = new DateTime('now');
        $hoy = $hoy->format("Y-m-d H:i:s");
        return $hoy;
    }
}
