<?php

session_start();

class Conectar{
    public static function conexion(){
        $conexion=new mysqli("mysql-artemisa-code.alwaysdata.net", "357066", "!Q2w3e4r%T", "artemisa-code_urbano-db");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>
