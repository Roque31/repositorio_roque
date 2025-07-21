<?php
// controllers/DashboardController.php

/**
 * Clase DashboardController
 *
 * Este controlador se encarga de manejar la lógica del dashboard.
 * Su principal responsabilidad es asegurarse de que solo los usuarios autenticados
 * puedan acceder al dashboard y mostrar la información correspondiente.
 */
class DashboardController {

    /**
     * Constructor de la clase.
     *
     * Verifica si el usuario está autenticado. Si no lo está,
     * lo redirige a la página de login. Esto protege el acceso al dashboard.
     */
    public function __construct() {
        // La función session_status() se puede usar para verificar el estado de la sesión,
        // pero aquí simplemente comprobamos si la variable de sesión 'user' está establecida.
        if (!isset($_SESSION['user'])) {
            // Si no hay un usuario en la sesión, redirige al login.
            header('Location: index.php?action=login');
            // Es crucial llamar a exit() después de una redirección para detener la ejecución del script.
            exit;
        }
    }

    /**
     * Método principal que muestra la vista del dashboard.
     *
     * Este método se ejecuta si el usuario ha superado la comprobación de autenticación
     * en el constructor.
     */
    public function index() {
        // Recupera los datos del usuario de la sesión para poder mostrarlos en la vista.
        $user = $_SESSION['user'];

        // Carga la vista del dashboard.
        // La variable $user estará disponible en 'views/dashboard.php'
        // para personalizar el contenido (ej. mensaje de bienvenida).
        require_once 'views/dashboard.php';
    }
}
?>
