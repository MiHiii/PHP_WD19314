<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
require_once __DIR__ . '/../models/ProductModel.php';

class AdminController
{
  private $userModel;
  private $categoryModel;
  private $productModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->categoryModel = new CategoryModel();
    $this->productModel = new ProductModel();
  }
  // Admin Dashboard

  public function index()
  {
    // Ensure session is started once
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    // Check if user is admin
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
      $req_mess = 'Bạn cần đăng nhập với tài khoản admin. Ấn "ok" để quay về trang chủ.';
      echo "<script>alert('$req_mess'); setTimeout(function(){ window.location.href = '../index.php'; }, 1000)</script>";
      exit();
    }

    // require_once '/controllers/ProductController.php';
    // require_once '/controllers/UserController.php';

    $productController = new ProductModel();
    $userController = new UserModel();

    // Get products and users data
    $products = $productController->getAllProducts();
    $users = $userController->read();

    // Pass data to the view
    include  __DIR__ . '/../views/admin/index.php';
  }
  // User Management
  public function listUsers()
  {
    $users = $this->userModel->read();
    include __DIR__ . '/../views/admin/user/index.php';
  }

  public function createUser($name, $email, $password)
  {
    if ($this->userModel->create($name, $email, $password)) {
      header("Location: /ecomerce-wd19314/admin/user");
    } else {
      echo "Error creating user.";
    }
  }

  public function updateUser($id)
  {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $currentPassword = isset($_POST['current_password']) ? trim($_POST['current_password']) : '';

    // Fetch the current user data
    $user = $this->userModel->getUserById($id);

    // Verify the current password
    if (password_verify($currentPassword, $user['password'])) {
      // Proceed with the update
      if ($this->userModel->update($id, $name, $email, $phone, $address)) {
        header("Location: /ecomerce-wd19314/admin/user");
      } else {
        echo "Error updating user.";
      }
    } else {
      echo "Current password is incorrect.";
    }
  }

  public function deleteUser($id)
  {
    if ($this->userModel->delete($id)) {
      header("Location: /ecomerce-wd19314/admin/user");
    } else {
      echo "Error deleting user.";
    }
  }

  // Category Management
  public function listCategories()
  {
    $categories = $this->categoryModel->getAllCategories();
    include __DIR__ . '/../views/admin/category/index.php';
  }

  public function createCategory()
  {
    $name = $_POST['name'];
    if ($this->categoryModel->create($name)) {
      header("Location: /ecomerce-wd19314/admin/category");
    } else {
      echo "Error creating category.";
    }
  }

  public function updateCategory($id)
  {
    $name = $_POST['name'];
    if ($this->categoryModel->updateCategory($id, $name)) {
      header("Location: /ecomerce-wd19314/admin/category");
    } else {
      echo "Error updating category.";
    }
  }

  public function deleteCategory($id)
  {
    if ($this->categoryModel->deleteCategory($id)) {
      header("Location: /ecomerce-wd19314/admin/category");
    } else {
      echo "Error deleting category.";
    }
  }

  // Product Management
  public function listProducts()
  {
    $products = $this->productModel->getAllProducts();
    include __DIR__ . '/../views/admin/product/index.php';
  }

  public function createProduct()
  {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $count = $_POST['count'];
    if ($this->productModel->create($name, $price, $category_id, $count)) {
      header("Location: /ecomerce-wd19314/admin/product");
    } else {
      echo "Error creating product.";
    }
  }

  public function edit($id)
  {
    // Get product by id
    $this->productModel->getProductById($id);
    // Load view with product data
    include __DIR__ . "/../views/product/edit.php";
  }

  public function update($id)
  {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $count = $_POST['count'];
    $img = $_POST['img'];
    $des = $_POST['description'];

    // Update the product
    $this->productModel->updateProduct($id, $name, $price, $category_id, $count, $img, $des);

    // Redirect to the product list
    header("Location: /ecomerce-wd19314/admin/product");
  }



  public function delete($id)
  {
    // Delete the product
    $this->productModel->deleteProduct($id);

    // Redirect or load view
    header("Location: /ecomerce-wd19314/admin/product");
  }
}

// Example usage
// $adminController = new AdminController();
// $adminController->listProducts();
