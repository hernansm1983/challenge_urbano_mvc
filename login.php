<?php
session_start();
require_once("db/db.php");
require_once("models/User.php");
//require_once("session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consultar la base de datos para verificar las credenciales
    // Crear una instancia del modelo User
    $userModel = new User();

    // Obtener los datos del usuario por email
    $userData = $userModel->getUserByEmail($email);

    if ($userData && password_verify($password, $userData['password'])) {
        // Las credenciales son válidas, iniciar sesión
        $_SESSION["userId"] = $userData["id"];
        $_SESSION["userEmail"] = $userData["email"];
        $_SESSION["userName"] = $userData["name"];
        
        // Redirigir al usuario a la página de inicio
        header("Location: index.php");
        exit();
    } else {
        // Las credenciales no son válidas, mostrar mensaje de error
        $_SESSION["error"] = "El email o la contraseña son incorrectos.";
        //var_dump($_SESSION);die();
        header("Location: views/loginForm.php");
        exit();
    }
}
?>
