<?php
include_once "funciones_comunes.php";
class Movimiento{
	private $id, $producto_id, $tipo, $cantidad, $fecha, $observaciones;
	
    public function __construct() {
		$this->id = "";
        $this->producto_id = "";
        $this->tipo = "";
        $this->cantidad = "";
        $this->fecha ="";
        $this->observaciones = "";
    }
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
	
	public function getProductoId() {
		return $this->producto_id;
	}
	
	public function setProductoId($producto_id): self {
		$this->producto_id = $producto_id;
		return $this;
	}
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function setTipo($tipo): self {
		$this->tipo = $tipo;
		return $this;
	}
	
	public function getCantidad() {
		return $this->cantidad;
	}
	
	public function setCantidad($cantidad): self {
		$this->cantidad = $cantidad;
		return $this;
	}
	
	public function getFecha() {
		return $this->fecha;
	}
	
	public function setFecha($fecha): self {
		$this->fecha = $fecha;
		return $this;
	}
	
	public function getObservaciones() {
		return $this->observaciones;
	}
	
	public function setObservaciones($observaciones): self {
		$this->observaciones = $observaciones;
		return $this;
	}
    // Método para obtener todas las entradas
    public function obtenerTodasEntradas() {
        $sql = "SELECT e.ID, p.nombre AS producto, e.fecha, e.cantidad AS total
                FROM entrada e 
                JOIN producto p ON e.ID_producto = p.ID
                ORDER BY e.ID ASC";
        $resultado = seleccionar($sql);
        return $resultado; //retornando un array asociativo de la consulta
    }

    public function registrarEntrada(Entrada $entrada){
        $sql = "INSERT INTO entrada (ID_producto, fecha, cantidad) 
                VALUES (:ID_producto, :fecha, :cantidad);
                UPDATE producto SET stock = stock + :cantidad WHERE ID = {$this->producto_id}";
        return ejecutarSQL($sql);
    }
     public function obtenerEntradasPorProducto($idProducto) {
        $sql = "SELECT e.ID, p.nombre AS producto, e.fecha, e.cantidad AS cantidad_entrada
                FROM entrada e
                JOIN producto p ON e.ID_producto = p.ID
                WHERE e.ID_producto = {$this->producto_id}
                ORDER BY e.fecha ASC";
        return ejecutarSQL($sql);
    }
}

?>