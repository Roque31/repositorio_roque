<?php

class DashboardController {
    public function index() {
        session_start();

        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            header("location: index.php?action=login");
            exit;
        }

        require 'views/dashboard/dashboard.php';
    }
}
?>
