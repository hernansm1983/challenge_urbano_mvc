<?php

session_start();

class Conectar{
    public static function conexion(){
        $conexion=new mysqli("mysql_urbano", "user", "password", "urbano_db");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>
