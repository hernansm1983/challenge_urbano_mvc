<?php

require_once("db/db.php");

class User{

    private $db;
    private $users;
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $updated_at;
    private $created_at;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->users=array();
    }


    // --- Obtiene una Lista con todos los Usuarios ---
    public function getUsers(){

        $sql = $this->db->query("SELECT * FROM users ");

        while($rows = $sql->fetch_assoc()){
            $this->users[]=$rows;
        }

        return $this->users;
    }


    // --- Obtiene un Usuario por ID ---
    public function getUserById($id){

        $sql = $this->db->query("SELECT * FROM users WHERE id = '$id' ");

        $user = $sql->fetch_assoc();

        return $user;
    }


    // --- Guarda los datos de un Usuario ---
    public function saveUser(){
        $sql = "INSERT INTO `users` (`id`, `name`, `surname`, `password`, `email`) 
                VALUES (null, 
                        '{$this->getName()}', 
                        '{$this->getSurname()}', 
                        '{$this->getPassword()}', 
                        '{$this->getEmail()}')";

        $save = $this->db->query($sql);
        
        $result = false;
        if($save){
            $result = true;
        }
        
        return $result;
    }


    // --- Actualiza un Usuario por ID ---
    public function updateUser($id){
        $sql = "UPDATE `users` SET 
                `name` = '{$this->getName()}',
                `surname` = '{$this->getSurname()}',
                `password` = '{$this->getPassword()}',
                `email` = '{$this->getEmail()}'
                WHERE `id` = $id";
    
        $update = $this->db->query($sql);
        
        $result = false;
        if($update){
            $result = true;
        }
        
        return $result;
    }
    

    // --- Borra un Usuario por ID ---
    public function deleteUserById($id) {

        // Conectar a la base de datos y realizar la eliminación
        $sql = "DELETE FROM users WHERE id = $id";
        $delete = $this->db->query($sql);

        // Verificar si la eliminación fue exitosa
        if ($delete) {
            return true;
        } else {
            return false;
        }

    }


    // --- Obtiene Un Usuario por Email ---
    public function getUserByEmail($email){

        $email = $this->db->real_escape_string($email);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->db->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set the value of id
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }


    /**
     * Get the value of name
     */
    public function getName() {
        return $this->name;
    }


    /**
     * Set the value of name
     */
    public function setName($name): self {
        $this->name = $name;
        return $this;
    }


    /**
     * Get the value of surname
     */
    public function getSurname() {
        return $this->surname;
    }


    /**
     * Set the value of surname
     */
    public function setSurname($surname): self {
        $this->surname = $surname;
        return $this;
    }


    /**
     * Get the value of email
     */
    public function getEmail() {
        return $this->email;
    }


    /**
     * Set the value of email
     */
    public function setEmail($email): self {
        $this->email = $email;
        return $this;
    }


    /**
     * Get the value of password
     */
    public function getPassword() {
        return $this->password;
    }


    /**
     * Set the value of password
     */
    public function setPassword($password): self {
        $this->password = $password;
        return $this;
    }


    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }


    /**
     * Set the value of updated_at
     */
    public function setUpdatedAt($updated_at): self {
        $this->updated_at = $updated_at;
        return $this;
    }


    /**
     * Get the value of created_at
     */
    public function getCreatedAt() {
        return $this->created_at;
    }

    
    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self {
        $this->created_at = $created_at;
        return $this;
    }
}
?>
