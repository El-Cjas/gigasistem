<?php
date_default_timezone_set("America/Caracas");
class Salida{
    private $id;
    private $idProducto;
    private $cantidad;
    private $fecha ;

    public function __construct($datos) {
        $this->idProducto = $datos["ID_producto"];
        $this->fecha = $datos["fecha"] ?? date("Y-m-d");
        $this->cantidad = $datos['cantidad'];
    }
    public function getFecha(){
        echo $this->fecha;
    }
    public function getIdProducto(){
        return $this->idProducto;
    }
    public function getCantidad(){
        return $this->cantidad;
    }
    public function getDatos(){
        return [
            ":ID_producto" => $this->idProducto,
            ":fecha" => $this->fecha,
            ":cantidad" => $this->cantidad
        ];
    }
    public function validarDatos(){
        if (empty($this->idProducto) || empty($this->fecha) || empty($this->cantidad)) {
            echo "Todos los campos son obligatorios.";
            return false;
        }
        if (!is_numeric($this->cantidad) || $this->cantidad <= 0) {
            echo "La cantidad debe ser un número positivo.";
            return false;
        }
        return true;
    }
}
// $datos = [
//     "ID_producto" => 10,
//     "fecha" => "2023-10-01",
//     "cantidad" => 5
// ];
// $salida = new Salida($datos);
// echo $salida->getDatos()[":fecha"]; // Devuelve 1