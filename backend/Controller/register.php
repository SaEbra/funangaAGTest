<?php
require_once '../Service/UserService.php'; // Include the UserService

header('Content-Type: application/json'); // Set the content type to JSON

$response = ['status' => 'error', 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true); // Get JSON payload

    // Validate payload
    if (isset($data['username']) && isset($data['email']) && isset($data['password'])) {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];

        $userService = new UserService($GLOBALS['conn']); // Instantiate the service

        // Check if the user already exists
        if ($userService->userExists($email)) {
            $response['message'] = 'Email is already in use.';
        } else {
            // Register the new user
            if ($userService->registerUser($username, $email, $password)) {
                $response['status'] = 'ok';
                $response['message'] = 'Registration successful! Welcome, ' . $username . '!';
            } else {
                $response['message'] = 'Registration failed. Please try again.';
            }
        }
    } else {
        $response['message'] = 'Username, email, and password are required.';
    }
}

// Return the JSON response
echo json_encode($response);
?>
