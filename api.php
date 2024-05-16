<?php
header("Content-Type: application/json; charset=UTF-8");

require_once("db/db.php");
require_once("controllers/userApiController.php");
//require_once("session.php");

$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$resource = array_shift($request);
$id = array_shift($request);

switch ($resource) {
    case 'users':
        $nombre_controlador = 'userApiController';
        //$action = $action ? $action : 'index'; 
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Recurso no encontrado."]);
        exit;
}

if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador();
   // echo json_encode($controlador);die();

    $method = $_SERVER['REQUEST_METHOD'];

    switch($method) {

        case 'GET':
            if ($id) {
                // --- getOneById ---
                if (method_exists($controlador, 'getOneById')) {
                    $controlador->getOneById($id);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Método GET no encontrado."]);    
                }
            } else {
                // --- getAll --
                if (method_exists($controlador, 'getAll')) {
                    $controlador->getAll();
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Método GET no encontrado."]);    
                }
            }
            break;

        case 'POST':
            // --- createUser ---
            if (method_exists($controlador, 'createUser')) {
                $controlador->createUser();
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Método POST no encontrado."]);    
            }
            break;

        case 'PUT':
            if ($id) {
                // --- updateUser ---
                if (method_exists($controlador, 'updateUser')) {
                    $controlador->updateUser($id);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Método PUT no encontrado."]);  
                }
            } else {
                http_response_code(400);
                echo json_encode(["message" => "ID requerido para PUT."]);   
            }
            break;

        case 'DELETE':
            if ($id) {
                // --- deleteUser ---
                if (method_exists($controlador, 'deleteUser')) {
                    $controlador->deleteUser($id);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Método DELETE no encontrado."]);  
                }
            } else {
                http_response_code(400);
                echo json_encode(["message" => "ID requerido para DELETE."]);      
            }
    }


   /* if (method_exists($controlador, $action)) {

        $controlador->$action();
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Acción no encontrada."]);
    }*/
} else {
    http_response_code(404);
    echo json_encode(["message" => "Controlador no encontrado."]);
}
