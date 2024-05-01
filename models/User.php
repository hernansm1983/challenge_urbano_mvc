<?php
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

    public function getUsers(){

        $consulta=$this->db->query("select * from users;");

        while($filas=$consulta->fetch_assoc()){
            $this->users[]=$filas;
        }

        return $this->users;
    }


    public function saveUser(){
        $sql = "INSERT INTO `users` (`id`, `name`, `surname`, `password`, `email`) VALUES (null, '{$this->getName()}', '{$this->getSurname()}', '{$this->getPassword()}', '{$this->getEmail()}')";
        $save = $this->db->query($sql);
        
        $result = false;
        if($save){
            $result = true;
        }
        
        return $result;
    }

    public function update_persona($id, $nombre, $contrasena, $email){
        // Aquí realizas la actualización de los datos de una persona en la base de datos
    }

    public function delete_persona($id){
        // Aquí realizas la eliminación de una persona de la base de datos
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
