<?php
// views/login.php

// Establece el título de la página que se mostrará en el header.
$title = 'Login';

// Incluye el archivo de cabecera (header.php).
// Esto permite reutilizar el código HTML del encabezado en múltiples páginas.
require_once 'header.php';
?>

<div class="container">
    <h2>Iniciar Sesión</h2>

    <?php
    // Muestra un mensaje de error si existe en la URL (parámetro 'error').
    // Esto es útil para informar al usuario sobre intentos de login fallidos.
    if (isset($_GET['error'])) {
        echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
    }
    ?>

    <!-- Formulario de inicio de sesión -->
    <!-- El 'action' del formulario apunta al 'index.php' con la acción 'login',
         lo que asegura que la solicitud sea manejada por el LoginController. -->
    <form action="index.php?action=login" method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Entrar</button>
    </form>
</div>

<?php
// Incluye el archivo de pie de página (footer.php).
// Esto permite reutilizar el código HTML del pie de página.
require_once 'footer.php';
?>
