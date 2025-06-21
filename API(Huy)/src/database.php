<?php
    header('Access-Control-Allow-Origin: http://localhost:5173');
    //header('Access-Control-Allow-Origin: http://localhost:5174');//test
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
  class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;

    public function __construct($host, $db_name, $username, $password) {
      $this->host = $host;
      $this->db_name = $db_name;
      $this->username = $username;
      $this->password = $password;
    }

    public function getConnection() : PDO {
     $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
     return new PDO($dsn, $this->username, $this->password, [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_STRINGIFY_FETCHES => false
      ]);
    }
  }
?>