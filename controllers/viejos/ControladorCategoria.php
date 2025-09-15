<?php
include_once "./models/ModeloCategoria.php";
include_once "./models/entidades/Categoria.php";

class ControladorCategoria{
    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloCategoria();
    }

    // Método para detectar si la petición es AJAX
    private function isAjaxRequest() {
        return (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        );
    }

    public function listarCategorias() {
        if ($this->isAjaxRequest()) {
            $categorias = $this->modelo->obtenerTodasCategorias();
            header('Content-Type: application/json');
            echo json_encode($categorias);
            exit;
        }
        $categorias = $this->modelo->obtenerTodasCategorias();
        include_once "views/categorias/listarCategorias.php";
    }
    public function crearCategoria() {
        $categoria = (isset($_POST['categoria'])) ? new Categoria($_POST["categoria"]) : null;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $categoria->verificarDatos()) {
            $this->modelo->crearCategoria($categoria);
            header("location: index.php");
        }else {
            
            include_once "views/categorias/registrarCategoria.php";
        }
    }
    public function actualizarCategoria() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["categoria"])){
            $categoria = new Categoria($_POST["categoria"]);
            $this->modelo->editarCategoria($categoria);
            header("Location: index.php?opcion=listarCategorias&edit=ok");
            exit;
        } else {
            $categoria = $this->modelo->obtenerCategoriaID($_GET["ID"]);
            if (!$categoria) {
                echo "Categoria no encontrada";
                header("location: index.php?opcion=listarCategorias");
                return;
            }
            include_once "views/categorias/editarCategoria.php";
        }
    }
    public function eliminarCategoria(){
        // Si es AJAX, responde en JSON
        if (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $id = $_POST["ID"] ?? 0;
            $ok = $this->modelo->eliminarCategoria($id);
            header('Content-Type: application/json');
            if ($ok) {
                echo json_encode(['success' => true, 'message' => 'Categoría eliminada correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo eliminar la categoría']);
            }
            exit;
        }
        // Si no es AJAX, redirige normalmente
        if ($_SERVER["REQUEST_METHOD"]== "POST" && $_POST["ID"]) {
            $this->modelo->eliminarCategoria($_POST["ID"]);
            header("location: index.php?opcion=listarCategorias");
            exit;
        } else {
            echo "Ha ocurrido un error";
        }
    }
    public function buscarCategorias() {
        if (isset($_POST["termino"])) {
            $termino = $_POST['termino'] ?? ''; // Obtener el término de búsqueda del formulario
            $categorias = $this->modelo->buscarCategorias($termino); // Llamar al modelo para buscar categorías
            include_once "views/categorias/listarCategorias.php"; // Incluir la vista para mostrar resultados
        } else {
            include_once 'views/categorias/listarCategorias.php';
        }
    }
 
    
}





