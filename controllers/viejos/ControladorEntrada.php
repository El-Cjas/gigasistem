<?php
include_once "./models/ModeloEntrada.php";
include_once "./models/entidades/Entrada.php";

class ControladorEntrada{
    private $modeloEntrada;
    private $modeloProducto;
    public function __construct() {
        $this->modeloEntrada = new ModeloEntrada();
        $this->modeloProducto = new ModeloProducto();
    }
    function mostrarEntradas(){
        $entradas = $this->modeloEntrada->obtenerTodasEntradas();
        include_once "views/entrada/listar.php";
    }
    public function registrarEntrada(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['entrada'])) {
            $entrada = new Entrada($_POST['entrada']);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $entrada->validarDatos()) {
            // Si los datos son válidos, registrar la entrada
            // y redirigir a la lista de entradas
            $this->modeloEntrada->registrarEntrada($entrada);
            header("Location: index.php?opcion=mostrarEntradas");
        } else {
            $productos = $this->modeloProducto->obtenerTodosProductos();
            include_once "views/entrada/crear.php";
        }
        
    }

    
}

?>