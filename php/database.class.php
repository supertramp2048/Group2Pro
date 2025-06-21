<?php
class database {
  protected $connection = null;
  protected $table='';
  protected $statement= null;
  protected $limit = 15;
  protected $offset = 0;
  protected $host ="";
  protected $user ="";
  protected $pass ="";
  protected $name ="";

  public function __construct($config)
  {
    $this->host = $config['host'];
    $this->user = $config['user']; 
    $this->pass = $config['pass'];
    $this->name = $config['name'];
    //=> khởi tạo các biến kết nối với database.
    $this->connect();
  }

  protected function connect()
  {
    $this->connection = new mysqli(
      $this->host, 
      $this->user, 
      $this->pass, 
      $this->name
    );//=> khởi tạo kết nối với database.
    if ($this->connection->connect_errno) {
      exit($this->connection->connect_error);
    }//=> nếu kết nối không thành công thì sẽ thoát khỏi chương trình và in ra lỗi kết nối.
  }
  public function table($tablename){
    $this->table = $tablename;
    return $this;//fluent interface: trả về chính nó để có thể gọi liên tiếp hàm.
  }

  public function limit($limit){
    $this->limit = $limit;
    return $this;
  }

  public function offset($offset){
    $this->offset = $offset;
    return $this;
  }

  public function resetQuery(){
    $this->table = '';
    $this->limit = 15;
    $this->offset = 0;
  }

  public function get(){
    $sql = "SELECT * FROM $this->table LIMIT ? OFFSET ?";
    $this->statement = $this->connection->prepare($sql);
    $this->statement->bind_param('ii',$this->limit,$this->offset);//=> 'ii' là kiểu dữ liệu của limit và offset, ở đây là kiểu số nguyên. 
    $this->statement->execute();  
    $this->resetQuery();

    $result = $this->statement->get_result();

    $returnData = [];
    while($row = $result->fetch_assoc()){
      $returnData[] = $row;
    }//=> fetch_assoc() sẽ trả về 1 mảng kết hợp với các trường trong bảng database.
    return $returnData;
  }

  public function insert($data=[]){
    $fields = implode(',',array_keys($data));//=> nối các phần tử trong mảng data thành 1 chuỗi.
    //echo $fields;
    $questionMarkArr = array_fill(0,count($data),'?');//=> tạo mảng có số phần tử bằng số phần tử của data đưa vào với giá trị các phần tử là '?'.
    //print_r($questionMarkArr);
    $ValueQMarks = implode(',',$questionMarkArr);//=> tạo chuõi
    //print_r($ValueQMarks);
    $sql = "INSERT INTO $this->table($fields) Value($ValueQMarks)";//=> tự sinh trưởng và số lượng giá trị tương ứng với database truyền vào. Vd: với database banhangdb thì sẽ tự sinh ra lệnh: $sql = "INSERT INTO $this->table(TenHang,DonVi,DonGia,SoLuong) Value(?,?,?,?)"; . 
    //echo $sql;
    $this->statement = $this->connection->prepare($sql);
    $this->statement->bind_param(str_repeat('s',count($data)),...array_values($data));//=> str_repeat('s',count($data)) sẽ tạo ra chuỗi 'ssss' với số lượng phần tử trong mảng data truyền vào.

    $this->statement->execute();
    $this->resetQuery();
  }


  public function updateRow($userId, $data=[]){ 
    $keyValue = [];
    foreach($data as $key => $value){
      $keyValue[] = "$key=?";
    }//=> tạo mảng với các phần tử là tên trường và dấu hỏi, ví dụ: ['TenHang=?','DonVi=?','DonGia=?','SoLuong=?'].

    $setFields = implode(',', $keyValue);


    $values = array_values($data);//=> lấy giá trị của mảng data truyền vào.
    $values[] = $userId; //=> thêm userId vào cuối mảng values để truyền vào câu lệnh update.
    $sql = "UPDATE $this->table SET UserName=?, Email=? WHERE UserId=?";
    $this->statement = $this->connection->prepare($sql);
    $dataTypes = str_repeat('s', count($data)) . 'i'; //=> tạo chuỗi kiểu dữ liệu với số lượng phần tử trong mảng data truyền vào, và 'i' là kiểu dữ liệu của userId, ở đây là kiểu số nguyên.
    $this->statement->bind_param($dataTypes, ...$values);

    $this->statement->execute();
    $this->resetQuery();
    return $this->statement->affected_rows; //=> trả về số dòng bị ảnh hưởng bởi câu lệnh update.
  }

  public function deleteId($id){
    $sql = "DELETE FROM $this->table WHERE HangId=?";
    $this->statement = $this->connection->prepare($sql);
    $this->statement->bind_param('i',$id);//=> 'i' là kiểu dữ liệu của id, ở đây là kiểu số nguyên.
    $this->statement->execute();
    $this->resetQuery();
    return $this->statement->affected_rows;//=> trả về số dòng bị ảnh hưởng bởi câu lệnh delete.
  }

  public function where($value){
    $sql = "SELECT * FROM $this->table WHERE UserName=?";
    $this->statement = $this->connection->prepare($sql);
    $this->statement->bind_param('s', $value);//=> 's' là kiểu dữ liệu của value, ở đây là kiểu chuỗi.
    $this->statement->execute();
    $result = $this->statement->get_result();
    $returnData = [];   
    while($row = $result->fetch_assoc()){
      $returnData[] = $row;
    }//=> fetch_assoc() sẽ trả về 1 mảng kết hợp với các trường trong bảng database.
    $this->resetQuery();
    return $returnData; //=> trả về mảng kết hợp với các trường trong bảng database.
  }

}
?>