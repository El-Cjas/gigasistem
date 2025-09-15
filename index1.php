<?php

   ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

session_start(); // Inicia la sesión
// Obtener la acción y opción desde la URL (GET)
$action = $_GET['action'] ?? '';
$opcion = $_GET['opcion'] ?? '';
// Incluir los controladores necesarios
require_once 'controllers/AuthController.php';
require_once 'controllers/ControladorCategoria.php';
require_once 'controllers/ControladorProducto.php';
require_once 'controllers/ControladorEntrada.php';
require_once 'controllers/ControladorSalida.php'; 

// Instanciar el controlador de autenticación
$authController = new AuthController();
// Manejar acciones relacionadas con autenticación
if (in_array($action, ['login', 'logout', 'dashboard'])) {
    switch ($action) {
        case 'login':
            // Si ya está logueado, redirigir al dashboard
            if (isset($_SESSION['user_id'])) {
                header('Location: index.php?action=dashboard');
                exit;
            }
            $authController->login(); // Llama al método de login
            exit;
        case 'logout':
            $authController->logout(); // Llama al método de logout
            exit;
        case 'dashboard':
            // Si no está logueado, forzar login
            if (!isset($_SESSION['user_id'])) {
                header('Location: index.php?action=login');
                exit;
            }
            $authController->dashboard(); //Muestra el dashboard
            exit;
    }
}

// Para otras opciones (categorías/productos), verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, redirigir a la página de login
    header('Location: index.php?action=login');
    exit;
}

// Instanciar el controlador de categorías
$categoriaController = new ControladorCategoria();
$productoController = new ControladorProducto();
$entradaController = new ControladorEntrada();
$salidaController = new ControladorSalida(); // Asegúrate de que este controlador exista


// Usar el método match para manejar las opciones
match ($opcion) {
    'registrarCategoria' => $categoriaController->crearCategoria(),      // Registrar nueva categoría
    'actualizarCategoria'    => $categoriaController->actualizarCategoria(), // Editar categoría existente
    'buscarCategorias'    => $categoriaController->buscarCategorias(),    // busca categorias
    'eliminarCategoria'  => $categoriaController->eliminarCategoria(),   // Eliminar categoría (parece que llama a actualizarCategoria, revisar si es correcto)
      default  => $categoriaController->listarCategorias(),    // Listar categorías por defecto
    
    //manejando las opciones de los productos
    "listarProductos"    => $productoController->listarProductos(),      // Listar productos
    "registrarProducto"  => $productoController->registrarProducto(),
    "editarProducto"     => $productoController->actualizarProducto(),      // <-- ¿existe este método?
    'buscarProductos'    => $productoController->buscarProductos(),
    "eliminarProducto"   => $productoController->eliminarProducto(),
    //manejando las opciones de las entradas 
    "mostrarEntradas"    => $entradaController->mostrarEntradas(),
    "registrarEntrada"   => $entradaController->registrarEntrada(),
    //manejando las opciones de las salidas
    "registrarSalida"   => $salidaController->registrarSalida(),
    "mostrarSalidas"    => $salidaController->mostrarSalidas(),
};

