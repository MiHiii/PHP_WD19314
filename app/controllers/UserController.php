<?php

require_once __DIR__ . '/../models/UserModel.php';

class UserController
{
  private $model;

  public function __construct()
  {
    $this->model = new UserModel();
  }

  // List all users
  public function index()
  {
    $users = $this->model->read();
    include __DIR__ . '/../views/user/index.php';
  }

  // Show user by ID
  public function show($id)
  {
    $user = $this->model->getUserById($id);
    include __DIR__ . '/../views/user/show.php';
  }

  public function showCreateForm()
  {
    include __DIR__ . '/../views/user/create.php';
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = isset($_POST['name']) ? trim($_POST['name']) : '';
      $email = isset($_POST['email']) ? trim($_POST['email']) : '';
      $password = isset($_POST['password']) ? trim($_POST['password']) : '';

      // Kiểm tra dữ liệu đầu vào
      if (!empty($name) && !empty($email) && !empty($password)) {
        // In ra các giá trị để debug
        echo "Name: $name<br>";
        echo "Email: $email<br>";
        echo "Password: $password<br>";

        // Gọi model để tạo người dùng
        if ($this->model->create($name, $email, $password)) {
          echo "User created successfully.";
          // Dừng script để tránh việc in ra lỗi phía dưới sau khi đã điều hướng
          header("Location: /ecomerce-wd19314");
          exit();
        } else {
          echo "Error creating user. Please try again.";
          $this->showCreateForm();
        }
      } else {
        echo "Error creating user. Please provide name, email, and password.";
        $this->showCreateForm();
      }
    } else {
      echo "Invalid request method.";
      $this->showCreateForm();
    }
  }


  // Show the edit form for a user
  public function edit($id)
  {
    $user = $this->model->getUserById($id);
    include __DIR__ . '/../views/admin/user/edit.php';
  }

  // Update a user
  public function update($id)
  {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $currentPassword = isset($_POST['current_password']) ? trim($_POST['current_password']) : '';

    // Fetch the current user data
    $user = $this->model->getUserById($id);

    // Verify the current password
    if (password_verify($currentPassword, $user['password'])) {
      // Proceed with the update
      if ($this->model->update($id, $name, $email, $phone, $address)) {
        header("Location: /ecomerce-wd19314/admin/user");
      } else {
        echo "Error updating user.";
      }
    } else {
      echo "Current password is incorrect.";
    }
  }


  // Delete a user
  public function delete($id)
  {
    if ($this->model->delete($id)) {
      header("Location: /ecomerce-wd19314/admin/users");
    } else {
      echo "Error deleting user.";
    }
  }

  // Authenticate a user
  public function authenticate($email, $password)
  {
    $user = $this->model->authenticate($email, $password);
    if ($user) {
      // Set session or token
      session_start();
      $_SESSION['user'] = $user;
      header("Location: /dashboard");
    } else {
      header("Location: /login?error=invalid_credentials");
    }
  }
}
