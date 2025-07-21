<?php
// index.php

// Iniciar la sesión para el manejo de la autenticación de usuarios.
// session_start() crea una sesión o reanuda la actual basada en un identificador de sesión
// pasado a través de una petición GET o POST, o pasado a través de una cookie.
session_start();

// Definir la acción por defecto que se ejecutará si no se especifica ninguna.
// En este caso, si el usuario está autenticado, se le redirige al 'dashboard',
// de lo contrario, se le muestra la página de 'login'.
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_SESSION['user']) ? 'dashboard' : 'login');

// Cargar el controlador correspondiente basado en la acción solicitada.
// Este es el núcleo del enrutador en un esquema MVC.
switch ($action) {
    case 'login':
        // Si la acción es 'login', se carga el controlador de login.
        // Este controlador manejará la lógica de la página de inicio de sesión.
        require_once 'controllers/LoginController.php';
        $controller = new LoginController();
        break;
    case 'dashboard':
        // Si la acción es 'dashboard', se carga el controlador del dashboard.
        // Este controlador se encarga de la página principal después de que el usuario ha iniciado sesión.
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        break;
    default:
        // Si la acción no corresponde a ninguna de las anteriores, se muestra un error 404.
        // http_response_code(404) envía un código de estado 404 Not Found al navegador.
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        echo "La página que buscas no existe.";
        exit; // Termina la ejecución del script para evitar que se procese más código.
}

// Ejecutar el método 'index' del controlador cargado.
// Este es el método principal que cada controlador debe implementar para manejar la solicitud.
$controller->index();
?>
