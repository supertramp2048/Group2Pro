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

  public function processRequest(string $method, ?string $id) :void {
    /*có 2 phần: 1 có id, 1 không
     + phần có id -> truy cập vào dòng cụ thể với id cho trước (resource request )
     + phần k có id -> truy cập tất cả các dòng (collection request) */
     if($id) {
      $this->processResourceRequest($method, $id);
     } else {
      $this->processCollectionRequest($method);
     }
  }

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
          throw new Exception('Title and price are required fields');
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


}

?>