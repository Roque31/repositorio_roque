<?php

require_once 'models/User.php';
require_once 'config.php';

class AuthController {
    private $user;

    public function __construct() {
        global $link;
        $this->user = new User($link);
    }

    public function login() {
        $username = $password = "";
        $username_err = $password_err = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty(trim($_POST["username"]))) {
                $username_err = "Please enter username.";
            } else {
                $username = trim($_POST["username"]);
            }

            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter your password.";
            } else {
                $password = trim($_POST["password"]);
            }

            if (empty($username_err) && empty($password_err)) {
                $user = $this->user->findByUsername($username);

                if ($user && $user->verifyPassword($password)) {
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $user->id;
                    $_SESSION["username"] = $user->username;
                    header("location: index.php?action=dashboard");
                } else {
                    $password_err = "The password you entered was not valid.";
                }
            }
        }

        require 'views/auth/login.php';
    }

    public function register() {
        $username = $password = "";
        $username_err = $password_err = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty(trim($_POST["username"]))) {
                $username_err = "Please enter a username.";
            } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
                $username_err = "Username can only contain letters, numbers, and underscores.";
            } else {
                $user = $this->user->findByUsername(trim($_POST["username"]));
                if ($user) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            }

            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter a password.";
            } elseif (strlen(trim($_POST["password"])) < 6) {
                $password_err = "Password must have atleast 6 characters.";
            } else {
                $password = trim($_POST["password"]);
            }

            if (empty($username_err) && empty($password_err)) {
                if ($this->user->create($username, $password)) {
                    header("location: index.php?action=login");
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }
        }

        require 'views/auth/register.php';
    }

    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("location: index.php?action=login");
        exit;
    }
}
?>
