<?php


require_once("models/User.php");
//$per = new User();

class userController {

    public function index() {
        //echo "index entro";
    
        // Lógica para obtener datos (READ)
        $per = new User();
        $datos = $per->getUsers();
        require_once("views/usersList.phtml");
    }


    public function createUser() {
        require_once("views/usersCreateForm.phtml");
    }

    public function save(){ 
        
        if(isset($_POST)){
            
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
            if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)){
                    $nameValidated = true;
            }else{
                    $nameValidated = false;
                    $errores['name'] = "El nombre no es válido, no debe contener numeros";
            }

            // Validar apellidos
            if(!empty($surname) && !is_numeric($surname) && !preg_match("/[0-9]/", $surname)){
                    $surnameValidated = true;
            }else{
                    $surnameValidated = false;
                    $errores['surname'] = "El apellido no es válido, no debe contener numeros";
            }

            // Validar el email
            if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $emailValidated = true;
            }else{
                    $emailValidated = false;
                    $errores['email'] = "El email no es válido";
            }

            // Validar la contraseña
            if(!empty($password1) && !empty($password2) ){
                
                if($password1 == $password2){
                    $passwordValidated = true;    
                }else{
                    $passwordValidated = false;
                    $errores['password'] = "Las contraseñas deben ser iguales";
                }
                    
            }else{
                    $passwordValidated = false;
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
            
                    $save = $user->saveUser();
                    
                    if($save){
                        $_SESSION['register'] = "Complete";
                        //BORRA LOS CAMPOS INGRESADOS DEL REGISTRO
                        //Utils::deleteSession('datos_registro');
                        header("Location:?");
                    }else{
                        $_SESSION['register'] = "Failed";
                    }
                }else{
                    $_SESSION['register'] = $errores;
                    header("Location:?controller=user&action=createUser");
                }
        }
        
    }
}


/*

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Lógica para obtener datos (READ)
    $datos = $per->get_personas();
    require_once("views/personas_view.phtml");

} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lógica para insertar datos (CREATE)
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $contrasena = $_POST["contrasena"];
    $email = $_POST["email"];
    $per->insert_persona($nombre, $contrasena, $email);
    // Redireccionar o mostrar mensaje de éxito

} elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
    // Lógica para actualizar datos (UPDATE)
    // Recuperar datos del formulario
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT["id"];
    $nombre = $_PUT["nombre"];
    $contrasena = $_PUT["contrasena"];
    $email = $_PUT["email"];
    $per->update_persona($id, $nombre, $contrasena, $email);
    // Redireccionar o mostrar mensaje de éxito

} elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Lógica para eliminar datos (DELETE)
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE["id"];
    $per->delete_persona($id);
    // Redireccionar o mostrar mensaje de éxito

}*/

