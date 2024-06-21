<?php
include_once __DIR__ . "/../../configs/database.php";

class ProductModel
{
  private $conn;

  public function __construct()
  {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  public function getAllProducts()
  {
    try {
      $sql = "SELECT * FROM products";
      $stmt = $this->conn->query($sql);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }

  public function getProductById($id)
  {
    try {
      $sql = "SELECT * FROM products WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function create($name, $price, $category_id, $count)
  {
    try {
      $sql = "INSERT INTO products (name, price, category_id, count) VALUES (:name, :price, :category_id, :count)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':price', $price);
      $stmt->bindParam(':category_id', $category_id);
      $stmt->bindParam(':count', $count);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function updateProduct($id, $name, $price, $category_id, $count, $img, $des)
  {
    try {
      $sql = "UPDATE products SET name = :name, price = :price, category_id = :category_id, count = :count, img = :img, des = :des WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':price', $price);
      $stmt->bindParam(':category_id', $category_id);
      $stmt->bindParam(':count', $count);
      $stmt->bindParam(':img', $img);
      $stmt->bindParam(':des', $des);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function deleteProduct($id)
  {
    try {
      $sql = "DELETE FROM products WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
}

// $productModel = new ProductModel();
// //update
// $productModel->updateProduct(3, 'name', 100, 1, 10, 'img', 'des');
