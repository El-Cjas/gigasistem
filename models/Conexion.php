<?php
class Conexion{
    //datos para la conexion de la base de datos del proyecto
    private $host = "localhost";
    private $bd = "gigasistem"; //aqui ira el nombre de la base de datos
    private $usuario = "root";
    private $pass = "123";
    private $conn;

    public function conectar(){
        try {
            $pdo = new PDO("mysql:host={$this->host};dbname={$this->bd}",$this->usuario,$this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $pdo;
        } catch (PDOException $error) {
            die("Error de conexion".$error->getMessage());
        }
    }

    public function desconectar(){
        $this->conn = null;
    }

    function ejecutarConsulta($sql, array $parametros=[]){
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($parametros);
    }
    function consultar($sql, array $parametros = []): array{
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($parametros);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// $xd = new Conexion();

// $xd->conectar();
// print_r( $xd->consultar("SELECT * FROM categoria"));

// $aja = $xd->query("select * from categoria");
// $lista = $aja->fetchAll();
// print_r($lista);


?>