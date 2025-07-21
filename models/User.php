<?php

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function findByUsername($username) {
        $query = "SELECT id, username, password FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->password = $row['password'];
            return $this;
        }

        return null;
    }

    public function create($username, $password) {
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }
}
?>
