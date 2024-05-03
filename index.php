<?php
require_once("db/db.php");
require_once("controllers/userController.php");
require_once("session.php");


//--- MAGIA DEL INDEX.PHP ---
if(isset($_GET['controller'])){
    
    $nombre_controlador = $_GET['controller'].'Controller';
    
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    
    $nombre_controlador = "userController";
    $action = "index";
    $action_default = "index";
    
}


if(class_exists($nombre_controlador)){
    
    $controlador = new $nombre_controlador();
    
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        
        $action = $_GET['action'];
        $controlador->$action();
        
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    
        $action_default = "index";
        $controlador->$action_default();
        
    }
}