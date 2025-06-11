<?php declare(strict_types=1);
  header('Access-Control-Allow-Origin: http://localhost:5173');
  header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
  header('Access-Control-Allow-Headers: token, Content-Type');
  header('Content-Type: application/json');
  file_put_contents("log.txt", file_get_contents("php://input")); // ghi log request vào file log.txt để kiểm tra dữ liệu gửi lên
  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
  }

  spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});//đăng ký autoload để tự động nạp các class khi cần thiết

set_exception_handler('ErrorHandler::handleException'); // đăng ký hàm xử lý ngoại lệ
   Header('Content-Type: application/json; charset=UTF-8');// điều chỉnh response về dạng json
  
  // kiểm tra xem có phải là request đến cart.php không

  if (basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) !== 'cart.php') {
    http_response_code(404);
    exit;
  }
  $id = $_GET['id'] ?? null;  
  $database = new Database('localhost', 'banhangdb', 'root', '');

  $gateway = new ProductGateway($database);

  $controller = new productControler($gateway);

  $controller->processRequestCart($_SERVER['REQUEST_METHOD'], $id);
  ?>