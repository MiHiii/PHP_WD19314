<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  public function showLoginForm()
  {
    // echo "showLoginForm method called.<br>";
    include __DIR__ . '/../views/auth/login.php';
  }

  public function login()
  {
    // Lấy dữ liệu từ POST
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $this->userModel->authenticate($email, $password);
    if ($user) {
      // Đăng nhập thành công
      $userData = $this->userModel->getUserByEmail($email);
      $userId = $userData['id']; // Lấy ID của người dùng đã xác thực
      $userDetails = $this->userModel->getUserById($userId); // Lấy thông tin chi tiết của người dùng
      if ($userDetails['role'] == 'admin') {
        header("Location: /ecomerce-wd19314/admin");
      } else {
        header("Location: /ecomerce-wd19314");
      }
    } else {
      // Đăng nhập thất bại
      echo "Invalid email or password.";
    }
  }



  public function logout()
  {
    session_start();
    session_destroy();
    header("Location: /ecomerce-wd19314/");
  }
}


// $authController = new AuthController();
// $authController->login('user1@gmail.com', 'user1');
