<?php

require_once __DIR__ . '/../../configs/database.php';

class CategoryModel
{
  private $conn;
  private $table_name = "categories";

  public function __construct()
  {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  // Create a new category
  public function create($name)
  {
    try {
      $query = "INSERT INTO " . $this->table_name . " (name) VALUES (:name)";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':name', $name);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  // Get all categories
  public function getAllCategories()
  {
    try {
      $query = "SELECT * FROM " . $this->table_name;
      $stmt = $this->conn->query($query);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }

  // Get a single category by ID
  public function getCategoryById($id)
  {
    try {
      $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  // Update a category
  public function updateCategory($id, $name)
  {
    try {
      $query = "UPDATE " . $this->table_name . " SET name = :name WHERE id = :id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  // Delete a category
  public function deleteCategory($id)
  {
    try {
      $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
}
