<?php
class Database
{
  private $host = 'localhost';
  private $db_name = 'assignment';
  private $username = 'root';
  private $password = '';
  public $conn;

  public function getConnection()
  {
    $this->conn = null;
    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      $this->conn->exec("set names utf8");
      // echo "Connected successfully";
    } catch (PDOException $exception) {
      echo "Connection error: ";
      echo "Connection error: " . $exception->getMessage();
    }

    return $this->conn;
  }
}


// $database = new Database();
// $database->getConnection();
