<?php
require_once 'controllers/AuthController.php';
require_once 'controllers/DashboardController.php';

$authController = new AuthController();
$dashboardController = new DashboardController();

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'dashboard':
        $dashboardController->index();
        break;
    default:
        $authController->login();
        break;
}
?>
