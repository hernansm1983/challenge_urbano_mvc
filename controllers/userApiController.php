<?php

require_once("models/User.php");

/**
 * @Route http://localhost:8000/api.php
 */
class userApiController {

    /**
     * @Method GET
     * @Route users/
     */
    public function getAll() {
        $user = new User();
        $datos = $user->getUsers();
        http_response_code(200); // OK
        echo json_encode($datos);
    }


    /**
     * @Method GET
     * @Route /users/{id}
     */
    public function getOneById($id) {
        $user = new User();
        $datos = $user->getUserById($id);
        if ($datos) {
            http_response_code(200); // OK
            echo json_encode($datos);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["message" => "Usuario no encontrado."]);
        }
    }


    /**
     * @Method POST
     * @Route /users
     */
    public function createUser() {

        $input = json_decode(file_get_contents("php://input"));
        $name = $input->name;
        $surname = $input->surname;
        $email = $input->email;
        $password = $input->password;

        $user = new User();
        $user->setName($name);
        $user->setSurname($surname);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $createdUser = $user->saveUser();

        if ($createdUser) {
            http_response_code(201); // Created
            echo json_encode($createdUser);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(["message" => "No se pudo crear el usuario."]);
        }

    }



    /**
     * @Method PUT
     * @Route /users/{id}
     */
    public function updateUser($id) {

        $input = json_decode(file_get_contents("php://input"));
        //$id = $input->id;
        $name = $input->name;
        $surname = $input->surname;
        $email = $input->email;
        $password = $input->password;

        $user = new User();
        $user->setName($name);
        $user->setSurname($surname);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        if ($user->updateUser($id)) {
            $updatedUser = $user->getUserById($id);
            http_response_code(200); // OK
            echo json_encode($updatedUser);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(["message" => "No se pudo actualizar el usuario."]);
        }
    }


    /**
     * @Method DELETE
     * @Route /users/{id}
     */
    public function deleteUser($id) {

        $user = new User();
        if ($user->deleteUserById($id)) {
            echo json_encode(["message" => "Usuario eliminado correctamente."]);
            http_response_code(204); // OK
        } else {
            echo json_encode(["message" => "No existe un usuario con ese ID."]);
            http_response_code(500); // Internal Server Error
        }

    }
}
