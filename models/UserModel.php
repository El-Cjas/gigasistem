<?php
require_once 'Conexion.php';//archivo de conecxion a la base de datos

class UserModel {
    private $db;//variable para almacenar la base de datos

    public function __construct() {
        $Conexion = new Conexion();//crea una nueva instancia de la clase conexion
        $this->db = $Conexion->conectar(); //establece la conexion en la base de datos
    }

    public function getUserByEmail($email) {
        try {//prepara la consulta SQL  para seleccionar un ususario por su email
            $query = "SELECT id, nombre, email, clave FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query); //prepara la consulta
            $stmt ->bindParam(':email' , $email); //vincula el parametro email
            $stmt->execute();//ejecuta la consulta
            
            return $stmt->fetch(PDO::FETCH_ASSOC); //devuelbe un array asociativo
        } catch(PDOException $e) {
            //captura cual quier excepccion de error
            error_log("Error en getUserByEmail: " . $e->getMessage());
            return false;
        }
    }
}

// $modelo = new UserModel();
// $usuario = $modelo->getUserByEmail("elcejon85@gmail.com");
// print_r($usuario);s