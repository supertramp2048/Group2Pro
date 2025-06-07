<?php
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

    header('Access-Control-Allow-Origin: http://localhost:5173');
    //header('Access-Control-Allow-Origin: http://localhost:5174');//test
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
   class ProductGateway {
    private PDO $conn;

    public function __construct(Database $database) {
        $this->conn = $database->getConnection(); // lấy dữ liệu từ database và thiết lập kết nối
    }

    public function getAllProducts() : array {
        $stmt = $this->conn->prepare("SELECT * FROM products");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function create(array $data) {
        $sql = "INSERT INTO products (title, unit, price, quantity, views, category) VALUES (:title, :unit, :price, :quantity, :views, :category)"; // câu lệnh SQL để thêm sản phẩm mới vào bảng products

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);//gán giá trị cho tham số trong câu lệnh SQL
        $stmt->bindValue(":unit", $data["unit"] ?? "", PDO::PARAM_STR);
        $stmt->bindValue(":price", $data["price"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":quantity", $data["quantity"] ?? 0, PDO::PARAM_INT); // ?? "" => nếu quantity không có thì gán giá trị 0
        $stmt->bindValue(":views", $data["views"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":category", $data["category"] ?? 1, PDO::PARAM_INT);
        $stmt->execute();

        return $this->conn->lastInsertId(); // trả về id của sản phẩm vừa được thêm vào
    }

    public function get(int $id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(array $current, array $new) : int {
        $sql = "UPDATE products SET title = :title, unit = :unit, price = :price, quantity = :quantity, views = :views, category = :category WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $current["id"], PDO::PARAM_INT);//không cập nhật id nên gán id hiện tại vào câu lệnh SQL
        $stmt->bindValue(":title", $new["title"] ?? $current["title"], PDO::PARAM_STR);// truong hợp không có title mới thì dùng title cũ
        $stmt->bindValue(":unit", $new["unit"] ?? $current["unit"], PDO::PARAM_STR);
        $stmt->bindValue(":price", $new["price"] ?? $current["price"], PDO::PARAM_INT);
        $stmt->bindValue(":quantity", $new["quantity"] ?? $current["quantity"], PDO::PARAM_INT);
        $stmt->bindValue(":views", $new["views"] ?? $current["views"], PDO::PARAM_INT);
        $stmt->bindValue(":category", $new["category"] ?? $current["category"], PDO::PARAM_INT);
        $stmt->execute();

        return (int)$current["id"];
    }

    public function delete(int $id) : int {
        $sql = "DELETE FROM products WHERE id = :id";//:iod là tham số trong câu lệnh SQL, sẽ được gán giá trị sau
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);// gán giá trị cho tham số trong câu lệnh SQL
        $stmt->execute();
        return $id;
    }

   }
?>