<?php
// Incluir el archivo de conexión a la base de datos y el modelo de usuario
require_once("db/db.php");
require_once("models/User.php");

// Crear una instancia del modelo de usuario
$userModel = new User();

// Obtener la lista de usuarios
$userList = $userModel->getUsers();

// Devolver la lista de usuarios en formato JSON
header('Content-Type: application/json');
echo json_encode($userList);
?>
