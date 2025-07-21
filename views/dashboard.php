<?php
// views/dashboard.php

// Establece el título de la página que se mostrará en el header.
$title = 'Dashboard';

// Incluye el archivo de cabecera (header.php).
require_once 'header.php';
?>

<div class="container">
    <div class="dashboard-header">
        <!-- Mensaje de bienvenida personalizado con el nombre del usuario -->
        <!-- htmlspecialchars() se usa para prevenir ataques XSS al mostrar datos del usuario. -->
        <h2>Bienvenido, <?php echo htmlspecialchars($user['name']); ?></h2>

        <!-- Enlace para cerrar sesión -->
        <!-- El enlace dirige a la acción 'login' con un parámetro 'logout=true',
             que será manejado por el LoginController para destruir la sesión. -->
        <a href="index.php?action=login&logout=true" class="logout-button">Cerrar Sesión</a>
    </div>

    <p>Este es tu panel de control. Desde aquí puedes acceder a las diferentes secciones de la aplicación.</p>

    <!-- Navegación simulada a otros módulos del sistema -->
    <nav class="dashboard-nav">
        <ul>
            <li><a href="#">Gestión de Productos</a></li>
            <li><a href="#">Reportes de Ventas</a></li>
            <li><a href="#">Configuración de la Cuenta</a></li>
            <li><a href="#">Soporte Técnico</a></li>
        </ul>
    </nav>
</div>

<?php
// Incluye el archivo de pie de página (footer.php).
require_once 'footer.php';
?>
