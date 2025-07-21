<?php
// models/User.php

/**
 * Clase User
 *
 * Representa el modelo de usuario en la aplicación.
 * Se encarga de la lógica de negocio relacionada con los usuarios,
 * como la validación de credenciales.
 */
class User {

    /**
     * @var array Un array simulado de usuarios para la autenticación.
     * En una aplicación real, estos datos provendrían de una base de datos.
     * Cada usuario tiene un 'id', 'username', 'password' (hash) y 'name'.
     */
    private $users = [
        1 => ['id' => 1, 'username' => 'admin', 'password' => 'admin', 'name' => 'Administrador'],
        2 => ['id' => 2, 'username' => 'usuario', 'password' => '1234', 'name' => 'Usuario de Prueba']
    ];

    /**
     * Valida las credenciales del usuario.
     *
     * Este método busca un usuario por su nombre de usuario y compara la contraseña.
     * En una aplicación real, se usaría password_verify() para comparar contraseñas hasheadas.
     *
     * @param string $username El nombre de usuario a validar.
     * @param string $password La contraseña a validar.
     * @return array|null Retorna un array con los datos del usuario si las credenciales son correctas,
     *                    de lo contrario, retorna null.
     */
    public function validate($username, $password) {
        foreach ($this->users as $user) {
            // Compara el nombre de usuario y la contraseña proporcionados con los almacenados.
            // strtolower() se usa para hacer la comparación de nombres de usuario insensible a mayúsculas/minúsculas.
            if (strtolower($user['username']) === strtolower($username) && $user['password'] === $password) {
                // Si las credenciales son correctas, retorna los datos del usuario.
                return $user;
            }
        }
        // Si no se encuentra ningún usuario o la contraseña es incorrecta, retorna null.
        return null;
    }
}
?>
