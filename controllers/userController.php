<?php


require_once("models/User.php");
//$per = new User();

class userController {

    // --- Carga la vista de todos los Usuarios creados ---
    public function index() {
        $per = new User();
        $datos = $per->getUsers();
        require_once("views/usersList.phtml");
    }


    // --- Carga el Form de creacion de Usuarios ---
    public function createUser() {
        require_once("views/usersCreateForm.phtml");
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

            require_once("views/usersCreateForm.phtml");
        } else {
            // ERROR
        }
    }


    // --- Borra la session y limpia el formulario de registro ---
    public function clearSession() {

        if (isset($_SESSION['registerData'])) {
            session_unset($_SESSION['registerData']);
        }

        require_once("views/usersCreateForm.phtml");
    }

    // --- Guarda en la DB 
    public function save(){ 
        
        if(isset($_POST)){

            // --- Establecemos en una Variable de session que estamos creando un usuario nuevo ---
            $_SESSION['registerData']['action'] = "create";
            
            $id = isset($_POST['id']) ? $_POST['id'] : false;
           // die($id);
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
                $errores['name'] = "El nombre no es válido, no debe contener numeros";
            }

            // Validar apellidos
            if(empty($surname) || is_numeric($surname) || preg_match("/[0-9]/", $surname)){
                $errores['surname'] = "El apellido no es válido, no debe contener numeros";
            }

            // Validar el email
            if(empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errores['email'] = "El email no es válido";
            }

            // Validar la contraseña
            if(!empty($password1) && !empty($password2) ){
                
                if($password1 != $password2){
                    $errores['password'] = "Las contraseñas deben ser iguales";
                }
                    
            }else{
                $errores['password'] = "Las contraseñas no deben estar vacías";
            }
            
            $user = new User();
            $user->setName($name);
            $user->setSurname($surname);
            $user->setEmail($email);
            $user->setPassword($password1);
            
            $guardar_usuario = false;
	
            if(count($errores) == 0){
                
                    $guardar_usuario = true;
            
                    // --- Se llama al create o al update ---
                    if (isset($id)) {
                        //die("update");
                        $save = $user->updateUser($id);

                        if($save){
    
                            $_SESSION['register'] = "Complete";
                            if (isset($_SESSION['registerData'])) {
                                unset($_SESSION['registerData']);
                            }
    
                            echo "<script>alert('Usuario editado correctamente'); window.location.href = '?';</script>";
                            //header("Location:?");
                            exit();
                        }else{
                            $_SESSION['register'] = "Failed";
                        }

                    } else {
                        //die("create");
                        $save = $user->saveUser();
                        if($save){
    
                            $_SESSION['register'] = "Complete";
                            if (isset($_SESSION['registerData'])) {
                                unset($_SESSION['registerData']);
                            }
    
                            echo "<script>alert('Usuario creado correctamente'); window.location.href = '?';</script>";
                            //header("Location:?");
                            exit();
                        }else{
                            $_SESSION['register'] = "Failed";
                        }
                    }
                    
                }else{
                    $_SESSION['register'] = $errores;
                    header("Location:?controller=user&action=createUser");
                }
        }
        
    }

    // --- Eliminar Usuario ---
    public function deleteUser() {

        //die("delete");

        $id = isset($_GET['id']) ? $_GET['id'] : false;
        //die("id=".$id);
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
        exit();
    }
}