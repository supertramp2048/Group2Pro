<?php
    header('Access-Control-Allow-Origin: http://localhost:5173');
    //header('Access-Control-Allow-Origin: http://localhost:5174');//test
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
    }

class productControler {

  private ProductGateway $gateway;
  public function __construct(ProductGateway $gateway) {
    $this->gateway = $gateway;
  }

  public function processRequest(string $method, ?string $id, ?string $category, ?string $page, ?string $limit) :void {
    /*có 2 phần: 1 có id, 1 không
     + phần có id -> truy cập vào dòng cụ thể với id cho trước (resource request )
     + phần k có id -> truy cập tất cả các dòng (collection request) */
     if($id) {
      $this->processResourceRequest($method, $id);
     } 
     else if($category && $page && $limit) {
      $this->processPaginationRequest($method, $category, $page, $limit);
     }
     else if($category) {
      $this->processCategoryRequest($method, $category);
     }
     else {
      $this->processCollectionRequest($method);
     }
  }

  public function processRequestCart(string $method, ?string $userId) :void {
    if($userId) {
      $this->processResourceCartRequest($method, $userId);
    } else {
      $this->processCollectionCartRequest($method);
    }
  }

  /*public function processRequestCategory(string $method, ?string $category) :void {
    if($category) {
      $this->processCategoryRequest($method, $category);
    } 
  }*/

  private function processResourceRequest(string $method, string $id) :void {
    // trong bất cứ trường hợp nào, t đều phải kiểm tra id có trong database hay không
    $product = $this->gateway->get($id); // lấy sản phẩm theo id
    if(!$product) {
      http_response_code(404); // trả về mã trạng thái 404 Not Found nếu không tìm thấy sản phẩm
      echo json_encode(['message' => 'Product not found']);
      return;
    }
    switch($method) {
      case 'GET':
        // lấy sản phẩm theo id
        echo json_encode($product);
        break;
      case 'PATCH':
        $data = [];
        parse_str(file_get_contents("php://input"), $data); // vì PATCH không gửi dữ liệu qua $_POST nên phải dùng hàm này để lấy dữ liệu từ request body
        if(! $data) {
          throw new ErrorException('No data provided for update');//không có dữ liệu để cập nhật
        }

        $id = $this->gateway->update($product, $data); // cập nhật sản phẩm
        echo json_encode([
          'id' => $id,
          'message' => 'Product updated successfully'
        ]);
      case 'DELETE':
        $row = $this->gateway->delete($id); // gọi hàm delete để xóa sản phẩm
        echo json_encode([
          'id' => $row,
          'message' => 'Product deleted successfully'
        ]);
        break;
      default:
        http_response_code(405); // trả về mã trạng thái 405 Method Not Allowed
        header('Allow: GET, PATCH, DELETE'); // thông báo các phương thức được hỗ trợ
        break;
    }
  }

  private function processCollectionRequest(string $method) :void {
    // xử lý các request không có id
    switch($method) {
      case 'GET':
        // lấy danh sách sản phẩm

        echo json_encode($this->gateway->getAllProducts());
        break;
      case 'POST': //Post => thêm sản phẩm mới
        // thêm sản phẩm mới
        $data = $_POST;
        if(empty($data['title']) || empty($data['price'])) {
          throw new Exception('title and price are required fields');
        }
        $id = $this->gateway->create($data);// id của sản phẩm mới được tạo sẽ được trả về từ hàm create trong ProductGateway

        http_response_code(201); // trả về mã trạng thái 201 Created
        echo json_encode([
          'id' => $id,
          'message' => 'Product created successfully'
        ]);
        break;
      default:
        http_response_code(405); // trả về mã trạng thái 405 Method Not Allowed
        header('Allow: GET, POST'); // thông báo các phương thức được hỗ trợ
        break;
    }
  }

  private function processCategoryRequest(string $method, string $category) :void {
    switch($method) {
      case 'GET':
        // lấy danh sách sản phẩm theo category
        echo json_encode($this->gateway->getByCategory($category));
        break;
      default:
        http_response_code(405); // trả về mã trạng thái 405 Method Not Allowed
        header('Allow: GET'); // thông báo các phương thức được hỗ trợ
        break;
    }
  }

  private function processResourceCartRequest(string $method, string $userId) :void {
    // xử lý các request có userId
    switch($method) {
      case 'GET':
        // lấy giỏ hàng của người dùng
        echo json_encode($this->gateway->getCarts($userId));
        break;
      case 'POST':
        // thêm sản phẩm vào giỏ hàng
        $data = json_decode(file_get_contents("php://input"), true); // lấy dữ liệu từ request body, $_POST không hoạt động vì front-end fetch với headers: {'Content-Type': 'application/json'},body: JSON.stringify(data)
        if(empty($data['productId'])) {
          throw new Exception('productId is required field');
        }
        $id = $this->gateway->addToCart($userId, $data['productId']);
        http_response_code(201); // trả về mã trạng thái 201 Created
        echo json_encode([
          'id' => $id,
          'message' => 'Product added to cart successfully'
        ]);
        break;
      case 'DELETE':
        // xóa sản phẩm khỏi giỏ hàng
        $data = json_decode(file_get_contents("php://input"), true);
        if(empty($data['cart_id'])) {
          $row = $this->gateway->clearCart($userId); // xóa tất cả sản phẩm trong giỏ hàng
        }
        else {
          $row = $this->gateway->removeFromCart($userId, $data['cart_id']);
          echo json_encode([
            'id' => $row,
            'message' => 'Product removed from cart successfully'
          ]);
        }
        break;
      default:
        http_response_code(405); // trả về mã trạng thái 405 Method Not Allowed
        header('Allow: GET, POST, DELETE'); // thông báo các phương thức được hỗ trợ
        break;

    }
  }
  private function processCollectionCartRequest(string $method) :void {
    // xử lý các request không có userId và productId
    switch($method) {
      case 'GET':
        // lấy danh sách giỏ hàng của tất cả người dùng
        echo json_encode($this->gateway->getAllCarts());
        break;
      default:
        http_response_code(405); // trả về mã trạng thái 405 Method Not Allowed
        header('Allow: GET'); // thông báo các phương thức được hỗ trợ
        break;
    }
  }
  private function processPaginationRequest(string $method, string $category, string $page, string $limit) :void {
    switch($method) {
      case 'GET':
        // lấy danh sách sản phẩm theo phân trang
        echo json_encode($this->gateway->paginate($category, $page, $limit));
        break;
      default:
        http_response_code(405); // trả về mã trạng thái 405 Method Not Allowed
        header('Allow: GET'); // thông báo các phương thức được hỗ trợ
        break;
    }
  }
}

?>