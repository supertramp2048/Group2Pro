<?php

    header('Access-Control-Allow-Origin: http://localhost:5173');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
    }

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
        $sql = "INSERT INTO products (title, price, quantity, category, description, brand) VALUES (:title, :price, :quantity, :category, :description, :brand)"; // câu lệnh SQL để thêm sản phẩm mới vào bảng products

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);//gán giá trị cho tham số trong câu lệnh SQL
        $stmt->bindValue(":price", $data["price"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":quantity", $data["quantity"] ?? 0, PDO::PARAM_INT); // ?? "" => nếu quantity không có thì gán giá trị 0
        $stmt->bindValue(":category", $data["category"] ?? 1, PDO::PARAM_INT);
        $stmt->bindValue(":description", $data["description"] ?? "", PDO::PARAM_STR);
        $stmt->bindValue(":brand", $data["brand"] ?? "", PDO::PARAM_STR);
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
    public function getByCategory(int $category) : array {
        $sql = "SELECT * FROM products WHERE category = :category";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":category", $category, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // trả về tất cả sản phẩm trong danh mục
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

    public function addToCart(int $userId, int $productId) : bool {
        $sql = "INSERT INTO user_cart (userId, productId) VALUES (:userId, :productId)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
        $stmt->bindValue(":productId", $productId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getCarts(int $userId) : array {
        //$sql = "SELECT * FROM user_cart WHERE userid = :user_id";
        $sql = "SELECT 
                    uc.id AS cart_id,
                    uc.userId,
                    uc.productId,
                    uc.addDate,
                    p.title,
                    p.price,
                    p.quantity,
                    p.brand,
                    p.description,
                    p.src
                FROM 
                    user_cart uc
                LEFT JOIN 
                    products p ON uc.productId = p.id
                WHERE 
                    uc.userId = :user_id
                ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllCarts() : array {
        $sql = "SELECT * FROM user_cart";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function removeFromCart(int $userId, int $cartId) : bool {
        $sql = "DELETE FROM user_cart WHERE userId = :userId AND id = :cartId LIMIT 1"; // LIMIT 1 để chỉ xóa một bản ghi, tránh xóa nhiều bản ghi nếu có nhiều sản phẩm cùng userId và productId
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
        $stmt->bindValue(":cartId", $cartId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function clearCart(int $userId) : bool {
        $sql = "DELETE FROM user_cart WHERE userId = :userId"; // xóa tất cả sản phẩm trong giỏ hàng của người dùng
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function paginate(int $category, int $page, int $limit) : array {
        $offset = ($page - 1) * $limit; // tính toán offset dựa trên trang hiện tại và giới hạn số sản phẩm trên mỗi trang
        $sql = "SELECT * FROM products WHERE category = :category LIMIT :limit OFFSET :offset"; // câu lệnh SQL để lấy sản phẩm theo phân trang
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":category", $category, PDO::PARAM_INT);
        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // trả về tất cả sản phẩm trong trang hiện tại
    }
    public function getTotalProducts(int $category) : int {
        $sql = "SELECT COUNT(*) FROM products WHERE category = :category"; // câu lệnh SQL để đếm số sản phẩm trong danh mục
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":category", $category, PDO::PARAM_INT);
        $stmt->execute();
        return (int)$stmt->fetchColumn(); // trả về tổng số sản phẩm trong danh mục
    }
}
?>