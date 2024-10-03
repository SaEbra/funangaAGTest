<?php
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /frontend/login.html"); // Redirect to login page
    exit();
}
?>