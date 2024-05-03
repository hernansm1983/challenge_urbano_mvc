<?php


require_once("models/User.php");

class userController {

    // --- Carga la vista de todos los Usuarios creados ---
    public function index() {

        if (isset($_SESSION['registerMsg'])) {
            unset($_SESSION['registerMsg']);
        }

        $per = new User();
        $datos = $per->getUsers();
        require_once("views/usersList.php");
    }


    // --- Carga el Form de creacion de Usuarios ---
    public function createUser() {
        // --- limpiamos las variables de session antes de redireccionar al form ---
        if (isset($_SESSION['registerData']) && $_GET['e'] != 1) {
            unset($_SESSION['registerData']);
        }
        require_once("views/usersCreateForm.php");
    }


    // --- Carga el Form de creacion de Usuarios ---
    public function updateUser() {
        // Cargar los datos del usuario por su ID
        $id = $_REQUEST['id'];
        $per = new User();
        $user = $per->getUserById($id);

        if ($user) {
            $_SESSION['registerData']['id'] = $id;
            $_SESSION['registerData']['name'] = $user['name'];
            $_SESSION['registerData']['surname'] = $user['surname'];
            $_SESSION['registerData']['email'] = $user['email'];
            $_SESSION['registerData']['action'] = "update";

            require_once("views/usersCreateForm.php");
        }
    }


    // --- Borra la session y limpia el formulario de registro ---
    public function clearSession() {

        if (isset($_SESSION['registerData'])) {
            unset($_SESSION['registerData']);
        }

        require_once("views/usersCreateForm.php");
    }


    // --- Guarda en la DB 
    public function save(){ 
        
        if(isset($_POST)){

            // --- Establecemos en una Variable de session que estamos creando un usuario nuevo ---
            $_SESSION['registerData']['action'] = "create";
            $action = isset($_POST['action']) ? $_POST['action'] : false;
            $target = isset($_POST['target']) ? $_POST['target'] : false;
            
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $surname = isset($_POST['surname']) ? $_POST['surname'] : false;
            $email = isset($_POST['email']) ? trim($_POST['email']) : false;
            $password1 = isset($_POST['password1']) ? $_POST['password1'] : false;
            $password2 = isset($_POST['password2']) ? $_POST['password2'] : false;
            
            //GUARDAMOS LOS DATOS INGRESADOS PARA USARLOS EN CASO DE ERRORES
            $_SESSION['registerData']['name'] = $_POST['name'];
            $_SESSION['registerData']['surname'] = $_POST['surname'];
            $_SESSION['registerData']['email'] = $_POST['email'];
            
            // Array de errores
            $errores = array();

            // Validar los datos antes de guardarlos en la base de datos
            // Validar campo nombre
            if(empty($name) || is_numeric($name) || preg_match("/[0-9]/", $name)){
                $errores['name'] = '<div class="error-message">El nombre no es válido, no debe contener numeros</div>';
            }

            // Validar apellidos
            if(empty($surname) || is_numeric($surname) || preg_match("/[0-9]/", $surname)){
                $errores['surname'] = '<div class="error-message">El apellido no es válido, no debe contener numeros</div>';
            }

            // Validar el email
            if(empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errores['email'] = '<div class="error-message">El email no es válido</div>';
            }

            // Validar la contraseña
            if(!empty($password1) && !empty($password2) ){
                
                if($password1 != $password2){
                    $errores['password'] = '<div class="error-message">Las contraseñas deben ser iguales</div>';
                } else {
                    // --- Ciframos la contraseña para darle mayor seguridad al sistema ---
                    $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                }
                    
            }else{
                $errores['password'] = '<div class="error-message">Las contraseñas no deben estar vacías</div>';
            }
            
            $user = new User();
            $user->setName($name);
            $user->setSurname($surname);
            $user->setEmail($email);
            $user->setPassword($hashedPassword);
	
            if(count($errores) == 0){
                
                    // --- Se llama al create o al update ---
                    if (!empty($id) && $target == "updateUser") {

                        $save = $user->updateUser($id);

                        if($save){
    
                            $_SESSION['registerData']['register'] = "Complete";
                            if (isset($_SESSION['registerData'])) {
                                unset($_SESSION['registerData']);
                            }
                            echo "<script>alert('Usuario editado correctamente'); window.location.href = '?';</script>";

                            exit();
                        }else{
                            $_SESSION['registerData']['register'] = "Failed";
                        }

                    } else {

                        $save = $user->saveUser();
                        if($save){
    
                            $_SESSION['registerData']['register'] = "Complete";
                            if (isset($_SESSION['registerData'])) {
                                unset($_SESSION['registerData']);
                                unset($_SESSION["registerMsg"]);
                            }
    
                            echo "<script>alert('Usuario creado correctamente'); window.location.href = '?';</script>";
                            exit();
                            
                        }else{
                            $_SESSION['registerData']['register'] = "Failed";
                        }
                    }
                    
                }else{

                    //--- Guardamos los mensajes de error del registro para mostrarlos en el form ---
                    $_SESSION['registerMsg'] = $errores;

                    if ($target == "createUser") {
                        header("Location:?controller=user&action=createUser&e=1");
                    } else {
                        header("Location:?controller=user&action=updateUser&id=" . $id);
                    }
                }
        }
        
    }

    // --- Eliminar Usuario ---
    public function deleteUser() {

        $id = isset($_GET['id']) ? $_GET['id'] : false;

        // Crear una instancia del modelo User
        $userModel = new User();

        // Llamar al método delete del modelo para eliminar el usuario por su ID
        $deleted = $userModel->deleteUserById($id);

        if ($deleted) {
            // Usuario eliminado correctamente
            $_SESSION['message'] = "Usuario eliminado correctamente";
        } else {
            // Error al eliminar el usuario
            $_SESSION['error'] = "Error al eliminar el usuario";
        }

        // Redirigir a la página de listado de usuarios
        header("Location: ?controller=user&action=index");
    }


    // --- Logout ---
    public function logout() {

        // Iniciar la sesión si aún no está iniciada
        session_start();

        // Destruir todas las variables de sesión
        session_unset();

        // Destruir la sesión
        session_destroy();

        // Redirigir al usuario a la página de inicio de sesión
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            header("Location: ../views/loginForm.php");
        } else {
            header("Location: /urbano/views/loginForm.php");
        }
    }
}