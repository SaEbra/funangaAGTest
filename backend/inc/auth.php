<?php
session_start();
$response = ['authenticated' => false];

if (isset($_SESSION['user_id'])) {
    $response['authenticated'] = true;
}

header('Content-Type: application/json');
echo json_encode($response);

?>
