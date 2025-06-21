<?php declare(strict_types=1);
  header('Access-Control-Allow-Origin: http://localhost:5173');
  header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
  header('Access-Control-Allow-Headers: token, Content-Type');
  header('Content-Type: application/json');

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
  }

  spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});//đăng ký autoload để tự động nạp các class khi cần thiết

set_exception_handler('ErrorHandler::handleException'); // đăng ký hàm xử lý ngoại lệ
   Header('Content-Type: application/json; charset=UTF-8');// điều chỉnh response về dạng json
  
  // kiểm tra xem có phải là request đến index.php không

  if (basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) !== 'index.php') {
    http_response_code(404);
    exit;
  }
  //$id = $parts[3] ?? null;
  $id = $_GET['id'] ?? null;
  $category = $_GET['category'] ?? null;
  $page = $_GET['page'] ?? null;
  $limit = $_GET['limit'] ?? null;
  $database = new Database('localhost', 'banhangdb', 'root', ''); // khởi tạo đối tượng Database với các thông tin kết nối đến database


  //$database->getConnection(); // khởi tạo kết nối đến database => bỏ vì đã được khởi tạo trong ProductGateway
  
  $gateway = new ProductGateway($database); // khởi tạo gateway để truy cập dữ liệu sản phẩm, nếu gateway cần thì sẽ tự động gọi ham getConnection() của Database để lấy đối tượng PDO

  $totalProducts = $gateway->getTotalProducts((int)$category); // lấy tổng số sản phẩm từ database để tính toán phân trang
  header("X-Total-Count: $totalProducts");
  header("Access-Control-Expose-Headers: X-Total-Count");

  $controller = new productControler($gateway); // khởi tạo controller để xử lý các request liên quan đến sản phẩm, đưa gateway vào để controller thồng qua gateway để lấy dữ liệu sản phẩm
  // Mặc định PDO sẽ ép kiểu dữ liệu về dạng chuỗi => dùng [PDO::ATTR_EMULATE_PREPARES => false] để tắt tính năng ép kiểu về dạng chuỗi.
  // Mặc định PDO sẽ xử lý "?" trong prepare statement rồi mới gửi đi => [PDO::ATTR_STRINGIFY_FETCHES => false] PDO gửi câu SQL có "?" đến Mysql xử lý, tránh SQL injection và tăng tốc độc truy vấn. 

  //PDO::<opions>: là các lựa chọn chỉ dịnh cấu hình của PDO, có thể được truyền vào khi khởi tạo đối tượng PDO.
  // Phương thức truyền PATCH
  $controller->processRequest($_SERVER['REQUEST_METHOD'], $id, $category, $page, $limit);
  ?>