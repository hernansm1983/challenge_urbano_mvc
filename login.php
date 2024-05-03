<?php
session_start();
require_once("db/db.php");
require_once("models/User.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consultamos la base de datos para verificar las credenciales
    // Creamos una instancia del modelo User
    $userModel = new User();

    // Obtenemos los datos del usuario por email
    $userData = $userModel->getUserByEmail($email);

    if ($userData && password_verify($password, $userData['password'])) {
        // Las credenciales son válidas, iniciamos sesión
        $_SESSION["userId"] = $userData["id"];
        $_SESSION["userEmail"] = $userData["email"];
        $_SESSION["userName"] = $userData["name"];
        
        // Redirigir al usuario a la página de inicio
        header("Location: index.php");
    } else {
        // Las credenciales no son válidas, mostramos el mensaje de error
        $_SESSION["error"] = "El email o la contraseña son incorrectos.";
        header("Location: views/loginForm.php");
    }
}
