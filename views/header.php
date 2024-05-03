<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Challenge Urbano</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <ul>
                <li><a href="../front.php" target="self">Front-End</a></li>
                <li><a href="?controller=user&action=index">Home</a></li>
                <li><a href="?controller=user&action=createUser">Alta Usuarios</a></li>
            </ul>
        </nav>
        <div class="user-info">
            <?php if(isset($_SESSION["userId"])): ?>
                <span>Bienvenido, <?php echo $_SESSION["userName"]; ?></span>
                <a class="nav-link" href="?controller=user&action=logout">Salir</a>
            <?php endif; ?>
        </div>
    </header>
</body>
</html>
