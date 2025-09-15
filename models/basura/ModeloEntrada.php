<?php
include_once "Conexion.php";
class ModeloEntrada{
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }
    // Método para obtener todas las entradas
    public function obtenerTodasEntradas() {
        $sql = "SELECT e.ID, p.nombre AS producto, e.fecha, e.cantidad AS total
                FROM entrada e 
                JOIN producto p ON e.ID_producto = p.ID
                ORDER BY e.ID ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarEntrada(Entrada $entrada){
        $sql = "INSERT INTO entrada (ID_producto, fecha, cantidad) 
                VALUES (:ID_producto, :fecha, :cantidad);
                UPDATE producto SET stock = stock + :cantidad WHERE ID = :ID_producto";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($entrada->getDatos());
    }
     public function obtenerEntradasPorProducto($idProducto) {
        $sql = "SELECT e.ID, p.nombre AS producto, e.fecha, e.cantidad AS cantidad_entrada
                FROM entrada e
                JOIN producto p ON e.ID_producto = p.ID
                WHERE e.ID_producto = :idProducto
                ORDER BY e.fecha ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':idProducto' => $idProducto]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
// $entrada = new ModeloEntrada();

// $x =$entrada->obtenerEntradas();
// print_r($x)

?>