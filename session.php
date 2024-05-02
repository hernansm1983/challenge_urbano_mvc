<?php
session_start();

// Verificar si no hay una sesión iniciada
if (!isset($_SESSION["userId"])) {
    
    // Construir la URL absoluta hacia loginForm.php
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = substr($url, 0, strpos($url, "/", 8)); // Eliminar cualquier subdirectorio

    // Redirigir al usuario a la página de inicio de sesión
    header("Location: $url/views/loginForm.php");
   // exit();
}
?>
