<?php
// controllers/LoginController.php

// Incluir el modelo de usuario para poder interactuar con él.
// require_once se asegura de que el archivo se incluya solo una vez.
require_once 'models/User.php';

/**
 * Clase LoginController
 *
 * Este controlador maneja toda la lógica relacionada con el inicio y cierre de sesión.
 */
class LoginController {

    /**
     * @var User Instancia del modelo User.
     */
    private $userModel;

    /**
     * Constructor de la clase.
     * Inicializa el modelo de usuario.
     */
    public function __construct() {
        $this->userModel = new User();
    }

    /**
     * Método principal que se ejecuta según la acción solicitada.
     *
     * Este método determina si se debe mostrar el formulario de login,
     * procesar un intento de login, o cerrar la sesión del usuario.
     */
    public function index() {
        // Verificar si se ha solicitado cerrar sesión.
        if (isset($_GET['logout'])) {
            $this->logout();
            return; // Termina la ejecución después de cerrar sesión.
        }

        // Verificar si el formulario de login ha sido enviado (método POST).
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleLogin();
        } else {
            // Si no es una solicitud POST, simplemente muestra la vista de login.
            $this->showLoginForm();
        }
    }

    /**
     * Muestra el formulario de inicio de sesión.
     */
    private function showLoginForm() {
        // Carga la vista del formulario de login.
        require_once 'views/login.php';
    }

    /**
     * Procesa el intento de inicio de sesión del usuario.
     */
    private function handleLogin() {
        // Obtiene el nombre de usuario y la contraseña del formulario.
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Valida las credenciales utilizando el modelo de usuario.
        $user = $this->userModel->validate($username, $password);

        if ($user) {
            // Si las credenciales son válidas:
            // 1. Almacena los datos del usuario en la sesión.
            $_SESSION['user'] = $user;
            // 2. Redirige al usuario al dashboard.
            header('Location: index.php?action=dashboard');
            exit; // Es importante llamar a exit() después de una redirección.
        } else {
            // Si las credenciales son incorrectas:
            // 1. Prepara un mensaje de error.
            $error = "Usuario o contraseña incorrectos.";
            // 2. Redirige de vuelta a la página de login con el mensaje de error.
            header('Location: index.php?action=login&error=' . urlencode($error));
            exit;
        }
    }

    /**
     * Cierra la sesión del usuario.
     */
    private function logout() {
        // Elimina todas las variables de sesión.
        session_unset();
        // Destruye la sesión actual.
        session_destroy();
        // Redirige al usuario a la página de login.
        header('Location: index.php?action=login');
        exit;
    }
}
?>
