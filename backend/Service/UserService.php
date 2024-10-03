<?php
require_once '../Model/db.php'; // Include the database connection

class UserService {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    // Check if the user exists
    public function userExists($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        // Fetch the user data
        $result = $stmt->get_result(); // Use this for MySQLi
        $user = $result->fetch_assoc(); // Fetch associative array
        return $user; 
    }

    // Register a new user
    public function registerUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }
}
?>
