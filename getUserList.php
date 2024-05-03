<?php
// Incluimos el archivo de conexión a la base de datos y el modelo de usuario
require_once("models/User.php");

// Creamos una instancia del modelo de usuario
$userModel = new User();

// Obtenemos la lista de usuarios
$userList = $userModel->getUsers();

// Devolvemos la lista de usuarios en formato JSON
header('Content-Type: application/json');
echo json_encode($userList);
