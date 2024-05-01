<?php
require_once("db/db.php");
require_once("controllers/userController.php");




//--- MAGIA DEL INDEX.PHP ---
if(isset($_GET['controller'])){
    
    $nombre_controlador = $_GET['controller'].'Controller';
    
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    
    $nombre_controlador = "userController";
    $action = "index";
    $action_default = "index";
    
}else{
    
    //show_error(); 
    
}
/*echo $nombre_controlador."</br>";
echo $action_default;
$controlador = new $nombre_controlador();
$controlador->$action();*/

if(class_exists($nombre_controlador)){
    
    $controlador = new $nombre_controlador();
    
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        
        $action = $_GET['action'];
        $controlador->$action();
        
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    
        $action_default = "index";
        $controlador->$action_default();
        
    }else{
        //show_error(); 
    }
}else{
    //show_error(); 
}   

//echo $nombre_controlador."</br>";
//echo $action_default;

//require_once 'views/layout/footer.php';
?>
