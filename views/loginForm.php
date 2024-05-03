<?php require_once("header.php"); ?>
<body>
    <h2>Iniciar sesión</h2>
    <div id="mensaje-container">Acceso al Sistema</div>
    <br><br>
    <form action="../login.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Iniciar sesión</button>
    </form>
    <?php if (isset($_SESSION["error"])) { ?>
        <br>
        <div id="mensaje-container" class="error-message">Datos Incorrectos</div>
    <?php } ?>
</body>
<?php include_once("footer.php");?>
