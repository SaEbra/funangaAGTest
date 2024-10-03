<?php
// backend/Controller/LoginController.php
require_once '../Service/UserService.php'; // Include the UserService
session_start(); // Start the session
header('Content-Type: application/json'); // Set the content type to JSON

$response = ['status' => 'error', 'message' => 'Invalid request'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true); // Get JSON payload

    // Validate payload
    if (isset($data['email']) && isset($data['password'])) {
        $email = $data['email'];
        $password = $data['password'];
        $rememberMe = $data['rememberMe'] ?? false;

        $userService = new UserService($GLOBALS['conn']); // Instantiate the service
        $user = $userService->userExists($email); // Check if user exists

        if ($user && password_verify($password, $user['password'])) {

            // Check if "Remember Me" is checked
            if ($rememberMe) {
                // Set a cookie for a longer duration, e.g., 30 days
                setcookie("user_id", $user['id'], time() + (30 * 24 * 60 * 60), "/");
            }

            $_SESSION['user_id'] = $user['id']; // Set session variable
            $response['status'] = 'ok';
            $response['message'] = 'login.';
        } else {
            $response['message'] = 'Invalid email or password.';
        }
    } else {
        $response['message'] = 'Email and password are required.';
    }
}

// Return the JSON response
echo json_encode($response);
?>
