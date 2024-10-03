<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = [];

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just unset the variables.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session
session_destroy();

// If you have set a cookie for "Remember Me", you may want to delete it as well
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, '/'); // Expire the cookie
}

// Prepare the response
$response = [
    'success' => true,
    'message' => 'Logout successful!'
];

// Set header for JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
