<?php
require_once 'models/UserModel.php';
require_once 'models/ModeloProducto.php';

class AuthController {
    private $userModel;
    private $productoModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->productoModel = new ModeloProducto();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $clave = $_POST['clave'] ?? '';
            
            $user = $this->userModel->getUserByEmail($email);
            
            if ($user && password_verify($clave, $user['clave'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                $error = "Credenciales inválidas";
                require_once 'views/auth/login.php';
            }
        } else {
            require_once 'views/auth/login.php';
        }
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) { //TE MANDA A INICIAR SESION SI NO HAY UNA SESION ACTIVA
            header('Location: index.php?action=login');
            exit;
        }
        $productos = $this->productoModel->obtenerTodosProductos();
        require_once 'views/auth/dashboard.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}
