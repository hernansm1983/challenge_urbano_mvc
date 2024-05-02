<?php require_once("header.php"); ?>
<body>
    <h2>Iniciar sesión</h2>
    <div id="mensaje-container"><?= (($_SESSION["error"]) ? "Datos Incorrectos" : "Acceso al Sistema") ?></div>
    <br><br>
    <form action="../login.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
<?php include_once("footer.php");?>
