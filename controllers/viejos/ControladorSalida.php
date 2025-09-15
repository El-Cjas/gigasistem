<?php
include_once "./models/ModeloSalida.php";
include_once "./models/entidades/Salida.php";

class ControladorSalida{
    private $modeloSalida;
    private $modeloProducto;
    public function __construct() {
        $this->modeloSalida = new ModeloSalida();
        $this->modeloProducto = new ModeloProducto();
    }
    function mostrarSalidas(){
        $salidas = $this->modeloSalida->obtenerTodasSalidas();
        include_once "views/salida/listar.php";
    }
    public function registrarSalida(){
        // Verificar si se ha enviado un formulario de salida
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salida'])) {
            $salida = new Salida($_POST['salida']);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salida']) && $salida->validarDatos()) {
            // Verificar si el producto tiene suficiente stock
            $producto = $this->modeloProducto->obtenerProductoPorId($salida->getIdProducto());
            if ($producto['stock'] < $salida->getCantidad()) {
                // Si no hay suficiente stock, redirigir con un mensaje de error
                header("Location: index.php?opcion=registrarSalida&error=stock_insuficiente");
                return;
            }
            // Registrar la salida
            $this->modeloSalida->registrarSalida($salida);
            header("Location: index.php?opcion=mostrarSalidas");
        } else {
            $productos = $this->modeloProducto->obtenerTodosProductos();
            include_once "views/salida/crear.php";
        }
    }
    
}

?>