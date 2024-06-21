<?php

require_once __DIR__ . '/../../configs/database.php';

class UserModel
{
  private $conn;
  private $table_name = "users";

  public function __construct()
  {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  // Create a new user
  public function create($name, $email, $password)
  {
    try {
      $query = "INSERT INTO " . $this->table_name . " SET name=:name, email=:email, password=:password";
      $stmt = $this->conn->prepare($query);

      $hashed_password = password_hash($password, PASSWORD_BCRYPT);

      $stmt->bindParam(":name", $name);
      $stmt->bindParam(":email", $email);
      $stmt->bindParam(":password", $hashed_password);

      if ($stmt->execute()) {
        return true;
      }
      return false;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  // Get all users
  public function read()
  {
    try {
      $query = "SELECT * FROM " . $this->table_name;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }

  // Get a single user by ID
  public function getUserById($id)
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

  // Update a user
  public function update($id, $name, $email, $phone, $address)
  {
    try {
      $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':phone', $phone);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);

      if ($stmt->execute()) {
        return true;
      }
      return false;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }


  // Delete a user
  public function delete($id)
  {
    try {
      $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);

      if ($stmt->execute()) {
        return true;
      }
      return false;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  // Authenticate a user
  public function authenticate($email, $password)
  {
    try {
      $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user && password_verify($password, $user['password'])) {
        //Lưu vào session
        session_start();
        $_SESSION['user'] = $user;
        print_r($_SESSION['user']);

        // echo "User authenticated";
        return $user;
      }
      return false;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  public function getUserByEmail($email)
  {
    try {
      $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
}

// $userModel = new UserModel();
// $userModel->authenticate('user3@gmail.com', 'user3');
