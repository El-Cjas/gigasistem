<?php
include_once "Conexion.php";
class ModeloSalida{
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }
    // Método para obtener todas las Salidas
    public function obtenerTodasSalidas() {
        $sql = "SELECT e.ID, p.nombre AS producto, e.fecha, e.cantidad AS total
                FROM salida e 
                JOIN producto p ON e.ID_producto = p.ID
                ORDER BY e.ID ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarSalida(Salida $salida){
        $sql = "INSERT INTO salida (ID_producto, fecha, cantidad) 
                VALUES (:ID_producto, :fecha, :cantidad);
                UPDATE producto SET stock = stock - :cantidad WHERE ID = :ID_producto";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($salida->getDatos());
    }

     public function obtenerSalidasPorProducto($idProducto) {
        $sql = "SELECT s.ID, p.nombre AS producto, s.fecha, s.cantidad AS cantidad_salida
                FROM salida s
                JOIN producto p ON s.ID_producto = p.ID
                WHERE s.ID_producto = :idProducto
                ORDER BY s.fecha ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':idProducto' => $idProducto]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}