<?php 

include_once("views/header.php");

//var_dump($_SESSION);//die();
//echo $_GET['action'];
if ($_GET['action'] == "updateUser") {
    $titulo = "Actualizar ";
    $boton = "Actualizar";
    $target = $_GET['action'];
} elseif ($_GET['action'] == "createUser") {
    $titulo = "Crear Nuevo ";
    $boton = "Registrar";
    $target = $_GET['action'];
}
?>
    <body>
        <h1><?=$titulo?> Usuario</h1>

        <!-- --- Mensaje del Registro --->
  
        <?php if(isset($_SESSION['registerData']['register']) && $_SESSION['registerData']['register'] == "Failed"): ?>
            <div id="mensaje-container">
                <strong class="mensaje_false">El Registro no se ha podido Completar Correctamente,<br> corrija los errores e intente nuevamente.</strong>
            </div>
        <?php endif; ?>

        <form action="?controller=user&action=save" method="POST">

        <!-- Envio como Ocultos dentro del form el ID del usuario 
             Y el target (create o update) -->
            <input type="hidden" id="id" name="id" value="<?=$_SESSION['registerData']['id']?>">
            <input type="hidden" id="target" name="target" value="<?=$target?>">

            <label for="name">Nombre:</label><br>
            <input type="text" id="name" name="name" value="<?=$_SESSION['registerData']['name']?>" required>

            <?= isset($_SESSION["registerMsg"]['name']) ? $_SESSION["registerMsg"]['name'].'<br>' : '' ?>
            <br>
            <label for="surname">Apellido:</label>
            <input type="text" id="surname" name="surname" value="<?=$_SESSION['registerData']['surname']?>" required>

            <?= isset($_SESSION["registerMsg"]['surname']) ? $_SESSION["registerMsg"]['surname'].'<br>' : '' ?>
            <br>
            <label for="password1">Contraseña:</label>
            <input type="password" id="password1" name="password1" required><br>

            <br>
            <label for="password2">Repetir Contraseña:</label>
            <input type="password" id="password2" name="password2" required><br>

            <?= isset($_SESSION["registerMsg"]['password']) ? $_SESSION["registerMsg"]['password'].'<br>' : '' ?>

            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?=$_SESSION['registerData']['email']?>" required>

            <?= isset($_SESSION["registerMsg"]['email']) ? $_SESSION["registerMsg"]['email'].'<br>' : '' ?>
            
            <input type="submit" value="<?=$boton?>">
            </br></br>
            <button onclick="limpiarFormulario()">Limpiar formulario</button>
        </form>
        <script>
        function limpiarFormulario() {
                window.location.href = '?controller=user&action=clearSession';
            }
        </script>
    </body>
<?php include_once("views/footer.php");?>
