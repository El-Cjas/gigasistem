<?php
include_once "models/entidades/Producto.php";
include_once "models/ModeloProducto.php";
include_once "models/ModeloCategoria.php";

class ControladorProducto{  
    private $model;
    private $modeloCategoria;
    
    public function __construct() {
        $this->model = new ModeloProducto();
        $this->modeloCategoria = new ModeloCategoria();
    }
    // AJAX: Listar productos en formato JSON
    public function listarProductos() {
        // Si la petición es AJAX (desde dashboard), responde JSON
        if ($this->isAjaxRequest()) {
            $productos = $this->model->obtenerTodosProductos();
            header('Content-Type: application/json');
            echo json_encode($productos);
            exit;
        }
        // Si no es AJAX, muestra la vista normal
        $productos = $this->model->obtenerTodosProductos();
        include_once "views/productos/listar.php";
    }

    // AJAX: Buscar productos en formato JSON
    public function buscarProductos() {
        if ($this->isAjaxRequest()) {
            $termino = $_POST['termino'] ?? '';
            $productos = $this->model->buscarProductos($termino);
            header('Content-Type: application/json');
            echo json_encode($productos);
            exit;
        }
        // Vista normal
        $termino = $_POST['termino'] ?? '';
        $productos = $this->model->buscarProductos($termino);
        include_once "views/productos/listar.php";
    }

    // AJAX: Eliminar producto (marcar como borrado) y responder JSON
    public function eliminarProducto() {
        if (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $id = $_POST['ID'] ?? 0;
            $ok = $this->model->eliminarProducto($id);
            header('Content-Type: application/json');
            if ($ok) {
                echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el producto']);
            }
            exit;
        }
        // Si no es AJAX, puedes redirigir o mostrar una vista
        if ($_SERVER["REQUEST_METHOD"]== "POST" && $_POST["ID"]) {
            $this->model->eliminarProducto($_POST["ID"]);
            echo "Producto eliminado exitosamente";
            header("location: index.php?opcion=listarProductos");
        } else {
            echo "ha ocurrido un error";
        }
    }

    public function actualizarProducto() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["producto"])) {
            $producto = new Producto($_POST["producto"]);
            $this->model->actualizarProducto($producto);
            header("Location: index.php?opcion=listarProductos");
            exit;
        } else {
            $id = $_GET["ID"] ?? null;
            if ($id) {
                $producto = $this->model->obtenerProductoID($id);
                $categorias = $this->modeloCategoria->obtenerTodasCategorias();
                // Convierte el objeto Producto a array si es necesario
                if ($producto instanceof Producto) {
                    $producto = $producto->getDatosConID();
                }
                include_once "views/productos/editar.php";
            } else {
                echo "ID de producto no especificado.";
            }
        }
    }

    public function registrarProducto() {
        $categorias = $this->modeloCategoria->obtenerTodasCategorias();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["producto"])) {
            $producto = new Producto($_POST["producto"]);
            if ($producto->validarDatos()) {
                $this->model->registrarProducto($producto);
                header("Location: index.php?opcion=listarProductos");
                exit;
            } else {
                $error = "Datos inválidos";
                include_once "views/productos/registrar.php";
            }
        } else {
            include_once "views/productos/registrar.php";
        }
    }

    // Método auxiliar para detectar AJAX
    private function isAjaxRequest() {
        return (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        );
    }
}

//print_r($_POST);
?>