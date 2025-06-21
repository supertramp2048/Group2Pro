<?php
session_start();

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:5173"); // Đổi đúng origin FE
header("Access-Control-Allow-Credentials: true");

// Hủy toàn bộ session
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Phản hồi JSON
echo json_encode(["message" => "Đã đăng xuất"]);
?>
