<?php
// get-session.php
session_start();
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
//$_SESSION['userName'] = 'long';
if (isset($_SESSION['userName'])) {
    echo json_encode([
        'loggedIn' => true,
        'username' => $_SESSION['userName'],
        'userId' => $_SESSION['userId']
    ]);
} else {
    echo json_encode([
        'loggedIn' => false
    ]);
}
