<?php
date_default_timezone_set("America/Caracas");
class Entrada{
    private $id;
    private $idProducto;
    private $stock;
    private $fecha ;

    public function __construct($datos) {
        $this->idProducto = $datos["ID_producto"];
        $this->fecha = $datos["fecha"] ?? date("Y-m-d");
        $this->stock = $datos['cantidad'];
    }
    public function getFecha(){
        echo $this->fecha;
    }
    public function getDatos(){
        return [
            ":ID_producto" => $this->idProducto,
            ":fecha" => $this->fecha,
            ":cantidad" => $this->stock
        ];
    }
    public function validarDatos(){
        if (empty($this->idProducto) || empty($this->fecha) || empty($this->stock)) {
            echo "Todos los campos son obligatorios.";
            return false;
        }
        if (!is_numeric($this->stock) || $this->stock <= 0) {
            echo "La cantidad debe ser un número positivo.";
            return false;
        }
        return true;
    }
}

/* `gigasistem`.`entrada` */


// $entrada = new Entrada([
//     "ID_producto" => 1,
//     "fecha" => "2023-10-01",
//     "cantidad" => 10
// ]);
// echo $entrada->validarDatos();


?>